@extends('layouts.app')

@include('templates.seo.meta', ['object' => $model])

@section('content')

    <div class="program-pg">
        <div class="container">

            <h1 class="page-title">@include('templates.seo.title', ['object' => $model])</h1>

            <div class="my-grid">

                <div class="my-grid-left">
                    <div class="program-pg-info">


                        <div class="my-grid-row program-pg-info__video">
                            <div class="my-grid__photo">
                                <img src="{{ $model->mainImage(1000) }}" alt="{{ $model->title }}">
                            </div>
                            <div data-mobile="1"></div>
                        </div>

                        <div class="default-description">
                            {!! StringManager::formattedVideos($model->description) !!}
                        </div>

                        <div data-desktop="2">
                            <div class="my-grid-row" data-portable>
                                <div class="program-pg-info-banner">
                                    <div class="program-pg-info-banner__wrapper">
                                        <p class="program-pg-info-banner__title">Пожертвовать деньги на программу:</p>
                                        <a href="{{ route('want.help', ['program' => $model->id]) }}" class="program-pg-info-banner__btn">
                                            <img src="/images/site/g-heart.svg" alt="heart">
                                            <span>Сделать пожертвование</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="my-grid-right">

                    <div data-desktop="1">
                        <div class="program-pg-banner" data-portable>
                            <p class="program-pg-banner__title">Сбор на программу</p>
                            <div class="program-pg-banner__btns">
                                <a href="{{ route('want.help', ['program' => $model->id]) }}" class="program-pg-banner__btn program-pg-banner__help">
                                    <img src="/images/site/heart.svg" alt="heart">
                                    <span>Сделать пожертвование</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if (count($similar) > 0)
                    <div data-desktop="3">
                        <div class="program-pg-other" data-portable>
                            <a href="{{ route('services') }}" class="program-pg-other__title">Другие программы</a>

                            <div class="program-pg-other__list default-slider">
                                @foreach($similar as $service)
                                    <div class="programs-slider__slide">
                                    @include('_service')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <div data-mobile="2"></div>
        <div data-mobile="3"></div>
    </div>

@endsection
