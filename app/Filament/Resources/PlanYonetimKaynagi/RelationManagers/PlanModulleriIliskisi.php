<?php

namespace App\Filament\Resources\PlanYonetimKaynagi\RelationManagers;

use App\Models\Modul;
use App\Models\PlanModulu;
use App\Support\DenetimYardimcisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PlanModulleriIliskisi extends RelationManager
{
    protected static string $relationship = 'planModulleri';

    protected static ?string $title = 'Plan modülleri';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('modul_id')
                ->label('Modül')
                ->options(function (): array {
                    $planId = (int) $this->getOwnerRecord()->getKey();
                    $atanmis = PlanModulu::query()
                        ->where('plan_id', $planId)
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
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('modul.ad')->label('Modül')->searchable(),
                Tables\Columns\TextColumn::make('modul.kod')->label('Kod'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Modül bağla')
                    ->using(function (array $data, Table $table): PlanModulu {
                        $iliski = $table->getRelationship();
                        $kayit = new PlanModulu($data);
                        $iliski->save($kayit);
                        $kayit->refresh();
                        DenetimYardimcisi::kaydet(
                            'plan_modulu_degisti',
                            PlanModulu::class,
                            (int) $kayit->getKey(),
                            null,
                            null,
                            ['plan_id' => $kayit->plan_id, 'modul_id' => $kayit->modul_id]
                        );

                        return $kayit;
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('Kaldır')
                    ->using(function (Model $record): bool {
                        /** @var PlanModulu $record */
                        $ozet = ['plan_id' => $record->plan_id, 'modul_id' => $record->modul_id];
                        $anahtar = (int) $record->getKey();
                        $silindi = (bool) $record->delete();
                        if ($silindi) {
                            DenetimYardimcisi::kaydet(
                                'plan_modulu_kaldirildi',
                                PlanModulu::class,
                                $anahtar,
                                null,
                                null,
                                $ozet
                            );
                        }

                        return $silindi;
                    }),
            ])
            ->bulkActions([]);
    }
}
