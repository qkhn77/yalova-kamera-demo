@php
    /** @var \App\Models\Firma|null $firma */
    $firma = $firma ?? null;
    $aktifModuller = $aktifModuller ?? [];
    $saltOkunurModuller = $saltOkunurModuller ?? [];
    $kapaliModuller = $kapaliModuller ?? [];
    $kullaniciSayisi = $kullaniciSayisi ?? 0;
    $abonelik = $abonelik ?? null;
@endphp

<x-filament-widgets::widget>
    <x-filament::section heading="Firma özeti" description="Aktif firmanız ve modül durumları">
        @if (! $firma)
            <p class="text-sm text-gray-500 dark:text-gray-400">Firma bilgisi yüklenemedi.</p>
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Firma</div>
                    <div class="mt-1 text-lg font-semibold text-gray-950 dark:text-white">{{ $firma->ad }}</div>
                    <div class="mt-2 text-xs text-gray-500">
                        Durum:
                        <span class="font-medium">{{ \App\Models\Firma::durumSecenekleri()[$firma->durum] ?? $firma->durum }}</span>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Kullanıcı sayısı</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-950 dark:text-white">{{ $kullaniciSayisi }}</div>
                </div>

                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Abonelik</div>
                    @if ($abonelik && $abonelik->plan)
                        <div class="mt-1 font-semibold text-gray-950 dark:text-white">{{ $abonelik->plan->ad }}</div>
                        <div class="mt-1 text-xs text-gray-500">
                            {{ $abonelik->baslangic_tarihi?->format('d.m.Y') }} — {{ $abonelik->bitis_tarihi?->format('d.m.Y') }}
                        </div>
                    @else
                        <div class="mt-1 text-sm text-gray-500">Tanımlı aktif abonelik yok (plan kısıtı gevşetilmiş olabilir).</div>
                    @endif
                </div>
            </div>

            <div class="mt-6 space-y-4">
                <div>
                    <h4 class="text-sm font-semibold text-success-600 dark:text-success-400">Aktif modüller</h4>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                        {{ count($aktifModuller) ? implode(', ', $aktifModuller) : '—' }}
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-warning-600 dark:text-warning-400">Salt okunur</h4>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                        {{ count($saltOkunurModuller) ? implode(', ', $saltOkunurModuller) : '—' }}
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-danger-600 dark:text-danger-400">Kapalı</h4>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                        {{ count($kapaliModuller) ? implode(', ', $kapaliModuller) : '—' }}
                    </p>
                </div>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
