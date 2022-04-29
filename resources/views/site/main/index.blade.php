@extends('layouts.app')

@section('content')
    @if ($agent->isMobile())
        <div class="webapp">
            <div class="tabs">
                <div class="tabs__nav">
                    <button class="tabs__btn tabs__btn_active">Активные сборы</button>
                    <button class="tabs__btn">Завершенные сборы</button>
                </div>
                <div class="tabs__content">
                    <div class="tabs__pane tabs__pane_show">
                        @if (count($pickings) > 0 && $category = Category::find(Category::TYPE_NEEDHELP))
                            <section class="poor">
                                <div class="poor-slider">
                                    @foreach($pickings as $picking)
                                        <div class="poor-slider__slide">
                                            @include('catalog._picking')
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    </div>
                    <div class="tabs__pane">
                        @if (count($pickingsCompleted) && $category = Category::find(Category::TYPE_HELPED))
                            <section class="poor">
                                <div class="poor-slider">
                                    @foreach($pickingsCompleted as $picking)
                                        <div class="poor-slider__slide">
                                            @include('catalog._picking')
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="home">
            <section class="preview">
                <div class="container">

                    <div class="preview__top-wrapper">
                        <div class="preview__left">
                            <!--                        <h1 class="preview__title">
                            {{ setting('main.meta_h1') }}
                            </h1>-->

                            <img src="/images/site/logo.svg" alt="">
                        </div>

                        <div class="preview__right">
                            <div class="preview-indicators">
                                <div class="preview-indicator preview-indicator-alltime">
                                    <div class="preview-indicator__sum">
                                        @if (setting('statistic.donation_all'))
                                            {{ formattedPrice(setting('statistic.donation_all')) }}
                                        @else
                                            {{ formattedPrice(Payment::wherePaid(true)->sum('amount')) }}
                                        @endif
                                    </div>
                                    <div class="preview-indicator__label">собрано за все время</div>
                                </div>
                                <div class="preview-indicator">
                                    <div class="preview-indicator__sum">
                                        @if (setting('statistic.donation_year'))
                                            {{ formattedPrice(setting('statistic.donation_year')) }}
                                        @else
                                            {{ formattedPrice(Payment::wherePaid(true)->whereBetween('created_at', [Carbon::createFromDate('01.01.'.date('Y')), Carbon::createFromDate('31.12.'.date('Y'))])->sum('amount')) }}
                                        @endif
                                    </div>
                                    <div class="preview-indicator__label">собрано в {{ date('Y') }} году</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="preview__buttons">
                        <div class="preview__buttons-donation">
                            <a href="{{ route('want.help') }}" class="preview__to-help">
                                <img src="/images/site/heart.svg" alt="heart">
                                <span>Сделать пожертвование</span>
                            </a>
                            <div class="preview__smileys">
                                <div class="preview__smile"><img src="/images/site/smile1.png" alt="smile"></div>
                                <div class="preview__smile"><img src="/images/site/smile2.png" alt="smile"></div>
                                <div class="preview__smile"><img src="/images/site/smile3.png" alt="smile"></div>
                            </div>
                        </div>

                        <div class="preview__buttons-reports">
                            <a href="{{ route('informations') }}" class="preview__report">
                                <span>Подробный отчет</span>
                                <img src="/images/site/b-circle-arrow.svg" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            @if (count($news) > 0)
                <section class="articles">
                    <div class="container">
                        <a href="{{ route('news') }}" class="articles__title">{{ setting('news.meta_h1') }}</a>
                        <div class="articles__list default-slider" id="articles-slider">
                            @foreach($news as $new)
                                <div class="articles-slider__slide">
                                    @include('news._new')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if (count($pickings) > 0 && $category = Category::find(Category::TYPE_NEEDHELP))
                <section class="poor">
                    <div class="container">
                        <a href="{{ route('catalog', $category->path) }}" class="poor__title">{{ $category->title }}</a>
                        <div class="poor-slider">
                            @foreach($pickings as $picking)
                                <div class="poor-slider__slide">
                                    @include('catalog._picking')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif


            @if (count($services) > 0)
                <section class="programs">
                    <div class="container">
                        <a href="{{ route('services') }}" class="programs__title">{{ setting('services.meta_h1') }}</a>

                        <div class="programs-slider">
                            @foreach($services as $service)
                                <div class="programs-slider__slide">
                                    @include('services._service', ['serviceSlider' => true])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <section class="appeal">
                <div class="container">
                    <div class="appeal__content">
                        <div class="appeal__for-mobile">
                            <p class="appeal__title">Сделай благотворительность образом&nbsp;жизни!</p>
                            <p class="appeal__subtitle">Участвуй в благом вместе с нами</p>
                            <div class="appeal__btns">
                                <a href="{{ route('want.help') }}" class="appeal__to-help">
                                    <img src="/images/site/g-heart.svg" alt="heart">
                                    <span>Сделать пожертвование</span>
                                </a>
                                <a href="{{ route('want.help') }}" class="appeal__volunteer">
                                    <span>Стать волонтером</span>
                                    <img src="/images/site/b-circle-arrow.svg" alt="icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if (count($pickingsCompleted) && $category = Category::find(Category::TYPE_HELPED))
                <section class="portfolio">
                    <div class="container">
                        <a href="{{ route('catalog', $category->path) }}" class="portfolio__title">{{ $category->title }}</a>

                        <div class="portfolio-slider">

                            @foreach($pickingsCompleted as $picking)
                                <div class="portfolio-slider__slide">
                                    @include('catalog._picking')
                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>
            @endif

        </div>
    @endif
@endsection

@section('footer_js')
    @if (!$agent->isMobile())
        <script>
            $('.poor-slider').slick({
                slidesToShow: 1,
                touchThreshold: 20,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            variableWidth: true,
                            infinite: true,
                            arrows: false,
                        }
                    },
                ]
            });
        </script>
    @endif
        <script>
        $('.programs-slider').slick({
            slidesToShow: 3,
            touchThreshold: 20,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        variableWidth: true,
                        infinite: true,
                        arrows: false,
                    }
                },
            ]
        });

        $('.portfolio-slider').slick({
            slidesToShow: 2,
            touchThreshold: 20,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        variableWidth: true,
                        infinite: true,
                        arrows: false,
                    }
                },
            ]
        });
    </script>
@endsection
