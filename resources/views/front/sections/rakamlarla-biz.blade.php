@php
    $s = fn (string $k, string $d = '') => \App\Models\Setting::get("modul.rakamlarla_biz.$k", $d);
    $img = function (string $k, string $defaultFile) use ($s) {
        $v = (string) $s($k, '');
        return $v !== '' ? asset('uploads/' . ltrim(str_replace('\\', '/', $v), '/')) : asset('theme/yalovakamera/images/' . $defaultFile);
    };
@endphp
<!-- Our Feature Section Start -->
<div class="our-feature dark-section">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="section-title">
                    <h3 class="wow fadeInUp">{{ $s('heading', 'Özellikler') }}</h3>
                    <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>{{ $s('sub_span', 'Gelişmiş') }}</span> {{ $s('sub_text', 'güvenlik sistemleri') }}</h2>
                </div>
            </div>

            <div class="col-lg-6 col-md-4">
                <div class="contact-now-circle">
                    <a href="{{ route('contact') }}">
                        <img src="{{ $img('contact_circle', 'contact-now-circle.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="our-feature-box">
                    <div class="feature-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ $img('icon_1', 'icon-feature-item-1.svg') }}" alt="">
                        </div>
                        <div class="feature-item-content">
                            <h3>{{ $s('title_1', '7/24 İzleme & Bildirim') }}</h3>
                            <p>{{ $s('text_1', 'Kesintisiz izleme ve hızlı bildirim altyapısı.') }}</p>
                        </div>
                    </div>

                    <div class="feature-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ $img('icon_2', 'icon-feature-item-2.svg') }}" alt="">
                        </div>
                        <div class="feature-item-content">
                            <h3>{{ $s('title_2', 'Yüksek Çözünürlük') }}</h3>
                            <p>{{ $s('text_2', 'Net görüntü ve güçlü gece görüş seçenekleri.') }}</p>
                        </div>
                    </div>

                    <div class="feature-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{ $img('icon_3', 'icon-feature-item-3.svg') }}" alt="">
                        </div>
                        <div class="feature-item-content">
                            <h3>{{ $s('title_3', 'Genişletilebilir Yapı') }}</h3>
                            <p>{{ $s('text_3', 'İhtiyacınıza göre ek kamera ve cihaz desteği.') }}</p>
                        </div>
                    </div>

                    <div class="feature-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="{{ $img('icon_4', 'icon-feature-item-4.svg') }}" alt="">
                        </div>
                        <div class="feature-item-content">
                            <h3>{{ $s('title_4', 'Darbeye Dayanım') }}</h3>
                            <p>{{ $s('text_4', 'Dış ortam koşullarına uygun sağlam tasarım.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="feature-counter-box">
                    <div class="feature-counter-item">
                        <h2><span class="counter">{{ $s('counter_1', '220') }}</span>+</h2>
                        <p>{{ $s('counter_label_1', 'Konut') }}</p>
                    </div>
                    <div class="feature-counter-item">
                        <h2><span class="counter">{{ $s('counter_2', '30') }}</span>+</h2>
                        <p>{{ $s('counter_label_2', 'AVM & Bina') }}</p>
                    </div>
                    <div class="feature-counter-item">
                        <h2><span class="counter">{{ $s('counter_3', '100') }}</span>+</h2>
                        <p>{{ $s('counter_label_3', 'Ticari Alan') }}</p>
                    </div>
                    <div class="feature-counter-item">
                        <h2><span class="counter">{{ $s('counter_4', '700') }}</span>+</h2>
                        <p>{{ $s('counter_label_4', 'Proje') }}</p>
                    </div>
                    <div class="feature-counter-item">
                        <h2><span class="counter">{{ $s('counter_5', '10') }}</span>+</h2>
                        <p>{{ $s('counter_label_5', 'Yıl Deneyim') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Feature Section End -->
