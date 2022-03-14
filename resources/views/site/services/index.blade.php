@extends('layouts.app')

@include('templates.seo.meta', ['object' => setting('services')])

@section('content')

<div class="programs">
    <div class="container">

        <h1 class="page-title">{{ setting('services.meta_h1') }}</h1>

        <div class="programs__list">
            @if (count($models) > 0)
                @foreach($models as $model)
                    @include('_service', ['service' => $model])
                @endforeach
            @else
                @include('templates.blocks.empty')
            @endif
        </div>

        <div class="pagination">
            @include('paginator.default', ['paginator' => $models])
        </div>

    </div>
</div>

@endsection
