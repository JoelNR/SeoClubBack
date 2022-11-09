<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class News extends CreateRecord
{
    protected static string $resource = NewsResource::class;
}
