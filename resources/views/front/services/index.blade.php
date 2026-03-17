@extends('front.layouts.app')

@section('title', isset($category) ? (($category->meta_title ?? $category->name) . ' | Yalova Kamera Servisler') : 'Servisler | Yalova Kamera Sistemleri')
@section('meta_description', isset($category) ? ($category->meta_description ?? $category->description ?? 'Yalova kamera servis kategorisi.') : 'IP kamera kurulumu, alarm sistemleri, montaj, teknik servis ve bakım hizmetleri. Yalova genelinde profesyonel çözümler.')
@section('meta_keywords', isset($category) ? ($category->meta_keywords ?? 'yalova kamera servisi, ' . ($category->name ?? '')) : 'yalova kamera servisi, kamera montaj servisi, alarm sistemi servisi, IP kamera kurulumu yalova, güvenlik sistemi teknik servis, kamera bakım onarım')

@php
    \App\Helpers\BreadcrumbHelper::clear();
    \App\Helpers\BreadcrumbHelper::add('Anasayfa', '/');
    \App\Helpers\BreadcrumbHelper::add('Servisler');
@endphp

@section('content')
    @php $categories = $categories ?? collect(); @endphp

    <div class="page-header">
        <div class="container">
            <div class="page-header-box">
                <h1 class="wow fadeInUp">Servisler</h1>
                {!! \App\Helpers\BreadcrumbHelper::render() !!}
                @if($categories->isNotEmpty())
                    <nav class="mt-3">
                        <a href="{{ route('services.index') }}" class="btn-default btn-sm {{ !isset($category) ? 'active' : '' }}">Tümü</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('services.index.category', $cat->slug) }}" class="btn-default btn-sm {{ (isset($category) && $category->id === $cat->id) ? 'active' : '' }}">{{ $cat->name }}</a>
                        @endforeach
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <div class="our-services">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Servisler</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">
                            @if(isset($category))
                                <span>{{ $category->name }}</span> kategorisi
                            @else
                                <span>Kapsamlı güvenlik</span> ve izleme çözümleri
                            @endif
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($services as $i => $s)
    <div class="col-lg-4 col-md-6">
        @include('front.partials.cards.service-card', ['s' => $s, 'i' => $i])
    </div>
                @empty
    <div class="col-12 text-center py-5">
        <p>Henüz servis eklenmemiş. Admin panelinden ekleyebilirsiniz.</p>
        <a href="{{ route('contact') }}" class="btn-default">İletişime Geç</a>
    </div>
    </div>
                @endforelse
    </div>

                <div class="col-lg-12">
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.4s">
                        <p><span>Ücretsiz</span> keşif ve teklif için <a href="{{ route('contact') }}">iletişime geç</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
