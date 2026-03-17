<style>
    /* Tüm admin panel içeriği: blog, servis, proje ve kategori listesi/ekleme sayfalarında mavi çizgi ve focus ring kaldır */
    .fi-main [role="checkbox"]:focus,
    .fi-main input[type="checkbox"]:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    .fi-main td:focus,
    .fi-main th:focus,
    .fi-main td:first-child:focus,
    .fi-main th:first-child:focus {
        outline: none !important;
        box-shadow: none !important;
        border-left-width: 0 !important;
    }
    .fi-main tr[aria-selected="true"],
    .fi-main tr[aria-selected="true"] td,
    .fi-main table tr:has(input[type="checkbox"]:checked) td:first-child {
        border-left-width: 0 !important;
        box-shadow: none !important;
        outline: none !important;
    }
    /* Ekleme/düzenleme formları: input, select, textarea, buton focus ring ve sol çizgi kaldır */
    .fi-main input:focus,
    .fi-main select:focus,
    .fi-main textarea:focus,
    .fi-main button:focus,
    .fi-main [type="text"]:focus,
    .fi-main [type="email"]:focus,
    .fi-main [type="number"]:focus,
    .fi-main [role="combobox"]:focus,
    .fi-main [contenteditable="true"]:focus {
        outline: none !important;
        box-shadow: none !important;
        border-left-width: 0 !important;
    }
    /* Filament form bileşenleri (wrapper ve input alanları) */
    .fi-main .fi-input:focus-within,
    .fi-main .fi-fo-field-wrp:focus-within,
    .fi-main [x-data]:focus,
    .fi-main .fi-section-content *:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    /* Modal ve slide-over içindeki formlar */
    .fi-modal input:focus,
    .fi-modal select:focus,
    .fi-modal textarea:focus,
    .fi-modal [role="checkbox"]:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    /* Sayfa / bölüm solundaki mavi çizgi (ekleme ve kategori sayfaları) */
    .fi-main .fi-section-content,
    .fi-main .fi-fo-section-content,
    .fi-main .fi-ta-content {
        border-left: none !important;
    }
</style>
