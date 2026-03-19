<?php

namespace App\Filament\Clusters\Web\Pages;

use Filament\Forms;

class ModulReferanslar extends BaseModulSectionEditor
{
    protected static ?string $title = 'Referanslar';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/referanslar';

    protected static function getModuleKey(): string
    {
        return 'referanslar';
    }

    protected function getDefaultData(): array
    {
        return [
            'heading' => 'Projeler',
            'sub_span' => 'Örnek',
            'sub_text' => 'uygulamalar',
        ];
    }

    protected function getEditorSchema(): array
    {
        return [
            Forms\Components\Placeholder::make('info')
                ->label('Not')
                ->content('Bu modülde şu an başlık alanları formdan yönetilir. Proje kartları mevcut dinamik proje yapısına geçişte güncellenecektir.'),
            Forms\Components\TextInput::make('heading')->label('Bölüm Başlığı')->required(),
            Forms\Components\TextInput::make('sub_span')->label('Alt Başlık (Span)')->required(),
            Forms\Components\TextInput::make('sub_text')->label('Alt Başlık (Devamı)')->required(),
        ];
    }
}

