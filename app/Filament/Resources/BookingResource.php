<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Mekanik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Booking Service';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Master Service';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pelanggan')
                    ->schema([
                        Forms\Components\TextInput::make('nama_pelanggan')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('Nomor HP')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informasi Kendaraan')
                    ->schema([
                        Forms\Components\TextInput::make('jenis_motor')
                            ->label('Jenis Motor')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tipe_kendaraan')
                            ->label('Tipe Kendaraan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nomor_polisi')
                            ->label('Nomor Polisi')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\Textarea::make('keluhan_kendaraan')
                            ->label('Keluhan Kendaraan')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informasi Service')
                    ->schema([
                        Forms\Components\TextInput::make('jenis_service')
                            ->label('Jenis Service')
                            ->disabled()
                            ->required()
                            ->dehydrated(),
                        Forms\Components\TextInput::make('harga_service')
                            ->label('Harga Service')
                            ->numeric()
                            ->disabled()
                            ->required()
                            ->dehydrated()
                            ->prefix('Rp '),
                        Forms\Components\Select::make('mekanik_id')
                            ->label('Mekanik')
                            ->relationship('mekanik', 'nama_mekanik')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Jadwal & Status')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal_kedatangan')
                            ->label('Tanggal Kedatangan')
                            ->required()
                            ->minDate(now()),
                        Forms\Components\TimePicker::make('jam_kedatangan')
                            ->label('Jam Kedatangan')
                            ->required(),
                        Forms\Components\TextInput::make('nomor_antrian')
                            ->label('Nomor Antrian')
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Booked' => 'Booked',
                                'Konfirmasi' => 'Konfirmasi',
                                'Sedang dikerjakan' => 'Sedang dikerjakan',
                                'Selesai' => 'Selesai',
                                'Dibatalkan' => 'Dibatalkan',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_antrian')
                    ->label('No. Antrian')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pelanggan')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor_polisi')
                    ->label('Nomor Polisi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_service')
                    ->label('Jenis Service')
                    ->badge(),
                Tables\Columns\TextColumn::make('tanggal_kedatangan')
                    ->label('Tanggal')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_kedatangan')
                    ->label('Jam')
                    ->time('H:i'),
                Tables\Columns\TextColumn::make('mekanik.nama_mekanik')
                    ->label('Mekanik')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray' => 'Booked',
                        'info' => 'Konfirmasi',
                        'warning' => 'Sedang dikerjakan',
                        'success' => 'Selesai',
                        'danger' => 'Dibatalkan',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_service')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Booked' => 'Booked',
                        'Konfirmasi' => 'Konfirmasi',
                        'Sedang dikerjakan' => 'Sedang dikerjakan',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ]),
                Tables\Filters\SelectFilter::make('jenis_service')
                    ->options([
                        'Paket Service Terminator 1' => 'Paket Service Terminator 1',
                        'Paket Service Terminator 2' => 'Paket Service Terminator 2',
                        'Paket Service Terminator 3' => 'Paket Service Terminator 3',
                        'Paket Service Terminator 4' => 'Paket Service Terminator 4',
                        'Paket Service Terminator 5' => 'Paket Service Terminator 5',
                        'Paket Service Terminator 6' => 'Paket Service Terminator 6',
                        'Paket Service Terminator 7' => 'Paket Service Terminator 7',
                        'Paket Service Terminator 8' => 'Paket Service Terminator 8',
                        'Paket Service Terminator 9' => 'Paket Service Terminator 9',
                        'Paket Service Terminator 10' => 'Paket Service Terminator 10',
                        'Paket Service Terminator 11' => 'Paket Service Terminator 11',
                        'Paket Service Terminator 12' => 'Paket Service Terminator 12',
                        'Paket Service Terminator 13' => 'Paket Service Terminator 13',
                        'Paket Service Terminator 14' => 'Paket Service Terminator 14',
                        'Paket Service Terminator 15' => 'Paket Service Terminator 15',
                        
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal_kedatangan', 'desc');
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}