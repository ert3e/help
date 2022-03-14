@extends('layouts.app')

@section('content')

    @include('_form', ['model' => null, 'parent' => $parent, 'modelName' => 'InformationBase'])

@endsection
