<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckoutResource\Pages;
use App\Filament\Resources\CheckoutResource\RelationManagers;
use App\Models\Checkout;
use App\Models\Customer;
use App\Models\Sparepart;
use App\Models\Invoice;
use App\Models\CheckoutSparepart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckoutResource extends Resource
{
    protected static ?string $model = CheckoutSparepart::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Checkout Sparepart';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Master Sparepart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Antrian')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_pembelian')
                            ->label('Nomor Antrian')
                            ->disabled()
                            ->dehydrated(),
                    ]),

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
                
                Forms\Components\Section::make('Informasi Sparepart')
                    ->schema([
                        Forms\Components\TextInput::make('sparepart.name')
                            ->label('Nama Sparepart')
                            ->required()
                            ->disabled()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Jumlah')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->required()
                            ->numeric(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Tanggal Pembelian')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal_pembelian')
                            ->label('Tanggal Pembelian')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->minDate(now()),
                        Forms\Components\TextInput::make('nomor_antrian')
                            ->label('Nomor Antrian')
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\Select::make('pembayaran')
                            ->label('Pembayaran')
                            ->required()
                            ->options([
                                'Sudah Bayar' => 'Sudah Bayar',
                                'Belum Bayar' => 'Belum Bayar',
                            ])
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Dipesan' => 'Dipesan',
                                'Konfirmasi' => 'Konfirmasi',
                                'Sedang Perjalanan' => 'Sedang Perjalanan',
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
                Tables\Columns\TextColumn::make('nomor_pembelian')
                    ->label('Antrian')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor HP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sparepart.name')
                    ->label('Nama Sparepart')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah'),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('idr', true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pembelian')
                    ->date(),
                Tables\Columns\TextColumn::make('pembayaran')
                    ->label('Pembayaran'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('pembayaran')
                    ->label('Filter Pembayaran')
                    ->options([
                        'Sudah Bayar' => 'Sudah Bayar',
                        'Belum Bayar' => 'Belum Bayar',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCheckouts::route('/'),
            'create' => Pages\CreateCheckout::route('/create'),
            'edit' => Pages\EditCheckout::route('/{record}/edit'),
        ];
    }
}

