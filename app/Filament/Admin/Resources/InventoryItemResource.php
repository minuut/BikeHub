<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\InventoryItem;
use Filament\Resources\Resource;
use App\Filament\Admin\Resources\InventoryItemResource\Pages;
use App\Filament\Admin\Resources\ServicePointResource\RelationManagers\InventoryItemsRelationManager;

class InventoryItemResource extends Resource
{
    protected static ?string $model = InventoryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_point_id')
                    ->label(__('filament.inventory_items.service_point_location'))
                    ->relationship('servicePoint', 'name')
                    ->required()
                    ->hiddenOn(InventoryItemsRelationManager::class)
                    ->disabledOn(InventoryItemsRelationManager::class),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.inventory_items.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('brand')
                    ->label(__('filament.inventory_items.brand'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->label(__('filament.inventory_items.type'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('stock')
                    ->label(__('filament.inventory_items.stock'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('price')
                    ->label(__('filament.inventory_items.price'))
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('€'),
                Forms\Components\TextInput::make('low_stock_threshold')
                    ->label(__('filament.inventory_items.low_stock_threshold'))
                    ->required()
                    ->numeric()
                    ->default(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TODO: Add transaction model
                Tables\Columns\TextColumn::make('servicePoint.name')
                    ->label(__('filament.inventory_items.service_point_location'))
                    ->searchable()
                    ->hiddenOn(InventoryItemsRelationManager::class),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.inventory_items.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->label(__('filament.inventory_items.brand'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('filament.inventory_items.type'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label(__('filament.inventory_items.stock'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('filament.inventory_items.price_per_unit'))
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('low_stock_threshold')
                    ->label(__('filament.inventory_items.low_stock_threshold'))
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListInventoryItems::route('/'),
            'create' => Pages\CreateInventoryItem::route('/create'),
            'edit' => Pages\EditInventoryItem::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('filament.inventory_items.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament.inventory_items.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.inventory_items.navigation_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.inventory_items.navigation_group');
    }

    public static function getTitle(): string
    {
        return __('filament.inventory_items.title');
    }

    public static function getSlug(): string
    {
        return __('filament.inventory_items.slug');
    }
}
