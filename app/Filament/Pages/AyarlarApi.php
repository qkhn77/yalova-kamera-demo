<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class AyarlarApi extends Page
{
    use \Filament\Pages\Concerns\InteractsWithFormActions;
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';
    protected static ?string $navigationGroup = 'Ayarlar';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Api Ayarları';
    protected static ?string $title = 'Api Ayarları';
    protected static string $view = 'filament.pages.ayarlar-form';
    protected static string $routePath = 'ayarlar/api';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'google_search_console' => Setting::get('google_search_console'),
            'whatsapp_code' => Setting::get('whatsapp_code'),
            'google_analytics_code' => Setting::get('google_analytics_code'),
            'webmaster_verification' => Setting::get('webmaster_verification'),
            'recaptcha_site_key' => Setting::get('recaptcha_site_key'),
            'instagram_token' => Setting::get('instagram_token'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Google Search Console')
                    ->description('Site doğrulama kodu tüm sayfaların <head> bölümüne meta etiket olarak eklenir.')
                    ->icon('heroicon-o-magnifying-glass-circle')
                    ->schema([
                        Forms\Components\TextInput::make('google_search_console')
                            ->label('Google Search Console doğrulama kodu')
                            ->placeholder('Örn: abc123XYZ...')
                            ->helperText('Search Console → Ayarlar → Site sahipliğini doğrulama → HTML etiketi → content içindeki değeri buraya yapıştırın.')
                            ->maxLength(255),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Diğer API & Entegrasyonlar')
                    ->schema([
                        Forms\Components\TextInput::make('whatsapp_code')->label('WhatsApp kodu / numara'),
                        Forms\Components\Textarea::make('google_analytics_code')->label('Google Analytics .js kodu')->rows(4),
                        Forms\Components\TextInput::make('webmaster_verification')->label('Webmaster Tools site doğrulama (yedek alan)')->maxLength(255),
                        Forms\Components\TextInput::make('recaptcha_site_key')->label('Google reCAPTCHA Site Key'),
                        Forms\Components\TextInput::make('instagram_token')->label('Instagram token kodu'),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        foreach ($data as $key => $value) {
            Setting::set($key, $value ?? '', 'api');
        }
        Notification::make()->title('API ayarları kaydedildi.')->success()->send();
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
