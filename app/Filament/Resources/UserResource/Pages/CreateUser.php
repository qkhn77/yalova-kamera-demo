<?php

namespace App\Filament\Resources\UserResource\Pages;
protected static bool $shouldRegisterNavigation = false;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
