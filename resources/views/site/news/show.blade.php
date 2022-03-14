@extends('layouts.app')

@include('templates.seo.meta', ['object' => $model])

@section('content')


    <div class="article-pg ">
        <div class="container news_m">

            <div class="my-grid article-pg__content">
                <div class="my-grid-left">

                    <h1 class="page-title">@include('templates.seo.title', ['object' => $model])</h1>

                    <div class="my-grid-row">
                        <p class="article-pg__about">{{ Date::parse($model->created_at)->format('j F Y') }}, Источник: Азим</p>
                    </div>

                    <div class="my-grid-row article-pg__main-photo">
                        <div class="my-grid__photo">
                            <img src="{{ $model->mainImage(1000) }}" alt="image">
                        </div>
                    </div>

                    <div class="article-pg__content-description default-description">
                        {!! StringManager::formattedVideos($model->description) !!}
                    </div>

                    {{--<div class="my-grid-row">
                        <p class="txt">При рождении врачи обнаружили, что у мальчика правая нога короче левой. О полноценной ходьбе и тем более беге не могло быть и речи. Мама старается помочь сыну и самостоятельно делает массаж ног, чтобы хоть немного развивать конечности. Но только операция способна излечить такое значительное отклонение. Гедонизм осмысляет дедуктивный метод.<br><br>Фонд «Азим» не остался равнодушным к истории маленького Кирилла и открывает сбор средств на сумму, которые необходимы для первой операции. Всего же необходимо будет провести три операции, чтобы выровнять обе ноги. Первую операцию планируют провести в городе Курган.</p>
                    </div>

                    <div class="my-grid-row">
                        <h2>Надстройка нетривиальна</h2>
                        <p class="txt">Гедонизм осмысляет дедуктивный метод. Отсюда естественно следует, что автоматизация дискредитирует предмет деятельности. Интеллект естественно понимает под собой интеллигибельный закон внешнего мира, открывая новые горизонты. Аксиома силлогизма, по определению, представляет собой неоднозначный предмет деятельности. Всего же необходимо будет провести три операции, чтобы выровнять обе ноги. Первую операцию планируют провести в городе Курган.<br><br>При рождении врачи обнаружили, что у мальчика правая нога короче левой. О полноценной ходьбе и тем более беге не могло быть и речи. Мама старается помочь сыну и самостоятельно делает массаж ног, чтобы хоть немного развивать конечности. Но только операция способна излечить такое значительное отклонение. Гедонизм осмысляет дедуктивный метод.<br><br>Фонд «Азим» не остался равнодушным к истории маленького Кирилла и открывает сбор средств на сумму, которые необходимы для первой операции. Всего же необходимо будет провести три операции, чтобы выровнять обе ноги. Первую операцию планируют провести в городе Курган.</p>
                    </div>--}}
                </div>

                @if (count($similar) > 0)
                <div data-desktop="1">
                    <div class="my-grid-right" data-portable>
                        <div class="my-grid-row">
                            <a href="{{ route('news') }}" class="article-pg__other-title">Еще статьи и новости</a>
                        </div>
                        <div class="article-pg__articles-list default-slider" id="article-pg-slider">
                            @foreach($similar as $new)
                                @include('_new')
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <div class="line desktop-hidden"></div>
        <div class="article-pg-slider-wrap" data-mobile="1"></div>
    </div>


@endsection

@section('footer_js')

@endsection
