@extends('layouts.app')

@section('content')
    {{ Form::open(['route' => ['admin.attributes.options.update', $model->parent, $model['id']], 'files' => true]) }}

    <div>
        <div class="form-group">
            <label for="title">Ответ</label>
            {{ Form::input('text', 'title', $model->title,  ['id' => 'title', 'class' => 'form-control']) }}
        </div>
    </div>


    <div class="form-group">
        {{ Form::button('Сохранить и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
@endsection
