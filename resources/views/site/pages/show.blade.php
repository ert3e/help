@extends('layouts.app')

@include('templates.seo.meta', ['object' => $model])

@section('content')

        @if (file_exists(resource_path().'/views/site/pages/_'.$model->link.'.blade.php'))

            @include('_'.$model->link)

        @elseif ($model->description)

            <div class="container">
                <h1 class="page-title">@include('templates.seo.title', ['object' => $model])</h1>
                <div class="default-description">
                    {!! $model->description !!}
                </div>
            </div>

        @endif

@endsection
