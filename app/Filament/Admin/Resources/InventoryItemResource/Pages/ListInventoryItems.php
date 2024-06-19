<?php

namespace App\Filament\Admin\Resources\InventoryItemResource\Pages;

use Filament\Actions;
use App\Models\ServicePoint;
use App\Models\InventoryItem;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\InventoryItemResource;

class ListInventoryItems extends ListRecords
{
    protected static string $resource = InventoryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTabs(): array
    {
        $servicePointIds = InventoryItem::distinct('service_point_id')->pluck('service_point_id');

        $tabs = [
            __('filament.inventory_items.all_parts') => Tab::make()->badge(InventoryItem::query()->count()),
        ];

        foreach ($servicePointIds as $servicePointId) {
            $servicePoint = ServicePoint::find($servicePointId);
            $tabs[$servicePoint->name] = Tab::make()
                ->badge(InventoryItem::where('service_point_id', $servicePointId)->count())
                ->icon('icon-service-point');
        }

        return $tabs;
    }
}
