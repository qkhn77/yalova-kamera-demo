<x-filament-panels::page>
    <div class="modul-menu-page">
        <div class="modul-menu-table-card rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden">
            {{ $this->table() }}
        </div>
    </div>

    <style>
        .fi-page:has(.modul-menu-page) .fi-header {
            background: transparent !important;
            padding-bottom: 0.5rem;
        }

        .modul-menu-table-card .fi-ta-header {
            background: transparent !important;
            border-bottom: 1px solid rgb(229 231 235);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .dark .modul-menu-table-card .fi-ta-header {
            border-bottom-color: rgb(75 85 99);
        }
    </style>
</x-filament-panels::page>

