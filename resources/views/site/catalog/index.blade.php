@extends('layouts.app')

@include('templates.seo.meta', ['object' => $category ? $category : setting('catalog')])

@section('content')

    <div class="pauper">
        <div class="container">

            <h1 class="page-title">@include('templates.seo.title', ['object' => $category ? $category : setting('catalog')])</h1>

            <div class="pauper__list">
                @if (count($pickings) > 0)
                    @foreach($pickings as $picking)
                        @include('_picking')
                    @endforeach
                @else
                    @include('templates.blocks.empty')
                @endif
            </div>

            <div class="pagination">
                @include('paginator.default', ['paginator' => $pickings])
            </div>

        </div>
    </div>

@endsection
