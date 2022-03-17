<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title', setting('main.meta_title'))</title>
    <meta name="description" content="@yield('meta_description', setting('main.meta_description'))">
    <meta name="keywords" content="@yield('meta_keywords', setting('main.meta_keywords'))">

    <meta name="apple-mobile-web-app-title" content="{{ setting('main.meta_title') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="/favicon.svg" type="image/xml+svg">

    <link rel="stylesheet" href="{{ mix('css/site/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    {!! setting('main.header_js') !!}
</head>


<body {{ Route::currentRouteName() != 'main' ? 'class=pages' : 'id=index-page' }}>

<div id="app" class="page">
    @include('layouts.header'){{--
    @include('layouts.sidebar')--}}
    @yield('content')

    @include('layouts.footer')
</div>





<div class="app_menu">
    <a href="/webapp/" class="sbor">Сборы</a>
    <a href="/news/" class="news_link">Новости</a>
    <a href="#" class="uved">Уведомления</a>
    <a href="/accaunt/" class="user">Профиль</a>
</div>


<div class="js">

<script src="/js/site/vendor.min.js"></script>
<script src="/js/site/app.js"></script>


@yield('footer_js')
{!! setting('main.footer_js') !!}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




</div>

</body>
</html>
