@php
    $s = fn (string $k, string $d = '') => \App\Models\Setting::get("modul.neden_biz.$k", $d);
    $img = function (string $k, string $defaultFile) use ($s) {
        $v = (string) $s($k, '');
        return $v !== '' ? asset('uploads/' . ltrim(str_replace('\\', '/', $v), '/')) : asset('theme/yalovakamera/images/' . $defaultFile);
    };
@endphp
    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">{{ $s('heading', 'Neden Biz?') }}</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>{{ $s('sub_span', 'Uzman ekip,') }}</span> {{ $s('sub_text', 'güvenilir çözümler') }}</h2>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ $img('icon_1', 'icon-why-choose-1.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>{{ $s('title_1', '7/24 Destek') }}</h3>
                                <p>{{ $s('text_1', 'Kurulum sonrası destek, bakım ve hızlı müdahale.') }}</p>
                            </div>
                        </div>

                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ $img('icon_2', 'icon-why-choose-2.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>{{ $s('title_2', 'İhtiyaca Özel') }}</h3>
                                <p>{{ $s('text_2', 'Mekâna uygun kamera ve alarm tasarımı.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-choose-image">
                        <figure>
                            <img src="{{ $img('image', 'why-choose-image.png') }}" alt="">
                        </figure>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ $img('icon_3', 'icon-why-choose-3.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>{{ $s('title_3', 'Uzaktan İzleme') }}</h3>
                                <p>{{ $s('text_3', 'Telefonla canlı izleme ve kayıt erişimi.') }}</p>
                            </div>
                        </div>

                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ $img('icon_4', 'icon-why-choose-4.svg') }}" alt="">
                            </div>
                            <div class="why-choose-item-content">
                                <h3>{{ $s('title_4', 'Periyodik Bakım') }}</h3>
                                <p>{{ $s('text_4', 'Sistem performansını koruyan düzenli bakım.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section End -->
