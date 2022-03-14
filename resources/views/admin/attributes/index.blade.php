@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.attributes.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить</a>

    <div class="table-responsive" id="sortable_table">
        <table class="table">
            <thead>
                <tr>
                    <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Атрибут', 'field' => 'title'])</th>
                    <th>@include('templates.titleSort', ['title' => 'Тип атрибута', 'field' => 'type'])</th>
                    <th>Категории</th>
                    <th>Кол-во ответов</th>
                    <th>@include('templates.titleSort', ['field' => '-'])</th>
                </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="5">Записей пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-key="{{ $model->id }}" data-href="{{ route('admin.attributes.edit', $model->id) }}">
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->title }}</td>
                        <td>{{ $model->getType() }}</td>
                        <td>
                            @if (count($model->categories) == 0)
                                Все
                            @else
                                @foreach($model->categories as $attrCategory)
                                    {{ $attrCategory->category->title }}<br>
                                @endforeach
                            @endif
                        </td>
                        <td>{!! $model->isSelect() ? '<a href="'.route('admin.attributes.options', $model->id).'">'.$model->options->count().'</a>' : '-'  !!}</td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.attributes.edit', $model->id),
                                'delete'    => route('admin.attributes.delete', $model->id),
                                $model->isSelect() ? 'customs' : ''  => [
                                    [
                                        'icon'  => 'fas fa-bars',
                                        'route' => route('admin.attributes.options', $model->id),
                                    ]
                                ],
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

@section('footer_js')
    <script>
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Attribute') }}');
    </script>
@endsection
