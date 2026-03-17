@extends('front.layouts.app')

@section('title', isset($category) ? (($category->meta_title ?? $category->name) . ' | Yalova Kamera Blog') : 'Yalova Kamera Kurulumu Blog | Güvenlik Sistemi İpuçları')
@section('meta_description', isset($category) ? ($category->meta_description ?? $category->description ?? 'Yalova kamera kurulumu blog kategorisi.') : 'Yalova kamera kurulumu, güvenlik sistemi ipuçları ve CCTV rehberleri. Profesyonel kamera montajı, alarm sistemi kurulumu hakkında detaylı bilgiler.')
@section('meta_keywords', isset($category) ? ($category->meta_keywords ?? 'yalova kamera kurulumu, blog, ' . ($category->name ?? '')) : 'yalova kamera kurulumu, güvenlik kamerası kurulumu, CCTV montajı, alarm sistemi, güvenlik ipuçları')

@php
    \App\Helpers\BreadcrumbHelper::clear();
    \App\Helpers\BreadcrumbHelper::add('Anasayfa', '/');
    \App\Helpers\BreadcrumbHelper::add('Blog');
@endphp

@section('content')
    @php $categories = $categories ?? collect(); @endphp

    <div class="page-header">
        <div class="container">
            <div class="page-header-box">
                <h1 class="wow fadeInUp">Blog</h1>
                                {!! \App\Helpers\BreadcrumbHelper::render() !!}
                @if($categories->isNotEmpty())
                    <nav class="mt-3">
                        <a href="{{ route('blog.index') }}" class="btn-default btn-sm {{ !isset($category) ? 'active' : '' }}">Tümü</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('blog.index.category', $cat->slug) }}" class="btn-default btn-sm {{ (isset($category) && $category->id === $cat->id) ? 'active' : '' }}">{{ $cat->name }}</a>
                        @endforeach
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <div class="our-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Blog</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s">
                            @if(isset($category))
                                <span>{{ $category->name }}</span> kategorisi
                            @elseif($posts->isNotEmpty())
                                <span>İpuçları ve</span> rehber içerikler
                            @else
                                Yakında içerikler eklenecek
                            @endif
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
            @forelse($posts as $i => $post)
    <div class="col-lg-4 col-md-6">
        @include('front.partials.cards.blog-card', ['post' => $post, 'i' => $i])
    </div>
             @empty
    <div class="col-12 text-center py-5">
        <p>Henüz blog yazısı eklenmemiş.</p>
    </div>
            @endforelse
            </div>
        </div>
    </div>
@endsection
