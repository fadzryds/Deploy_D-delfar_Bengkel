<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SparepartResource\Pages;
use App\Models\Sparepart;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class SparepartResource extends Resource
{
    protected static ?string $model = Sparepart::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Sparepart';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Sparepart')
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->nullable(),

            Forms\Components\TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('stock')
                ->label('Stok')
                ->numeric()
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->label('Gambar')
                ->image()
                ->directory('spareparts'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => (int) $state)
                    ->color(fn ($state) => $state == 0 ? 'danger' : 'success')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
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
            'index' => Pages\ListSpareparts::route('/'),
            'create' => Pages\CreateSparepart::route('/create'),
            'edit' => Pages\EditSparepart::route('/{record}/edit'),
        ];
    }
}