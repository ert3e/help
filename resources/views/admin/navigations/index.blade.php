@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.navigations.add', $parent_id) }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>

    <div class="table-responsive" id="sortable_table">
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    @if ($parent_id != 0)
                        <th>Ссылка</th>
                    @endif
                    <th></th>
                </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="{{ $parent_id != 0 ? 4 : 3 }}">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-key="{{ $model['id'] }}" data-href="{{ route('admin.navigations', $model->id) }}">
                        <td>{{ $model->id }}</td>
                        <td><a href="{{ route('admin.navigations', $model->id) }}">{{ $model->title }}</a></td>
                        @if ($parent_id != 0)
                            <td>{{ $model->url }}</td>
                        @endif
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.navigations.edit', $model->id),
                                'delete'    => route('admin.navigations.delete', $model->id),
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection

@section('footer_js')
    <script>
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Navigation') }}');
    </script>
@endsection
