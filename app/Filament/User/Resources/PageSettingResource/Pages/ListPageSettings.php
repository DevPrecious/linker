<?php

namespace App\Filament\User\Resources\PageSettingResource\Pages;

use App\Filament\User\Resources\PageSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageSettings extends ListRecords
{
    protected static string $resource = PageSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
