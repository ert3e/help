@extends('layouts.app')

@section('content')

    @include('_form', [
        'model' => $model,
        'modelName' => 'InformationBase',
        'parent_id' => isset($model->parent) ? $model->parent->id : 0
    ])

@endsection
