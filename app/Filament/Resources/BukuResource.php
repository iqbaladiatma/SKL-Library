<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuResource\Pages;
use App\Filament\Resources\BukuResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BukuResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'eLibrary Books';

    protected static ?string $modelLabel = 'Book';

    protected static ?string $pluralModelLabel = 'Books';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Book Information')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Judul Buku'),

                                Forms\Components\TextInput::make('author')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Penulis'),

                                Forms\Components\Textarea::make('description')
                                    ->required()
                                    ->rows(4)
                                    ->label('Deskripsi/Sinopsis'),

                                Forms\Components\TextInput::make('isbn')
                                    ->maxLength(20)
                                    ->label('ISBN'),

                                Forms\Components\TextInput::make('published_year')
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(date('Y') + 1)
                                    ->label('Tahun Terbit'),

                                Forms\Components\TextInput::make('pages')
                                    ->numeric()
                                    ->minValue(1)
                                    ->label('Jumlah Halaman'),

                                Forms\Components\Select::make('language')
                                    ->options([
                                        'Indonesian' => 'Bahasa Indonesia',
                                        'English' => 'English',
                                        'Arabic' => 'العربية',
                                        'Chinese' => '中文',
                                        'Japanese' => '日本語',
                                        'Korean' => '한국어',
                                    ])
                                    ->default('Indonesian')
                                    ->label('Bahasa'),

                                Forms\Components\TextInput::make('category')
                                    ->maxLength(100)
                                    ->label('Kategori'),

                                Forms\Components\TextInput::make('stock')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->label('Stok Tersedia'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Content & Media')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('3:4')
                                    ->directory('images')
                                    ->nullable()
                                    ->label('Legacy Image')
                                    ->helperText('Legacy image field (optional)'),

                                Forms\Components\FileUpload::make('cover_image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageCropAspectRatio('3:4')
                                    ->directory('covers')
                                    ->nullable()
                                    ->label('Cover Image')
                                    ->helperText('Upload cover image dengan rasio 3:4'),

                                Forms\Components\Textarea::make('content')
                                    ->rows(10)
                                    ->nullable()
                                    ->label('Content (HTML)')
                                    ->helperText('Konten HTML untuk pembacaan online'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Premium Settings')
                            ->schema([
                                Forms\Components\Toggle::make('is_premium')
                                    ->label('Premium Content')
                                    ->helperText('Aktifkan untuk menjadikan buku berbayar')
                                    ->reactive(),

                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->minValue(0)
                                    ->prefix('Rp ')
                                    ->visible(fn(Forms\Get $get): bool => $get('is_premium'))
                                    ->label('Harga')
                                    ->helperText('Harga dalam Rupiah'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->circular()
                    ->size(50),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),

                Tables\Columns\IconColumn::make('is_premium')
                    ->label('Premium')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->visible(fn(): bool => true),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match (true) {
                        $state > 10 => 'success',
                        $state > 0 => 'warning',
                        default => 'danger',
                    }),

                Tables\Columns\TextColumn::make('published_year')
                    ->label('Tahun')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(fn() => Book::distinct()->pluck('category', 'category')->filter()->toArray())
                    ->label('Kategori'),

                Tables\Filters\TernaryFilter::make('is_premium')
                    ->label('Premium Content'),

                Tables\Filters\SelectFilter::make('language')
                    ->options([
                        'Indonesian' => 'Bahasa Indonesia',
                        'English' => 'English',
                        'Arabic' => 'العربية',
                        'Chinese' => '中文',
                        'Japanese' => '日本語',
                        'Korean' => '한국어',
                    ])
                    ->label('Bahasa'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_premium')
                        ->label('Mark as Premium')
                        ->icon('heroicon-o-star')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['is_premium' => true]);
                            });
                        })
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('mark_free')
                        ->label('Mark as Free')
                        ->icon('heroicon-o-star')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['is_premium' => false, 'price' => 0]);
                            });
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBukus::route('/'),
            'create' => Pages\CreateBuku::route('/create'),
            'edit' => Pages\EditBuku::route('/{record}/edit'),
        ];
    }
}
