<?php

namespace App\Filament\Resources\FirmaYonetimKaynagi\RelationManagers;

use App\Models\FirmaModulu;
use App\Models\Modul;
use App\Support\DenetimYardimcisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ModullerleIliskiYoneticisi extends RelationManager
{
    protected static string $relationship = 'firmaModulleri';

    protected static ?string $title = 'Firma modülleri';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('modul_id')
                ->label('Modül')
                ->options(function (): array {
                    $firmaId = (int) $this->getOwnerRecord()->getKey();
                    $atanmis = FirmaModulu::query()
                        ->where('firma_id', $firmaId)
                        ->pluck('modul_id');

                    return Modul::query()
                        ->where('aktif_mi', true)
                        ->whereNotIn('id', $atanmis)
                        ->orderBy('ad')
                        ->pluck('ad', 'id')
                        ->all();
                })
                ->required()
                ->searchable(),
            Forms\Components\Select::make('durum')
                ->label('Durum')
                ->options([
                    'aktif' => 'Aktif',
                    'salt_okunur' => 'Salt okunur',
                    'kapali' => 'Kapalı',
                ])
                ->required()
                ->default('aktif')
                ->native(false),
            Forms\Components\DatePicker::make('baslangic_tarihi')->label('Başlangıç'),
            Forms\Components\DatePicker::make('bitis_tarihi')->label('Bitiş'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('modul.ad')->label('Modül')->searchable(),
                Tables\Columns\TextColumn::make('modul.kod')->label('Kod'),
                Tables\Columns\TextColumn::make('durum')
                    ->label('Durum')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'aktif' => 'Aktif',
                        'salt_okunur' => 'Salt okunur',
                        'kapali' => 'Kapalı',
                        default => (string) $state,
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'aktif' => 'success',
                        'salt_okunur' => 'warning',
                        'kapali' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('baslangic_tarihi')->label('Başlangıç')->date('d.m.Y'),
                Tables\Columns\TextColumn::make('bitis_tarihi')->label('Bitiş')->date('d.m.Y'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Modül ekle')
                    ->using(function (array $data, Table $table): FirmaModulu {
                        $iliski = $table->getRelationship();
                        $kayit = new FirmaModulu($data);
                        $iliski->save($kayit);
                        $kayit->refresh();
                        DenetimYardimcisi::kaydet(
                            'firma_modulu_degisti',
                            FirmaModulu::class,
                            (int) $kayit->getKey(),
                            (int) $kayit->firma_id,
                            null,
                            $kayit->only(['modul_id', 'durum', 'baslangic_tarihi', 'bitis_tarihi'])
                        );

                        return $kayit;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Düzenle')
                    ->form([
                        Forms\Components\Select::make('durum')
                            ->label('Durum')
                            ->options([
                                'aktif' => 'Aktif',
                                'salt_okunur' => 'Salt okunur',
                                'kapali' => 'Kapalı',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('baslangic_tarihi')->label('Başlangıç'),
                        Forms\Components\DatePicker::make('bitis_tarihi')->label('Bitiş'),
                    ])
                    ->using(function (array $data, Model $record, Table $table): void {
                        /** @var FirmaModulu $record */
                        $record->update($data);
                        $record->refresh();
                        DenetimYardimcisi::kaydet(
                            'firma_modulu_degisti',
                            FirmaModulu::class,
                            (int) $record->getKey(),
                            (int) $record->firma_id,
                            null,
                            $record->only(['durum', 'baslangic_tarihi', 'bitis_tarihi'])
                        );
                    }),
            ])
            ->bulkActions([]);
    }
}
