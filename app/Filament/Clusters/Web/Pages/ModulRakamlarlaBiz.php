<?php

namespace App\Filament\Clusters\Web\Pages;

use Filament\Forms;

class ModulRakamlarlaBiz extends BaseModulSectionEditor
{
    protected static ?string $title = 'Rakamlarla Biz';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/rakamlarla-biz';

    protected static function getModuleKey(): string
    {
        return 'rakamlarla_biz';
    }

    protected function getDefaultData(): array
    {
        return [
            'heading' => 'Özellikler',
            'sub_span' => 'Gelişmiş',
            'sub_text' => 'güvenlik sistemleri',
            'contact_circle' => '',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('heading')->label('Bölüm Başlığı')->required(),
            Forms\Components\TextInput::make('sub_span')->label('Alt Başlık (Span)')->required(),
            Forms\Components\TextInput::make('sub_text')->label('Alt Başlık (Devamı)')->required(),
            Forms\Components\FileUpload::make('contact_circle')->label('İletişim Çember Görseli')->image()->disk('public')->directory('moduller/rakamlarla-biz')->visibility('public'),

            Forms\Components\FileUpload::make('icon_1')->label('Özellik 1 İkon')->image()->disk('public')->directory('moduller/rakamlarla-biz')->visibility('public'),
            Forms\Components\TextInput::make('title_1')->label('Özellik 1 Başlık')->default('7/24 İzleme & Bildirim'),
            Forms\Components\Textarea::make('text_1')->label('Özellik 1 Metin')->rows(2)->default('Kesintisiz izleme ve hızlı bildirim altyapısı.'),

            Forms\Components\FileUpload::make('icon_2')->label('Özellik 2 İkon')->image()->disk('public')->directory('moduller/rakamlarla-biz')->visibility('public'),
            Forms\Components\TextInput::make('title_2')->label('Özellik 2 Başlık')->default('Yüksek Çözünürlük'),
            Forms\Components\Textarea::make('text_2')->label('Özellik 2 Metin')->rows(2)->default('Net görüntü ve güçlü gece görüş seçenekleri.'),

            Forms\Components\FileUpload::make('icon_3')->label('Özellik 3 İkon')->image()->disk('public')->directory('moduller/rakamlarla-biz')->visibility('public'),
            Forms\Components\TextInput::make('title_3')->label('Özellik 3 Başlık')->default('Genişletilebilir Yapı'),
            Forms\Components\Textarea::make('text_3')->label('Özellik 3 Metin')->rows(2)->default('İhtiyacınıza göre ek kamera ve cihaz desteği.'),

            Forms\Components\FileUpload::make('icon_4')->label('Özellik 4 İkon')->image()->disk('public')->directory('moduller/rakamlarla-biz')->visibility('public'),
            Forms\Components\TextInput::make('title_4')->label('Özellik 4 Başlık')->default('Darbeye Dayanım'),
            Forms\Components\Textarea::make('text_4')->label('Özellik 4 Metin')->rows(2)->default('Dış ortam koşullarına uygun sağlam tasarım.'),

            Forms\Components\TextInput::make('counter_1')->label('Sayaç 1 Değer')->default('220'),
            Forms\Components\TextInput::make('counter_label_1')->label('Sayaç 1 Etiket')->default('Konut'),
            Forms\Components\TextInput::make('counter_2')->label('Sayaç 2 Değer')->default('30'),
            Forms\Components\TextInput::make('counter_label_2')->label('Sayaç 2 Etiket')->default('AVM & Bina'),
            Forms\Components\TextInput::make('counter_3')->label('Sayaç 3 Değer')->default('100'),
            Forms\Components\TextInput::make('counter_label_3')->label('Sayaç 3 Etiket')->default('Ticari Alan'),
            Forms\Components\TextInput::make('counter_4')->label('Sayaç 4 Değer')->default('700'),
            Forms\Components\TextInput::make('counter_label_4')->label('Sayaç 4 Etiket')->default('Proje'),
            Forms\Components\TextInput::make('counter_5')->label('Sayaç 5 Değer')->default('10'),
            Forms\Components\TextInput::make('counter_label_5')->label('Sayaç 5 Etiket')->default('Yıl Deneyim'),
        ];
    }
}

