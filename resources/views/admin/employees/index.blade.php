@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.employees.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>
    <div class="right">
        <a href="#" data-toggle="modal" data-target=".bs-settings-modal-lg" class="btn btn-success"><i class="fa fa-cog" aria-hidden="true"></i> Настройки модуля</a>
    </div>

    <div class="table-responsive" id="sortable_table">
        <table class="table">
            <thead>
                <tr>
                    <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                    <th>Изображение</th>
                    <th>@include('templates.titleSort', ['title' => 'ФИО', 'field' => 'title'])</th>
                    <th>@include('templates.titleSort', ['field' => '-'])</th>
                </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="4">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-key="{{ $model->id }}" data-href="{{ route('admin.employees.edit', $model->id) }}">
                        <td>{{ $model->id }}</td>
                        <td>
                            <img src="{{ $model->resize($model->mainImage(), 100) }}" alt="">
                        </td>
                        <td>{{ $model->fio }}</td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.employees.edit', $model->id),
                                'delete'    => route('admin.employees.delete', $model->id),
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>

    @include('templates.paginator', ['paginator' => $models])

    @include('templates.moduleSettings', [
        'module'                => 'employees',
        'fields'                => config('modules.types.Admin.Employees.seoFields'),
        'showSeoFields'         => false,
        'showPaginateFields'    => false,
    ])

@endsection

@section('footer_js')
    <script>
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Employee') }}');
    </script>
@endsection
