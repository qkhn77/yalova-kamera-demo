<?php

namespace App\Filament\Resources\FirmaYonetimKaynagi\RelationManagers;

use App\Models\FirmaAboneligi;
use App\Support\DenetimYardimcisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AboneliklerleIliskiYoneticisi extends RelationManager
{
    protected static string $relationship = 'firmaAbonelikleri';

    protected static ?string $title = 'Abonelikler';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('plan_id')
                ->label('Plan')
                ->relationship('plan', 'ad', fn ($sorgu) => $sorgu->orderBy('ad'))
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Select::make('durum')
                ->label('Durum')
                ->options([
                    'aktif' => 'Aktif',
                    'suresi_doldu' => 'Süresi doldu',
                    'iptal' => 'İptal',
                ])
                ->required()
                ->default('aktif')
                ->native(false),
            Forms\Components\DatePicker::make('baslangic_tarihi')
                ->label('Başlangıç')
                ->required()
                ->default(now()),
            Forms\Components\DatePicker::make('bitis_tarihi')
                ->label('Bitiş')
                ->required()
                ->default(now()->addMonth()),
            Forms\Components\Toggle::make('otomatik_yenileme')
                ->label('Otomatik yenileme'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('plan.ad')->label('Plan')->sortable(),
                Tables\Columns\TextColumn::make('plan.kod')->label('Plan kodu'),
                Tables\Columns\TextColumn::make('durum')
                    ->label('Durum')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'aktif' => 'Aktif',
                        'suresi_doldu' => 'Süresi doldu',
                        'iptal' => 'İptal',
                        default => (string) $state,
                    }),
                Tables\Columns\TextColumn::make('baslangic_tarihi')->label('Başlangıç')->date('d.m.Y'),
                Tables\Columns\TextColumn::make('bitis_tarihi')->label('Bitiş')->date('d.m.Y'),
                Tables\Columns\IconColumn::make('otomatik_yenileme')->label('Oto. yenileme')->boolean(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Abonelik ekle')
                    ->using(function (array $data, Table $table): FirmaAboneligi {
                        $iliski = $table->getRelationship();
                        $kayit = new FirmaAboneligi($data);
                        $iliski->save($kayit);
                        $kayit->refresh();
                        DenetimYardimcisi::kaydet(
                            'abonelik_guncellendi',
                            FirmaAboneligi::class,
                            (int) $kayit->getKey(),
                            (int) $kayit->firma_id,
                            null,
                            $kayit->only(['plan_id', 'durum', 'baslangic_tarihi', 'bitis_tarihi'])
                        );

                        return $kayit;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Düzenle')
                    ->using(function (array $data, Model $record, Table $table): void {
                        /** @var FirmaAboneligi $record */
                        $record->update($data);
                        $record->refresh();
                        DenetimYardimcisi::kaydet(
                            'abonelik_guncellendi',
                            FirmaAboneligi::class,
                            (int) $record->getKey(),
                            (int) $record->firma_id,
                            null,
                            $record->only(['plan_id', 'durum', 'baslangic_tarihi', 'bitis_tarihi', 'otomatik_yenileme'])
                        );
                    }),
            ])
            ->bulkActions([]);
    }
}
