<?php
$route = Route::current();

$uri = $route->uri;
?>
<aside id="profile_menu" class="profile__menu">
    <div class="profile__menu_devider">
        <div class="profile__menu_username">
            <span>
                Ваше имя
            </span>
        </div>
    </div>

    <ul class="profile__menu_list">
        <li @if($uri == "profile") class="active" @endif>
            <a href="{{ route('profile.main') }}">
                <span>Данные</span>
                <span @if($uri == "profile") class="active" @endif></span>
            </a>
        </li>
        <li @if($uri == "donation") class="active" @endif>
            <a href="{{ route('donation.main') }}">
                <span>Ваши пожертвования</span>
                <span @if($uri == "donation") class="active" @endif></span>
            </a>
        </li>
    </ul>
</aside>