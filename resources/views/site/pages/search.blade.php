@extends('layouts.app')

@include('templates.seo.meta', ['object' => $moduleSettings])

@section('content')

    <div class="search-result">
        <div class="container">

            <p class="page-title">Результаты поиска</p>

            <div class="my-grid">
                <div class="my-grid-left">

                    @if (array_sum([count($pickings), count($news), count($services)]) === 0)
                        <p class="search-result__warn">К сожалению, по вашему запросу ничего не найдено...</p>
                        <a href="{{ route('main') }}" class="search-result__exit">Вернуться на главную</a>
                    @endif

                    @if (count($pickings) > 0)
                    <div class="search-section">
                        <p class="search-section__title">Список нуждающихся</p>
                        <div class="search-section__list">
                            @foreach($pickings as $picking)
                            <a href="{{ route('catalog', $picking->path) }}" class="search-section-item">
                                <div>
                                    <div class="search-section-item__photo">
                                        <img src="{{ $picking->mainImage(400) }}">
                                    </div>
                                </div>
                                <div class="search-section-item__info">
                                    <p class="search-section-item__title">{{ $picking->title }}</p>
                                    <p class="search-section-item__desc">{!! output($picking->description, 120) !!}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if (count($news) > 0)
                        <div class="search-section">
                            <p class="search-section__title">Статьи и новости</p>
                            <div class="search-section__list">
                                @foreach($news as $new)
                                <a href="{{ route('news.show', $new->slug) }}" class="search-section-item">
                                    <div>
                                        <div class="search-section-item__photo">
                                            <img src="{{ $new->mainImage(400) }}">
                                        </div>
                                    </div>
                                    <div class="search-section-item__info">
                                        <p class="search-section-item__title">{{ $new->title }}</p>
                                        <p class="search-section-item__desc">{{ Date::parse($new->created_at)->format('j F Y') }}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                        @if (count($services) > 0)
                            <div class="search-section">
                                <p class="search-section__title">Программы фонда</p>
                                <div class="search-section__list">
                                    @foreach($services as $service)
                                        <a href="{{ route('services.show', $service->slug) }}" class="search-section-item">
                                            <div>
                                                <div class="search-section-item__photo">
                                                    <img src="{{ $service->mainImage(400) }}">
                                                </div>
                                            </div>
                                            <div class="search-section-item__info">
                                                <p class="search-section-item__title">{{ $service->title }}</p>
                                                <p class="search-section-item__desc">{!! output($service->description, 120) !!}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                </div>
            </div>

        </div>
    </div>

@endsection
