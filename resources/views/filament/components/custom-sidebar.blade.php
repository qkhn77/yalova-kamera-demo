@php
    use App\Filament\Clusters\Muhasebe\Pages\Cari;
    use App\Filament\Clusters\Muhasebe\Pages\Stok;
    use App\Filament\Clusters\Muhasebe\Pages\GelenFatura;
    use App\Filament\Clusters\Muhasebe\Pages\GidenFatura;
    use App\Filament\Clusters\Muhasebe\Pages\BekleyenFatura;
    use App\Filament\Clusters\Muhasebe\Pages\IptalFatura;
    use App\Filament\Clusters\Muhasebe\Pages\Kasalar;
    use App\Filament\Clusters\Muhasebe\Pages\Bankalar;
    use App\Filament\Clusters\Muhasebe\Pages\KasaSatis;
    use App\Filament\Clusters\Muhasebe\Pages\PosSatis;
    use App\Filament\Clusters\Muhasebe\Pages\BankaSatis;

    use App\Filament\Clusters\TeknikServis\Pages\ServisDashboard;
    use App\Filament\Clusters\TeknikServis\Pages\CihazEkle;
    use App\Filament\Clusters\TeknikServis\Pages\ArizaliCihazlar;
    use App\Filament\Clusters\TeknikServis\Pages\TeslimEdilenCihazlar;
    use App\Filament\Clusters\TeknikServis\Pages\ServisEkle;
    use App\Filament\Clusters\TeknikServis\Pages\ServisListesi;
    use App\Filament\Clusters\TeknikServis\Pages\TamamlananServisler;
    use App\Filament\Clusters\TeknikServis\Pages\CihazMarkaModelEkleme;
    use App\Filament\Clusters\TeknikServis\Pages\AksesuarEkleme;
    use App\Filament\Clusters\TeknikServis\Pages\ArizaEkleme;
    use App\Filament\Clusters\TeknikServis\Pages\KabulFisi;
    use App\Filament\Clusters\TeknikServis\Pages\TeslimFisi;
    use App\Filament\Clusters\TeknikServis\Pages\GenelAyarlar;

    use App\Filament\Clusters\Web\Pages\BilgiSayfalari;
    use App\Filament\Clusters\Web\Pages\Iletisim;
    use App\Filament\Clusters\Web\Pages\Hakkimizda;
    use App\Filament\Clusters\Web\Pages\WebModuller;
    use App\Filament\Clusters\Web\Pages\WebServisListesi;
    use App\Filament\Clusters\Web\Pages\WebServisKategori;
    use App\Filament\Clusters\Web\Pages\WebProje;
    use App\Filament\Clusters\Web\Pages\WebProjeKategori;
    use App\Filament\Clusters\Web\Pages\BlogListesi;
    use App\Filament\Clusters\Web\Pages\BlogKategori;
    use App\Filament\Clusters\Web\Pages\WebGenelAyarlar;
    use App\Filament\Clusters\Web\Pages\WebApiAyarlar;
    use App\Filament\Clusters\Web\Pages\WebMailAyarlar;

    use App\Filament\Clusters\Ayarlar\Pages\Kullanicilar;
    use App\Filament\Clusters\Ayarlar\Pages\KullaniciGruplari;

    $adminPrefix = \App\Providers\Filament\AdminPanelProvider::adminPath();
    $currentPath = request()->path();
    $isDashboard = request()->is($adminPrefix) || request()->is($adminPrefix.'/');

    $isMuhasebe = str_starts_with($currentPath, $adminPrefix.'/muhasebe');
    $isFatura = str_starts_with($currentPath, $adminPrefix.'/muhasebe/fatura');
    $isFinans = str_starts_with($currentPath, $adminPrefix.'/muhasebe/finans');
    $isSatis = str_starts_with($currentPath, $adminPrefix.'/muhasebe/satis');

    $isTeknikServis = str_starts_with($currentPath, $adminPrefix.'/teknik-servis');
    $isCihazKayit = str_starts_with($currentPath, $adminPrefix.'/teknik-servis/cihaz-kayit');
    $isServisKayit = str_starts_with($currentPath, $adminPrefix.'/teknik-servis/servis-kayit');
    $isTeknikAyarlar = str_starts_with($currentPath, $adminPrefix.'/teknik-servis/ayarlar');

    $isWeb = str_starts_with($currentPath, $adminPrefix.'/web');
    $isSayfalar = str_starts_with($currentPath, $adminPrefix.'/web/sayfalar');
    $isServisler = str_starts_with($currentPath, $adminPrefix.'/web/servisler');
    $isProjeler = str_starts_with($currentPath, $adminPrefix.'/web/projeler');
    $isBloglar = str_starts_with($currentPath, $adminPrefix.'/web/bloglar');
    $isWebAyarlar = str_starts_with($currentPath, $adminPrefix.'/web/web-ayarlar');

    $isAyarlar = str_starts_with($currentPath, $adminPrefix.'/ayarlar');
    $isKullaniciAyarlari = str_starts_with($currentPath, $adminPrefix.'/ayarlar/kullanici-ayarlari');
