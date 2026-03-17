<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class AyarlarGenel extends Page
{
    use \Filament\Pages\Concerns\InteractsWithFormActions;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Ayarlar';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Genel Ayarlar';
    protected static ?string $title = 'Genel Ayarlar';
    protected static string $view = 'filament.pages.ayarlar-form.blade-eski.php';
    protected static string $routePath = 'ayarlar/genel';
    protected static ?string $settingsGroup = 'general';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'site_logo' => Setting::get('site_logo'),
            'footer_logo' => Setting::get('footer_logo'),
            'favicon' => Setting::get('favicon'),
            'site_url' => Setting::get('site_url', config('app.url')),
            'site_title' => Setting::get('site_title', config('app.name')),
            'meta_description' => Setting::get('meta_description'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Genel')->schema([
                    Forms\Components\TextInput::make('site_logo')->label('Site logosu dosya yolu'),
                    Forms\Components\TextInput::make('footer_logo')->label('Footer logo dosya yolu'),
                    Forms\Components\TextInput::make('favicon')->label('Favicon dosya yolu'),
                    Forms\Components\TextInput::make('site_url')->label('Site URL')->url(),
                    Forms\Components\TextInput::make('site_title')->label('Site başlığı'),
                    Forms\Components\Textarea::make('meta_description')->label('SEO açıklama (description)')->rows(3),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        foreach ($data as $key => $value) {
            Setting::set($key, $value ?? '', 'general');
        }
        Notification::make()->title('Kaydedildi')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')->label('Kaydet')->action('save')->color('primary'),
        ];
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
