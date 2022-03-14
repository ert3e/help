<a {{ $partner->url ? 'href=' . $partner->url : '' }} class="partners__item" rel="nofollow" title="{{ $partner->title }}">
    <img src="{{ $partner->resize($partner->mainImage(), 200) }}" alt="{{ $partner->title }}">
</a>
