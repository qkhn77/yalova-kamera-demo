@extends('front.layouts.app')


@section('title','Yalova Kamera Sistemleri | Güvenlik Kamerası Kurulum')
@section('meta_description','Yalova güvenlik kamerası, alarm sistemleri, keşif ve kurulum hizmetleri. Yalova bölgesinde profesyonel servis indirimli fiyat fırsatı.')
@section('meta_keywords','yalova kamera kurulumu, yalova güvenlik kamerası, yalova alarm sistemi, CCTV kurulumu, güvenlik kamerası montajı, güvenlik sistemi keşif ve kurulum')


@section('content')

     <!-- Hero Section Start -->
         <div class="hero hero-video dark-section">

     <!-- Video Start -->
          <div class="hero-bg-video">
              <video autoplay muted loop id="myVideo">
                 <source src="{{ asset('theme/yalovakamera/images/hero-bg-video.mp4') }}" type="video/mp4">
              </video>
         </div>

     <!-- Video End -->

        <!-- Video End -->

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Yalova Kamera Sistemleri</h3>
                            <h1 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">
                                Her mekâna uygun gelişmiş güvenlik çözümleri
                            </h1>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">
                                IP kamera, alarm ve kayıt çözümlerinde keşif, kurulum, servis ve bakım.
                            </p>
                        </div>

                        <div class="hero-body wow fadeInUp" data-wow-delay="0.6s">
                            <div class="hero-btn">
                                <a href="{{ route('contact') }}" class="btn-default">Hemen Teklif Al</a>
                            </div>

                            <div class="video-play-button">
                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                    <i class="fa-solid fa-play"></i>
                                </a>
                                <p>videoyu izle</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image">
                        <figure>
                            <img src="{{ asset('theme/yalovakamera/images/hero-image.png') }}" alt="Yalova Kamera Sistemleri">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- Best Service Section Start -->
    <div class="best-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="best-services-box">

                        <div class="best-service-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-best-service-1.svg') }}" alt="">
                            </div>
                            <div class="best-service-item-content">
                                <h3>İç Mekân Kameraları</h3>
                            </div>
                        </div>

                        <div class="best-service-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-best-service-2.svg') }}" alt="">
                            </div>
                            <div class="best-service-item-content">
                                <h3>7/24 Alarm Müdahalesi</h3>
                            </div>
                        </div>

                        <div class="best-service-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-best-service-3.svg') }}" alt="">
                            </div>
                            <div class="best-service-item-content">
                                <h3>Profesyonel Sistem Kurulumu</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best Service Section End -->

    <!-- About Us Section Start -->
    <div class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-images">

                        <div class="about-img-1">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/yalovakamera/images/about-img-1.jpg') }}" alt="">
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
                            <h3 class="wow fadeInUp">Hakkımızda</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">
                                <span>Evleri ve işletmeleri</span> güvenle koruyun
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">
                                Yalova’da güvenlik kamerası ve alarm sistemlerinde keşif, kurulum, servis ve bakım hizmeti sunuyoruz.
                            </p>
                        </div>

                        <div class="about-experience-box wow fadeInUp" data-wow-delay="0.6s">
                            <div class="about-experience-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('theme/yalovakamera/images/about-experience-image.jpg') }}" alt="">
                                </figure>
                            </div>

                            <div class="about-experience-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-about-experience.svg') }}" alt="">
                                </div>
                                <div class="about-experience-content">
                                    <h3><span class="counter">10</span>+ Yıl Deneyim</h3>
                                </div>
                            </div>
                        </div>

                        <div class="about-us-body wow fadeInUp" data-wow-delay="0.8s">
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
                                <a href="{{ route('about') }}" class="btn-default">Detay</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Our Services Section Start (veritabanından - Servisler sayfası ile aynı kaynak) -->
    <div class="our-services">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Servisler</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">
                            <span>Kapsamlı güvenlik</span> ve izleme çözümleri
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($services->take(6) as $i => $s)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item wow fadeInUp" @if($i>0) data-wow-delay="{{ 0.2*$i }}s" @endif>
                            <div class="service-image">
                                <a href="{{ route('services.show', $s->slug) }}" data-cursor-text="Detay">
                                    <figure class="image-anime">
                                        <img src="{{ asset('theme/yalovakamera/images/'.($s->image ?: 'service-image-1.jpg')) }}" alt="{{ $s->title }}">
                                    </figure>
                                </a>
                            </div>
                            <div class="service-body">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/'.($s->icon ?: 'icon-service-item-1.svg')) }}" alt="">
                                </div>
                                <div class="service-content">
                                    <h3><a href="{{ route('services.show', $s->slug) }}">{{ $s->title }}</a></h3>
                                    <p>{{ $s->short_description }}</p>
                                </div>
                                <div class="service-btn">
                                    <a href="{{ route('services.show', $s->slug) }}" class="readmore-btn">Detay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-12">
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="1.2s">
                        <p><span>Ücretsiz</span> keşif ve teklif için <a href="{{ route('contact') }}">iletişime geç</a></p>
                        <p class="mt-2"><a href="{{ route('services.index') }}" class="readmore-btn">Tüm servisler</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services Section End -->

    <!-- Our Projects Section Start (veritabanından - WebProje sayfası ile aynı kaynak) -->
    <div class="our-projets">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Projeler</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">
                            <span>Kapsamlı güvenlik</span> ve izleme çözümleri
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($projects->take(6) as $i => $p)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item wow fadeInUp" @if($i>0) data-wow-delay="{{ 0.2*$i }}s" @endif>
                            <div class="service-image">
                                <a href="{{ route('projects.show', $p->slug) }}" data-cursor-text="Detay">
                                    <figure class="image-anime">
                                        <img src="{{ asset('theme/yalovakamera/images/'.($p->image ?: 'service-image-1.jpg')) }}" alt="{{ $p->title }}">
                                    </figure>
                                </a>
                            </div>
                            <div class="service-body">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/'.($p->icon ?: 'icon-service-item-1.svg')) }}" alt="">
                                </div>
                                <div class="service-content">
                                    <h3><a href="{{ route('projects.show', $p->slug) }}">{{ $p->title }}</a></h3>
                                    <p>{{ \Illuminate\Support\Str::limit($p->description ?? $p->title, 80) }}</p>
                                </div>
                                <div class="service-btn">
                                    <a href="{{ route('projects.show', $p->slug) }}" class="readmore-btn">Detay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-12">
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="1.2s">
                        <p><span>Ücretsiz</span> keşif ve teklif için <a href="{{ route('contact') }}">iletişime geç</a></p>
                        <p class="mt-2"><a href="{{ route('projects.index') }}" class="readmore-btn">Tüm projeler</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Projects Section End -->

    @include('front.sections.neden-biz')

    @include('front.sections.neler-yapiyoruz')

    @include('front.sections.referanslar')

    @include('front.sections.rakamlarla-biz')

    @include('front.sections.teknik-destek')

    <!-- İletişim CTA Box Section Start -->
    <div class="cta-box dark-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="cta-box-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">İletişim</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Güvenliğinizi</span> bugün kurun</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Ücretsiz keşif ve teklif için bize ulaşın.</p>
                        </div>

                        <div class="cta-box-body wow fadeInUp" data-wow-delay="0.6s">
                            <div class="cta-box-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-phone.svg') }}" alt="">
                                </div>
                                <div class="cta-box-item-content">
                                    <p>Telefon</p>
                                    <h3><a href="tel:+902263520724">0 (226) 352 07 24</a></h3>
                                </div>
                            </div>

                            <div class="cta-box-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-mail.svg') }}" alt="">
                                </div>
                                <div class="cta-box-item-content">
                                    <p>E-posta</p>
                                    <h3><a href="mailto:info@yalovakamera.com">info@yalovakamera.com</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="cta-box-image">
                        <img src="{{ asset('theme/yalovakamera/images/cta-box-image.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Box Section End -->

    @include('front.sections.musteri-yorumlari')

    @include('front.sections.faqs')

    <!-- Our Blog Section Start -->
    <div class="our-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Blog</h3>
                        <h2 class="wow fadeInUp" data-cursor="-opaque" data-wow-delay="0.2s"><span>Güncel</span> içerikler</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="post-item wow fadeInUp">
                        <div class="post-featured-image">
                            <a href="{{ route('blog.index') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('theme/yalovakamera/images/post-1.jpg') }}" alt="">
                                </figure>
                            </a>
                            <div class="post-item-meta">
                                <a href="{{ route('blog.index') }}">20 Jan</a>
                            </div>
                        </div>

                        <div class="post-item-body">
                            <div class="post-item-content">
                                <h2><a href="{{ route('blog.index') }}">Ev için kamera kurulumunun 5 avantajı</a></h2>
                            </div>
                            <div class="blog-item-btn">
                                <a href="{{ route('blog.index') }}" class="readmore-btn">devamı</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="post-featured-image">
                            <a href="{{ route('blog.index') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('theme/yalovakamera/images/post-2.jpg') }}" alt="">
                                </figure>
                            </a>
                            <div class="post-item-meta">
                                <a href="{{ route('blog.index') }}">20 Jan</a>
                            </div>
                        </div>

                        <div class="post-item-body">
                            <div class="post-item-content">
                                <h2><a href="{{ route('blog.index') }}">Güvenlik teknolojilerinde trendler</a></h2>
                            </div>
                            <div class="blog-item-btn">
                                <a href="{{ route('blog.index') }}" class="readmore-btn">devamı</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="post-featured-image">
                            <a href="{{ route('blog.index') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="{{ asset('theme/yalovakamera/images/post-3.jpg') }}" alt="">
                                </figure>
                            </a>
                            <div class="post-item-meta">
                                <a href="{{ route('blog.index') }}">20 Jan</a>
                            </div>
                        </div>

                        <div class="post-item-body">
                            <div class="post-item-content">
                                <h2><a href="{{ route('blog.index') }}">Evde güvenlik için pratik ipuçları</a></h2>
                            </div>
                            <div class="blog-item-btn">
                                <a href="{{ route('blog.index') }}" class="readmore-btn">devamı</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Blog Section End -->

@endsection
