@php
    $image = $product->image_url ?: asset('theme/yalovakamera/images/service-image-1.jpg');
    $badge = $product->stock_badge;
@endphp

<div class="service-item wow fadeInUp h-100">
    <div class="service-image">
        <a href="{{ route('products.show', $product->slug) }}">
            <figure class="image-anime">
                <img
                    src="{{ $image }}"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    decoding="async"
                >
            </figure>
        </a>
        @if($product->is_featured)
            <span class="badge bg-warning text-dark position-absolute m-3">Öne Çıkan</span>
        @endif
    </div>
    <div class="service-content p-3">
        @if($product->category)
            <a href="{{ route('products.category', $product->category->slug) }}" class="badge bg-secondary text-decoration-none mb-2">{{ $product->category->name }}</a>
        @endif
        <h3><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
        @if($product->short_description)
            <p>{{ \Illuminate\Support\Str::limit(strip_tags($product->short_description), 110) }}</p>
        @endif
        <div class="d-flex align-items-center justify-content-between mt-3">
            <div>
                @if($product->final_price)
                    <strong>₺{{ number_format($product->final_price, 2, ',', '.') }}</strong>
                    @if($product->discounted_price && $product->price)
                        <small class="text-muted text-decoration-line-through ms-1">₺{{ number_format((float) $product->price, 2, ',', '.') }}</small>
                    @endif
                @else
                    <strong>Fiyat sorunuz</strong>
                @endif
            </div>
            <span class="badge bg-{{ $badge['class'] }}">{{ $badge['label'] }}</span>
        </div>
        <div class="mt-3">
            <a href="{{ route('products.show', $product->slug) }}" class="btn-default btn-sm">Detay</a>
        </div>
    </div>
</div>

