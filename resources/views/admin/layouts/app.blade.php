<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Админ-панель</title>
    <link href="/css/default/bootstrap.css" rel="stylesheet">
    <link href="{{ mix('css/admin/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.svg" type="image/xml+svg">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>

<div id="app">
@unless(Route::is('admin.auth'))
    @include('layouts.header')
@endunless

@yield('content')

@unless(Route::is('admin.auth'))
    @include('layouts.footer')
@endunless
</div>

<script type="text/javascript" src="/js/admin/app.js"></script>
<script type="text/javascript" src="/js/admin/ckeditor/ckeditor.js"></script>
@yield('footer_js')

</body>
</html>
