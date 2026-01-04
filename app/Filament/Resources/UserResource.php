<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $pluralLabel = 'Users';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto Profil')
                    ->image()
                    ->directory('users')
                    ->disk('public')
                    ->imageEditor()
                    ->circleCropper() 
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('nomor_karyawan')
                    ->label('Nomor Karyawan')
                    ->unique(ignoreRecord: true)
                    ->maxLength(50)
                    ->visible(fn ($get) => in_array($get('role'), ['admin', 'staff']))
                    ->required(fn ($get) => in_array($get('role'), ['admin', 'staff'])),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'staff' => 'Staff',
                        'user'  => 'User',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => $record === null)
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->hiddenOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular() 
                    ->size(45),

                Tables\Columns\TextColumn::make('nomor_karyawan')
                    ->label('No. Karyawan')
                    ->toggleable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('role')
                    ->colors([
                        'danger' => 'admin',
                        'warning' => 'staff',
                        'success' => 'user',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'staff' => 'Staff',
                        'user' => 'User',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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