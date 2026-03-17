<x-filament-panels::page>
    <div class="blog-listesi-page">
        <div class="blog-listesi-table-card rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden">
            {{ $this->table() }}
        </div>
    </div>

    <style>
        .fi-page:has(.blog-listesi-page) .fi-header {
            background: transparent !important;
            padding-bottom: 0.5rem;
        }
        .blog-listesi-table-card .fi-ta-header {
            background: transparent !important;
            border-bottom: 1px solid rgb(229 231 235);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .dark .blog-listesi-table-card .fi-ta-header {
            border-bottom-color: rgb(75 85 99);
        }
        .blog-listesi-table-card .fi-ta-row {
            min-height: 3rem;
            height: 3rem;
        }
        .blog-listesi-table-card .fi-ta-row > td {
            vertical-align: middle;
        }
    </style>

    <x-filament-actions::modals />
</x-filament-panels::page>
