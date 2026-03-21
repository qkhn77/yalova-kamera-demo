<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FirmaIciKullaniciKaynagi\Pages;
use App\Filament\Resources\FirmaIciKullaniciKaynagi\RelationManagers;
use App\Models\FirmaKullanici;
use App\Models\Rol;
use App\Models\User;
use App\Services\TenantContextService;
use App\Support\FirmaIciRolKisitlayici;
use App\Support\SaaSemaYardimcisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FirmaIciKullaniciKaynagi extends Resource
{
    protected static ?string $model = FirmaKullanici::class;

    protected static ?string $slug = 'firma-ici-kullanicilar';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationLabel(): string
    {
        return 'Firma kullanıcıları';
    }

    public static function getModelLabel(): string
    {
        return 'Firma kullanıcısı';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Firma kullanıcıları';
    }

    public static function canAccess(): bool
    {
        if (! SaaSemaYardimcisi::firmaKullanicilariTablosuVarMi()) {
            return false;
        }

        return Auth::check() && Auth::user()->can('viewAny', FirmaKullanici::class);
    }

    public static function getEloquentQuery(): Builder
    {
        $sorgu = parent::getEloquentQuery()
            ->withoutGlobalScopes()
            ->with(['kullanici', 'rol', 'firma']);

        $kullanici = Auth::user();
        if (! $kullanici) {
            return $sorgu->whereRaw('1 = 0');
        }

        if ((bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false)) {
            return $sorgu;
        }

        $fid = app(TenantContextService::class)->aktifFirmaId();
        if (! $fid) {
            return $sorgu->whereRaw('1 = 0');
        }

        return $sorgu->where('firma_id', $fid);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Kullanıcı')
                ->schema([
                    Forms\Components\Select::make('hedef_firma_id')
                        ->label('Firma')
                        ->relationship('firma', 'ad', fn (Builder $s) => $s->orderBy('ad'))
                        ->searchable()
                        ->preload()
                        ->live()
                        ->visible(function (Forms\Components\Component $bilesen): bool {
                            return $bilesen->getLivewire() instanceof CreateRecord
                                && static::superAdminMi();
                        })
                        ->required(function (Forms\Components\Component $bilesen): bool {
                            return $bilesen->getLivewire() instanceof CreateRecord
                                && static::superAdminMi();
                        }),
                    Forms\Components\TextInput::make('email')
                        ->label('E-posta')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->disabled(fn (?FirmaKullanici $kayit): bool => $kayit !== null),
                    Forms\Components\TextInput::make('password')
                        ->label('Şifre')
                        ->password()
                        ->revealable()
                        ->maxLength(255)
                        ->required(fn (?FirmaKullanici $kayit): bool => $kayit === null)
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->helperText(fn (?FirmaKullanici $kayit): string => $kayit ? 'Boş bırakılırsa şifre değişmez.' : 'Yeni kullanıcı için zorunlu.'),
                    Forms\Components\TextInput::make('kullanici_adi')
                        ->label('Kullanıcı adı')
                        ->required()
                        ->maxLength(255)
                        ->unique(User::class, 'kullanici_adi', ignoreRecord: true),
                    Forms\Components\TextInput::make('ad_soyad')
                        ->label('Ad soyad')
                        ->maxLength(255),
                ])->columns(2),
            Forms\Components\Section::make('Firma bağlantısı')
                ->schema([
                    Forms\Components\Select::make('rol_id')
                        ->label('Rol')
                        ->options(function (Forms\Get $get): array {
                            $kullanici = Auth::user();
                            if (! $kullanici) {
                                return [];
                            }

                            $fid = (int) ($get('hedef_firma_id') ?: 0);
                            if ($fid <= 0) {
                                $fid = (int) (app(TenantContextService::class)->aktifFirmaId() ?? 0);
                            }
                            if ($fid <= 0) {
                                return [];
                            }

                            if (static::superAdminMi()) {
                                return Rol::query()->where('sistem_rolu_mu', true)->orderBy('ad')->pluck('ad', 'id')->all();
                            }

                            return FirmaIciRolKisitlayici::atanabilirRollerSorgusu($kullanici, $fid)
                                ->pluck('ad', 'id')
                                ->all();
                        })
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('durum')
                        ->label('Durum')
                        ->options([
                            'aktif' => 'Aktif',
                            'pasif' => 'Pasif',
                        ])
                        ->required()
                        ->default('aktif'),
                    Forms\Components\Select::make('onay_durumu')
                        ->label('Onay durumu')
                        ->options([
                            'aktif' => 'Aktif',
                            'beklemede' => 'Beklemede',
                        ])
                        ->default('aktif'),
                    Forms\Components\Toggle::make('varsayilan_firma_mi')
                        ->label('Varsayılan firma'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firma.ad')
                    ->label('Firma')
                    ->visible(fn (): bool => static::superAdminMi())
                    ->sortable(),
                Tables\Columns\TextColumn::make('kullanici.ad_soyad')
                    ->label('Ad soyad')
                    ->placeholder(fn (FirmaKullanici $kayit): string => (string) ($kayit->kullanici?->name ?? ''))
                    ->searchable(),
                Tables\Columns\TextColumn::make('kullanici.kullanici_adi')
                    ->label('Kullanıcı adı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kullanici.email')
                    ->label('E-posta')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rol.ad')
                    ->label('Rol')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('durum')->label('Durum')->badge(),
                Tables\Columns\TextColumn::make('onay_durumu')
                    ->label('Onay')
                    ->badge()
                    ->placeholder('aktif'),
                Tables\Columns\IconColumn::make('varsayilan_firma_mi')->label('Varsayılan')->boolean(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('durum')
                    ->label('Durum')
                    ->options(['aktif' => 'Aktif', 'pasif' => 'Pasif']),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Düzenle'),
                Tables\Actions\DeleteAction::make()->label('Ayır'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Seçilenleri ayır'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        if (! SaaSemaYardimcisi::tabloVarMi('kullanici_yetkileri')) {
            return [];
        }

        return [
            RelationManagers\OzelYetkilerleIliskiYoneticisi::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\FirmaIciKullaniciListesi::route('/'),
            'create' => Pages\FirmaIciKullaniciOlustur::route('/create'),
            'edit' => Pages\FirmaIciKullaniciDuzenle::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        if (! SaaSemaYardimcisi::firmaKullanicilariTablosuVarMi()) {
            return false;
        }

        return Auth::check() && Auth::user()->can('viewAny', FirmaKullanici::class);
    }

    public static function canCreate(): bool
    {
        if (! SaaSemaYardimcisi::firmaKullanicilariTablosuVarMi()) {
            return false;
        }

        return Auth::check() && Auth::user()->can('create', FirmaKullanici::class);
    }

    public static function canEdit(Model $kayit): bool
    {
        if (! SaaSemaYardimcisi::firmaKullanicilariTablosuVarMi()) {
            return false;
        }

        return Auth::check() && Auth::user()->can('update', $kayit);
    }

    public static function canDelete(Model $kayit): bool
    {
        if (! SaaSemaYardimcisi::firmaKullanicilariTablosuVarMi()) {
            return false;
        }

        return Auth::check() && Auth::user()->can('delete', $kayit);
    }

    protected static function superAdminMi(): bool
    {
        $k = Auth::user();

        return $k instanceof User
            && ((bool) ($k->super_admin_mi ?? false) || (bool) ($k->is_admin ?? false));
    }
}
