<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use App\Models\Post;
use App\Services\ThumbnailService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogListesi extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $cluster = Web::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Blog Yönetimi';

    protected static ?string $slug = 'bloglar/blog-listesi';

    protected static string $view = 'filament.clusters.web.pages.blog-listesi';

    public static function getNavigationLabel(): string
    {
        return 'Blog Listesi';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Blog Yönetimi';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Blog Yönetimi';
    }

    public function getSubheading(): ?string
    {
        return 'Blog yazılarını ekleyin, düzenleyin. Görsele tıklayarak ön izleme yapabilirsiniz.';
    }

    public function table(?Table $table = null): Table
    {
        if ($table === null) {
            return $this->getTable();
        }

        return $table
            ->query(Post::query()->with('category'))
            ->columns([
                Tables\Columns\ViewColumn::make('image')
                    ->label('Görsel')
                    ->view('filament.clusters.web.columns.blog-image-preview')
                    ->alignCenter()
                    ->width('3rem')
                    ->sortable(false),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Yayın tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Yayında')
                    ->onColor('success')
                    ->offColor('gray')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->defaultPaginationPageOption(15)
            ->filters([
                Tables\Filters\SelectFilter::make('post_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Yayında'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Blog ekle')
                    ->modalHeading('Blog ekle')
                    ->icon('heroicon-o-plus')
                    ->form($this->getPostFormSchema())
                    ->mutateFormDataUsing(function (array $data): array {
                        if (empty($data['slug']) && ! empty($data['title'])) {
                            $data['slug'] = Str::slug($data['title']);
                        }
                        return $data;
                    })
                    ->action(function (array $data): void {
                        $imageName = $data['image_name'] ?? null;
                        unset($data['image_name']);
                        $post = Post::create($data);
                        if ($imageName && $post->image) {
                            $newPath = $this->renameStoredImage($post->image, $imageName);
                            if ($newPath) {
                                $post->update(['image' => $newPath]);
                            }
                        }
                        if ($post->image) {
                            app(ThumbnailService::class)->generate('posts', $post->image);
                        }
                        Notification::make()
                            ->title('Blog yazısı eklendi.')
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Görüntüle')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Post $record): string => route('blog.show', $record->slug), shouldOpenInNewTab: true),
                Tables\Actions\EditAction::make()
                    ->label('Düzenle')
                    ->icon('heroicon-o-pencil-square')
                    ->form($this->getPostFormSchema())
                    ->fillForm(fn (Post $record): array => array_merge($record->toArray(), [
                        'image_name' => $record->image ? pathinfo($record->image, PATHINFO_FILENAME) : '',
                    ]))
                    ->action(function (Post $record, array $data): void {
                        $imageName = $data['image_name'] ?? null;
                        unset($data['image_name']);
                        $record->update($data);
                        if ($imageName && $record->image) {
                            $currentBase = pathinfo($record->image, PATHINFO_FILENAME);
                            $desiredBase = Str::slug($imageName);
                            if ($desiredBase !== $currentBase) {
                                $newPath = $this->renameStoredImage($record->image, $imageName);
                                if ($newPath) {
                                    $record->update(['image' => $newPath]);
                                }
                            }
                        }
                        if ($record->image) {
                            app(ThumbnailService::class)->generate('posts', $record->image);
                        }
                        Notification::make()
                            ->title('Blog yazısı güncellendi.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->label('Sil')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('kopyala')
                        ->label('Kopyala')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('info')
                        ->action(function ($records): void {
                            foreach ($records as $post) {
                                $copy = $post->replicate();
                                $copy->title = $post->title . ' (Kopya)';
                                $copy->slug = Str::slug($copy->title) . '-' . uniqid();
                                $copy->is_published = false;
                                $copy->published_at = null;
                                $copy->save();
                            }
                        })
                        ->deselectRecordsAfterCompletion()
                        ->successNotificationTitle('Seçilen yazılar kopyalandı.'),
                    Tables\Actions\BulkAction::make('yayinla')
                        ->label('Yayınla')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_published' => true]))
                        ->deselectRecordsAfterCompletion()
                        ->successNotificationTitle('Seçilen yazılar yayınlandı.'),
                    Tables\Actions\BulkAction::make('yayindanKaldir')
                        ->label('Yayından kaldır')
                        ->icon('heroicon-o-eye-slash')
                        ->color('gray')
                        ->action(fn ($records) => $records->each->update(['is_published' => false]))
                        ->deselectRecordsAfterCompletion()
                        ->successNotificationTitle('Seçilen yazılar yayından kaldırıldı.'),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->checkIfRecordIsSelectableUsing(fn (Post $record): bool => true);
    }

    protected function getPostFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Blog yazısı')
                ->schema([
                    // 0. Kategori (en başta)
                    Forms\Components\Select::make('post_category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->placeholder('Kategori seçin'),
                    // 1. SEO Başlık (Google title)
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık (SEO)')
                        ->required()
                        ->maxLength(70)
                        ->live(debounce: 0)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation === 'create' && $state) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->helperText(fn ($state) => mb_strlen((string) $state).' / 70 karakter. Google arama sonuçlarında görünür. 50-60 karakter önerilir.'),
                    // 2. Özet (meta description)
                    Forms\Components\Textarea::make('excerpt')
                        ->label('Özet (Meta Açıklama)')
                        ->required()
                        ->maxLength(165)
                        ->rows(3)
                        ->columnSpanFull()
                        ->live(debounce: 0)
                        ->helperText(fn ($state) => mb_strlen((string) $state).' / 165 karakter. 150-160 karakter önerilir.'),
                    // 3. Anahtar kelimeler
                    Forms\Components\TextInput::make('meta_keywords')
                        ->label('Anahtar kelimeler')
                        ->required()
                        ->maxLength(500)
                        ->columnSpanFull()
                        ->placeholder('yalova kamera, ip kamera kurulumu, güvenlik kamera')
                        ->helperText('Sayfa ile ilgili anahtar kelimeler. Virgül ile ayrılmalıdır.'),
                    // 4. Slug (SEO URL)
                    Forms\Components\TextInput::make('slug')
                        ->label('SEO URL adresi')
                        ->required()
                        ->maxLength(255)
                        ->unique(Post::class, 'slug', ignoreRecord: true)
                        ->rules(['alpha_dash:ascii'])
                        ->placeholder('ip-kamera-kurulumu')
                        ->helperText('Sayfanın SEO uyumlu URL adresidir. Google\'a sayfanın ana versiyonunu bildirir. Duplicate içerik oluşmasını engeller. Boş bırakılırsa başlıktan otomatik oluşturulur.'),
                    // 5. İçerik (Açıklama editör)
                    Forms\Components\RichEditor::make('content')
                        ->label('Açıklama (içerik)')
                        ->required()
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('posts'),
                    // Görsel + dosya adı
                    Forms\Components\FileUpload::make('image')
                        ->label('Görsel')
                        ->disk('public')
                        ->directory('posts')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Önerilen: 1200x630 px. Max 2 MB.'),
                    Forms\Components\TextInput::make('image_name')
                        ->label('Görsel dosya adı')
                        ->placeholder('Örn: blog-yazim-gorseli')
                        ->maxLength(255)
                        ->helperText('İsteğe bağlı. Yüklemeden önce veya sonra değiştirebilirsiniz. Uzantı otomatik eklenir.'),
                    // 6. OG Title
                    Forms\Components\TextInput::make('og_title')
                        ->label('OG Title')
                        ->maxLength(100)
                        ->columnSpanFull()
                        ->live(debounce: 0)
                        ->helperText(fn ($state) => mb_strlen((string) $state).' / 100 karakter. Boş bırakılırsa SEO başlığı kullanılır.'),
                    // 7. OG Description
                    Forms\Components\Textarea::make('og_description')
                        ->label('OG Description')
                        ->maxLength(200)
                        ->rows(2)
                        ->columnSpanFull()
                        ->live(debounce: 0)
                        ->helperText(fn ($state) => mb_strlen((string) $state).' / 200 karakter. Boş bırakılırsa meta açıklama kullanılır.'),
                    // 8. OG Image
                    Forms\Components\FileUpload::make('og_image')
                        ->label('OG Image')
                        ->disk('public')
                        ->directory('posts')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Sosyal medya paylaşım görseli. Önerilen boyut: 1200x630 px.'),
                    // 9. Google index
                    Forms\Components\Select::make('meta_robots')
                        ->label('Google index ayarı')
                        ->options([
                            'index,follow' => 'index, follow — Sayfa Google\'da görünür (varsayılan)',
                            'noindex,nofollow' => 'noindex, nofollow — Google\'da görünmez',
                        ])
                        ->default('index,follow')
                        ->required(),
                    // 10. Yayın tarihi (varsayılan bugün)
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Yayın tarihi')
                        ->default(now())
                        ->native(false)
                        ->displayFormat('d.m.Y H:i'),
                    // 11. Yayında
                    Forms\Components\Toggle::make('is_published')
                        ->label('Yayında')
                        ->default(true),
                    // 12. Sıra
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Sıra')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(2),
        ];
    }

    /**
     * Storage'daki görseli yeni adla taşır. Yeni path döner veya hata durumunda null.
     */
    protected function renameStoredImage(string $currentPath, string $newNameWithoutExt): ?string
    {
        $disk = Storage::disk('public');
        $path = str_replace('\\', '/', $currentPath);
        $path = ltrim($path, '/');
        if (! str_starts_with($path, 'posts/')) {
            $path = 'posts/'.$path;
        }
        if (! $disk->exists($path)) {
            return null;
        }
        $ext = pathinfo($path, PATHINFO_EXTENSION) ?: 'jpg';
        $base = Str::slug($newNameWithoutExt) ?: 'image';
        $newPath = 'posts/'.$base.'.'.$ext;
        if ($disk->exists($newPath) && $newPath !== $path) {
            $newPath = 'posts/'.$base.'-'.uniqid().'.'.$ext;
        }
        if ($newPath === $path) {
            return $path;
        }
        $disk->move($path, $newPath);

        return $newPath;
    }
}
