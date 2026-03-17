<div class="service-item wow fadeInUp">
    <div class="service-image">
        <a href="{{ route('projects.show', $p->slug) }}">
            <figure class="image-anime">
                <img src="{{ asset('theme/yalovakamera/images/' . ($p->image ?: 'service-image-1.jpg')) }}" alt="{{ $p->title }}">
            </figure>
        </a>
    </div>

    <div class="service-body">

        <div class="service-content">

            @if($p->category)
                <span class="badge bg-secondary mb-1">{{ $p->category->name }}</span>
            @endif

            <h3>
                <a href="{{ route('projects.show', $p->slug) }}">{{ $p->title }}</a>
            </h3>

            <p>{{ \Illuminate\Support\Str::limit($p->description ?? '', 80) }}</p>

        </div>

        <div class="service-btn">
            <a href="{{ route('projects.show', $p->slug) }}" class="readmore-btn">Detay</a>
        </div>

    </div>
</div>
