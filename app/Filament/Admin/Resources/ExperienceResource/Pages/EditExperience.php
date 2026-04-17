<?php

namespace App\Filament\Admin\Resources\ExperienceResource\Pages;

use App\Filament\Admin\Resources\ExperienceResource;
use Filament\Resources\Pages\EditRecord;

class EditExperience extends EditRecord
{
    protected static string $resource = ExperienceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
