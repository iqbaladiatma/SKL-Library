<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Users';

    protected static ?string $modelLabel = 'User';

    protected static ?string $pluralModelLabel = 'Users';

    protected static ?string $navigationGroup = 'eLibrary Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('User Information')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Full Name'),

                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->label('Email Address'),

                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->dehydrated(fn($state) => filled($state))
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->label('Password'),

                                Forms\Components\Toggle::make('is_admin')
                                    ->label('Admin Access')
                                    ->helperText('Give this user admin privileges'),
                            ]),

                        Forms\Components\Tabs\Tab::make('eLibrary Settings')
                            ->schema([
                                Forms\Components\TextInput::make('balance')
                                    ->numeric()
                                    ->prefix('Rp ')
                                    ->default(0)
                                    ->label('Account Balance')
                                    ->helperText('User\'s current balance for purchasing books'),

                                Forms\Components\Select::make('subscription_type')
                                    ->options([
                                        'free' => 'Free',
                                        'basic' => 'Basic',
                                        'premium' => 'Premium',
                                        'enterprise' => 'Enterprise',
                                    ])
                                    ->default('free')
                                    ->label('Subscription Type'),

                                Forms\Components\DateTimePicker::make('subscription_expires_at')
                                    ->label('Subscription Expires At')
                                    ->helperText('Leave empty for free users'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-user')
                    ->trueColor('danger')
                    ->falseColor('success'),

                Tables\Columns\TextColumn::make('balance')
                    ->label('Balance')
                    ->money('IDR')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match (true) {
                        $state > 100000 => 'success',
                        $state > 10000 => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\BadgeColumn::make('subscription_type')
                    ->label('Subscription')
                    ->colors([
                        'gray' => 'free',
                        'primary' => 'basic',
                        'warning' => 'premium',
                        'success' => 'enterprise',
                    ]),

                Tables\Columns\TextColumn::make('subscription_expires_at')
                    ->label('Expires')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_admin')
                    ->label('Admin Users'),

                Tables\Filters\SelectFilter::make('subscription_type')
                    ->options([
                        'free' => 'Free',
                        'basic' => 'Basic',
                        'premium' => 'Premium',
                        'enterprise' => 'Enterprise',
                    ])
                    ->label('Subscription Type'),

                Tables\Filters\Filter::make('has_balance')
                    ->label('Has Balance')
                    ->query(fn(Builder $query): Builder => $query->where('balance', '>', 0)),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('add_balance')
                        ->label('Add Balance')
                        ->icon('heroicon-o-plus-circle')
                        ->form([
                            Forms\Components\TextInput::make('amount')
                                ->numeric()
                                ->required()
                                ->prefix('Rp ')
                                ->label('Amount to Add'),
                        ])
                        ->action(function (User $record, array $data): void {
                            $record->increment('balance', $data['amount']);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Add Balance')
                        ->modalDescription('Add balance to user account')
                        ->modalSubmitActionLabel('Add Balance'),

                    Tables\Actions\Action::make('reset_balance')
                        ->label('Reset Balance')
                        ->icon('heroicon-o-arrow-path')
                        ->color('danger')
                        ->action(function (User $record): void {
                            $record->update(['balance' => 0]);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Reset Balance')
                        ->modalDescription('Set user balance to zero')
                        ->modalSubmitActionLabel('Reset Balance'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('make_admin')
                        ->label('Make Admin')
                        ->icon('heroicon-o-shield-check')
                        ->action(function ($records): void {
                            $records->each(function ($record) {
                                $record->update(['is_admin' => true]);
                            });
                        })
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('remove_admin')
                        ->label('Remove Admin')
                        ->icon('heroicon-o-user')
                        ->action(function ($records): void {
                            $records->each(function ($record) {
                                $record->update(['is_admin' => false]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
