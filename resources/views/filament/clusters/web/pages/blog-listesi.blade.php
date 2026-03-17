<x-filament-panels::page>
    {{-- Header arka planı yok; beyaz yuvarlak kart sadece tablo alanında --}}
    <div class="blog-listesi-page">
        <div class="blog-listesi-table-card rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden">
            {{ $this->table() }}
        </div>
    </div>

    <style>
        /* Blog listesi: başlık ve Yeni yazı butonunun olduğu alan arka plansız */
        .fi-page:has(.blog-listesi-page) .fi-header {
            background: transparent !important;
            padding-bottom: 0.5rem;
        }
        /* Beyaz yuvarlak alan butondan sonra (tablo kartı) başlar */
        .blog-listesi-table-card .fi-ta-header {
            background: transparent !important;
            border-bottom: 1px solid rgb(229 231 235);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .dark .blog-listesi-table-card .fi-ta-header {
            border-bottom-color: rgb(75 85 99);
        }
        /* Satır yüksekliği sabit; fotoğrafa göre büyümez, tüm sütunlar aynı yükseklikte */
        .blog-listesi-table-card .fi-ta-row {
            min-height: 3rem;
            height: 3rem;
        }
        .blog-listesi-table-card .fi-ta-row > td {
            vertical-align: middle;
        }
        .blog-listesi-table-card .blog-listesi-cell-image {
            max-width: 3rem;
            max-height: 3rem;
        }
        .blog-listesi-table-card .blog-listesi-cell-image img {
            max-width: 3rem !important;
            max-height: 3rem !important;
        }
    </style>

    {{-- Görsel ön izleme: tablodaki görsele tıklanınca bu modal açılır --}}
    <x-filament-actions::modals />

    @script
    <script>
        $wire.on('open-image-preview', (e) => {
            if (!e.url) return;
            const modal = document.createElement('div');
            modal.id = 'image-preview-overlay';
            modal.className = 'fixed inset-0 z-[100] flex items-center justify-center bg-black/70 p-4';
            modal.innerHTML = `
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-4xl max-h-[90vh] overflow-auto p-4" @click.stop>
                    <div class="flex justify-end mb-2">
                        <button type="button" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" data-close-preview>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <img src="${e.url}" alt="${e.title || 'Ön izleme'}" class="max-w-full max-h-[80vh] object-contain mx-auto rounded-lg" />
                    ${e.title ? `<p class="text-sm text-gray-500 dark:text-gray-400 text-center mt-2">${e.title}</p>` : ''}
                </div>
            `;
            const close = () => {
                modal.remove();
                document.body.style.overflow = '';
            };
            modal.querySelector('[data-close-preview]').addEventListener('click', close);
            modal.addEventListener('click', (ev) => { if (ev.target === modal) close(); });
            document.body.style.overflow = 'hidden';
            document.body.appendChild(modal);
        });
    </script>
    @endscript
</x-filament-panels::page>