@endphp

<div
    x-data="{
        muhasebeOpen: @js($isMuhasebe),
        faturaOpen: @js($isFatura),
        finansOpen: @js($isFinans),
        satisOpen: @js($isSatis),
        teknikServisOpen: @js($isTeknikServis),
        cihazKayitOpen: @js($isCihazKayit),
        servisKayitOpen: @js($isServisKayit),
        teknikAyarlarOpen: @js($isTeknikAyarlar),
        webOpen: @js($isWeb),
        sayfalarOpen: @js($isSayfalar),
        servislerOpen: @js($isServisler),
        projelerOpen: @js($isProjeler),
        bloglarOpen: @js($isBloglar),
        webAyarlarOpen: @js($isWebAyarlar),
        ayarlarOpen: @js($isAyarlar),
        kullaniciAyarlariOpen: @js($isKullaniciAyarlari),
    }"
    class="custom-sidebar"
>
    <style>
        .custom-sidebar {
            --sidebar-accent: rgb(21 94 253);
            --sidebar-accent-bg: rgb(21 94 253 / 0.12);
            --sidebar-hover: rgb(0 0 0 / 0.04);
            --sidebar-text: rgb(17 24 39);
            --sidebar-muted: rgb(107 114 128);
            --sidebar-border: rgb(229 231 235);
        }
        .dark .custom-sidebar,
        .dark .custom-sidebar * {
            --sidebar-hover: rgb(255 255 255 / 0.06);
            --sidebar-text: rgb(243 244 246);
            --sidebar-muted: rgb(156 163 175);
            --sidebar-border: rgb(75 85 99);
        }

        .custom-sidebar .nav-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0.4rem 0.5rem;
            font-size: 0.8125rem;
            border-radius: 0.5rem;
            font-weight: 500;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: background-color 0.15s ease, color 0.15s ease;
            border: none;
            background: transparent;
            cursor: pointer;
            text-align: left;
        }
        .custom-sidebar .nav-item:hover {
            background: var(--sidebar-hover);
        }
        .custom-sidebar .nav-item.is-active {
            background: var(--sidebar-accent-bg);
            color: var(--sidebar-accent);
            font-weight: 600;
        }
        .custom-sidebar .nav-item .chevron {
            flex-shrink: 0;
            width: 1rem;
            height: 1rem;
            color: var(--sidebar-muted);
            transition: transform 0.2s ease;
        }
        .custom-sidebar .nav-item.is-active .chevron {
            color: var(--sidebar-accent);
        }
        .custom-sidebar .nav-item[aria-expanded="true"] .chevron {
            transform: rotate(90deg);
        }

        .custom-sidebar .nav-group {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
            padding-left: 0.75rem;
            margin-top: 0.25rem;
            border-left: 2px solid var(--sidebar-border);
            margin-left: 0.5rem;
        }
        .custom-sidebar .nav-group .nav-item {
            font-size: 0.8125rem;
            padding: 0.375rem 0.625rem;
        }
        .custom-sidebar .nav-group .nav-group {
            border-left-style: dashed;
            padding-left: 0.5rem;
        }

        .custom-sidebar .section-gap {
            height: 1px;
            background: var(--sidebar-border);
            margin: 0.75rem 0.5rem;
            opacity: 0.6;
        }
        .custom-sidebar .nav-item-start {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 0;
        }
        .custom-sidebar .nav-item-icon {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
            color: var(--sidebar-muted);
            transition: color 0.15s ease;
        }
        .custom-sidebar .nav-item.is-active .nav-item-icon {
            color: var(--sidebar-accent);
        }
    </style>

    <nav class="flex flex-col gap-0.5" aria-label="Ana menü">
        {{-- Dashboard --}}
        <a
            href="{{ url(\App\Providers\Filament\AdminPanelProvider::adminPath()) }}"
            class="nav-item {{ $isDashboard ? 'is-active' : '' }}"
        >
            <span class="nav-item-start">
                <x-filament::icon icon="heroicon-o-squares-2x2" class="nav-item-icon" />
                <span>Gösterge Paneli</span>
            </span>
        </a>

        <div class="section-gap" aria-hidden="true"></div>

        {{-- Muhasebe --}}
        <button
            type="button"
            class="nav-item {{ $isMuhasebe ? 'is-active' : '' }}"
            x-on:click="muhasebeOpen = !muhasebeOpen"
            :aria-expanded="muhasebeOpen"
        >
            <span class="nav-item-start">
                <x-filament::icon icon="heroicon-o-currency-dollar" class="nav-item-icon" />
                <span>Muhasebe</span>
            </span>
            <svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>
        <div x-show="muhasebeOpen" x-collapse class="nav-group">
            <a href="{{ Cari::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/cari') ? 'is-active' : '' }}"><span>Cari</span></a>
            <a href="{{ Stok::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/stok') ? 'is-active' : '' }}"><span>Stok</span></a>
            <button type="button" class="nav-item {{ $isFatura ? 'is-active' : '' }}" x-on:click="faturaOpen = !faturaOpen" :aria-expanded="faturaOpen">
                <span>Fatura</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="faturaOpen" x-collapse class="nav-group">
                <a href="{{ GelenFatura::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/fatura/gelen-fatura') ? 'is-active' : '' }}"><span>Gelen Fatura</span></a>
                <a href="{{ GidenFatura::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/fatura/giden-fatura') ? 'is-active' : '' }}"><span>Giden Fatura</span></a>
                <a href="{{ BekleyenFatura::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/fatura/bekleyen-fatura') ? 'is-active' : '' }}"><span>Bekleyen Fatura</span></a>
                <a href="{{ IptalFatura::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/fatura/iptal-fatura') ? 'is-active' : '' }}"><span>İptal Fatura</span></a>
            </div>
            <button type="button" class="nav-item {{ $isFinans ? 'is-active' : '' }}" x-on:click="finansOpen = !finansOpen" :aria-expanded="finansOpen">
                <span>Finans</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="finansOpen" x-collapse class="nav-group">
                <a href="{{ Kasalar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/finans/kasalar') ? 'is-active' : '' }}"><span>Kasalar</span></a>
                <a href="{{ Bankalar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/finans/bankalar') ? 'is-active' : '' }}"><span>Bankalar</span></a>
            </div>
            <button type="button" class="nav-item {{ $isSatis ? 'is-active' : '' }}" x-on:click="satisOpen = !satisOpen" :aria-expanded="satisOpen">
                <span>Satış</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="satisOpen" x-collapse class="nav-group">
                <a href="{{ KasaSatis::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/satis/kasa-satis') ? 'is-active' : '' }}"><span>Kasa Satış</span></a>
                <a href="{{ PosSatis::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/satis/pos-satis') ? 'is-active' : '' }}"><span>Pos Satış</span></a>
                <a href="{{ BankaSatis::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/muhasebe/satis/banka-satis') ? 'is-active' : '' }}"><span>Banka Satış</span></a>
            </div>
        </div>

        <div class="section-gap" aria-hidden="true"></div>

        {{-- Teknik Servis --}}
        <button type="button" class="nav-item {{ $isTeknikServis ? 'is-active' : '' }}" x-on:click="teknikServisOpen = !teknikServisOpen" :aria-expanded="teknikServisOpen">
            <span class="nav-item-start">
                <x-filament::icon icon="heroicon-o-wrench-screwdriver" class="nav-item-icon" />
                <span>Teknik Servis</span>
            </span>
            <svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>
        <div x-show="teknikServisOpen" x-collapse class="nav-group">
            <a href="{{ ServisDashboard::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/servis-dashboard') ? 'is-active' : '' }}"><span>Servis Dashboard</span></a>
            <button type="button" class="nav-item {{ $isCihazKayit ? 'is-active' : '' }}" x-on:click="cihazKayitOpen = !cihazKayitOpen" :aria-expanded="cihazKayitOpen">
                <span>Cihaz Kayıt</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="cihazKayitOpen" x-collapse class="nav-group">
                <a href="{{ CihazEkle::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/cihaz-kayit/cihaz-ekle') ? 'is-active' : '' }}"><span>Cihaz Ekle</span></a>
                <a href="{{ ArizaliCihazlar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/cihaz-kayit/arizali-cihazlar') ? 'is-active' : '' }}"><span>Arızalı Cihaz Listesi</span></a>
                <a href="{{ TeslimEdilenCihazlar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/cihaz-kayit/teslim-edilen-cihazlar') ? 'is-active' : '' }}"><span>Teslim Edilen Cihazlar</span></a>
            </div>
            <button type="button" class="nav-item {{ $isServisKayit ? 'is-active' : '' }}" x-on:click="servisKayitOpen = !servisKayitOpen" :aria-expanded="servisKayitOpen">
                <span>Servis Kayıt</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="servisKayitOpen" x-collapse class="nav-group">
                <a href="{{ ServisEkle::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/servis-kayit/servis-ekle') ? 'is-active' : '' }}"><span>Servis Ekle</span></a>
                <a href="{{ ServisListesi::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/servis-kayit/servis-listesi') ? 'is-active' : '' }}"><span>Servis Listesi</span></a>
                <a href="{{ TamamlananServisler::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/servis-kayit/tamamlanan-servisler') ? 'is-active' : '' }}"><span>Tamamlanan Servisler</span></a>
            </div>
            <button type="button" class="nav-item {{ $isTeknikAyarlar ? 'is-active' : '' }}" x-on:click="teknikAyarlarOpen = !teknikAyarlarOpen" :aria-expanded="teknikAyarlarOpen">
                <span>Ayarlar</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="teknikAyarlarOpen" x-collapse class="nav-group">
                <a href="{{ CihazMarkaModelEkleme::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/ayarlar/cihaz-marka-model-ekleme') ? 'is-active' : '' }}"><span>Cihaz / Marka / Model</span></a>
                <a href="{{ AksesuarEkleme::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/ayarlar/aksesuar-ekleme') ? 'is-active' : '' }}"><span>Aksesuar Ekleme</span></a>
                <a href="{{ ArizaEkleme::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/ayarlar/ariza-ekleme') ? 'is-active' : '' }}"><span>Arıza Ekleme</span></a>
                <a href="{{ KabulFisi::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/ayarlar/kabul-fisi') ? 'is-active' : '' }}"><span>Kabul Fişi</span></a>
                <a href="{{ TeslimFisi::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/ayarlar/teslim-fisi') ? 'is-active' : '' }}"><span>Teslim Fişi</span></a>
                <a href="{{ GenelAyarlar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/teknik-servis/ayarlar/genel-ayarlar') ? 'is-active' : '' }}"><span>Genel Ayarlar</span></a>
            </div>
        </div>

        <div class="section-gap" aria-hidden="true"></div>

        {{-- Web --}}
        <button type="button" class="nav-item {{ $isWeb ? 'is-active' : '' }}" x-on:click="webOpen = !webOpen" :aria-expanded="webOpen">
            <span class="nav-item-start">
                <x-filament::icon icon="heroicon-o-globe-alt" class="nav-item-icon" />
                <span>Web</span>
            </span>
            <svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>
        <div x-show="webOpen" x-collapse class="nav-group">
            <button type="button" class="nav-item {{ $isSayfalar ? 'is-active' : '' }}" x-on:click="sayfalarOpen = !sayfalarOpen" :aria-expanded="sayfalarOpen">
                <span>Sayfalar</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="sayfalarOpen" x-collapse class="nav-group">
                <a href="{{ BilgiSayfalari::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/sayfalar/bilgi-sayfalari') ? 'is-active' : '' }}"><span>Bilgi Sayfaları</span></a>
                <a href="{{ Iletisim::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/sayfalar/iletisim') ? 'is-active' : '' }}"><span>İletişim</span></a>
                <a href="{{ Hakkimizda::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/sayfalar/hakkimizda') ? 'is-active' : '' }}"><span>Hakkımızda</span></a>
            </div>
            <a href="{{ WebModuller::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/web-moduller') ? 'is-active' : '' }}"><span>Modüller</span></a>
            <button type="button" class="nav-item {{ $isServisler ? 'is-active' : '' }}" x-on:click="servislerOpen = !servislerOpen" :aria-expanded="servislerOpen">
                <span>Servisler</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="servislerOpen" x-collapse class="nav-group">
                <a href="{{ WebServisListesi::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/servisler/web-servis-listesi') ? 'is-active' : '' }}"><span>Servis Listesi</span></a>
                <a href="{{ WebServisKategori::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/servisler/web-servis-kategori') ? 'is-active' : '' }}"><span>Servis Kategori</span></a>
            </div>
            <button type="button" class="nav-item {{ $isProjeler ? 'is-active' : '' }}" x-on:click="projelerOpen = !projelerOpen" :aria-expanded="projelerOpen">
                <span>Projeler</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="projelerOpen" x-collapse class="nav-group">
                <a href="{{ WebProje::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/projeler/web-proje') ? 'is-active' : '' }}"><span>Projeler</span></a>
                <a href="{{ WebProjeKategori::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/projeler/web-proje-kategori') ? 'is-active' : '' }}"><span>Proje Kategorileri</span></a>
            </div>
            <button type="button" class="nav-item {{ $isBloglar ? 'is-active' : '' }}" x-on:click="bloglarOpen = !bloglarOpen" :aria-expanded="bloglarOpen">
                <span>Bloglar</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="bloglarOpen" x-collapse class="nav-group">
                <a href="{{ BlogListesi::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/blog-listesi') ? 'is-active' : '' }}"><span>Blog Listesi</span></a>
                <a href="{{ BlogKategori::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/blog-kategori') ? 'is-active' : '' }}"><span>Blog Kategorileri</span></a>
            </div>
            <button type="button" class="nav-item {{ $isWebAyarlar ? 'is-active' : '' }}" x-on:click="webAyarlarOpen = !webAyarlarOpen" :aria-expanded="webAyarlarOpen">
                <span>Site Ayarları</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="webAyarlarOpen" x-collapse class="nav-group">
                <a href="{{ WebGenelAyarlar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/web-ayarlar/web-genel-ayarlar') ? 'is-active' : '' }}"><span>Genel Ayarlar</span></a>
                <a href="{{ WebApiAyarlar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/web-ayarlar/web-api-ayarlar') ? 'is-active' : '' }}"><span>Api Ayarları</span></a>
                <a href="{{ WebMailAyarlar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/web/web-ayarlar/web-mail-ayarlar') ? 'is-active' : '' }}"><span>Mail Ayarları</span></a>
            </div>
        </div>

        <div class="section-gap" aria-hidden="true"></div>

        {{-- Ayarlar --}}
        <button type="button" class="nav-item {{ $isAyarlar ? 'is-active' : '' }}" x-on:click="ayarlarOpen = !ayarlarOpen" :aria-expanded="ayarlarOpen">
            <span class="nav-item-start">
                <x-filament::icon icon="heroicon-o-cog-6-tooth" class="nav-item-icon" />
                <span>Ayarlar</span>
            </span>
            <svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>
        <div x-show="ayarlarOpen" x-collapse class="nav-group">
            <button type="button" class="nav-item {{ $isKullaniciAyarlari ? 'is-active' : '' }}" x-on:click="kullaniciAyarlariOpen = !kullaniciAyarlariOpen" :aria-expanded="kullaniciAyarlariOpen">
                <span>Kullanıcı Ayarları</span><svg class="chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="kullaniciAyarlariOpen" x-collapse class="nav-group">
                <a href="{{ Kullanicilar::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/ayarlar/kullanici-ayarlari/kullanicilar') ? 'is-active' : '' }}"><span>Kullanıcılar</span></a>
                <a href="{{ KullaniciGruplari::getUrl() }}" class="nav-item {{ request()->is($adminPrefix.'/ayarlar/kullanici-ayarlari/kullanici-gruplari') ? 'is-active' : '' }}"><span>Kullanıcı Grupları</span></a>
            </div>
        </div>
    </nav>
</div>
