<?php

namespace App\Filament\Admin\Resources\CvSettingResource\Pages;

use App\Filament\Admin\Resources\CvSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditCvSetting extends EditRecord
{
    protected static string $resource = CvSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
