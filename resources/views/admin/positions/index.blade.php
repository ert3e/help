@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.positions.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Должность', 'field' => 'title'])</th>
                    <th>@include('templates.titleSort', ['field' => '-'])</th>
                </tr>
            </thead>
            <tbody>
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="3">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-href="{{ route('admin.positions.edit', $model['id']) }}">
                        <td>{{ $model['id'] }}</td>
                        <td>{{ $model['title'] }}</td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.positions.edit', $model['id']),

                                in_array($model->id, [User::ROOT, User::USER]) ? '' :
                                   'delete'    => route('admin.positions.delete', $model['id']),
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

