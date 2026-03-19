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

  <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="Yalova Kamera Sistemleri; Yalova ilinde güvenlik kamerası, alarm sistemleri, satış, kurulum, projelendirme, bakım ve onarım hizmetleri sunmaktadır.">
	<meta name="keywords" content="Yalova kamera sistemleri, Yalova güvenlik kamerası, alarm sistemleri Yalova, kamera kurulumu Yalova, güvenlik sistemleri Yalova">
	<meta name="author" content="Yalova Kamera Sistemleri">
	<!-- Page Title -->
    <title>Hakkımızda - Yalova Kamera Sistemleri</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/yalovakamera/images/favicon.png') }}">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="css/slicknav.min.css" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
	<!-- Font Awesome Icon Css-->
	<link href="css/all.min.css" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="css/animate.css" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Mouse Cursor Css File -->
	<link rel="stylesheet" href="css/mousecursor.css">
	<!-- Main Custom Css -->
	<link href="css/custom.css" rel="stylesheet" media="screen">
</head>
<body>

    <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{ asset('theme/yalovakamera/images/loader.svg') }}" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

	<!-- Header End -->



    <!-- About Us Section Start -->
    <div class="about-us page-about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Us Images Start -->
                    <div class="about-us-images">
                        <div class="about-img-1">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/yalovakamera/images/about-img-1.jpg') }}" alt="Yalova Kamera Sistemleri">
                            </figure>

                            <div class="company-experience-circle">
                                <img src="{{ asset('theme/yalovakamera/images/experience-circle.svg') }}" alt="">
                            </div>
                        </div>

                        <div class="about-img-2">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/yalovakamera/images/about-img-2.jpg') }}" alt="Güvenlik Kamera Sistemleri">
                            </figure>
                        </div>
                    </div>
                    <!-- About Us Images End -->
                </div>

                <div class="col-lg-6">
                    <div class="about-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Hakkımızda</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Yalova’da güvenliğinizi</span> profesyonel çözümlerle koruyoruz</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Yalova Kamera Sistemleri olarak Yalova ilinde kamera ve alarm sistemleri satış, kurulum, projelendirme, bakım ve onarım servisi hizmetleri vermekteyiz. Ev, iş yeri, ofis, mağaza, apartman ve sanayi alanları için ihtiyaca özel güvenlik çözümleri sunuyor; kaliteli ürün, uzman işçilik ve hızlı teknik destek anlayışıyla çalışıyoruz.</p>
                        </div>

                        <div class="about-experience-box wow fadeInUp" data-wow-delay="0.6s">
                            <div class="about-experience-image">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('theme/yalovakamera/images/about-experience-image.jpg') }}" alt="Tecrübeli Güvenlik Hizmetleri">
                                </figure>
                            </div>

                            <div class="about-experience-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-about-experience.svg') }}" alt="">
                                </div>
                                <div class="about-experience-content">
                                    <h3>Müşteri memnuniyeti odaklı, garantili ve profesyonel güvenlik sistemleri hizmeti sunuyoruz</h3>
                                </div>
                            </div>
                        </div>

                        <div class="about-us-body wow fadeInUp" data-wow-delay="0.8s">
                            <div class="about-contact-box">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-about-contact.svg') }}" alt="">
                                </div>
                                <div class="about-contact-box-content">
                                    <p>Bize Hemen Ulaşın</p>
                                    <h3><a href="tel:02263520724">0226 352 07 24</a></h3>
                                </div>
                            </div>

                            <div class="about-us-btn">
                                <a href="contact.html" class="btn-default">İletişime Geçin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Our Mission Vision Section Start -->
    <div class="our-mission-vision dark-section">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="mission-vision-image">
                        <figure class="image-anime">
                            <img src="{{ asset('theme/yalovakamera/images/mission-vision-img.jpg') }}" alt="Misyon ve Vizyon">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-vision-content">
                        <div class="mission-vision-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-mission.svg') }}" alt="">
                            </div>
                            <div class="mission-vision-item-content">
                                <h3>Misyonumuz</h3>
                                <p>Müşterilerimize ihtiyaçlarına en uygun kamera ve alarm sistemlerini sunarak yaşam ve çalışma alanlarını daha güvenli hale getirmek; kaliteli ürün, doğru projelendirme ve güvenilir teknik servis ile kalıcı memnuniyet sağlamaktır.</p>
                            </div>
                        </div>

                        <div class="mission-vision-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-vision.svg') }}" alt="">
                            </div>
                            <div class="mission-vision-item-content">
                                <h3>Vizyonumuz</h3>
                                <p>Yalova’da güvenlik sistemleri alanında güvenilirliği, teknik yeterliliği ve hizmet kalitesiyle öne çıkan, müşterilerin ilk tercih ettiği lider firmalardan biri olmaktır.</p>
                            </div>
                        </div>

                        <div class="mission-vision-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-goal.svg') }}" alt="">
                            </div>
                            <div class="mission-vision-item-content">
                                <h3>Hedefimiz</h3>
                                <p>Her projede maksimum verim, uzun ömürlü sistem kullanımı ve hızlı servis desteği sunarak bireysel ve kurumsal müşterilerimize eksiksiz güvenlik çözümleri sağlamaktır.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Mission Vision Section End -->

    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Neden Bizi Tercih Etmelisiniz?</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Uzman ekip,</span> kaliteli ürün ve güvenilir servis</h2>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-why-choose-1.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>Hızlı Teknik Destek</h3>
                                <p>Kurulum sonrası bakım, arıza tespiti ve onarım süreçlerinde hızlı ve çözüm odaklı destek sağlıyoruz.</p>
                            </div>
                        </div>

                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-why-choose-2.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>İhtiyaca Özel Çözümler</h3>
                                <p>Ev, iş yeri, apartman, mağaza ve fabrika gibi farklı alanlara özel projelendirme yapıyoruz.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-choose-image">
                        <figure>
                            <img src="{{ asset('theme/yalovakamera/images/why-choose-image.png') }}" alt="Yalova Kamera Sistemleri Hizmetleri">
                        </figure>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-why-choose-3.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>Uzaktan Erişim</h3>
                                <p>Mobil cihazlardan izleme imkânı sunan modern kamera sistemleri ile her yerden kontrol sağlayabilirsiniz.</p>
                            </div>
                        </div>

                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-why-choose-4.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>Garantili Hizmet</h3>
                                <p>Tüm hizmetlerimiz garantili olup müşteri memnuniyeti odaklı çalışma prensibiyle sunulmaktadır.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section End -->

    <!-- Our Commitment Section Start -->
    <div class="our-commitment">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="our-commitment-images">
                        <div class="our-commitment-img-box">
                            <div class="commitment-image-1">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('theme/yalovakamera/images/commitment-image-1.jpg') }}" alt="Profesyonel Güvenlik Hizmetleri">
                                </figure>
                            </div>

                            <div class="satisfy-client-box">
                                <div class="satisfy-client-content">
                                    <h2><span class="counter">100</span>+</h2>
                                    <p>Memnun Müşteri ve Tamamlanan Güvenlik Çözümü</p>
                                </div>

                                <div class="satisfy-client-images">
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('theme/yalovakamera/images/satisfy-client-img-1.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('theme/yalovakamera/images/satisfy-client-img-2.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('theme/yalovakamera/images/satisfy-client-img-3.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('theme/yalovakamera/images/satisfy-client-img-4.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="satisfy-client-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('theme/yalovakamera/images/satisfy-client-img-5.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="our-commitment-img-box">
                            <div class="commitment-image-2">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('theme/yalovakamera/images/commitment-image-2.jpg') }}" alt="Kamera ve Alarm Sistemleri">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="our-commitment-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Taahhüdümüz</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Güvenlikte kaliteyi</span> ve sürekliliği sağlıyoruz</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Yalova Kamera Sistemleri olarak her projede doğru keşif, doğru ürün seçimi ve doğru montaj ilkesiyle hareket ediyoruz. Sadece satış değil, satış sonrası teknik destek ve sürdürülebilir hizmet anlayışı da sunuyoruz.</p>
                        </div>
                    </div>

                    <div class="commitment-counter-box">
                        <div class="commitment-counter-item">
                            <h2><span class="counter">100</span>+</h2>
                            <p>Kurulum Hizmeti</p>
                        </div>

                        <div class="commitment-counter-item">
                            <h2><span class="counter">100</span>+</h2>
                            <p>Teknik Servis Desteği</p>
                        </div>

                        <div class="commitment-counter-item">
                            <h2><span class="counter">100</span>+</h2>
                            <p>Müşteri Memnuniyeti</p>
                        </div>
                    </div>

                    <div class="commitment-list wow fadeInUp" data-wow-delay="0.6s">
                        <ul>
                            <li>Kaliteli ürün, profesyonel kurulum ve garantili hizmet sunuyoruz.</li>
                            <li>Kamera, alarm ve güvenlik sistemlerinde uzun ömürlü çözümler sağlıyoruz.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Commitment Section End -->

    <!-- Our Expertise Section Start -->
    <div class="our-expertise">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="our-expertise-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Uzmanlığımız</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Akıllı güvenlik çözümleri</span> ile maksimum koruma</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Projeye uygun kamera sistemleri, alarm altyapıları, kayıt cihazları, görüntüleme çözümleri ve bakım servisleri ile kapsamlı güvenlik hizmetleri sunuyoruz.</p>
                        </div>

                        <div class="our-expertise-body">
                            <div class="expertise-item-box">
                                <div class="expertise-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('theme/yalovakamera/images/icon-expertise-item-1.svg') }}" alt="">
                                    </div>
                                    <div class="expertise-item-content">
                                        <h3>Modern Teknoloji</h3>
                                        <p>Güncel güvenlik sistemleri ile yüksek performanslı çözümler sunuyoruz.</p>
                                    </div>
                                </div>

                                <div class="expertise-item">
                                    <div class="icon-box">
                                        <img src="{{ asset('theme/yalovakamera/images/icon-expertise-item-2.svg') }}" alt="">
                                    </div>
                                    <div class="expertise-item-content">
                                        <h3>Profesyonel Uygulama</h3>
                                        <p>Keşif, projelendirme, montaj ve servis süreçlerini titizlikle yürütüyoruz.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="expertise-counter-box">
                                <div class="expertise-counter-content">
                                    <h2><span class="counter">24</span>/7</h2>
                                    <p>Destek ve Servis Yaklaşımı</p>
                                </div>

                                <div class="expertise-counter-list">
                                    <ul>
                                        <li>Kamera sistemleri kurulumu</li>
                                        <li>Alarm sistemleri teknik servis hizmeti</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="our-expertise-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('theme/yalovakamera/images/expertise-image.jpg') }}" alt="Uzman Güvenlik Çözümleri">
                        </figure>

                        <div class="expertise-contact-box">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-phone.svg') }}" alt="">
                            </div>
                            <div class="expertise-contact-content">
                                <h3>Hemen Arayın</h3>
                                <p><a href="tel:02263520724">0226 352 07 24</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Expertise Section End -->

    <!-- What We Do Section Start -->
    <div class="what-we-do dark-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="what-we-do-content">
                        <div class="section-title section-title-center">
                            <h3 class="wow fadeInUp">Ne Yapıyoruz?</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Güvenlik ve izleme</span> sistemlerinde profesyonel hizmet veriyoruz</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Yalova Kamera Sistemleri olarak güvenlik kamerası ve alarm sistemleri satışından kurulumuna, projelendirmeden bakım ve onarıma kadar tüm süreçlerde profesyonel hizmet vermekteyiz.</p>
                            <p class="wow fadeInUp" data-wow-delay="0.6s">Her mekânın güvenlik ihtiyacının farklı olduğunu biliyor, buna göre özel çözümler geliştiriyoruz. Kullandığımız sistemler yüksek görüntü kalitesi, güvenilir performans ve kolay kullanım avantajı sunar. Amacımız müşterilerimize uzun ömürlü, verimli ve sorunsuz güvenlik altyapısı sağlamaktır.</p>
                        </div>

                        <div class="about-need-help wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="{{ asset('theme/yalovakamera/images/icon-need-help.svg') }}" alt="">
                            </div>
                            <div class="need-help-content">
                                <p>Hizmetlerimiz Hakkında Bilgi Alın</p>
                                <h3><a href="tel:02263520724">0226 352 07 24</a></h3>
                            </div>
                        </div>
                    </div>                    
                </div>

                <div class="col-lg-6">
                    <div class="what-we-counter-image">                       
                        <div class="what-we-counter-box">
                            <div class="what-we-counter-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-what-we-counter-1.svg') }}" alt="">
                                </div>
                                <div class="what-we-counter-item-content">
                                    <h3><span class="counter">24</span>/7</h3>
                                    <p>Teknik Destek Yaklaşımı</p>
                                </div>
                            </div>

                            <div class="what-we-counter-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-what-we-counter-2.svg') }}" alt="">
                                </div>
                                <div class="what-we-counter-item-content">
                                    <h3><span class="counter">100</span>+</h3>
                                    <p>Tamamlanan Hizmet</p>
                                </div>
                            </div>
                        </div>

                        <div class="what-we-image">
                            <figure>
                                <img src="{{ asset('theme/yalovakamera/images/what-we-image.jpg') }}" alt="Güvenlik Çözümleri">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- What We Do Section End -->

    <!-- Our Team Section Start -->
    <div class="our-team">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Uzman Ekibimiz</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Güvenliğiniz için çalışan</span> profesyonel kadro</h2>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="section-content-btn">
                        <div class="section-title-content wow fadeInUp" data-wow-delay="0.4s">
                            <p>Kurulum, bakım, onarım ve teknik destek süreçlerinde deneyimli ekibimizle Yalova’da profesyonel güvenlik sistemleri hizmeti sunuyoruz.</p>
                        </div>
    
                        <div class="section-btn wow fadeInUp" data-wow-delay="0.6s">
                            <a href="team.html" class="btn-default">Tüm Ekibi Gör</a>
                        </div>
                    </div>   
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="team-image">
                            <a href="team-single.html" data-cursor-text="Görüntüle">
                                <figure class="image-anime">
                                    <img src="{{ asset('theme/yalovakamera/images/team-1.jpg') }}" alt="">
                                </figure>
                            </a>
                
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                
                        <div class="team-content">
                            <h3><a href="team-single.html">Teknik Destek Ekibi</a></h3>
                            <p>Kurulum ve Servis Uzmanı</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-image">
                            <a href="team-single.html" data-cursor-text="Görüntüle">
                                <figure class="image-anime">
                                    <img src="{{ asset('theme/yalovakamera/images/team-2.jpg') }}" alt="">
                                </figure>
                            </a>
                
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                
                        <div class="team-content">
                            <h3><a href="team-single.html">Projelendirme Ekibi</a></h3>
                            <p>Güvenlik Sistemleri Uzmanı</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.75s">
                        <div class="team-image">
                            <a href="team-single.html" data-cursor-text="Görüntüle">
                                <figure class="image-anime">
                                    <img src="{{ asset('theme/yalovakamera/images/team-3.jpg') }}" alt="">
                                </figure>
                            </a>
                
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                
                        <div class="team-content">
                            <h3><a href="team-single.html">Bakım Onarım Ekibi</a></h3>
                            <p>Sistem Kontrol Uzmanı</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <div class="team-image">
                            <a href="team-single.html" data-cursor-text="Görüntüle">
                                <figure class="image-anime">
                                    <img src="{{ asset('theme/yalovakamera/images/team-4.jpg') }}" alt="">
                                </figure>
                            </a>
                
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                
                        <div class="team-content">
                            <h3><a href="team-single.html">Müşteri Destek Ekibi</a></h3>
                            <p>Destek ve Koordinasyon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Team Section End -->    

    <!-- Our Support Section Start -->
    <div class="our-support about-support">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="our-support-images">
                        <div class="our-support-image box-1">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/yalovakamera/images/support-image-1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="our-support-image box-2">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('theme/yalovakamera/images/support-image-2.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="our-support-circle">
                            <a href="contact.html"><img src="{{ asset('theme/yalovakamera/images/contact-now-circle-2.svg') }}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="our-support-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Teknik Destek</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Her zaman ulaşılabilir</span> güvenilir teknik servis</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Sistemlerinizin sorunsuz çalışması için bakım, kontrol, arıza tespiti ve onarım hizmetlerini profesyonel şekilde sunuyoruz.</p>
                        </div>

                        <div class="our-support-body wow fadeInUp" data-wow-delay="0.6s">
                            <div class="support-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-support-item-1.svg') }}" alt="">
                                </div>
                                <div class="support-item-content">
                                    <h3>Kamera Sistemi Kurulumu</h3>
                                    <p>İç ve dış mekânlara uygun profesyonel kamera sistemleri kurulumu yapıyoruz.</p>
                                </div>
                            </div>

                            <div class="support-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-support-item-2.svg') }}" alt="">
                                </div>
                                <div class="support-item-content">
                                    <h3>Alarm Sistemleri Servisi</h3>
                                    <p>Alarm sistemleri için kurulum, kontrol, bakım ve onarım desteği veriyoruz.</p>
                                </div>
                            </div>
                        </div>

                        <div class="our-support-btn wow fadeInUp" data-wow-delay="0.8s">
                            <a href="contact.html" class="btn-default">Bizimle İletişime Geçin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Support Section End -->

    <!-- Our Testimonials Section Start -->
    <div class="our-testimonials">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Müşteri Yorumları</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Müşterilerimizin</span> bize duyduğu güven</h2>
                    </div>
                </div>               
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Sürükle">
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-author-box">
                                                <div class="author-image">
                                                    <figure class="image-anime">
                                                        <img src="{{ asset('theme/yalovakamera/images/author-1.jpg') }}" alt="">
                                                    </figure>
                                                </div>
                                                <div class="author-content">
                                                    <h3>Ahmet Y.</h3>
                                                    <p>İşyeri Sahibi</p>
                                                </div>  
                                            </div>        
                                            <div class="testimonial-quote">
                                                <img src="{{ asset('theme/yalovakamera/images/testimonial-quote.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>                                   
                                        </div>                              
                                        <div class="testimonial-content">
                                            <p>"İşyerimiz için kamera ve alarm sistemi kurulumu yaptırdık. Hem kurulum süreci hem de sonrasında verilen destekten çok memnun kaldık. Güvenilir ve profesyonel bir firma."</p>
                                        </div>                              
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-author-box">
                                                <div class="author-image">
                                                    <figure class="image-anime">
                                                        <img src="{{ asset('theme/yalovakamera/images/author-2.jpg') }}" alt="">
                                                    </figure>
                                                </div>
                                                <div class="author-content">
                                                    <h3>Mehmet K.</h3>
                                                    <p>Apartman Yöneticisi</p>
                                                </div>  
                                            </div>        
                                            <div class="testimonial-quote">
                                                <img src="{{ asset('theme/yalovakamera/images/testimonial-quote.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>                                   
                                        </div>                                   
                                        <div class="testimonial-content">
                                            <p>"Apartmanımız için yapılan kamera sistemi kurulumu çok başarılı oldu. Görüntü kalitesi çok iyi, ekip ilgili ve işini düzgün yapıyor. Tavsiye ederim."</p>
                                        </div>                              
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-author-box">
                                                <div class="author-image">
                                                    <figure class="image-anime">
                                                        <img src="{{ asset('theme/yalovakamera/images/author-3.jpg') }}" alt="">
                                                    </figure>
                                                </div>
                                                <div class="author-content">
                                                    <h3>Ayşe T.</h3>
                                                    <p>Ev Sahibi</p>
                                                </div>  
                                            </div>        
                                            <div class="testimonial-quote">
                                                <img src="{{ asset('theme/yalovakamera/images/testimonial-quote.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>                                   
                                        </div>                           
                                        <div class="testimonial-content">
                                            <p>"Evimize kurulan güvenlik sistemi sayesinde içimiz çok daha rahat. Sorularımıza hızlı cevap verildi, montaj temiz ve düzenli yapıldı. Müşteri memnuniyeti gerçekten ön planda."</p>
                                        </div>                              
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-btn">
                                <div class="testimonial-button-prev"></div>
                                <div class="testimonial-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Testimonials Section End -->

    <!-- CTA Box Section Start -->
    <div class="cta-box dark-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="cta-box-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">İletişim</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Güvenliğiniz için</span> doğru adres: Yalova Kamera Sistemleri</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Kamera ve alarm sistemleri hakkında bilgi almak, keşif talep etmek veya teklif istemek için hemen bizimle iletişime geçin.</p>
                        </div>

                        <div class="cta-box-body wow fadeInUp" data-wow-delay="0.6s">
                            <div class="cta-box-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-phone.svg') }}" alt="">
                                </div>
                                <div class="cta-box-item-content">
                                    <p>Telefon Numarası</p>
                                    <h3><a href="tel:02263520724">0226 352 07 24</a></h3>
                                </div>
                            </div>

                            <div class="cta-box-item">
                                <div class="icon-box">
                                    <img src="{{ asset('theme/yalovakamera/images/icon-mail.svg') }}" alt="">
                                </div>
                                <div class="cta-box-item-content">
                                    <p>E-posta Adresi</p>
                                    <h3><a href="mailto:info@yalovakamera.com">info@yalovakamera.com</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="cta-box-image">
                        <img src="{{ asset('theme/yalovakamera/images/cta-box-image.png') }}" alt="İletişim">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Box Section End -->

    <!-- Our FAQs Section Start -->
    <div class="our-faqs about-our-faqs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="our-faqs-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Sık Sorulan Sorular</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Merak edilen</span> sorular ve cevaplar</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Kamera ve alarm sistemleri, kurulum süreçleri, bakım hizmetleri ve teknik destek hakkında sık sorulan soruların cevaplarını burada bulabilirsiniz.</p>
                        </div>

                        <div class="our-faqs-list wow fadeInUp" data-wow-delay="0.6s">
                            <ul>
                                <li>Yüksek çözünürlüklü görüntü sistemleri</li>
                                <li>Uzaktan izleme ve kontrol çözümleri</li>
                                <li>Profesyonel kurulum ve teknik servis desteği</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="faq-accordion" id="accordion">
                        <div class="accordion-item wow fadeInUp">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    Hangi tür kamera sistemleri sunuyorsunuz?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>İhtiyaca göre iç ve dış mekân güvenlik kameraları, kayıt cihazları, IP kamera sistemleri ve uzaktan izleme destekli çözümler sunuyoruz.</p>
                                    <img src="{{ asset('theme/yalovakamera/images/faqs-accordion-img.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Kamera görüntülerine telefondan erişebilir miyim?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Evet. Kurulan sisteme göre cep telefonu, tablet veya bilgisayar üzerinden canlı izleme ve geçmiş kayıtları görüntüleme imkânı sunulmaktadır.</p>
                                    <img src="{{ asset('theme/yalovakamera/images/faqs-accordion-img.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Kurulum hizmeti veriyor musunuz?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Evet. Satışını yaptığımız tüm sistemler için keşif, projelendirme, kurulum ve devreye alma hizmeti veriyoruz.</p>
                                    <img src="{{ asset('theme/yalovakamera/images/faqs-accordion-img.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Bakım ve onarım servisi sağlıyor musunuz?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Evet. Mevcut kamera ve alarm sistemleri için arıza tespiti, periyodik bakım, onarım ve sistem iyileştirme hizmetleri sunuyoruz.</p>
                                    <img src="{{ asset('theme/yalovakamera/images/faqs-accordion-img.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our FAQs Section End -->
      
      
        






















@endsection