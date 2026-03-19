@extends('front.layouts.app')

@section('title', 'Ürünler | Yalova Kamera')
@section('meta_description', 'Kamera sistemleri, kayıt cihazları, güvenlik ekipmanları ve aksesuar ürünleri.')

@php
    \App\Helpers\BreadcrumbHelper::clear();
    \App\Helpers\BreadcrumbHelper::add('Anasayfa', '/');
    \App\Helpers\BreadcrumbHelper::add('Ürünler');
@endphp

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="page-header-box">
                <h1 class="wow fadeInUp">Ürünler</h1>
                {!! \App\Helpers\BreadcrumbHelper::render() !!}
            </div>
        </div>
    </div>

    <div class="our-services">
        <div class="container">
            @if($featuredProducts->isNotEmpty())
                <div class="row mb-4">
                    <div class="col-12">
                        <h3 class="mb-3">Öne Çıkan Ürünler</h3>
                    </div>
                    @foreach($featuredProducts as $product)
                        <div class="col-lg-3 col-md-6 mb-3">
                            @include('front.products.partials.card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            @endif

            @include('front.products.partials.filters', [
                'action' => route('products.index'),
                'categories' => $categories,
                'brands' => $brands,
            ])

            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        @include('front.products.partials.card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4>Sonuç bulunamadı</h4>
                        <p>Arama kriterlerinizi değiştirip tekrar deneyin.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Anasayfa",
      "item": "{{ route('home') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Ürünler",
      "item": "{{ route('products.index') }}"
    }
  ]
}
</script>
@endpush

