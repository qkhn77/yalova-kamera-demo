<?php

namespace App\Filament\Resources\FirmaYonetimKaynagi\RelationManagers;

use App\Models\FirmaKullanici;
use App\Support\DenetimYardimcisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class KullanicilarlaIliskiYoneticisi extends RelationManager
{
    protected static string $relationship = 'firmaKullanicilari';

    protected static ?string $title = 'Firma kullanıcıları';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('durum')
                ->label('Durum')
                ->options([
                    'aktif' => 'Aktif',
                    'pasif' => 'Pasif',
                ])
                ->required(),
            Forms\Components\Select::make('onay_durumu')
                ->label('Onay durumu')
                ->options([
                    'aktif' => 'Aktif',
                    'beklemede' => 'Beklemede',
                ])
                ->helperText('Giriş için genelde «Aktif» olmalıdır.'),
            Forms\Components\Select::make('rol_id')
                ->label('Rol')
                ->relationship('rol', 'ad')
                ->searchable()
                ->preload(),
            Forms\Components\Toggle::make('varsayilan_firma_mi')
                ->label('Varsayılan firma'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('kullanici.kullanici_adi')->label('Kullanıcı adı')->searchable(),
                Tables\Columns\TextColumn::make('kullanici.email')->label('E-posta')->searchable(),
                Tables\Columns\TextColumn::make('rol.ad')->label('Rol')->placeholder('—'),
                Tables\Columns\TextColumn::make('durum')->label('Durum')->badge(),
                Tables\Columns\TextColumn::make('onay_durumu')->label('Onay')->badge()->placeholder('aktif'),
                Tables\Columns\IconColumn::make('varsayilan_firma_mi')->label('Varsayılan')->boolean(),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Düzenle')
                    ->using(function (array $veri, Model $kayit): void {
                        /** @var FirmaKullanici $kayit */
                        $kayit->update($veri);
                        $kayit->refresh();
                        DenetimYardimcisi::kaydet(
                            'firma_kullanicisi_guncellendi',
                            FirmaKullanici::class,
                            (int) $kayit->getKey(),
                            (int) $kayit->firma_id,
                            null,
                            $kayit->only(['durum', 'onay_durumu', 'rol_id', 'varsayilan_firma_mi'])
                        );
                    }),
            ])
            ->bulkActions([]);
    }
}
