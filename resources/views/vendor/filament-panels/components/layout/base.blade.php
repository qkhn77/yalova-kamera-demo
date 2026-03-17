@props([
    'livewire' => null,
])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ])
>
    <head>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_START, scopes: $livewire->getRenderHookScopes()) }}

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @if ($favicon = filament()->getFavicon())
            <link rel="icon" href="{{ $favicon }}" />
        @endif

        @php
            $title = trim(strip_tags(($livewire ?? null)?->getTitle() ?? ''));
            $brandName = trim(strip_tags(filament()->getBrandName()));
        @endphp

        <title>
            {{ filled($title) ? "{$title} - " : null }} {{ $brandName }}
        </title>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_BEFORE, scopes: $livewire->getRenderHookScopes()) }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        @filamentStyles

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontHtml() }}

        <style>
            :root {
                --font-family: '{!! filament()->getFontFamily() !!}';
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
                --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }};
                --fi-input-focus: rgb(21 94 253);
            }
        </style>
        <style>
            /* Input/select/textarea: görünür kenarlık (border-none override) */
            .fi-body input[type="text"],
            .fi-body input[type="email"],
            .fi-body input[type="url"],
            .fi-body input[type="tel"],
            .fi-body input[type="number"],
            .fi-body input[type="password"],
            .fi-body input[type="search"],
            .fi-body select,
            .fi-body textarea,
            .fi-body .fi-input {
                border: 1px solid rgb(203 213 225) !important;
            }
            .dark .fi-body input[type="text"],
            .dark .fi-body input[type="email"],
            .dark .fi-body input[type="url"],
            .dark .fi-body input[type="tel"],
            .dark .fi-body input[type="number"],
            .dark .fi-body input[type="password"],
            .dark .fi-body input[type="search"],
            .dark .fi-body select,
            .dark .fi-body textarea,
            .dark .fi-body .fi-input {
                border-color: rgb(71 85 105) !important;
            }
            /* Input vurgu: odakta net mavi çizgi (arka planla karışmasın) */
            .fi-body input:focus,
            .fi-body .fi-input:focus,
            .fi-body .fi-input input:focus,
            .fi-body select:focus,
            .fi-body textarea:focus {
                border-color: rgb(21 94 253) !important;
                border-width: 2px !important;
                outline: none !important;
                box-shadow: 0 0 0 2px rgb(21 94 253) !important;
                --tw-ring-color: rgb(21 94 253) !important;
                --tw-ring-shadow: 0 0 0 2px rgb(21 94 253) !important;
            }
            /* Wrapper odakta: ring/shadow arka plan rengi almasın, sadece mavi */
            .fi-body [data-slot="input"]:focus-within,
            .fi-body [data-slot="input-wrapper"]:focus-within {
                --tw-ring-color: rgb(21 94 253) !important;
                --tw-ring-shadow: 0 0 0 2px rgb(21 94 253) !important;
                box-shadow: 0 0 0 2px rgb(21 94 253) !important;
            }
            .fi-body [data-slot="input"]:focus-within .fi-input,
            .fi-body [data-slot="input-wrapper"]:focus-within .fi-input {
                border-color: rgb(21 94 253) !important;
                box-shadow: 0 0 0 2px rgb(21 94 253) !important;
            }
            /* Metin seçimi: görünür arka plan */
            .fi-body ::selection {
                background-color: rgb(21 94 253) !important;
                color: rgb(255 255 255) !important;
            }
            /* Kaydet / primary butonlar */
            .fi-body button[type="submit"].fi-btn,
            .fi-body .fi-btn-primary,
            .fi-body a.fi-btn-primary,
            .fi-body [class*="fi-btn"][class*="primary"] {
                background-color: rgb(21 94 253) !important;
                border-color: rgb(21 94 253) !important;
                color: rgb(255 255 255) !important;
            }
            .fi-body button[type="submit"].fi-btn:hover,
            .fi-body .fi-btn-primary:hover,
            .fi-body a.fi-btn-primary:hover {
                background-color: rgb(19 85 228) !important;
                border-color: rgb(19 85 228) !important;
                color: rgb(255 255 255) !important;
            }
        </style>

        @stack('styles')

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_AFTER, scopes: $livewire->getRenderHookScopes()) }}

        {{-- Input odak: mavi çizgi net görünsün, arka plan rengiyle karışmasın --}}
        <style data-input-focus-override>
            .fi-body .fi-input {
                border: 1px solid rgb(203, 213, 225) !important;
            }
            .dark .fi-body .fi-input {
                border-color: rgb(71, 85, 105) !important;
            }
            .fi-body input:focus,
            .fi-body .fi-input:focus,
            .fi-body select:focus,
            .fi-body textarea:focus {
                border: 2px solid rgb(21, 94, 253) !important;
                box-shadow: 0 0 0 2px rgb(21, 94, 253) !important;
                outline: none !important;
                --tw-ring-color: rgb(21, 94, 253) !important;
                --tw-ring-shadow: 0 0 0 2px rgb(21, 94, 253) !important;
            }
            .fi-body [data-slot="input"]:focus-within,
            .fi-body [data-slot="input-wrapper"]:focus-within {
                --tw-ring-color: rgb(21, 94, 253) !important;
                box-shadow: 0 0 0 2px rgb(21, 94, 253) !important;
            }
            .fi-body [data-slot="input"]:focus-within .fi-input,
            .fi-body [data-slot="input-wrapper"]:focus-within .fi-input,
            .fi-body [data-slot="input"]:focus-within input,
            .fi-body [data-slot="input-wrapper"]:focus-within input {
                border: 2px solid rgb(21, 94, 253) !important;
                box-shadow: 0 0 0 2px rgb(21, 94, 253) !important;
            }
        </style>

        @if (! filament()->hasDarkMode())
            <script>
                localStorage.setItem('theme', 'light')
            </script>
        @elseif (filament()->hasDarkModeForced())
            <script>
                localStorage.setItem('theme', 'dark')
            </script>
        @else
            <script>
                const loadDarkMode = () => {
                    window.theme = localStorage.getItem('theme') ?? @js(filament()->getDefaultThemeMode()->value)

                    if (
                        window.theme === 'dark' ||
                        (window.theme === 'system' &&
                            window.matchMedia('(prefers-color-scheme: dark)')
                                .matches)
                    ) {
                        document.documentElement.classList.add('dark')
                    }
                }

                loadDarkMode()

                document.addEventListener('livewire:navigated', loadDarkMode)
            </script>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_END, scopes: $livewire->getRenderHookScopes()) }}
    </head>

    <body
        {{ $attributes
                ->merge(($livewire ?? null)?->getExtraBodyAttributes() ?? [], escape: false)
                ->class([
                    'fi-body',
                    'fi-panel-' . filament()->getId(),
                    'min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white',
                ]) }}
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_START, scopes: $livewire->getRenderHookScopes()) }}

        {{ $slot }}

        @livewire(Filament\Livewire\Notifications::class)

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_BEFORE, scopes: $livewire->getRenderHookScopes()) }}

        @filamentScripts(withCore: true)

        @if (filament()->hasBroadcasting() && config('filament.broadcasting.echo'))
            <script data-navigate-once>
                window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                window.dispatchEvent(new CustomEvent('EchoLoaded'))
            </script>
        @endif

        @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()))
            <script>
                loadDarkMode()
            </script>
        @endif

        @stack('scripts')

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_AFTER, scopes: $livewire->getRenderHookScopes()) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_END, scopes: $livewire->getRenderHookScopes()) }}
    </body>
</html>
