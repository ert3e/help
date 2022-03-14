@extends('layouts.app')

@section('content')

    <h3 id="hello">Добро пожаловать в админку сайта "<a href="{{ route('main') }}">{{ setting('main.title') }}</a>"!</h3>

    <?php
    $date = new Carbon\Carbon;
    $date->subDay();

    $counter = [
        'users'=> [
            'all' => User::count(),
            'new' => User::where('created_at', '>', $date)->count(),
        ],
        'pickings'=> [
            'all' => Picking::count(),
            'new' => Picking::where('created_at', '>', $date)->count(),
        ],
        'news'=> [
            'all' => News::count(),
            'new' => News::where('created_at', '>', $date)->count(),
        ],
        'informations'=> [
            'all' => Information::count(),
            'new' => Information::where('created_at', '>', $date)->count(),
        ],
        'feedback'=> [
            'all' => Feedback::count(),
            'new' => Feedback::where('created_at', '>', $date)->count(),
        ],
    ];
    ?>

    <div id="blocks">

        @if (config('modules.types.Admin.Users'))
        <a href="{{ route('admin.users') }}" class="block">
            <i class="fas fa-users"></i>
            <div>
                <span class="block_new">
                    <i class="fas fa-level-up-alt"></i>
                    {{ $counter['users']['new'] }}
                </span>
                <p>{{ $counter['users']['all'] }}</p>
                {{ Lang::choice('пользователь|пользователя|пользователей', $counter['users']['all']) }}
            </div>
        </a>
        @endif

        @if (config('modules.types.Admin.News'))
        <a href="{{ route('admin.news') }}" class="block">
            <i class="fa fa-newspaper"></i>
            <div>
                <span class="block_new">
                    <i class="fas fa-level-up-alt"></i>
                    {{ $counter['news']['new'] }}
                </span>
                <p>{{ $counter['news']['all'] }}</p>
                {{ Lang::choice('новость|новости|новостей', $counter['news']['all']) }}
            </div>
        </a>
        @endif

        @if (config('modules.types.Admin.Informations'))
        <a href="{{ route('admin.informations') }}" class="block">
            <i class="fas fa-poll" aria-hidden="true"></i>
            <div>
                <span class="block_new">
                    <i class="fas fa-level-up-alt" aria-hidden="true"></i>
                    {{ $counter['informations']['new'] }}
                </span>
                <p>{{ $counter['informations']['all'] }}</p>
                {{ Lang::choice('отчет|отчета|отчетов', $counter['informations']['all']) }}
            </div>
        </a>
        @endif

        @if (config('modules.types.Admin.Catalog'))
            <a href="{{ route('admin.catalog') }}" class="block">
                <i class="fas fa-coins" aria-hidden="true"></i>
                <div>
            <span class="block_new">
                <i class="fas fa-level-up-alt" aria-hidden="true"></i>
                {{ $counter['pickings']['new'] }}
            </span>
                    <p>{{ $counter['pickings']['all'] }}</p>
                    {{ Lang::choice('сбор|сбора|сборов', $counter['pickings']['all']) }}
                </div>
            </a>
        @endif

        @if (config('modules.types.Admin.Feedbacks'))
        <a href="{{ route('admin.feedbacks') }}" class="block">
            <i class="fas fa-comments"></i>
            <div>
                <span class="block_new">
                    <i class="fas fa-level-up-alt"></i>
                    {{ $counter['feedback']['new'] }}
                </span>
                <p>{{ $counter['feedback']['all'] }}</p>
                {{ Lang::choice('обращение|обращения|обращений', $counter['feedback']['all']) }}
            </div>
        </a>
        @endif


    </div>

@endsection
