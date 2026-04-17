<?php

namespace App\Filament\Admin\Resources\HobbyResource\Pages;

use App\Filament\Admin\Resources\HobbyResource;
use Filament\Resources\Pages\EditRecord;

class EditHobby extends EditRecord
{
    protected static string $resource = HobbyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
