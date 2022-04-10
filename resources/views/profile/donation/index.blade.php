
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
     <aside id="content" class="donation__container">
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
                         <h4>Помогли через мои рассылки</h4>
                         <img src="/images/site/expand-arrow.svg" class="expand-arrow" alt="expand-arrow">
                    </div>
                     <div class="donation__sum">
                         {{ $donations_href }}
                         <span>₽</span>
                     </div>
                 </div>
             </div>
         </div>
     </aside>
    </div>
@endsection
