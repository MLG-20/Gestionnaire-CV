<?php

namespace App\Filament\Admin\Resources\FooterSettingResource\Pages;

use App\Filament\Admin\Resources\FooterSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListFooterSettings extends ListRecords
{
    protected static string $resource = FooterSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
