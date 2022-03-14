@extends('layouts.app')

@section('content')

    @include('_form', [
        'model'         => $model,
        'category_id'   => isset($model->category) ? $model->category->id : 0
    ])

@endsection
