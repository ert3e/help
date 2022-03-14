@extends('layouts.app')

@section('content')

    @if ($parent_id != 0)
    <a href="{{ route('admin.informations.add', $parent_id) }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>
    @endif
    <div class="right">
        <a href="#" data-toggle="modal" data-target=".bs-settings-modal-lg" class="btn btn-success"><i class="fa fa-cog" aria-hidden="true"></i> Настройки модуля</a>
    </div>

    <div class="table-responsive" id="sortable_table">
        <table class="table">
            <thead>
            <tr>
                <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                <th>@include('templates.titleSort', ['title' => 'Заголовок', 'field' => 'title'])</th>
                <th>@include('templates.titleSort', ['field' => '-'])</th>
            </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="4">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-key="{{ $model->id }}" @if ($parent_id == 0 || $model->parent->parent_id == 0) data-href="{{ route('admin.informations', $model->id) }}" @endif>
                        <td>{{ $model->id }}</td>

                        @if ($parent_id == 0 || $model->parent->parent_id == 0)
                            <td><a href="{{ route('admin.informations', $model->id) }}">{{ $model->title }}</a></td>
                        @else
                            <td>{{ $model->title }}</td>
                        @endif
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.informations.edit', $model->id),
                                'delete'    => route('admin.informations.delete', $model->id),
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>


    @include('templates.moduleSettings', [
        'module' => 'informations',
    ])

@endsection

@section('footer_js')
    <script>
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Information') }}');
    </script>
@endsection
