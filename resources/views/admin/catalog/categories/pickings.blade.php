@extends('layouts.app')

@section('content')

    <div class="btn-group" role="group">
        <button id="btnGroup" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-plus-circle"></i> Добавить
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroup">
            <a href="{{ route('admin.catalog.add.category', 0) }}" class="dropdown-item">Категорию</a>
            <a href="{{ route('admin.catalog.add.picking', 0) }}" class="dropdown-item">Товар</a>
        </div>
    </div>

    <div class="right">
        <a href="{{ route('admin.catalog') }}" class="btn btn-danger"><i class="fa fa-list" aria-hidden="true"></i> Открыть каталог</a>
    </div>

    <h3 class="table-title">Все сборы</h3>
    <div class="table-responsive sortable_table_products" id="sortable_table">
        <table class="table table-products table-list-items">
            <thead>
            <tr>
                <th>@include('templates.titleSort', ['title' => '№', 'field' => 'id'])</th>
                <th>Изображение</th>
                <th>@include('templates.titleSort', ['title' => 'Заголовок', 'field' => 'title'])</th>
                <th>@include('templates.titleSort', ['title' => 'Сумма сбора', 'field' => 'price'])</th>
                <th>Собрано</th>
                <th>@include('templates.titleSort', ['title' => 'Активность', 'field' => 'active'])</th>
                <th>@include('templates.titleSort', ['field' => '-'])</th>
            </tr>
            </thead>
            <tbody class="sortable-table">
            @if ($pickings->count() == 0)
                <tr class="empty-items"><td colspan="6">Записей пока нет</td></tr>
            @else
                @foreach($pickings as $picking)
                    <tr data-key="{{ $picking->id }}"  data-href="{{ route('admin.catalog.edit.picking', $picking->id) }}">
                        <td>{{ $picking->id }}</td>
                        <td>
                            <img src="{{ $picking->resize($picking->mainImage(), 100) }}" alt="">
                        </td>
                        <td>{{ $picking->title }}</td>
                        <td>{{ $picking->price }}</td>
                        <td>{{ $picking->paymentsPaid->sum('amount') }}</td>
                        <td><span class="badge badge-{{ $picking->active ? 'success' : 'danger' }}">{{ $picking->activeStatus() }}</span></td>
                        <td>
                            @include('templates.buttonsControl', [
                                'edit'      => route('admin.catalog.edit.picking', $picking->id),
                                'delete'    => route('admin.catalog.delete.picking', $picking->id),
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>

    @include('templates.paginator', ['paginator' => $pickings])

@endsection

@section('footer_js')
    <script>
        enableDragSort('sortable-table', '{{ route('admin.sortable', 'Picking') }}');
    </script>
@endsection
