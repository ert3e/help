@extends('layouts.app')

@section('content')
    <div class="login">
        @if ($agent->isMobile())
            <div class="container">
                <div class="return">
                    <a href="/donation/" class="arrow"></a>
                    <span> Вернутся назад</span>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="login__container">
                <div class="login-form__part">
                    <div class="login-form__title">Пожалуйста укажите свой телефон </div>
                    <livewire:phone-verification
                            :stopEvents="true"
                            :customRedirectTo="'/profile'"
                            :emptyCustomFields="false"
                            :customParams="['btn' => 'Login', 'title' => 'Login']"
                            :formWrap="true"
                            :loginAndRegister="true"
                    />
                </div>
            </div>
        </div>
    </div>

@endsection
