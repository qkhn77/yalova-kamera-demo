<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class WebApiAyarlar extends Page implements HasForms
{
    use InteractsWithForms;
    use \Filament\Pages\Concerns\InteractsWithFormActions;

    protected static ?string $cluster = Web::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = 'API Ayarları';
    protected static ?string $slug = 'web-ayarlar/web-api-ayarlar';
    protected static string $view = 'filament.clusters.web.pages.web-api-ayarlar';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'google_search_console' => Setting::get('google_search_console'),
            'whatsapp_code' => Setting::get('whatsapp_code'),
            'google_analytics_code' => Setting::get('google_analytics_code'),
            'webmaster_verification' => Setting::get('webmaster_verification'),
            'recaptcha_site_key' => Setting::get('recaptcha_site_key'),
            'recaptcha_secret_key' => Setting::get('recaptcha_secret_key'),
            'instagram_token' => Setting::get('instagram_token'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Head bölümüne eklenecek kodlar')
                    ->description('Bu alanlara girilen kodlar sitenin tüm sayfalarının <head> bölümüne otomatik eklenir (SEO, doğrulama, analitik).')
                    ->icon('heroicon-o-code-bracket-square')
                    ->schema([
                        Forms\Components\TextInput::make('google_search_console')
                            ->label('Google Search Console kodu')
                            ->placeholder('Örn: abc123XYZ...')
                            ->helperText('Google Search Console → Ayarlar → Site sahipliğini doğrulama → HTML etiketi → content içindeki değeri yapıştırın. <head> içine meta name="google-site-verification" olarak eklenir.')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('google_analytics_code')
                            ->label('Google Analytics kodu')
                            ->rows(4)
                            ->placeholder('<!-- Google Analytics --> veya gtag script...')
                            ->helperText('Google Analytics (gtag.js veya eski UA) script bloğunu buraya yapıştırın. Tüm sayfaların <head> bölümüne eklenir.'),
                        Forms\Components\TextInput::make('webmaster_verification')
                            ->label('Webmaster / diğer doğrulama (yedek)')
                            ->placeholder('İsteğe bağlı')
                            ->helperText('Başka bir doğrulama meta değeri kullanacaksanız buraya yazın.')
                            ->maxLength(255),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Diğer entegrasyonlar')
                    ->description('İletişim formu (reCAPTCHA), sosyal medya ve WhatsApp linkleri.')
                    ->schema([
                        Forms\Components\TextInput::make('recaptcha_site_key')
                            ->label('Google reCAPTCHA Site Key')
                            ->placeholder('reCAPTCHA v2 site key (iletişim formu)')
                            ->helperText('İletişim formunda robot doğrulaması için. reCAPTCHA v2 "I\'m not a robot" kullanılır.'),
                        Forms\Components\TextInput::make('recaptcha_secret_key')
                            ->label('Google reCAPTCHA Secret Key')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->placeholder('Sunucu tarafı doğrulama için')
                            ->helperText('Google reCAPTCHA admin panelinden alınır. Site Key ile birlikte doldurulmalı.'),
                        Forms\Components\TextInput::make('whatsapp_code')
                            ->label('WhatsApp numarası')
                            ->placeholder('Örn: 905551234567')
                            ->helperText('Ülke kodu ile birlikte, başında + olmadan. Footer ve iletişimde WhatsApp linki olarak kullanılır.'),
                        Forms\Components\TextInput::make('instagram_token')
                            ->label('Instagram profil URL veya kullanıcı adı')
                            ->placeholder('https://instagram.com/yalovakamera veya yalovakamera')
                            ->helperText('Footer ve iletişim sayfasındaki Instagram linki.'),
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
}
