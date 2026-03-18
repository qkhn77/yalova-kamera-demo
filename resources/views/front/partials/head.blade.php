<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

@php
    $gsc = \App\Models\Setting::get('google_search_console') ?: \App\Models\Setting::get('webmaster_verification');
    $gaCode = \App\Models\Setting::get('google_analytics_code');
@endphp
@if(!empty($gsc))
<meta name="google-site-verification" content="{{ $gsc }}">
@endif

@if(!empty($gaCode))
{!! $gaCode !!}
@elseif($gaId = config('services.google.analytics_id'))
<!-- Google Analytics (GA4) - config fallback -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $gaId }}', { 'anonymize_ip': true });
</script>
@endif

@php
    $siteTitle = \App\Models\Setting::get('site_title', config('app.name')) ?: 'Yalova Kamera Kurulumu | Güvenlik Kamerası Sistemleri - Yalova Kamera';
    $siteDescription = \App\Models\Setting::get('meta_description') ?: 'Yalova\'da profesyonel kamera kurulumu, güvenlik kamerası ve alarm sistemleri. CCTV çözümleri, servis ve bakım hizmetleri. Yalova kamera kurulumu için uzman ekibimizle iletişime geçin.';
    $siteKeywords = \App\Models\Setting::get('meta_keywords') ?: 'yalova kamera kurulumu, güvenlik kamerası, alarm sistemi, CCTV, Yalova kamera servisi, güvenlik sistemi kurulumu, kamera montajı';
@endphp
<title>@yield('title', $siteTitle)</title>
<meta name="description" content="@yield('meta_description', $siteDescription)">
<meta name="keywords" content="@yield('meta_keywords', $siteKeywords)">
<meta name="robots" content="@yield('meta_robots', 'index, follow')">
<meta name="author" content="Yalova Kamera Sistemleri">
<meta name="language" content="tr-TR">
<meta name="geo.region" content="TR-77">
<meta name="geo.placename" content="Yalova">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('og_title', 'Yalova Kamera Kurulumu | Güvenlik Kamerası Sistemleri - Yalova Kamera')">
<meta property="og:description" content="@yield('og_description', 'Yalova\'da profesyonel kamera kurulumu, güvenlik kamerası ve alarm sistemleri. CCTV çözümleri, servis ve bakım hizmetleri.')">
<meta property="og:image" content="@yield('og_image', '/theme/yalovakamera/images/yalova_kamera.png')">
<meta property="og:site_name" content="Yalova Kamera Sistemleri">
<meta property="og:locale" content="tr_TR">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="@yield('og_title', 'Yalova Kamera Kurulumu | Güvenlik Kamerası Sistemleri - Yalova Kamera')">
<meta property="twitter:description" content="@yield('og_description', 'Yalova\'da profesyonel kamera kurulumu, güvenlik kamerası ve alarm sistemleri.')">
<meta property="twitter:image" content="@yield('og_image', '/theme/yalovakamera/images/yalova_kamera.png')">

<link rel="canonical" href="{{ url()->current() }}">

<link rel="shortcut icon" type="image/x-icon" href="/theme/yalovakamera/images/favicon.png">

<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link href="/theme/yalovakamera/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="/theme/yalovakamera/css/slicknav.min.css" rel="stylesheet">
<link href="/theme/yalovakamera/css/swiper-bundle.min.css" rel="stylesheet">
<link href="/theme/yalovakamera/css/all.min.css" rel="stylesheet" media="screen">
<link href="/theme/yalovakamera/css/animate.css" rel="stylesheet">
<link href="/theme/yalovakamera/css/magnific-popup.css" rel="stylesheet">
<link href="/theme/yalovakamera/css/mousecursor.css" rel="stylesheet">
<link href="/theme/yalovakamera/css/custom.css" rel="stylesheet" media="screen">