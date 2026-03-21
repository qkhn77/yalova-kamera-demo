<?php

namespace App\Filament\Pages;

use App\Models\Firma;
use App\Services\FirmaAyarDeposu;
use App\Support\SaaSemaYardimcisi;
use App\Services\TenantContextService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class FirmaAyarlariSayfasi extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static string $view = 'filament.pages.firma-ayarlari-sayfasi';

    protected static ?string $title = 'Firma ayarları';

    protected static ?string $slug = 'firma-ayarlari';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        if (! SaaSemaYardimcisi::firmalarTablosuVarMi()) {
            return false;
        }

        $kullanici = Auth::user();
        if (! $kullanici) {
            return false;
        }

        $fid = app(TenantContextService::class)->aktifFirmaId();
        if (! $fid) {
            return false;
        }

        $firma = Firma::query()->find($fid);

        return $firma !== null && $kullanici->can('update', $firma);
    }

    public function mount(): void
    {
        $fid = $this->aktifFirmaId();
        if (! $fid) {
            abort(403);
        }

        $firma = Firma::query()->findOrFail($fid);
        $depo = app(FirmaAyarDeposu::class);

        $this->data = [
            'firma_ayar_ad' => $firma->ad,
            'telefon' => $firma->telefon,
            'eposta' => $firma->eposta,
            'adres' => $firma->adres,
            'logo' => $depo->oku($fid, 'logo'),
            'para_birimi' => $depo->oku($fid, 'para_birimi', 'TRY'),
            'varsayilan_dil' => $depo->oku($fid, 'varsayilan_dil', 'tr'),
            'zaman_dilimi' => $depo->oku($fid, 'zaman_dilimi', 'Europe/Istanbul'),
        ];

        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Genel')
                    ->schema([
                        Forms\Components\TextInput::make('firma_ayar_ad')
                            ->label('Firma adı')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->disk('public')
                            ->directory('firma-logolari')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('telefon')
                            ->label('Telefon')
                            ->tel()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('eposta')
                            ->label('E-posta')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('adres')
                            ->label('Adres')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make('Bölgesel')
                    ->schema([
                        Forms\Components\TextInput::make('para_birimi')
                            ->label('Para birimi')
                            ->maxLength(8)
                            ->default('TRY')
                            ->helperText('Örn. TRY, USD'),
                        Forms\Components\TextInput::make('varsayilan_dil')
                            ->label('Varsayılan dil')
                            ->maxLength(12)
                            ->default('tr')
                            ->helperText('Örn. tr, en'),
                        Forms\Components\Select::make('zaman_dilimi')
                            ->label('Zaman dilimi')
                            ->searchable()
                            ->options(collect(\DateTimeZone::listIdentifiers())->mapWithKeys(fn (string $z): array => [$z => $z]))
                            ->default('Europe/Istanbul'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function kaydet(): void
    {
        $fid = $this->aktifFirmaId();
        if (! $fid) {
            abort(403);
        }

        $firma = Firma::query()->findOrFail($fid);
        $this->authorize('update', $firma);

        $s = $this->form->getState();

        $firma->update([
            'ad' => $s['firma_ayar_ad'] ?? $firma->ad,
            'telefon' => $s['telefon'] ?? null,
            'eposta' => $s['eposta'] ?? null,
            'adres' => $s['adres'] ?? null,
        ]);

        $depo = app(FirmaAyarDeposu::class);
        if (array_key_exists('logo', $s) && filled($s['logo'])) {
            $depo->yaz($fid, 'logo', $s['logo']);
        }
        $depo->yaz($fid, 'para_birimi', $s['para_birimi'] ?? 'TRY');
        $depo->yaz($fid, 'varsayilan_dil', $s['varsayilan_dil'] ?? 'tr');
        $depo->yaz($fid, 'zaman_dilimi', $s['zaman_dilimi'] ?? 'Europe/Istanbul');

        Notification::make()->title('Firma ayarları kaydedildi.')->success()->send();
    }

    protected function aktifFirmaId(): ?int
    {
        return app(TenantContextService::class)->aktifFirmaId();
    }
}
