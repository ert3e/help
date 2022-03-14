<a href="{{ route('services.show', $service->slug) }}" class="program">
    <img src="{{ $service->mainImage(400) }}" alt="{{ $service->title }}">
    <p class="program__title">{{ $service->title }}</p>
</a>
