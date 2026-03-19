<?php

namespace App\Filament\Clusters\Web\Pages;

use Filament\Forms;

class ModulMusteriYorumlari extends BaseModulSectionEditor
{
    protected static ?string $title = 'Müşteri Yorumları';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/musteri-yorumlari';

    protected static function getModuleKey(): string
    {
        return 'musteri_yorumlari';
    }

    protected function getDefaultData(): array
    {
        return [
            'heading' => 'Müşteri Yorumları',
            'sub_span' => 'Gerçek',
            'sub_text' => 'geri bildirimler',
            'quote_icon' => '',
            'author_image_1' => '',
            'name_1' => 'Sophia Reynolds',
            'role_1' => 'CEO',
            'comment_1' => 'Kurulum çok hızlı ve temiz yapıldı. Görüntü kalitesi harika.',
            'author_image_2' => '',
            'name_2' => 'Kathryn Murphy',
            'role_2' => 'Yönetici',
            'comment_2' => 'Teknik destek hızlı. Tavsiye ederim.',
            'author_image_3' => '',
            'name_3' => 'John Miller',
            'role_3' => 'IT Manager',
            'comment_3' => 'Sistem stabil çalışıyor, uzaktan izleme sorunsuz.',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('heading')->label('Bölüm Başlığı')->required(),
            Forms\Components\TextInput::make('sub_span')->label('Alt Başlık (Span)')->required(),
            Forms\Components\TextInput::make('sub_text')->label('Alt Başlık (Devamı)')->required(),
            Forms\Components\FileUpload::make('quote_icon')->label('Alıntı İkonu')->image()->disk('public')->directory('moduller/musteri-yorumlari')->visibility('public'),

            Forms\Components\FileUpload::make('author_image_1')->label('Yorum 1 Yazar Görseli')->image()->disk('public')->directory('moduller/musteri-yorumlari')->visibility('public'),
            Forms\Components\TextInput::make('name_1')->label('Yorum 1 İsim')->required(),
            Forms\Components\TextInput::make('role_1')->label('Yorum 1 Ünvan')->required(),
            Forms\Components\Textarea::make('comment_1')->label('Yorum 1 Metni')->rows(2)->required(),

            Forms\Components\FileUpload::make('author_image_2')->label('Yorum 2 Yazar Görseli')->image()->disk('public')->directory('moduller/musteri-yorumlari')->visibility('public'),
            Forms\Components\TextInput::make('name_2')->label('Yorum 2 İsim')->required(),
            Forms\Components\TextInput::make('role_2')->label('Yorum 2 Ünvan')->required(),
            Forms\Components\Textarea::make('comment_2')->label('Yorum 2 Metni')->rows(2)->required(),

            Forms\Components\FileUpload::make('author_image_3')->label('Yorum 3 Yazar Görseli')->image()->disk('public')->directory('moduller/musteri-yorumlari')->visibility('public'),
            Forms\Components\TextInput::make('name_3')->label('Yorum 3 İsim')->required(),
            Forms\Components\TextInput::make('role_3')->label('Yorum 3 Ünvan')->required(),
            Forms\Components\Textarea::make('comment_3')->label('Yorum 3 Metni')->rows(2)->required(),
        ];
    }
}

