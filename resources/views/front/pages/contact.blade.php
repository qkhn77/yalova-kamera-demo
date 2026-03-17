

@extends('front.layouts.app')

@section('title','İletişim | Yalova Kamera Sistemleri')
@section('meta_description','Yalova kamera kurulumu konusunda uzman ekibimiz. Güvenlik kamerası ve alarm sistemi kurulumu, servis ve bakım hizmetlerinde yılların deneyimi.')
@section('meta_keywords','yalova kamera kurulumu telefon, yalova güvenlik sistemi ara, yalova kamera fiyatları, yalova alarm sistemi yapan firmalar')


@php
    \App\Helpers\BreadcrumbHelper::clear();
    \App\Helpers\BreadcrumbHelper::add('Anasayfa', '/');
    \App\Helpers\BreadcrumbHelper::add('İletişim');
@endphp

@section('content')

    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="wow fadeInUp">İletişim</h1>
                        {!! \App\Helpers\BreadcrumbHelper::render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Contact Us Start -->
    <div class="page-contact-us">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-4">

                    <div class="contact-us-content">

                        <div class="section-title">

                            <h3 class="wow fadeInUp">İletişim</h3>

                            <h2 class="wow fadeInUp" data-wow-delay="0.2s">
                                <span>Güvenliğinizi</span> bizimle sağlayın
                            </h2>

                            <p class="wow fadeInUp" data-wow-delay="0.4s">
                                Sorularınız mı var veya güvenlik sistemleri hakkında bilgi mi almak istiyorsunuz?
                                Ekibimiz size yardımcı olmaktan memnuniyet duyar.
                            </p>

                        </div>


                        <div class="contact-social-list wow fadeInUp" data-wow-delay="0.6s">

                            <ul>

                                <li>
                                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                </li>

                                <li>
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                </li>

                                <li>
                                    <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                                </li>

                                <li>
                                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                </li>

                            </ul>

                        </div>

                    </div>

                </div>



                <div class="col-lg-8">

                    <div class="contact-info-list">


                        <div class="contact-info-item wow fadeInUp">

                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-phone.svg') }}">
                            </div>

                            <div class="contact-item-content">

                                <p>Telefon</p>

                                <h3>
                                    <a href="tel:+902263520724">
                                        0 (226) 352 07 24
                                    </a>
                                </h3>

                            </div>

                        </div>



                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">

                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-mail.svg') }}">
                            </div>

                            <div class="contact-item-content">

                                <p>E-posta</p>

                                <h3>
                                    <a href="mailto:info@yalovakamera.com">
                                        info@yalovakamera.com
                                    </a>
                                </h3>

                            </div>

                        </div>



                        <div class="contact-info-item location-item wow fadeInUp" data-wow-delay="0.4s">

                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-location.svg') }}">
                            </div>

                            <div class="contact-item-content">

                                <p>Adres</p>

                                <h3>
                                    Çiftlikköy / Yalova
                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Page Contact Us End -->



    <!-- Contact Form Section -->
    <div class="contact-form-section">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="contact-us-box">

                        <div class="google-map-iframe">

                            <iframe
                                src="https://www.google.com/maps?q=Yalova%20Çiftlikköy&output=embed"
                                loading="lazy">
                            </iframe>

                        </div>



                        <div class="contact-us-form">

                            <div class="section-title">

                                <h2>Mesaj Gönder</h2>

                                <p>
                                    Güvenlik sistemleri hakkında bilgi almak için bize mesaj gönderebilirsiniz.
                                </p>

                            </div>



                            <form method="POST" action="#" class="contact-form">

                                @csrf

                                <div class="row">

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="name" class="form-control" placeholder="Ad Soyad">
                                    </div>


                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" placeholder="Telefon">
                                    </div>


                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" name="email" class="form-control" placeholder="E-posta">
                                    </div>


                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" rows="3" placeholder="Mesajınız"></textarea>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default">
                                            Mesaj Gönder
                                        </button>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
