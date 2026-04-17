<?php

namespace App\Filament\Admin\Resources\FooterSettingResource\Pages;

use App\Filament\Admin\Resources\FooterSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditFooterSetting extends EditRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
