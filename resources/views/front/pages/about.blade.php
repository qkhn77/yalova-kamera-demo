@extends('front.layouts.app')

@section('title','Hakkımızda | Yalova Kamera Sistemleri')
@section('meta_description','Yalova kamera kurulumu konusunda uzman ekibimiz. Güvenlik kamerası ve alarm sistemi kurulumu, servis ve bakım hizmetlerinde yılların deneyimi.')
@section('meta_keywords','yalova kamera kurulumu, yalova güvenlik sistemi, yalova kamera fiyatları, yalova alarm sistemi')

@php
    \App\Helpers\BreadcrumbHelper::clear();
    \App\Helpers\BreadcrumbHelper::add('Anasayfa', '/');
    \App\Helpers\BreadcrumbHelper::add('Servisler');
@endphp

@section('content')
    <div class="page-header">
        <div class="container">


            <div class="page-header-box">
                <h1 class="wow fadeInUp">Hakımızda</h1>
             {!! \App\Helpers\BreadcrumbHelper::render() !!}
            </div>

        </div>
    </div>

    <div class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-images">
                        <div class="about-img-1">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/yalovakamera/images/about-img-1.jpg') }}" alt="Hakkımızda">
                            </figure>
                            <div class="company-experience-circle">
                                <img src="{{ asset('theme/yalovakamera/images/experience-circle.svg') }}" alt="">
                            </div>
                        </div>

                        <div class="about-img-2">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/yalovakamera/images/about-img-2.jpg') }}" alt="">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Yalova Kamera Sistemleri</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">
                                <span>Evleri ve işletmeleri</span> güvenle koruyun
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">
                                Yalova / Çiftlikköy merkezli ekibimizle IP kamera, alarm ve kayıt çözümlerinde keşif,
                                kurulum, servis ve periyodik bakım hizmetleri sunuyoruz.
                            </p>
                        </div>

                        <div class="about-us-body wow fadeInUp" data-wow-delay="0.6s">
                            <div class="about-contact-box">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-about-contact.svg') }}" alt="">
                                </div>
                                <div class="about-contact-box-content">
                                    <p>Hemen Arayın</p>
                                    <h3><a href="tel:+902263520724">0 (226) 352 07 24</a></h3>
                                </div>
                            </div>

                            <div class="about-us-btn">
                                <a href="{{ route('contact') }}" class="btn-default">İletişime Geç</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection