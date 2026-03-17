<div class="service-item wow fadeInUp">
    <div class="service-image">
        <a href="{{ route('services.show', $s->slug) }}">
            <figure class="image-anime">
                <img src="{{ asset('theme/yalovakamera/images/' . ($s->image ?: 'service-image-1.jpg')) }}" alt="{{ $s->title }}">
            </figure>
        </a>
    </div>

    <div class="service-body">
        <div class="service-content">

            @if($s->category)
                <span class="badge bg-secondary mb-1">{{ $s->category->name }}</span>
            @endif

            <h3>
                <a href="{{ route('services.show', $s->slug) }}">{{ $s->title }}</a>
            </h3>

            <p>{{ $s->short_description }}</p>

        </div>

        <div class="service-btn">
            <a href="{{ route('services.show', $s->slug) }}" class="readmore-btn">Detay</a>
        </div>
    </div>
</div>
