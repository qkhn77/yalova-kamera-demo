<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class AyarlarGenel extends Page
{
    use \Filament\Pages\Concerns\InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Ayarlar';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Genel Ayarlar';
    protected static ?string $title = 'Genel Ayarlar';
    protected static string $view = 'filament.pages.ayarlar-form';
    protected static string $routePath = 'ayarlar/genel';
    protected static ?string $settingsGroup = 'general';

    public ?array $data = [];

    private static function defaultSiteUrl(): string
    {
        return rtrim(config('app.url'), '/');
    }

    private static function defaultAdminUrl(): string
    {
        $path = Setting::get('admin_path', 'admin');
        return self::defaultSiteUrl() . '/' . ltrim($path, '/');
    }

    public function mount(): void
    {
        $this->form->fill([
            'site_url' => Setting::get('site_url', self::defaultSiteUrl()),
            'admin_path' => Setting::get('admin_path', 'admin'),
            'site_title' => Setting::get('site_title', config('app.name')),
            'meta_description' => Setting::get('meta_description'),
            'meta_keywords' => Setting::get('meta_keywords'),
            'site_logo' => Setting::get('site_logo'),
            'footer_logo' => Setting::get('footer_logo'),
            'copyright_text' => Setting::get('copyright_text', '© ' . date('Y') . ' Yalova Kamera Sistemleri. Tüm hakları saklıdır.'),
        ]);
    }

    public function form(Form $form): Form
    {
        $defaultHeaderLogo = 'theme/yalovakamera/images/yalova_kamera.png';
        $defaultFooterLogo = 'theme/yalovakamera/images/footer-logo.svg';

        return $form
            ->schema([
                Forms\Components\Section::make('URL Ayarları')
                    ->description('Site ve admin panel adresleri.')
                    ->icon('heroicon-o-link')
                    ->schema([
                        Forms\Components\TextInput::make('site_url')
                            ->label('Site URL')
                            ->placeholder(self::defaultSiteUrl())
                            ->url()
                            ->helperText('Varsayılan: ' . self::defaultSiteUrl())
                            ->maxLength(255),
                        Forms\Components\TextInput::make('admin_path')
                            ->label('Admin panel giriş URL yolu')
                            ->placeholder('admin')
                            ->helperText('Varsayılan: admin → Giriş: ' . self::defaultAdminUrl() . '. Değiştirdikten sonra "php artisan route:clear" çalıştırın.')
                            ->maxLength(64)
                            ->regex('/^[a-z0-9_-]+$/i'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('SEO (Google)')
                    ->description('Arama motoru başlık, açıklama ve anahtar kelimeler.')
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        Forms\Components\TextInput::make('site_title')
                            ->label('Web site adı / Google title')
                            ->placeholder(config('app.name'))
                            ->helperText('Sayfa başlığı ve Google\'da görünen başlık.')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Site açıklaması (Google description)')
                            ->rows(3)
                            ->placeholder('Kısa site açıklaması…')
                            ->helperText('Google arama sonuçlarında görünen açıklama.')
                            ->maxLength(500),
                        Forms\Components\Textarea::make('meta_keywords')
                            ->label('Anahtar kelimeler (Google keywords)')
                            ->rows(2)
                            ->placeholder('kelime1, kelime2, kelime3')
                            ->helperText('Virgülle ayırarak anahtar kelimeler girin.')
                            ->maxLength(500),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Logolar')
                    ->description('Header ve footer logoları. Yüklemezseniz varsayılan logo kullanılır.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('site_logo')
                            ->label('Header logo')
                            ->image()
                            ->disk('public')
                            ->directory('settings/logos')
                            ->visibility('public')
                            ->imagePreviewHeight(80)
                            ->helperText('Varsayılan: theme/yalovakamera/images/yalova_kamera.png'),
                        Forms\Components\FileUpload::make('footer_logo')
                            ->label('Footer logo')
                            ->image()
                            ->disk('public')
                            ->directory('settings/logos')
                            ->visibility('public')
                            ->imagePreviewHeight(60)
                            ->helperText('Varsayılan: theme/yalovakamera/images/footer-logo.svg'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Footer')
                    ->description('Alt bilgi metni.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\Textarea::make('copyright_text')
                            ->label('Copyright metni')
                            ->rows(2)
                            ->placeholder('© ' . date('Y') . ' Site Adı. Tüm hakları saklıdır.')
                            ->helperText('Footer\'da görünecek telif metni.')
                            ->maxLength(500),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // FileUpload returns storage path; store as path that works with asset('public_storage/...')
        foreach (['site_logo', 'footer_logo'] as $key) {
            if (!empty($data[$key]) && is_string($data[$key])) {
                $data[$key] = ltrim($data[$key], '/');
            }
        }

        foreach ($data as $key => $value) {
            Setting::set($key, $value ?? '', 'general');
        }

        Notification::make()->title('Ayarlar kaydedildi.')->success()->send();
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
