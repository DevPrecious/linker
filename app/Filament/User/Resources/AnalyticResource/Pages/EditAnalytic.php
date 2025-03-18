<?php

namespace App\Filament\User\Resources\AnalyticResource\Pages;

use App\Filament\User\Resources\AnalyticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnalytic extends EditRecord
{
    protected static string $resource = AnalyticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
