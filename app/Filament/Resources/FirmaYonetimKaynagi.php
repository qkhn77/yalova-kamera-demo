<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FirmaYonetimKaynagi\Pages;
use App\Filament\Resources\FirmaYonetimKaynagi\RelationManagers;
use App\Models\Firma;
use App\Models\User;
use App\Support\DenetimYardimcisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FirmaYonetimKaynagi extends Resource
{
    protected static ?string $model = Firma::class;

    protected static ?string $slug = 'sistem-firmalar';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationLabel(): string
    {
        return 'Firmalar';
    }

    public static function getModelLabel(): string
    {
        return 'Firma';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Firmalar';
    }

    /**
     * Policy’deki firma.guncelle kiracıya açık kalır; bu SaaS ekranı yalnızca süper admin içindir.
     */
    protected static function sadeceSistemYoneticisi(): bool
    {
        $kullanici = auth()->user();

        return $kullanici instanceof User
            && ((bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false));
    }

    public static function canAccess(): bool
    {
        return static::sadeceSistemYoneticisi();
    }

    public static function canViewAny(): bool
    {
        return static::sadeceSistemYoneticisi();
    }

    public static function canView(Model $kayit): bool
    {
        return static::sadeceSistemYoneticisi();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Firma bilgileri')
                ->schema([
                    Forms\Components\TextInput::make('ad')
                        ->label('Firma adı')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('kisa_ad')
                        ->label('Kısa ad')
                        ->maxLength(120),
                    Forms\Components\TextInput::make('firma_kodu')
                        ->label('Firma kodu')
                        ->maxLength(100)
                        ->helperText('Boş bırakılırsa otomatik üretilir.')
                        ->unique(Firma::class, 'firma_kodu', ignoreRecord: true),
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
                    Forms\Components\TextInput::make('vergi_no')
                        ->label('Vergi no')
                        ->maxLength(50),
                    Forms\Components\Select::make('durum')
                        ->label('Durum')
                        ->options(Firma::durumSecenekleri())
                        ->required()
                        ->native(false),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('ad')->label('Firma adı')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('firma_kodu')->label('Firma kodu')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('telefon')->label('Telefon')->searchable(),
                Tables\Columns\TextColumn::make('eposta')->label('E-posta')->searchable(),
                Tables\Columns\TextColumn::make('durum')
                    ->label('Durum')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => Firma::durumSecenekleri()[$state] ?? (string) $state)
                    ->color(fn (?string $state): string => match ($state) {
                        Firma::DURUM_AKTIF => 'success',
                        Firma::DURUM_BEKLEMEDE => 'warning',
                        Firma::DURUM_ASKIDA => 'danger',
                        Firma::DURUM_SURESI_DOLDU => 'gray',
                        Firma::DURUM_IPTAL_EDILDI => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('durum')
                    ->label('Durum')
                    ->options(Firma::durumSecenekleri()),
                Tables\Filters\Filter::make('created_at')
                    ->label('Oluşturulma')
                    ->form([
                        Forms\Components\DatePicker::make('baslangic')->label('Başlangıç'),
                        Forms\Components\DatePicker::make('bitis')->label('Bitiş'),
                    ])
                    ->query(function (Builder $sorgu, array $veri): Builder {
                        return $sorgu
                            ->when($veri['baslangic'] ?? null, fn (Builder $q, $t) => $q->whereDate('created_at', '>=', $t))
                            ->when($veri['bitis'] ?? null, fn (Builder $q, $t) => $q->whereDate('created_at', '<=', $t));
                    }),
                Tables\Filters\Filter::make('firma_kodu')
                    ->label('Firma kodu')
                    ->form([
                        Forms\Components\TextInput::make('deger')->label('Kod içerir'),
                    ])
                    ->query(function (Builder $sorgu, array $veri): Builder {
                        $d = $veri['deger'] ?? null;
                        if (! filled($d)) {
                            return $sorgu;
                        }

                        return $sorgu->where('firma_kodu', 'like', '%'.$d.'%');
                    }),
                Tables\Filters\Filter::make('firma_adi')
                    ->label('Firma adı')
                    ->form([
                        Forms\Components\TextInput::make('deger')->label('Ad içerir'),
                    ])
                    ->query(function (Builder $sorgu, array $veri): Builder {
                        $d = $veri['deger'] ?? null;
                        if (! filled($d)) {
                            return $sorgu;
                        }

                        return $sorgu->where('ad', 'like', '%'.$d.'%');
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('onayla')
                        ->label('Onayla (aktif)')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (Firma $kayit): bool => $kayit->durum !== Firma::DURUM_AKTIF)
                        ->action(function (Firma $kayit): void {
                            $kayit->update([
                                'durum' => Firma::DURUM_AKTIF,
                                'onaylandi_mi' => true,
                                'onay_tarihi' => now(),
                                'onaylayan_kullanici_id' => auth()->id(),
                            ]);
                            DenetimYardimcisi::kaydet('firma_durumu_degisti', Firma::class, (int) $kayit->id, (int) $kayit->id, null, [
                                'durum' => Firma::DURUM_AKTIF,
                                'onaylandi_mi' => true,
                            ]);
                        }),
                    Tables\Actions\Action::make('askiya_al')
                        ->label('Askıya al')
                        ->icon('heroicon-o-pause-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->visible(fn (Firma $kayit): bool => $kayit->durum !== Firma::DURUM_ASKIDA)
                        ->action(function (Firma $kayit): void {
                            $kayit->update(['durum' => Firma::DURUM_ASKIDA]);
                            DenetimYardimcisi::kaydet('firma_durumu_degisti', Firma::class, (int) $kayit->id, (int) $kayit->id, null, ['durum' => Firma::DURUM_ASKIDA]);
                        }),
                    Tables\Actions\Action::make('iptal_et')
                        ->label('İptal et')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (Firma $kayit): bool => $kayit->durum !== Firma::DURUM_IPTAL_EDILDI)
                        ->action(function (Firma $kayit): void {
                            $kayit->update(['durum' => Firma::DURUM_IPTAL_EDILDI]);
                            DenetimYardimcisi::kaydet('firma_durumu_degisti', Firma::class, (int) $kayit->id, (int) $kayit->id, null, ['durum' => Firma::DURUM_IPTAL_EDILDI]);
                        }),
                    Tables\Actions\Action::make('beklemede_yap')
                        ->label('Beklemede yap')
                        ->icon('heroicon-o-clock')
                        ->requiresConfirmation()
                        ->visible(fn (Firma $kayit): bool => $kayit->durum !== Firma::DURUM_BEKLEMEDE)
                        ->action(function (Firma $kayit): void {
                            $kayit->update(['durum' => Firma::DURUM_BEKLEMEDE]);
                            DenetimYardimcisi::kaydet('firma_durumu_degisti', Firma::class, (int) $kayit->id, (int) $kayit->id, null, ['durum' => Firma::DURUM_BEKLEMEDE]);
                        }),
                ]),
                Tables\Actions\EditAction::make()->label('Düzenle'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\KullanicilarlaIliskiYoneticisi::class,
            RelationManagers\ModullerleIliskiYoneticisi::class,
            RelationManagers\AboneliklerleIliskiYoneticisi::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\FirmaListesi::route('/'),
            'create' => Pages\FirmaOlustur::route('/create'),
            'edit' => Pages\FirmaDuzenle::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return static::sadeceSistemYoneticisi();
    }

    public static function canEdit(Model $kayit): bool
    {
        return static::sadeceSistemYoneticisi();
    }

    public static function canDelete(Model $kayit): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }
}
