@extends('front.layouts.app')

@section('title', $service->title . ' | Servisler')
@section('meta_description', $service->short_description)
@section('meta_keywords', trim(($service->category?->name ? $service->category->name . ', ' : '') . $service->title . ', yalova kamera kurulumu, güvenlik kamerası servisi, alarm sistemi servisi', ', '))

@section('content')
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="wow fadeInUp" data-cursor="-opaque">{{ $service->title }}</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.2s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Servisler</a></li>
                                @if($service->category)
                                    <li class="breadcrumb-item"><a href="{{ route('services.index.category', $service->category->slug) }}">{{ $service->category->name }}</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        @if($service->category)
            <p><a href="{{ route('services.index.category', $service->category->slug) }}" class="badge bg-secondary text-decoration-none">{{ $service->category->name }}</a></p>
        @endif
        @if($service->image_url)
            <figure class="mb-4">
                <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="img-fluid rounded">
            </figure>
        @endif
        @if($service->short_description)
            <p class="lead">{{ $service->short_description }}</p>
        @endif
        @if($service->content)
            <div class="content mb-4">{!! $service->content !!}</div>
        @endif
        <a href="{{ route('contact') }}" class="btn-default">Teklif Al</a>
    </div>
@endsection
