@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.faq.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>
    <div class="right">
        <a href="#" data-toggle="modal" data-target=".bs-settings-modal-lg" class="btn btn-success"><i class="fa fa-cog" aria-hidden="true"></i> Настройки модуля</a>
    </div>

    <div class="table-responsive" id="sortable_table">
        <table class="table">
            <thead>
            <tr>
                <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                <th>@include('templates.titleSort', ['title' => 'Вопрос', 'field' => 'question'])</th>
                <th>@include('templates.titleSort', ['field' => '-'])</th>
            </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="3">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-key="{{ $model->id }}">
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->question }}</td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.faq.edit', $model->id),
                                'delete'    => route('admin.faq.delete', $model->id),
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
        'module' => 'faq',
    ])

@endsection

@section('footer_js')
    <script>
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Faq') }}');
    </script>
@endsection
