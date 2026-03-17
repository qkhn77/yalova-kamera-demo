<!-- Our Projects Start -->
<div class="our-projects">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">Projeler</h3>
                    <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque"><span>Örnek</span> uygulamalar</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="our-Project-nav wow fadeInUp" data-wow-delay="0.4s">
                    <ul>
                        <li><a href="#" class="active-btn" data-filter="*">Tümü</a></li>
                        <li><a href="#" data-filter=".residential">Konut</a></li>
                        <li><a href="#" data-filter=".commercial">Ticari</a></li>
                        <li><a href="#" data-filter=".industrial">Endüstriyel</a></li>
                        <li><a href="#" data-filter=".retail">Mağaza</a></li>
                        <li><a href="#" data-filter=".office">Ofis</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row project-item-boxes align-items-center">
                    @php $p = 'theme/yalovakamera/images/'; @endphp

                    <div class="col-lg-4 col-md-6 project-item-box residential">
                        <div class="project-item wow fadeInUp">
                            <div class="project-image">
                                <a href="{{ route('projects.index') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset($p.'project-1.jpg') }}" alt="">
                                    </figure>
                                </a>
                                <div class="project-tag">
                                    <a href="{{ route('projects.index') }}">Konut</a>
                                </div>
                            </div>
                            <div class="project-content">
                                <h3><a href="{{ route('projects.index') }}">Konut Kamera Kurulumu</a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 project-item-box commercial">
                        <div class="project-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="project-image">
                                <a href="{{ route('projects.index') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset($p.'project-2.jpg') }}" alt="">
                                    </figure>
                                </a>
                                <div class="project-tag">
                                    <a href="{{ route('projects.index') }}">Ticari</a>
                                </div>
                            </div>
                            <div class="project-content">
                                <h3><a href="{{ route('projects.index') }}">İşletme Güvenlik Çözümü</a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 project-item-box industrial">
                        <div class="project-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="project-image">
                                <a href="{{ route('projects.index') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset($p.'project-3.jpg') }}" alt="">
                                    </figure>
                                </a>
                                <div class="project-tag">
                                    <a href="{{ route('projects.index') }}">Endüstriyel</a>
                                </div>
                            </div>
                            <div class="project-content">
                                <h3><a href="{{ route('projects.index') }}">Fabrika / Depo İzleme</a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 project-item-box retail">
                        <div class="project-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="project-image">
                                <a href="{{ route('projects.index') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset($p.'project-4.jpg') }}" alt="">
                                    </figure>
                                </a>
                                <div class="project-tag">
                                    <a href="{{ route('projects.index') }}">Mağaza</a>
                                </div>
                            </div>
                            <div class="project-content">
                                <h3><a href="{{ route('projects.index') }}">Mağaza Kamera Sistemi</a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 project-item-box residential">
                        <div class="project-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="project-image">
                                <a href="{{ route('projects.index') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset($p.'project-5.jpg') }}" alt="">
                                    </figure>
                                </a>
                                <div class="project-tag">
                                    <a href="{{ route('projects.index') }}">Konut</a>
                                </div>
                            </div>
                            <div class="project-content">
                                <h3><a href="{{ route('projects.index') }}">Site / Apartman Çözümü</a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 project-item-box office">
                        <div class="project-item wow fadeInUp" data-wow-delay="1s">
                            <div class="project-image">
                                <a href="{{ route('projects.index') }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <img src="{{ asset($p.'project-6.jpg') }}" alt="">
                                    </figure>
                                </a>
                                <div class="project-tag">
                                    <a href="{{ route('projects.index') }}">Ofis</a>
                                </div>
                            </div>
                            <div class="project-content">
                                <h3><a href="{{ route('projects.index') }}">Ofis Güvenliği</a></h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Projects End -->
