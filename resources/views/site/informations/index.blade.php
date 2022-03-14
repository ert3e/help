@extends('layouts.app')

@include('templates.seo.meta', ['object' => setting('informations')])

@section('content')

    <div class="reports">
        <div class="container">

            <h1 class="page-title">{{ setting('informations.meta_h1') }}</h1>

            <div class="reports-years">
                @foreach($categories as $category)
                    <a href="{{ route('informations', $category->id) }}" class="reports-years__item {{ $selectedCategory->id == $category->id ? 'reports-years__item_active' : '' }}"><span>{{ $category->title }}</span></a>
                @endforeach
            </div>

            <div class="reports-docs">
                @if (count($informations) > 0)
                    @foreach($informations as $information)
                        @include('_information')
                    @endforeach
                @else
                    @include('templates.blocks.empty')
                @endif
            </div>

            <div class="pagination">
                @include('paginator.default', ['paginator' => $informations])
            </div>
        </div>
    </div>

@endsection
