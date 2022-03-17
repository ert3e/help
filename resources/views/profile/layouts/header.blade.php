<header class="header">
    <div class="cap">
        <div class="container">
            <div class="header__left">
                <a href="{{ route('main') }}" class="header__logo">
                    <img src="/images/site/logo.svg" alt="фонд Азим">
                </a>

                <nav class="header-menu">
                    <ul class="header-menu__list">
                        @if ($navMenu = App\Models\NavigationBase::whereAlias('header_menu')->first())
                            @if (count($navMenu->childs) > 0)
                                @foreach($navMenu->childs()->get() as $menuLink)

                                    @if (count($menuLink->childs) > 0)
                                        <li class="header-menu__item header-menu__item-more">
                                            <p><img src="/images/site/3line.svg" alt="icon" class="item-img"> {{ $menuLink->title }}</p>

                                            <div class="header-dropdown" hidden>
                                                <ul>
                                                    @foreach($menuLink->childs as $child)
                                                        <li><a href="{{ $child->url }}">{{ $child->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </li>
                                    @else
                                        <li class="header-menu__item"><a class="{{ $menuLink->class }}" href="{{ $menuLink->url }}">{{ $menuLink->title }}</a></li>
                                    @endif

                                @endforeach
                            @endif
                        @endif

                        <li class="header-menu__item" id="desktop-search-place">
                            {{ Form::open(['route' => 'search', 'class' => 'search-info', 'method' => 'GET', 'id' => 'search-info']) }}
                                <input type="text" class="search-info__input" name="q" autocomplete="off">
                                <span class="search-info__close">
                                    <img src="/images/site/close.svg" alt="закрыть">
                                </span>
                            {{ Form::close() }}
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="header__right">


                <div class="header__right_phones">
                    @if (setting('contacts.telephone'))
                        <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone')) }}" class="header__number">{{ setting('contacts.telephone') }}</a>
                    @endif
                    @if (setting('contacts.telephone_2'))
                        <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone_2')) }}" class="header__number">{{ setting('contacts.telephone_2') }}</a>
                    @endif
                    @if (setting('contacts.telephone_3'))
                        <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone_3')) }}" class="header__number">{{ setting('contacts.telephone_3') }}</a>
                    @endif
                </div>

                <a href="{{ route('want.help') }}" class="header__to-help">
                    <img src="/images/site/heart.svg" alt="heart">
                    <span>Хочу помочь</span>
                </a>
            </div>

            <div class="header-panel">
                <div id="mobile-search-place">
                      {{ Form::open(['route' => 'search', 'class' => 'search-info', 'method' => 'GET', 'id' => 'search-info']) }}
                                <input type="text" class="search-info__input" name="q" autocomplete="off">
                                <span class="search-info__close">
                                    <img src="/images/site/close.svg" alt="закрыть">
                                </span>
                            {{ Form::close() }}
                </div>
                <div class="header-panel__item" id="toggle-menu"><img src="/images/site/3line.svg" alt="toggle"></div>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="global-menu" hidden>
        <div class="container">
            <ul class="global-menu__list">
                @if ($navMenu && count($navMenu->childs) > 0)
                    @foreach($navMenu->childs()->get() as $menuLink)

                        @if (count($menuLink->childs) > 0)
                            <li class="global-menu__item">
                                <a class="{{ $menuLink->class }}" href="{{ $menuLink->url }}">{{ $menuLink->title }}</a>
                            </li>
                            @foreach($menuLink->childs as $child)
                                <li class="global-menu__item">
                                    <a href="{{ $child->url }}">{{ $child->title }}</a>
                                </li>
                            @endforeach
                        @else
                            <li class="global-menu__item">
                                <a class="{{ $menuLink->class }}" href="{{ $menuLink->url }}">{{ $menuLink->title }}</a>
                            </li>
                        @endif

                    @endforeach
                @endif
            </ul>

            @if (setting('contacts.telephone'))
                <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone')) }}" class="global-menu__number">{{ setting('contacts.telephone') }}</a>
            @endif

            <a href="{{ route('want.help') }}" class="global-menu__to-help">
                <img src="/images/site/heart.svg" alt="heart">
                <span>Хочу помочь</span>
            </a>
        </div>
    </div>
</header>

@if (session('message_success'))
    <div class="cw" id="message-success">{!! session('message_success') !!}</div>
@endif

@if ((isset($errors) && count($errors) > 0) || session('message_error'))
    <div class="attention-container">
        <div class="cw">
            @if (session('message_error'))
                <p>{!! session('message_error') !!}</p>
            @endif
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

@if (isset($bc) && Route::currentRouteName() != 'main')
    <div class="container">
        <div class="breadcrumbs">
            {!! $bc->render() !!}
        </div>
    </div>
@endif
