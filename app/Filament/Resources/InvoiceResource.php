<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Customer;
use App\Models\Invoice;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\{
    Select,
    TextInput,
    Textarea,
    DatePicker
};
use Filament\Tables\Columns\TextColumn;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
        protected static ?string $navigationLabel = 'Invoice Sparepart';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Master Sparepart';

    public static function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('tanggal_servis')
                ->label('Tanggal Servis')
                ->required(),

            Select::make('customer_id')
                ->label('Nama Customer')
                ->options(
                    Customer::with('user')
                        ->get()
                        ->pluck('user.name', 'id')
                )
                ->searchable()
                ->required(),

            Select::make('kendaraan_id')
                ->relationship('kendaraan', 'nomor_plat')
                ->required(),

            Select::make('mekanik_id')
                ->relationship('mekanik', 'nama_mekanik')
                ->required(),

            TextInput::make('jenis_servis')
                ->label('Jenis Servis')
                ->required(),

            Textarea::make('keluhan')
                ->rows(3),

            Textarea::make('catatan_mekanik')
                ->rows(3),

            TextInput::make('km_servis')
                ->label('KM Servis')
                ->numeric(),

            TextInput::make('total_biaya')
                ->label('Total Biaya')
                ->numeric()
                ->prefix('Rp')
                ->required(),

            Select::make('status')
                ->options([
                    'proses' => 'Proses',
                    'selesai' => 'Selesai',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_servis')->date(),
                TextColumn::make('customer.user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('kendaraan.nomor_plat')->label('Plat'),
                TextColumn::make('mekanik.nama_mekanik')->label('Mekanik'),
                TextColumn::make('jenis_servis'),
                TextColumn::make('total_biaya')->money('IDR'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => $state === 'selesai' ? 'success' : 'warning'),
            ])
            ->defaultSort('tanggal_servis', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}