

<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-footer-box">
                    @php
                        $footerLogo = \App\Models\Setting::get('footer_logo');
                        $footerLogoUrl = $footerLogo
                            ? (str_starts_with($footerLogo, 'settings/') ? asset('uploads/' . ltrim($footerLogo, '/')) : asset($footerLogo))
                            : asset('theme/yalovakamera/images/footer-logo.svg');
                    @endphp
                    <div class="footer-logo">
                        <img src="{{ $footerLogoUrl }}" alt="{{ \App\Models\Setting::get('site_title', config('app.name')) }}">
                    </div>

                    <div class="footer-contact-details">
                        <div class="footer-contact-item">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-phone.svg') }}" alt="">
                            </div>
                            <div class="footer-contact-item-content">
                                <p>Telefon</p>
                                <h3><a href="tel:+902263520724">0 (226) 352 07 24</a></h3>
                            </div>
                        </div>

                        <div class="footer-contact-item">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-mail.svg') }}" alt="">
                            </div>
                            <div class="footer-contact-item-content">
                                <p>E-posta</p>
                                <h3><a href="mailto:info@yalovakamera.com">info@yalovakamera.com</a></h3>
                            </div>
                        </div>

                        <div class="footer-contact-item">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-location.svg') }}" alt="">
                            </div>
                            <div class="footer-contact-item-content">
                                <p>Adres</p>
                                <h3>Yalova / Çiftlikköy</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="about-footer">
                    <div class="footer-links">
                        <h3>Yalova Kamera Sistemleri</h3>
                        <p>Güvenlik kamerası ve alarm sistemlerinde keşif, kurulum, servis ve bakım hizmetleri.</p>
                    </div>

                    @php
                        $footerWhatsapp = \App\Models\Setting::get('whatsapp_code');
                        $footerInstagram = \App\Models\Setting::get('instagram_token');
                        if (!empty($footerInstagram) && !str_contains($footerInstagram, '://')) {
                            $footerInstagram = 'https://instagram.com/' . ltrim($footerInstagram, '/');
                        }
                    @endphp
                    <div class="footer-social-links">
                        <ul>
                            @if(!empty($footerWhatsapp))
                            <li><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $footerWhatsapp) }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a></li>
                            @endif
                            @if(!empty($footerInstagram))
                            <li><a href="{{ $footerInstagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                            @endif
                            <li><a href="#" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a></li>
                            <li><a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-links">
                    <h3>Hızlı Menü</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li><a href="{{ route('about') }}">Hakkımızda</a></li>
                        <li><a href="{{ route('services.index') }}">Servisler</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('contact') }}">İletişim</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-links">
                    <h3>Bilgi Sayfaları</h3>
                    @php
                        $footerBilgiSayfalari = \App\Models\BilgiSayfa::query()
                            ->where('is_active', true)
                            ->orderBy('sort_order')
                            ->orderBy('title')
                            ->limit(8)
                            ->get();
                    @endphp
                    <ul>
                        @forelse($footerBilgiSayfalari as $footerBilgi)
                            <li>
                                <a href="{{ route('information.show', $footerBilgi->slug) }}">
                                    {{ $footerBilgi->title }}
                                </a>
                            </li>
                        @empty
                            <li><a href="{{ route('information.index') }}">Bilgi Merkezi</a></li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="newsletter-form footer-links">
                    <h3>Abone Ol</h3>
                    <p>Kampanya ve duyuruları almak için e-postanı bırak.</p>
                    <form id="newsletterForm" action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="mail" placeholder="E-posta adresiniz" required>
                            <button type="submit" class="newsletter-btn"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-copyright-text">
                        <p>{{ \App\Models\Setting::get('copyright_text', '© ' . date('Y') . ' Yalova Kamera Sistemleri. Tüm hakları saklıdır.') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="footer-privacy-policy">
                        @php
                            $privacyPage = \App\Models\BilgiSayfa::query()
                                ->where('is_active', true)
                                ->where('slug', 'gizlilik-politikasi')
                                ->first();
                            $termsPage = \App\Models\BilgiSayfa::query()
                                ->where('is_active', true)
                                ->whereIn('slug', ['kullanim-sartlari', 'kullanim-kosullari'])
                                ->first();
                        @endphp
                        <ul>
                            <li><a href="{{ route('contact') }}">Destek</a></li>
                            <li><a href="{{ $privacyPage ? route('information.show', $privacyPage->slug) : route('information.index') }}">Gizlilik Politikası</a></li>
                            <li><a href="{{ $termsPage ? route('information.show', $termsPage->slug) : route('information.index') }}">Kullanım Şartları</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



