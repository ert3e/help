@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.services.add', $parent_id) }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>
    <div class="right">
        <a href="#" data-toggle="modal" data-target=".bs-settings-modal-lg" class="btn btn-success"><i class="fa fa-cog" aria-hidden="true"></i> Настройки модуля</a>
    </div>

    <div class="table-responsive" id="sortable_table">
        <table class="table">
            <thead>
            <tr>
                <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                <th>Изображение</th>
                <th>@include('templates.titleSort', ['title' => 'Заголовок', 'field' => 'title'])</th>
                <th>@include('templates.titleSort', ['title' => 'Описание', 'field' => 'description'])</th>
                <th>@include('templates.titleSort', ['field' => '-'])</th>
            </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="5">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-key="{{ $model->id }}">
                        <td>{{ $model->id }}</td>
                        <td>
                            <img src="{{ $model->mainImage(200) }}" alt="">
                        </td>
                        <td>{{ $model->title }}</td>
                        <td>{{ output($model->description, 80) }}</td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.services.edit', $model->id),
                                'delete'    => route('admin.services.delete', $model->id),
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>


    @include('templates.moduleSettings', [
        'module' => 'services',
        'fields' => config('modules.types.Admin.Services.seoFields')
    ])

@endsection

@section('footer_js')
    <script>
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Service') }}');
    </script>
@endsection
