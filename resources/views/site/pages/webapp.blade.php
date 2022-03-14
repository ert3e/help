  <div class="preloader" 
  style=" position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      display: block;
      background: #fff;
    z-index: 99999999;">
    <div class="preloader__row" style="    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;">
<img src="/images/site/logo.svg" alt="фонд Азим" width="70%">
    </div>
  </div>
@extends('layouts.app')
@section('content')


<div class="webapp">
  <div class="tabs">
    <div class="tabs__nav"> 
      <button class="tabs__btn tabs__btn_active">Активные сборы</button>
      <button class="tabs__btn">Завершенные сборы</button>
    </div>
    <div class="tabs__content">
      <div class="tabs__pane tabs__pane_show">
                 @if (count($pickings) > 0 && $category = Category::find(Category::TYPE_NEEDHELP))
        <section class="poor">
            <div class="container">
                      <div class="poor-slider">
                    @foreach($pickings as $picking)
                        <div class="poor-slider__slide">
                            @include('catalog._picking')
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
      </div>
      <div class="tabs__pane">
              @if (count($pickingsCompleted) && $category = Category::find(Category::TYPE_HELPED))
    
        <section class="poor">
            <div class="container">
                              <div class="poor-slider">
                 @foreach($pickingsCompleted as $picking)
                        <div class="poor-slider__slide">
                            @include('catalog._picking')
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
      </div>
    </div>


</div>



</div>



@endsection

@section('footer_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$.cookie('name', 'value'); 
</script> 

<script type="text/javascript">
const square = document.querySelector('.sbor');
square.style.filter = 'none';
</script>

<script type="text/javascript">
    window.onload = function () {
      window.setTimeout(function () {
        document.body.classList.add('loaded');
        document.body.classList.remove('loaded_hiding');
      }, 800);
    }
  </script>
@endsection

