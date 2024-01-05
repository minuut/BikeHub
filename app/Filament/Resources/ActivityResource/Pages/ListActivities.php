<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Enums\AppointmentStatus;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    public static function getResource(): string
    {
        return config('filament-logger.activity_resource');
    }
}