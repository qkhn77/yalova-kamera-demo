<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;

abstract class BaseModulSectionEditor extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithFormActions;

    protected static ?string $cluster = Web::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.clusters.web.pages.modul-editor';

    public ?array $data = [];

    abstract protected static function getSectionFileName(): string;

    public function mount(): void
    {
        $this->form->fill([
            'content' => $this->readSectionContent(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Forms\Components\Placeholder::make('info')
                    ->label('Bilgi')
                    ->content('Bu editör, ilgili front section dosyasını birebir düzenler. Yazı ve görselleri front sırasına göre peş peşe düzenleyebilirsiniz.'),
                Forms\Components\Textarea::make('content')
                    ->label('Blade İçeriği')
                    ->rows(38)
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $content = (string) ($state['content'] ?? '');

        File::put($this->getSectionFilePath(), $content);

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

    protected function getSectionFilePath(): string
    {
        return resource_path('views/front/sections/' . static::getSectionFileName());
    }

    protected function readSectionContent(): string
    {
        $file = $this->getSectionFilePath();

        if (! File::exists($file)) {
            return '';
        }

        return (string) File::get($file);
    }
}

