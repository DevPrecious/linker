<?php

namespace App\Filament\User\Resources\AnalyticResource\Pages;

use App\Filament\User\Resources\AnalyticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnalytics extends ListRecords
{
    protected static string $resource = AnalyticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
