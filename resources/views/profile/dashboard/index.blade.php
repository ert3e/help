
@extends('layouts.app')

@section('sidebar')
    <div class="container">
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
     <aside id="content" class="profile__container">
         <div class="dashboard-form__part">
             <div class="update">
                <form class="update__form">
                    <div class="update__form-col">
                        <div class="update__form-row">
                            <label for="phone">Ваш номер</label>
                            <input type="text" class="phone-field" id="phone" value="{{ auth()->user()->phone }}" placeholder="+7 (988) 445-08-45">
                        </div>
                        <div class="update__form-row">
                            <label for="name">Ваше имя</label>
                            <input type="text" id="name" value="{{ auth()->user()->name }}" placeholder="Введите ваше имя">
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
                            <input type="text" id="date" placeholder="Дата рождения">
                        </div>
                        <div class="update__form-row">
                            <label for="email">Ваша почта</label>
                            <input type="email" value="{{ auth()->user()->email }}" placeholder="@" id="email">
                        </div>

                        <div class="update__form-row">
                            <label for="city">Ваш город</label>
                            <input type="text" value="{{ auth()->user()->address }}" placeholder="Введите ваш город" id="city">
                        </div>
                    </div>
                </form>
             </div>
         </div>
     </aside>
    </div>
@endsection
