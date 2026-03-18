<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use App\Models\ContactPage;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class Iletisim extends Page implements HasForms
{
    use InteractsWithForms;
    use \Filament\Pages\Concerns\InteractsWithFormActions;

    protected static ?string $cluster = Web::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = 'İletişim';
    protected static ?string $slug = 'sayfalar/iletisim';
    protected static string $view = 'filament.clusters.web.pages.iletisim';

    public ?array $data = [];

    public function mount(): void
    {
        $c = ContactPage::instance();
        $this->form->fill([
            'meta_title' => $c->meta_title,
            'meta_description' => $c->meta_description,
            'meta_keywords' => $c->meta_keywords,
            'header_heading' => $c->header_heading,
            'section_heading' => $c->section_heading,
            'section_subheading' => $c->section_subheading,
            'section_intro' => $c->section_intro,
            'phone' => $c->phone,
            'email' => $c->email,
            'address' => $c->address,
            'map_url' => $c->map_url,
            'form_heading' => $c->form_heading,
            'form_intro' => $c->form_intro,
            'whatsapp_url' => $c->whatsapp_url,
            'instagram_url' => $c->instagram_url,
            'linkedin_url' => $c->linkedin_url,
            'pinterest_url' => $c->pinterest_url,
            'twitter_url' => $c->twitter_url,
            'facebook_url' => $c->facebook_url,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('İletişim başlığı ve açıklama')
                    ->description('Sayfadaki "İletişim" başlığı, alt başlık ve açıklama metni.')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        Forms\Components\TextInput::make('section_heading')
                            ->label('Bölüm başlığı')
                            ->placeholder('İletişim')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('section_subheading')
                            ->label('Alt başlık (örn: Güvenliğinizi bizimle sağlayın)')
                            ->placeholder('Güvenliğinizi bizimle sağlayın')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('section_intro')
                            ->label('Açıklama metni')
                            ->rows(3)
                            ->placeholder('Sorularınız mı var...')
                            ->maxLength(1000),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Telefon, e-posta, adres')
                    ->description('İletişim sayfasında görünen iletişim bilgileri. Forma gelen mailler Mail Ayarları\'ndaki adrese gider.')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefon')
                            ->placeholder('0 (226) 352 07 24')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('email')
                            ->label('E-posta (sayfada görünen)')
                            ->email()
                            ->placeholder('info@yalovakamera.com')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label('Adres')
                            ->placeholder('Çiftlikköy / Yalova')
                            ->maxLength(255),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Sosyal medya linkleri')
                    ->description('İkonlara tıklanınca açılacak URL\'ler. Boş bırakılan ikon gösterilmez.')
                    ->icon('heroicon-o-share-across')
                    ->schema([
                        Forms\Components\TextInput::make('whatsapp_url')
                            ->label('WhatsApp (örn: 905551234567 veya https://wa.me/905551234567)')
                            ->placeholder('905551234567')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->placeholder('https://instagram.com/...')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pinterest_url')
                            ->label('Pinterest')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('twitter_url')
                            ->label('X (Twitter)')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Google Harita')
                    ->description('Embed URL veya iframe src. Örn: https://www.google.com/maps/embed?pb=...')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Forms\Components\Textarea::make('map_url')
                            ->label('Harita embed URL')
                            ->rows(2)
                            ->placeholder('https://www.google.com/maps?q=Yalova%20Çiftlikköy&output=embed')
                            ->helperText('Google Maps\'te paylaş → Harita yerleştir → src içindeki URL\'yi yapıştırın.')
                            ->maxLength(2000),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Form başlığı (isteğe bağlı)')
                    ->schema([
                        Forms\Components\TextInput::make('form_heading')
                            ->label('Mesaj formu başlığı')
                            ->placeholder('Mesaj Gönder')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('form_intro')
                            ->label('Form açıklaması')
                            ->rows(2)
                            ->maxLength(500),
                    ])
                    ->columns(1)
                    ->collapsed(),

                Forms\Components\Section::make('SEO (isteğe bağlı)')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')->label('Sayfa başlığı (title)')->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')->label('Meta açıklama')->rows(2)->maxLength(500),
                        Forms\Components\TextInput::make('meta_keywords')->label('Meta anahtar kelimeler')->maxLength(255),
                        Forms\Components\TextInput::make('header_heading')->label('Sayfa üst başlık')->maxLength(255),
                    ])
                    ->columns(1)
                    ->collapsed(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $c = ContactPage::instance();

        // WhatsApp: sadece rakam ise wa.me linkine çevir
        if (!empty($data['whatsapp_url']) && preg_match('/^[0-9+]+$/', preg_replace('/\s/', '', $data['whatsapp_url']))) {
            $data['whatsapp_url'] = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $data['whatsapp_url']);
        }

        $c->update($data);
        Notification::make()->title('İletişim sayfası kaydedildi.')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')->label('Kaydet')->action('save')->color('primary'),
        ];
    }
}
