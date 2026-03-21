<?php

namespace App\Filament\Resources\FirmaIciKullaniciKaynagi\RelationManagers;

use App\Models\User;
use App\Services\YetkiService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OzelYetkilerleIliskiYoneticisi extends RelationManager
{
    protected static string $relationship = 'ozelYetkiler';

    protected static ?string $title = 'Özel yetkiler (ver / reddet)';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('yetki_id')
                ->label('Yetki')
                ->options(function (): array {
                    $veren = auth()->user();
                    /** @var FirmaKullanici $sahip */
                    $sahip = $this->getOwnerRecord();
                    if (! $veren instanceof User) {
                        return [];
                    }

                    return app(YetkiService::class)
                        ->atanabilirYetkiKayitlari($veren, (int) $sahip->firma_id)
                        ->mapWithKeys(fn ($y) => [$y->id => $y->kod.' — '.$y->ad])
                        ->all();
                })
                ->required()
                ->searchable(),
            Forms\Components\Select::make('izin_tipi')
                ->label('İzin tipi')
                ->options([
                    'ver' => 'Ver',
                    'reddet' => 'Reddet',
                ])
                ->required()
                ->default('ver')
                ->native(false),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('yetki.kod')->label('Kod')->searchable(),
                Tables\Columns\TextColumn::make('yetki.ad')->label('Açıklama'),
                Tables\Columns\TextColumn::make('izin_tipi')->label('Tip')->badge()
                    ->formatStateUsing(fn (?string $s): string => match ($s) {
                        'ver' => 'Ver',
                        'reddet' => 'Reddet',
                        default => (string) $s,
                    }),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Satır ekle'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Düzenle'),
                Tables\Actions\DeleteAction::make()->label('Sil'),
            ])
            ->bulkActions([]);
    }
}
