@extends('layouts.app')

@include('templates.seo.meta', ['object' => ['meta_title' => 'Страница не найдена']])

@section('content')

    @include('templates.blocks.alert-page', [
        'title' => 'Ошибка - 404',
        'description' => 'Страница на которую Вы перешли - к сожалению, не найдена.'
    ])

@endsection
