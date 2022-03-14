@extends('layouts.app')

@section('content')

    <div class="container container-center">
        {{ Form::open(['class' => 'form-signin', 'role' => 'form', 'route' => 'admin.auth']) }}

        <h2 class="form-signin-heading">Вход в админ-панель</h2>

        <div class="form-signin-content">

            @if (session('message_error'))
                <div class="message_error mt-0">{{ session('message_error') }}</div>
            @endif

            <div class="form-group">
                {{ Form::input('password', 'password', '', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Пожалуйста, введите пароль:']) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Вход', ['class' => 'btn btn-lg btn-primary']) }}
            </div>

            <small class="admin-copy">админ-панель: <a href="{{ route('main') }}">{{ $_SERVER['SERVER_NAME'] }}</a></small>

        </div>
        {{ Form::close() }}
    </div>

@endsection
