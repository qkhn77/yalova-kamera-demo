@php
    $s = fn (string $k, string $d = '') => \App\Models\Setting::get("modul.faqs.$k", $d);
    $img = function (string $k, string $defaultFile) use ($s) {
        $v = (string) $s($k, '');
        return $v !== '' ? asset('uploads/' . ltrim(str_replace('\\', '/', $v), '/')) : asset('theme/yalovakamera/images/' . $defaultFile);
    };
@endphp
<!-- Our FAQs Section Start -->
<div class="our-faqs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="our-faqs-content">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $s('heading', 'SSS') }}</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>{{ $s('sub_span', 'Sıkça') }}</span> {{ $s('sub_text', 'sorulan sorular') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s">{{ $s('text', 'Kurulum, servis ve sistemler hakkında hızlı cevaplar.') }}</p>
                    </div>

                    <div class="our-faqs-list wow fadeInUp" data-wow-delay="0.6s">
                        <ul>
                            <li>{{ $s('list_1', 'Yüksek çözünürlüklü kayıt') }}</li>
                            <li>{{ $s('list_2', 'Uzaktan canlı izleme') }}</li>
                            <li>{{ $s('list_3', 'Geniş açı kapsama') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="faq-accordion faq-accordion-box" id="accordion">

                    <div class="accordion-item wow fadeInUp">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                {{ $s('q_1', 'Hangi kamera sistemlerini kuruyorsunuz?') }}
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>{{ $s('a_1', 'IP kameralar, NVR sistemleri ve dış ortam çözümleri sunuyoruz.') }}</p>
                                <img src="{{ $img('image', 'faqs-accordion-img.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                {{ $s('q_2', 'Kamerayı uzaktan izleyebilir miyim?') }}
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse show" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>{{ $s('a_2', 'Evet. Telefon uygulaması ile canlı izleme ve kayıt erişimi sağlanır.') }}</p>
                                <img src="{{ $img('image', 'faqs-accordion-img.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                        <h2 class="accordion-header" id="heading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                {{ $s('q_3', 'Kurulum hizmeti veriyor musunuz?') }}
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>{{ $s('a_3', 'Evet. Keşif, montaj ve devreye alma dahil anahtar teslim kurulum yapıyoruz.') }}</p>
                                <img src="{{ $img('image', 'faqs-accordion-img.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                        <h2 class="accordion-header" id="heading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                {{ $s('q_4', 'Kameralar dış ortam için uygun mu?') }}
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>{{ $s('a_4', 'Evet. IP66/67 gibi koruma sınıfına sahip dış ortam kameraları kuruyoruz.') }}</p>
                                <img src="{{ $img('image', 'faqs-accordion-img.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our FAQs Section End -->
