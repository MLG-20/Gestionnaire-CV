<?php

namespace App\Filament\Admin\Resources\CvSettingResource\Pages;

use App\Filament\Admin\Resources\CvSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListCvSettings extends ListRecords
{
    protected static string $resource = CvSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
