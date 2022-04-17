
@extends('layouts.app')

@section('sidebar')
    <div class="container">
        <div class="user_cart">
            <div class="avatar">
                @include('layouts.user-avatar')
            </div>
            <div class="login"><a href="#">Войти или зарегистрироваться</a></div>
        </div>
    </div>
    <div class="container hidden">
        <div class="profile-head__title">
            @include('layouts.user-avatar')
        </div>
        <div class="profile-head__menu">
            @if (isset($bc))
                <div class="breadcrumbs">
                    {!! $bc->render() !!}
                </div>
            @endif
        </div>
    </div>
    <div class="container">
    @include('layouts.sidebar')
@endsection
@section('content')
            <div class="summa_cart">
                <h4 class="wash">Ваши пожертвования</h4>
                <p class="summa"><span>0</span> ₽</p>
                <hr>
                <h4 class="ref">Помогли через мои рассылки</h4>
                <p class="summa"><span>0</span> ₽</p>
            </div>
            <div class="green_cart_accaunt"> Помогать благотворительному<br> фонду “Азим”.
                <a class="white_acc_button" href="{{ route('want.help') }}" class="banner__to-help">
                    <img src="/images/site/heart.svg" alt="помочь">
                    <span>Помочь Азиму</span>
                </a>
            </div>
            <div class="info_cart">
                <a href="/programs/" class="accaunt_link program_fond">Программы фонда</a>
                <a href="/pages/kontakty/" class="accaunt_link comment_fond">Связаться с нами</a>
                <a href="/faq/" class="accaunt_link help_fond">Частые вопросы</a>
                <a href="/partners/" class="accaunt_link part_fond">Партнеры</a>
            </div>
             <aside id="content" class="donation__container hidden">
                 <div class="donation__part">
                     <div class="donation__money">
                         <div class="donation__section">
                             <div class="donation__title all">
                                 <img src="/images/site/g-heart.svg" class="heart" alt="heart">
                                 <h4>Мои пожертвования</h4>
                                 <img src="/images/site/expand-arrow.svg" class="expand-arrow" alt="heart">
                             </div>
                             <div class="donation__sum">
                                 {{ $donations }}
                                 <span>₽</span>
                             </div>
                         </div>
                         <div class="donation__section bottom-section">
                             <div class="donation__title">
                                 <img src="/images/site/forward-arrow.svg" class="forward-arrow" alt="forward-arrow">
                                 <h4><a id="clipboard" href="want-help?refferal={{ $donations_code }}">Помогли через мои рассылки</a></h4>
                                 <img src="/images/site/expand-arrow.svg" class="expand-arrow" alt="expand-arrow">
                            </div>
                             <div class="donation__sum">
                                 {{ $donations_ref }}
                                 <span>₽</span>
                             </div>
                         </div>
                     </div>
                 </div>
             </aside>
        </div>
@endsection
