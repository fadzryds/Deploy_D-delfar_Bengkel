<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MekanikResource\Pages;
use App\Models\Kendaraan;
use App\Models\Booking;
use App\Models\Mekanik;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class MekanikResource extends Resource
{
    protected static ?string $model = Mekanik::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Mekanik';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('mekanik')
                    ->avatar()
                    ->label('Foto Mekanik'),

                Forms\Components\TextInput::make('nama_mekanik')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('nomor_karyawan')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('no_hp')
                    ->label('Nomor HP')
                    ->tel(),

                Forms\Components\Textarea::make('alamat')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('gaji')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->required()
                    ->default('aktif'),
            ])
            ->columns(2);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->circular()
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('nama_mekanik')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nomor_karyawan')
                    ->label('No. Karyawan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('HP'),

                Tables\Columns\TextColumn::make('gaji')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'aktif',
                        'danger' => 'nonaktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('nama_mekanik');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMekaniks::route('/'),
            'create' => Pages\CreateMekanik::route('/create'),
            'edit' => Pages\EditMekanik::route('/{record}/edit'),
        ];
    }
}