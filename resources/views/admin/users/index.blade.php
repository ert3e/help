@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.users.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Имя', 'field' => 'name'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Фамилия', 'field' => 'last_name'])</th>
                    <th>@include('templates.titleSort', ['title' => 'E-mail', 'field' => 'email'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Телефон', 'field' => 'telephone'])</th>
                    <th>@include('templates.titleSort', ['field' => '-'])</th>
                </tr>
            </thead>
            <tbody>
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="6">Пользователей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-href="{{ route('admin.users.edit', $model->id) }}">
                        <td>{{ $model['id'] }}</td>
                        <td>{{ $model['name'] }}</td>
                        <td>{{ $model['last_name'] }}</td>
                        <td>{{ $model['email'] }}</td>
                        <td>{{ $model['telephone'] }}</td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.users.edit', $model['id']),
                                $model->id == 1 ? '' : 'delete'    => route('admin.users.delete', $model['id']),
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

