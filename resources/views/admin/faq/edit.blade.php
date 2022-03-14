@extends('layouts.app')

@section('content')

    @include('_form', ['model' => $model, 'modelName' => 'FaqBase'])

@endsection
