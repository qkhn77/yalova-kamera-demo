<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;

abstract class BaseModulSectionEditor extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithFormActions;

    protected static ?string $cluster = Web::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.clusters.web.pages.modul-editor';

    public ?array $data = [];

    abstract protected static function getModuleKey(): string;

    abstract protected function getDefaultData(): array;

    abstract protected function getEditorSchema(): array;

    public function mount(): void
    {
        $defaults = $this->getDefaultData();
        $state = [];

        foreach ($defaults as $key => $defaultValue) {
            $state[$key] = Setting::get($this->settingKey($key), $defaultValue);
        }

        $this->form->fill($state);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema($this->getEditorSchema())
            ->columns(1);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            Setting::set($this->settingKey($key), $value ?? '', 'web_moduller');
        }

        Notification::make()
            ->title('Modül içeriği kaydedildi.')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Kaydet')
                ->action('save')
                ->color('primary'),
        ];
    }

    protected function settingKey(string $field): string
    {
        return 'modul.' . static::getModuleKey() . '.' . $field;
    }
}

