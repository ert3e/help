<?php
$needAuth = env('ADMIN_NEED_AUTH', FALSE);
?>
<header>

    <div id="head" class="clearfix">

        <div id="head_title">
            <a class="head_link" href="{{ route('admin.main') }}">Админ-панель</a>
        </div>

        <div id="head_menu">
            @if (isset($bc))
                {!! $bc->render() !!}
            @endif


            <div id="head_other_menu">
                @if (config('modules.types.Admin.Settings'))
                    <a href="{{ route('admin.settings') }}"><i class="fa fa-cog"></i></a>
                @endif
                <a href="#" data-toggle="collapse" data-target=".navbar-collapse" id="mobile_menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
            </div>
        </div>

    </div>


</header>


<aside id="dashboard_menu" class="dashboard_menu">

    <ul class="dashboard_menu_list">

        <p class="dashboard_menu_devider">Контент</p>
        {!! getModule('Catalog', Category::count().'/'.Picking::count()) !!}
        {!! getModule('News', News::count()) !!}
        {!! getModule('Sliders', Slider::count()) !!}
        {!! getModule('Services', Service::count()) !!}
        {!! getModule('Pages', Page::count()) !!}
        {!! getModule('Informations', Information::count()) !!}
        {!! getModule('Partners', Partner::count()) !!}
        <li>
            <a href="#" class="submenu_opener"><i class="fa fa-list" aria-hidden="true"></i> <span>Доп. разделы</span> </a>
            <ul class="submenu">
                {!! getModule('Attributes', Attribute::count()) !!}
                {!! getModule('Faq', Faq::count()) !!}
                {!! getModule('Navigations') !!}
            </ul>
        </li>
        {!! getModule('Feedbacks', Feedback::count()) !!}
        {!! getModule('Employees', Employee::count()) !!}

        <p class="dashboard_menu_devider">Настройки</p>
        {!! getModule('Settings') !!}

        <p class="dashboard_menu_devider">Дополнительно</p>
        {!! getModule('Ymlgenerator') !!}
        {!! getModule('Filemanager') !!}

    </ul>

</aside>

<aside id="content" class="content">

    {{-- Conclusion successful communication --}}
    @if (session('message_success'))
        <div class="message_success">{{ session('message_success') }}</div>
    @endif
    {{-- Displays error --}}
    @if (session('message_error'))
        <div class="message_error">{{ session('message_error') }}</div>
    @endif

    {{-- The output of the array of errors --}}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
