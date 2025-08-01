<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookPurchaseResource\Pages;
use App\Filament\Resources\BookPurchaseResource\RelationManagers;
use App\Models\BookPurchase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookPurchaseResource extends Resource
{
    protected static ?string $model = BookPurchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart'; // Ikon lebih relevan

    protected static ?string $navigationLabel = 'Book Purchases';

    protected static ?string $modelLabel = 'Book Purchase';

    protected static ?string $pluralModelLabel = 'Book Purchases';

    protected static ?string $navigationGroup = 'eLibrary Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('User'),
                Forms\Components\Select::make('book_id')
                    ->relationship('book', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Book'),
                Forms\Components\TextInput::make('amount_paid')
                    ->numeric()
                    ->prefix('Rp ')
                    ->required()
                    ->label('Amount Paid')
                    ->rules(['min:0']), // Validasi tambahan
                Forms\Components\DateTimePicker::make('purchase_date')
                    ->default(now())
                    ->required()
                    ->label('Purchase Date'),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'balance' => 'Balance',
                        'credit_card' => 'Credit Card',
                        'bank_transfer' => 'Bank Transfer',
                        'e_wallet' => 'E-Wallet',
                        'cash' => 'Cash',
                    ])
                    ->default('balance')
                    ->required()
                    ->label('Payment Method'),
                Forms\Components\TextInput::make('transaction_id')
                    ->maxLength(255)
                    ->label('Transaction ID')
                    ->helperText('Optional transaction ID for external payment systems'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('book.title')
                    ->label('Book')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->label('Amount')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchase_date')
                    ->label('Purchase Date')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('payment_method')
                    ->label('Payment Method')
                    ->colors([
                        'primary' => 'balance',
                        'success' => 'credit_card',
                        'warning' => 'bank_transfer',
                        'info' => 'e_wallet',
                        'secondary' => 'cash',
                    ]),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'balance' => 'Balance',
                        'credit_card' => 'Credit Card',
                        'bank_transfer' => 'Bank Transfer',
                        'e_wallet' => 'E-Wallet',
                        'cash' => 'Cash',
                    ])
                    ->label('Payment Method'),
                Tables\Filters\SelectFilter::make('user_id') // Filter tambahan
                    ->relationship('user', 'name')
                    ->label('User'),
                Tables\Filters\Filter::make('purchase_date')
                    ->form([
                        Forms\Components\DatePicker::make('purchase_from')
                            ->label('Purchase From'),
                        Forms\Components\DatePicker::make('purchase_until')
                            ->label('Purchase Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['purchase_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('purchase_date', '>=', $date),
                            )
                            ->when(
                                $data['purchase_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('purchase_date', '<=', $date),
                            );
                    })
                    ->label('Purchase Date Range'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('view_book')
                        ->label('View Book')
                        ->icon('heroicon-o-book-open')
                        ->url(fn(BookPurchase $record): string => route('books.show', $record->book_id))
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('view_user')
                        ->label('View User')
                        ->icon('heroicon-o-user')
                        ->url(fn(BookPurchase $record): string => route('filament.admin.resources.users.edit', $record->user_id))
                        ->openUrlInNewTab(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('purchase_date', 'desc');
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
            'index' => Pages\ListBookPurchases::route('/'),
            'create' => Pages\CreateBookPurchase::route('/create'),
            'edit' => Pages\EditBookPurchase::route('/{record}/edit'),
        ];
    }
}