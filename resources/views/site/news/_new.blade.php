<a href="{{ route('news.show', $new->slug) }}" class="article">
    <div class="article__img">
        <img src="{{ $new->mainImage(400) }}" alt="{{ $new->title }}">
    </div>
    <div class="article__title">
        <span>{{ $new->title }}</span>
    </div>
    <div class="article__date">
        <span>{{ Date::parse($new->created_at)->format('j F Y') }}</span>
    </div>
</a>
