@extends('layouts.app')
@section('sidebar')
    @if ($agent->isMobile())
        <div class="container">
            <div class="return">
                <a href="/donation/" class="arrow"></a>
                <span> Вернутся назад</span>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="user_cart">
        <div class="avatar">
            @include('layouts.user-avatar')
        </div>
        <div class="login"><a href="#" onclick="document.getElementById('avatar').click();">Изменить фото профиля</a></div>
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
    <div class="container ">
        @include('layouts.sidebar')
@endsection
@section('content')
     <aside id="content" class="profile__container">
         <div class="dashboard-form__part">
             <div class="update">
                <form class="update__form" action="{{ route('profile.update') }}" method="POST">
                    <div class="update__form-col">
                        <div class="update__form-row">
                            <label for="phone">Ваш номер</label>
                            <input type="text" class="phone-field" id="phone" name="phone" value="{{ auth()->user()->phone }}" placeholder="+7 (988) 445-08-45" disabled>
                        </div>
                        <div class="update__form-row">
                            <label for="name">Ваше имя</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" placeholder="Введите ваше имя">
                        </div>
                        <div class="update__form-row">
                            <label for="gender">Пол</label>
                            <select name="gender" id="gender">
                                <option value="male">Мужской</option>
                                <option value="female">Женский</option>
                            </select>
                        </div>
                    </div>
                    <div class="update__form-col">
                        <div class="update__form-row">
                            <input type="text" id="date" name="data" placeholder="Дата рождения">
                        </div>
                        <div class="update__form-row">
                            <label for="email">Ваша почта</label>
                            <input type="text" name="email" value="{{ auth()->user()->email }}" placeholder="@" id="email">
                        </div>

                        <div class="update__form-row">
                            <label for="city">Ваш город</label>
                            <input type="text" name="address" value="{{ auth()->user()->address }}" placeholder="Введите ваш город" id="city">
                        </div>
                    </div>
                    <div class="update__form-col">
                        <button type="submit" class="update__form-button">Обновить</button>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>
             </div>
         </div>
     </aside>
    </div>
@endsection
