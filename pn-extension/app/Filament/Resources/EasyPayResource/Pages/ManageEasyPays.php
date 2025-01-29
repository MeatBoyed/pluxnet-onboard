<?php

namespace App\Filament\Resources\EasyPayResource\Pages;

use App\Filament\Resources\EasyPayResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEasyPays extends ManageRecords
{
    protected static string $resource = EasyPayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
