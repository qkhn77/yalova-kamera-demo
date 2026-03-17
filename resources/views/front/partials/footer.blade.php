

<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-footer-box">
                    <div class="footer-logo">
                        <img src="{{ asset('theme/yalovakamera/images/footer-logo.svg') }}" alt="Yalova Kamera Sistemleri">
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

                    <div class="footer-social-links">
                        <ul>
                            <li><a href="#" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a></li>
                            <li><a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
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
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-links">
                    <h3>Servisler</h3>
                    <ul>
                        <li><a href="{{ route('services.index') }}">IP Kamera Sistemleri</a></li>
                        <li><a href="{{ route('services.index') }}">Alarm Sistemleri</a></li>
                        <li><a href="{{ route('services.index') }}">Montaj & Kurulum</a></li>
                        <li><a href="{{ route('services.index') }}">Teknik Servis</a></li>
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
                        <p>© {{ date('Y') }} Yalova Kamera Sistemleri. Tüm hakları saklıdır.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="footer-privacy-policy">
                        <ul>
                            <li><a href="{{ route('contact') }}">Destek</a></li>
                            <li><a href="#">Gizlilik Politikası</a></li>
                            <li><a href="#">Kullanım Şartları</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



