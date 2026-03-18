<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class WebMailAyarlar extends Page
{
    use \Filament\Pages\Concerns\InteractsWithFormActions;

    protected static ?string $cluster = Web::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = 'Mail Ayarları';
    protected static ?string $slug = 'web-ayarlar/web-mail-ayarlar';
    protected static string $view = 'filament.pages.ayarlar-form';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'mail_host' => Setting::get('mail_host', config('mail.mailers.smtp.host')),
            'mail_port' => Setting::get('mail_port', config('mail.mailers.smtp.port')),
            'mail_encryption' => Setting::get('mail_encryption', config('mail.mailers.smtp.encryption')),
            'mail_username' => Setting::get('mail_username', config('mail.mailers.smtp.username')),
            'mail_password' => '',
            'mail_active' => (bool) Setting::get('mail_active', true),
            'mail_recipient' => Setting::get('mail_recipient', config('mail.from.address')),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('SMTP Bağlantısı')
                    ->description('E-posta gönderimi için SMTP sunucu bilgileri.')
                    ->icon('heroicon-o-server-stack')
                    ->schema([
                        Forms\Components\TextInput::make('mail_host')
                            ->label('SMTP Server')
                            ->placeholder('smtp.gmail.com')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mail_port')
                            ->label('SMTP Port')
                            ->numeric()
                            ->default(587)
                            ->placeholder('587')
                            ->required(),
                        Forms\Components\Select::make('mail_encryption')
                            ->label('Mail Sertifika (Şifreleme)')
                            ->options([
                                'tls' => 'TLS',
                                'ssl' => 'SSL',
                                '' => 'Yok',
                            ])
                            ->placeholder('TLS')
                            ->default('tls'),
                        Forms\Components\TextInput::make('mail_username')
                            ->label('SMTP Email')
                            ->email()
                            ->placeholder('ornek@alanadi.com')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mail_password')
                            ->label('SMTP Email Şifre')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Değiştirmek için yazın; boş bırakırsanız mevcut şifre korunur.')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Genel')
                    ->schema([
                        Forms\Components\Toggle::make('mail_active')
                            ->label('Aktif / Pasif')
                            ->helperText('Pasif yapılırsa e-posta gönderimi yapılmaz (log\'a yazılır).')
                            ->default(true),
                        Forms\Components\TextInput::make('mail_recipient')
                            ->label('Mesajın Geleceği E-Posta Adresi')
                            ->email()
                            ->placeholder('info@yalovakamera.com')
                            ->helperText('İletişim formu ve bildirimlerin gönderileceği adres.')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        if (empty($data['mail_password'])) {
            $data['mail_password'] = Setting::get('mail_password');
        }
        foreach ($data as $key => $value) {
            if ($key === 'mail_password' && $value === '') {
                continue;
            }
            Setting::set($key, $value ?? '', 'mail');
        }
        Notification::make()->title('Mail ayarları kaydedildi.')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')->label('Kaydet')->action('save')->color('primary'),
        ];
    }
}
