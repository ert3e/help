@extends('layouts.app')

@include('templates.seo.meta', ['object' => $picking])

@section('content')

    <div class="pauper-person picking_m">
        <div class="container">

            <h1 class="page-title">@include('templates.seo.title', ['object' => $picking])</h1>

            <div class="my-grid">
                <div class="my-grid-left">
                    <div class="my-grid-row">
                        <div class="my-grid__photo">
                            <img src="{{ $picking->mainImage(1000) }}" alt="person" style="top: 0; transform: translate(-50%, 0);">
                        </div>
                        <div data-mobile="1"></div>
                    </div>

                    <div class="default-description">
                        {!! StringManager::formattedVideos($picking->description) !!}
                    </div>

                </div>

                <div class="my-grid-right">

                    <div data-desktop="1">
                        <div class="banner" data-portable>
                            <div class="banner__label"><span>Сбор на:</span></div>
                            <p class="banner__title">{{ $picking->attribute('picking_to')->value ?? '-' }}</p>

                            <div class="banner-statistics">
                                @if ($picking->paymentsPaid->sum('amount') < $picking->price && $picking->category_id == Category::TYPE_NEEDHELP)
                                <div class="banner__need banner-statistics-item">
                                    <p class="banner-statistics-item__label">Нужно</p>
                                    <p class="banner-statistics-item__sum">{{ $picking->formattedPrice() }}</p>
                                </div>
                                @endif
                                <div class="banner__collected banner-statistics-item">
                                    <p class="banner-statistics-item__label">Собрали</p>
                                    
                                    @if ($picking->paymentsPaid->sum('amount') == 0 && $picking->category_id == Category::TYPE_HELPED)
                                        <p class="banner-statistics-item__sum">{{ formattedPrice($picking->price) }}</p>
                                    @else
                                        <p class="banner-statistics-item__sum">{{ formattedPrice($picking->paymentsPaid->sum('amount')) }}</p>
                                    @endif
                                    
                                </div>
                            </div>

                            <div class="banner__btns">
                                @if ($picking->paymentsPaid->sum('amount') < $picking->price && $picking->category_id == Category::TYPE_NEEDHELP)
                                    <a href="{{ route('want.help', ['picking' => $picking->id]) }}" class="banner__to-help">
                                        <img src="/images/site/heart.svg" alt="помочь">
                                        <span>Помочь</span>
                                    </a>
                                @else
                                    <button class="banner__okey">
                                        <img src="/images/site/check-circle.svg" alt="завершено">
                                        <span>Сбор завершен</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($picking->paymentsPaid->sum('amount') < $picking->price && $picking->category_id == Category::TYPE_NEEDHELP)

                        <div class="requisites">
                            <div class="requisites__wrap">
                                <p class="requisites__title">Реквизиты для помощи:</p>
                            </div>
                            @if ($attrSms = $picking->attribute('sms'))
                            <div class="requisites__wrap">
                                <div class="requisites__wrap-key">
                                    <p>СМС</p>
                                </div>
                                <div class="requisites__wrap-val">
                                    <p>{{ $attrSms->value }}</p>
                                </div>
                            </div>
                            @endif


                            <div class="requisites__wrap">
                                <div class="requisites__wrap-key">
                                    <p>Карта Сбербанк</p>
                                </div>
                                <div class="requisites__wrap-val">
                                    @if ($attrSbCard = $picking->attribute('sberbank_card'))
                                    <div class="req-block">
                                        <p>{{ $attrSbCard->value }}</p>
                                        <small>{{ $picking->attribute('sberbank_card_info')->value ?? '' }}</small>
                                    </div>
                                    @endif

                                    @if ($attrSbPhone = $picking->attribute('sberbank_phone'))
                                        <div class="req-block">
                                            <p>{{ $attrSbPhone->value }}</p>
                                            <small>{{ $picking->attribute('sberbank_phone_info')->value ?? '' }}</small>
                                        </div>
                                    @endif

                                </div>
                            </div>


                            @if ($attrVtbCard = $picking->attribute('vtb_card'))
                                <div class="requisites__wrap">
                                    <div class="requisites__wrap-key">
                                        <p>Карта ВТБ</p>
                                    </div>
                                    <div class="requisites__wrap-val">
                                        <div class="req-block">
                                            <p>{{ $attrVtbCard->value }}</p>
                                            <small>{{ $picking->attribute('vtb_card_info')->value ?? '' }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($attrQiwi = $picking->attribute('qiwi'))
                                <div class="requisites__wrap">
                                    <div class="requisites__wrap-key">
                                        <p>Киви-кошелёк</p>
                                    </div>
                                    <div class="requisites__wrap-val">
                                        <p>{{ $attrQiwi->value }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($attrYandexMoney = $picking->attribute('yandex_money'))
                                <div class="requisites__wrap">
                                    <div class="requisites__wrap-key">
                                        <p>Яндекс-деньги</p>
                                    </div>
                                    <div class="requisites__wrap-val">
                                        <p>{{ $attrYandexMoney->value }}</p>
                                    </div>
                                </div>
                            @endif


                            @if ($picking->attribute('beeline') || $picking->attribute('megafon') || $picking->attribute('mts'))
                            <div class="requisites__wrap mobile-operator">

                                @if ($picking->attribute('beeline'))
                                <div class="requisites__wrap-key-operator">
                                    <p>Билайн</p>
                                    <span>{{ $picking->attribute('beeline')->value ?? '-' }}</span>
                                </div>
                                @endif

                                @if ($picking->attribute('megafon'))
                                <div class="requisites__wrap-key-operator">
                                    <p>Мегафон</p>
                                    <span>{{ $picking->attribute('megafon')->value ?? '-' }}</span>
                                </div>
                                @endif

                                @if ($picking->attribute('mts'))
                                <div class="requisites__wrap-key-operator">
                                    <p>МТС</p>
                                    <span>{{ $picking->attribute('mts')->value ?? '-' }}</span>
                                </div>
                                @endif
                            </div>
                            @endif


                        </div>
                    @endif
                </div>
            </div>
        </div>


        @if (count($similar) > 0 && $category = Category::find(1))
            <div class="pauper-person__line"></div>

            <div class="pauper-person__poor">
                <div class="container pauper-person-container">
                    <a href="{{ route('catalog', $category->path) }}" class="pauper-person__title">{{ $category->title }}</a>

                    <div class="poor-slider">
                        @foreach($similar as $picking)
                            <div class="poor-slider__slide">
                                @include('catalog._picking')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


    </div>

@endsection

@section('footer_js')
    <script>
        @if (count($similar) > 0)
            $('.poor-slider').slick({
                slidesToShow: 2,
                infinite: true,
                slidesToScroll: 1,
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
        @endif
    </script>
@endsection
