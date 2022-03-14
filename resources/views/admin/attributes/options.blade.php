@extends('layouts.app')

@section('content')

    <div class="alert alert-success fade show in" id="alertSave" style="display:none;">
        <strong>Изменения успешно сохранены!</strong>
    </div>

    <h3>Все варианты атрибута "{{ $attribute['title'] }}":</h3>

    {{ Form::open(['route' => ['admin.attributes.options.store', $attribute['id']]]) }}

    <div class="table-responsive">
        <table class="table">
            <thead>

            <tr>
                <th>Заголовок</th>
                <th></th>
            </tr>

            <tr>
                <td style="width: 80%;">
                    <input type="text" name="title" class="form-control" required>
                </td>
                <td>
                    <input type="submit" value="Добавить" class="btn btn-primary">
                </td>
            </tr>

            </thead>


            <tbody id="attributes_list">
            @if ($attribute->options->count() == 0)
                <tr class="empty-items"><td colspan="2">Нет ответов</td></tr>
            @else
                @foreach($attribute->options as $option)
                <tr>
                    <td style="text-align: left;">
                        {{ $option->title }}
                    </td>
                    <td>
                        @include('templates.buttonsControl', [
                            'edit'   => route('admin.attributes.options.edit', [$attribute->id, $option->id]),
                            'delete' => route('admin.attributes.options.delete', [$attribute->id, $option->id]),
                        ])
                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    {{ Form::close() }}



@endsection

