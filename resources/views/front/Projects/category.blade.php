@extends('front.layouts.app')

@section('title', isset($category) ? $category->name . ' | Proje Kategorisi' : 'Proje Kategorisi')
@section('meta_description', isset($category) && !empty($category->seo_description) ? $category->seo_description : 'Proje kategori içerikleri')

@php
    \App\Helpers\BreadcrumbHelper::clear();
    \App\Helpers\BreadcrumbHelper::add('Anasayfa', '/');
    \App\Helpers\BreadcrumbHelper::add('Projeler', route('projects.index'));
    \App\Helpers\BreadcrumbHelper::add($category->name ?? 'Kategori');
@endphp

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="page-header-box">
                <h1 class="wow fadeInUp">{{ $category->name ?? 'Kategori' }}</h1>
                {!! \App\Helpers\BreadcrumbHelper::render() !!}
            </div>
        </div>
    </div>

    <div class="our-services">
        <div class="container">
            <div class="row">
                @forelse($projects ?? [] as $i => $p)
                    <div class="col-lg-4 col-md-6">
                        @include('front.partials.cards.project-card', ['p' => $p, 'i' => $i])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p>Bu kategoride henüz proje bulunmuyor.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection