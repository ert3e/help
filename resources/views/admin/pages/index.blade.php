@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.pages.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Заголовок', 'field' => 'title'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Описание', 'field' => 'description'])</th>
                    <th>Ссылка</th>
                    <th>@include('templates.titleSort', ['field' => '-'])</th>
                </tr>
            </thead>
            <tbody>
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="4">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-href="{{ route('admin.pages.edit', $model->id) }}">
                        <td>{{ $model['id'] }}</td>
                        <td>{{ $model['title'] }}</td>
                        <td>{{ output($model->description, 80) }}</td>
                        <td><input type="text" value="{{ route('pages', $model['slug']) }}" class="form-control"></td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.pages.edit', $model['id']),
                                'delete'    => route('admin.pages.delete', $model['id']),
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    @include('templates.paginator', ['paginator' => $models])

@endsection

