@extends('layouts.app')

@section('content')

    <a href="{{ route('admin.sliders.add', $parent_id) }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить {{ $parent_id == 0 ? 'слайдер' : 'слайд' }}</a>

    <div class="table-responsive" id="sortable_table">
        <table class="table">
            <thead>
                <tr>
                    <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                    @if ($parent_id != 0)
                        <th>Слайд</th>
                    @endif
                    <th>@include('templates.titleSort', ['title' => 'Заголовок', 'field' => 'title'])</th>
                    @if ($parent_id != 0)
                        <th>@include('templates.titleSort', ['title' => 'Дата добавления', 'field' => 'created_at'])</th>
                    @endif
                    <th>@include('templates.titleSort', ['field' => '-'])</th>
                </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($models->count() == 0)
                <tr class="empty-items"><td colspan="5">Слайдов пока нет</td></tr>
            @else
                @foreach($models as $model)
                    <tr data-key="{{ $model['id'] }}" data-href="{{ $parent_id == 0 ? route('admin.sliders', $model->id) : route('admin.sliders.edit', $model['id']) }}">
                        <td>{{ $model['id'] }}</td>

                        @if ($parent_id != 0)
                            <td><img src="{{ $model->resize($model->mainImage(), 100) }}" alt=""></td>
                            <td>{{ $model['title'] }}</td>
                            <td>{{ $model['created_at'] }}</td>
                        @else
                            <td><a href="{{ route('admin.sliders', $model->id) }}">{{ $model['title'] }}</a></td>
                        @endif

                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.sliders.edit', $model['id']),
                                'delete'    => route('admin.sliders.delete', $model['id']),
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
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Slider') }}');
    </script>
@endsection
