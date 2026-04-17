<?php

namespace App\Filament\Admin\Resources\HobbyResource\Pages;

use App\Filament\Admin\Resources\HobbyResource;
use Filament\Resources\Pages\ListRecords;

class ListHobbies extends ListRecords
{
    protected static string $resource = HobbyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
