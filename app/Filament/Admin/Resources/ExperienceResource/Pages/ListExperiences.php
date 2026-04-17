<?php

namespace App\Filament\Admin\Resources\ExperienceResource\Pages;

use App\Filament\Admin\Resources\ExperienceResource;
use Filament\Resources\Pages\ListRecords;

class ListExperiences extends ListRecords
{
    protected static string $resource = ExperienceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
