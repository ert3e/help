@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="container">

            <div class="login__container">
                <div class="login-form__part">
                    <div class="login-form__title">Пожалуйста укажите свой телефон </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <input id="telephone" type="phone" class="login-form-footer_input @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="offset">
                                <button type="submit" class="login-form-footer__btn">
                                    <span>Войти</span>
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
