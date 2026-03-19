@php
    $s = fn (string $k, string $d = '') => \App\Models\Setting::get("modul.teknik_destek.$k", $d);
    $img = function (string $k, string $defaultFile) use ($s) {
        $v = (string) $s($k, '');
        return $v !== '' ? asset('uploads/' . ltrim(str_replace('\\', '/', $v), '/')) : asset('theme/yalovakamera/images/' . $defaultFile);
    };
@endphp
<!-- Our Support Section Start -->
<div class="our-support">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="our-support-images">
                    <div class="our-support-image box-1">
                        <figure class="image-anime reveal">
                            <img src="{{ $img('image_1', 'support-image-1.jpg') }}" alt="">
                        </figure>
                    </div>
                    <div class="our-support-image box-2">
                        <figure class="image-anime reveal">
                            <img src="{{ $img('image_2', 'support-image-2.jpg') }}" alt="">
                        </figure>
                    </div>
                    <div class="our-support-circle">
                        <a href="{{ route('contact') }}">
                            <img src="{{ $img('circle_image', 'contact-now-circle-2.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="our-support-content">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $s('heading', 'Teknik Destek') }}</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>{{ $s('sub_span', 'Güvenilir') }}</span> {{ $s('sub_text', 'destek') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">{{ $s('text', 'Kurulum sonrası destek, bakım ve arıza çözümleri.') }}</p>
                    </div>

                    <div class="our-support-body wow fadeInUp" data-wow-delay="0.6s">
                        <div class="support-item">
                            <div class="icon-box">
                                <img src="{{ $img('icon_1', 'icon-support-item-1.svg') }}" alt="">
                            </div>
                            <div class="support-item-content">
                                <h3>{{ $s('title_1', 'Kamera Kurulumu') }}</h3>
                                <p>{{ $s('text_1', 'Keşif + montaj + devreye alma.') }}</p>
                            </div>
                        </div>

                        <div class="support-item">
                            <div class="icon-box">
                                <img src="{{ $img('icon_2', 'icon-support-item-2.svg') }}" alt="">
                            </div>
                            <div class="support-item-content">
                                <h3>{{ $s('title_2', 'Güvenlik Çözümleri') }}</h3>
                                <p>{{ $s('text_2', 'Alarm, kayıt ve erişim sistemleri.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="our-support-btn wow fadeInUp" data-wow-delay="0.8s">
                        <a href="{{ route('contact') }}" class="btn-default">{{ $s('button_text', 'İletişime Geç') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Support Section End -->
