@extends('layouts.app')

@section('content')

    <div class="btn-group" role="group">
        <button id="btnGroup" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-plus-circle"></i> Добавить
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroup">
            @if ($parent_id == 0)
            <a href="{{ route('admin.catalog.add.category', $parent_id) }}" class="dropdown-item">Категорию</a>
            @endif
            @if ($parent_id != 0)
            <a href="{{ route('admin.catalog.add.picking', $parent_id) }}" class="dropdown-item">{{ $moduleItems['singleItem'] }}</a>
            @endif
        </div>
    </div>

    <div class="right">
        <div class="mb-2">
            <a href="#" data-toggle="modal" data-target=".bs-settings-modal-lg" class="btn btn-success"><i class="fa fa-cog" aria-hidden="true"></i> Настройки модуля</a>
        </div>
        <div class="mb-4">
            <a href="{{ route('admin.catalog.pickings') }}" class="btn btn-danger"><i class="fa fa-list" aria-hidden="true"></i> Показать все сборы</a>
        </div>
    </div>


    @if ($parent_id == 0)
        @if (count($models) == 0)
            <div class="table-title"><small>Категории не найдены...</small></div>
        @else
            <h3 class="table-title">Категории</h3>
            <div class="table-responsive" id="sortable_table">
            <table class="table table-categories table-list-items">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Изображение</th>
                    <th>Заголовок</th>
                    <th>Подкатегорий/{{ $moduleItems['manyItems'] }}</th>
                    <th>Активность</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="sortable-table sortable-table-categories" data-sortable-key="categoriesKey" data-gg="1">
                    @foreach($models as $model)
                        <tr data-key="{{ $model->id }}" data-href="{{ route('admin.catalog', $model->id) }}">
                            <td>{{ $model->id }}</td>
                            <td>
                                <img src="{{ $model->resize($model->mainImage(), 100) }}" alt="">
                            </td>
                            <td><a href="{{ route('admin.catalog', $model->id) }}">{{ $model->title }}</a></td>
                            <td>{{ $model->getCountInside('childs') }} / {{ $model->getCountInside('pickings') }}</td>
                            <td><span class="badge badge-{{ $model->active ? 'success' : 'danger' }}">{{ $model->activeStatus() }}</span></td>
                            <td>
                                @include('templates.buttonsControl', [
                                    'edit'      => route('admin.catalog.edit.category', $model->id),
                                    'delete'    => route('admin.catalog.delete.category', $model->id),
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endif



    @if ($parent_id != 0)
    <h3 class="table-title">{{ $moduleItems['manyItemsList'] }}</h3>
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
            <tbody class="sortable-table sortable-table-products" data-sortable-key="pickingsKey">
            @if ($pickings->count() == 0)
                <tr class="empty-items"><td colspan="6">Записей пока нет</td></tr>
            @else
                @foreach($pickings as $picking)
                    <tr data-key="{{ $picking->id }}" data-href="{{ route('admin.catalog.edit.picking', $picking->id) }}">
                        <td>{{ $picking->id }}</td>
                        <td>
                            <img src="{{ $picking->resize($picking->mainImage(), 100) }}" alt="">
                        </td>
                        <td><a href="{{ route('admin.catalog.edit.picking', $picking->id) }}">{{ $picking->title }}</a></td>
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
    @endif


    @include('templates.moduleSettings', [
        'module' => 'catalog',
        'fields' => config('modules.types.Admin.Catalog.seoFields')
    ])

@endsection

@section('footer_js')
    <script>
        enableDragSort('sortable-table-categories', '{{ route('admin.sortable', 'Category') }}', 'categoriesKey');
        enableDragSort('sortable-table-pickings', '{{ route('admin.sortable', 'Picking') }}', 'pickingsKey');
    </script>
@endsection
