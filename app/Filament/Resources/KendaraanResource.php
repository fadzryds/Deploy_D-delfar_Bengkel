<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KendaraanResource\Pages;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Data Kendaraan';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([

            Forms\Components\Select::make('customer_id')
                ->label('Nama Customer')
                ->relationship('customer', 'nama_pelanggan')
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('nomor_polisi')
                ->label('Nomor Polisi')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('jenis_motor')
                ->label('Jenis Motor')
                ->required(),

            Forms\Components\TextInput::make('tipe_kendaraan')
                ->label('Tipe Kendaraan')
                ->required(),

            Forms\Components\TextInput::make('status')
                    ->label('Status Kendaraan')
                    ->disabled()
                    ->dehydrated(false)
                    ->default('Booked'),

        ])->columns(2);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nomor_polisi')
                    ->label('Nomor Polisi')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer.nama_pelanggan')
                    ->label('Customer')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_motor')
                    ->label('Jenis Motor'),

                Tables\Columns\TextColumn::make('tipe_kendaraan')
                    ->label('Tipe'),

                Tables\Columns\BadgeColumn::make('status') // ngambil dari booking
                    ->label('Status Kendaraan')
                    ->getStateUsing(function ($record) {
                        $latestBooking = $record->serviceBooking()->latest('created_at')->first();
                        return $latestBooking ? $latestBooking->status : '-';
                    })
                    ->colors([
                        'gray' => 'Booked',
                        'info' => 'Konfirmasi',
                        'success' => 'Selesai',
                        'danger' => 'Dibatalkan',
                    ])
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
            'edit' => Pages\EditKendaraan::route('/{record}/edit'),
        ];
    }
}
