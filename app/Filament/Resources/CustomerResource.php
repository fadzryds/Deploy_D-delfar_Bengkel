<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Customer';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([

            Forms\Components\Select::make('user_id')
                ->label('Akun User')
                ->relationship('user', 'name')
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, callable $set) {
                    $user = User::find($state);
                    if ($user) {
                        $set('nama_pelanggan', $user->name);
                        $set('email', $user->email);
                    }
                }),

            Forms\Components\TextInput::make('nama_pelanggan')
                ->label('Nama Customer')
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('no_hp')
                ->label('Nomor Handphone')
                ->required()
                ->maxLength(20),

            Forms\Components\TextInput::make('email')
                ->label('Email Customer')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('Option')
                ->label('Jenis Customer')
                ->options([
                    'Cust-Service'   => 'Customer Service',
                    'Cust-Sparepart' => 'Customer Sparepart',
                ])
                ->default('Cust-Service')
                ->required(),

        ])->columns(2);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nama_pelanggan')
                    ->label('Nama Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No HP'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\TextColumn::make('Option')
                    ->label('JenisCust'),

            ])
            
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
