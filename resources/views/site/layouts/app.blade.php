<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title', setting('main.meta_title'))</title>
    <meta name="description" content="@yield('meta_description', setting('main.meta_description'))">
    <meta name="keywords" content="@yield('meta_keywords', setting('main.meta_keywords'))">
    @include('templates.seo.og')
    <meta name="apple-mobile-web-app-title" content="{{ setting('main.meta_title') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="/favicon.svg" type="image/xml+svg">
    @include('templates.seo.touchIcons')
    <link rel="stylesheet" href="{{ mix('css/site/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    {!! setting('main.header_js') !!}
</head>


<body {{ Route::currentRouteName() != 'main' ? 'class=pages' : 'id=index-page' }}>

<div id="app" class="page">
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
</div>



@if (trim($__env->yieldContent('modals')))
<div class="modal-window-layout">
    @yield('modals')
</div>
@endif


<div class="js">

<script src="/js/site/vendor.min.js"></script>
<script src="/js/site/app.js"></script>


@yield('footer_js')
{!! setting('main.footer_js') !!}
@include('templates.seo.microdata.Organization')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
$('.uved').click(function() { // Вызываем функцию по нажатию на кнопку

    $('#zaglush_uved').addClass('shows');  
})
$('#zaglush_uved').click(function() { // Обрабатываем клик по заднему фону
      $('#zaglush_uved').addClass('nones'); // Скрываем затемнённый задний фон и основное всплывающее окно
})

</script>

      <script type="text/javascript">
    if ( $.cookie('name') == null ) {
 
}
else {
   var ss = document.createElement("link");
            ss.rel = "stylesheet";
            ss.href = "/css/site/style_app.css";
            ss.type = "text/css";
            ss.media = "all";
            document.getElementsByTagName("head")[0].appendChild(ss);

         
};

    if ( $.cookie('name') == null ) {
 
}
else {

   $(".header__logo").attr("href", "/webapp/")
};

if ($(".news_m").length){
  // делаем здесь что-то 
$('.news_link').addClass('no_filter');  

}

if ($(".picking_m").length){
  // делаем здесь что-то 
$('.sbor').addClass('no_filter');  

}



  </script>


</div>
  <script>
    class ItcTabs {
      constructor(target, config) {
        const defaultConfig = {};
        this._config = Object.assign(defaultConfig, config);
        this._elTabs = typeof target === 'string' ? document.querySelector(target) : target;
        this._elButtons = this._elTabs.querySelectorAll('.tabs__btn');
        this._elPanes = this._elTabs.querySelectorAll('.tabs__pane');
        this._eventShow = new Event('tab.itc.change');
        this._init();
        this._events();
      }
      _init() {
        this._elTabs.setAttribute('role', 'tablist');
        this._elButtons.forEach((el, index) => {
          el.dataset.index = index;
          el.setAttribute('role', 'tab');
          this._elPanes[index].setAttribute('role', 'tabpanel');
        });
      }
      show(elLinkTarget) {
        const elPaneTarget = this._elPanes[elLinkTarget.dataset.index];
        const elLinkActive = this._elTabs.querySelector('.tabs__btn_active');
        const elPaneShow = this._elTabs.querySelector('.tabs__pane_show');
        if (elLinkTarget === elLinkActive) {
          return;
        }
        elLinkActive ? elLinkActive.classList.remove('tabs__btn_active') : null;
        elPaneShow ? elPaneShow.classList.remove('tabs__pane_show') : null;
        elLinkTarget.classList.add('tabs__btn_active');
        elPaneTarget.classList.add('tabs__pane_show');
        this._elTabs.dispatchEvent(this._eventShow);
        elLinkTarget.focus();
      }
      showByIndex(index) {
        const elLinkTarget = this._elButtons[index];
        elLinkTarget ? this.show(elLinkTarget) : null;
      };
      _events() {
        this._elTabs.addEventListener('click', (e) => {
          const target = e.target.closest('.tabs__btn');
          if (target) {
            e.preventDefault();
            this.show(target);
          }
        });
      }
    }

    const elTab = document.querySelector('.tabs');
    // инициализация elTab как табы
    const tab = new ItcTabs(elTab);

    const index = localStorage.getItem('tabs-index');
    index > -1 ? tab.showByIndex(index) : null;

    elTab.addEventListener('tab.itc.change', (e) => {
      const index = elTab.querySelector('.tabs__btn_active').dataset.index;
      localStorage.setItem('tabs-index', index);
    });
  </script>


</body>
</html>
