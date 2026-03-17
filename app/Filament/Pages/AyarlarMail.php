<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class AyarlarMail extends Page
{
    use \Filament\Pages\Concerns\InteractsWithFormActions;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Ayarlar';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Mail Ayarları';
    protected static ?string $title = 'Mail Ayarları';
    protected static string $view = 'filament.pages.ayarlar-form.blade-eski.php';
    protected static string $routePath = 'ayarlar/mail';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'mail_driver' => Setting::get('mail_driver', 'smtp'),
            'mail_host' => Setting::get('mail_host', config('mail.mailers.smtp.host')),
            'mail_port' => Setting::get('mail_port', config('mail.mailers.smtp.port')),
            'mail_username' => Setting::get('mail_username'),
            'mail_password' => Setting::get('mail_password'),
            'mail_encryption' => Setting::get('mail_encryption'),
            'mail_from_address' => Setting::get('mail_from_address', config('mail.from.address')),
            'mail_from_name' => Setting::get('mail_from_name', config('mail.from.name')),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Mail')->schema([
                    Forms\Components\Select::make('mail_driver')->label('Sürücü')->options(['smtp' => 'SMTP', 'mail' => 'Mail', 'sendmail' => 'Sendmail']),
                    Forms\Components\TextInput::make('mail_host')->label('Host'),
                    Forms\Components\TextInput::make('mail_port')->label('Port')->numeric(),
                    Forms\Components\TextInput::make('mail_username')->label('Kullanıcı adı'),
                    Forms\Components\TextInput::make('mail_password')->label('Şifre')->password(),
                    Forms\Components\TextInput::make('mail_encryption')->label('Şifreleme (tls/ssl)'),
                    Forms\Components\TextInput::make('mail_from_address')->label('Gönderen adres'),
                    Forms\Components\TextInput::make('mail_from_name')->label('Gönderen adı'),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        foreach ($data as $key => $value) {
            Setting::set($key, $value ?? '', 'mail');
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
