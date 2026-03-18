<!doctype html>
<html lang="tr">
<head>
    @include('front.partials.head')
</head>
<body>

@include('front.partials.header')

@yield('content')

@include('front.partials.footer')

<footer style="padding: 20px; background: #333; color: white; text-align: center;">
    <p>&copy; 2026 Yalova Kamera</p>
</footer>

<script src="/theme/yalovakamera/js/jquery-3.7.1.min.js"></script>
<script src="/theme/yalovakamera/js/bootstrap.min.js"></script>

<script src="/theme/yalovakamera/js/validator.min.js"></script>
<script src="/theme/yalovakamera/js/jquery.slicknav.js"></script>
<script src="/theme/yalovakamera/js/swiper-bundle.min.js"></script>

<script src="/theme/yalovakamera/js/jquery.waypoints.min.js"></script>
<script src="/theme/yalovakamera/js/jquery.counterup.min.js"></script>

<script src="/theme/yalovakamera/js/jquery.magnific-popup.min.js"></script>
<script src="/theme/yalovakamera/js/parallaxie.js"></script>

<script src="/theme/yalovakamera/js/gsap.min.js"></script>
<script src="/theme/yalovakamera/js/ScrollTrigger.min.js"></script>
<script src="/theme/yalovakamera/js/SplitText.js"></script>

<script src="/theme/yalovakamera/js/magiccursor.js"></script>
<script src="/theme/yalovakamera/js/isotope.min.js"></script>
<script src="/theme/yalovakamera/js/jquery.mb.YTPlayer.min.js"></script>
<script src="/theme/yalovakamera/js/wow.min.js"></script>
<script src="/theme/yalovakamera/js/SmoothScroll.js"></script>

<script src="/theme/yalovakamera/js/function.js"></script>

@stack('scripts')

</body>
</html>