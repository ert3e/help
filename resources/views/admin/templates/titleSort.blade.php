<?php

    if ($field == '-') {
        if (isset($_GET['sort']) || isset($_GET['search'])) {
            echo '<a href="?" class="badge badge-danger">Сбросить</a>';
        }

        return true;
    }

    $type = 'asc';
    $symbol = '';
    $get = $_GET;

    // проверяем есть ли поисковой запрос
    $isSearch = isset($_GET['search'][$field]) && $_GET['search'][$field] != '' ? true : false;

    if (isset($get['sort'][$field])) {
         $type = $get['sort'][$field] == 'asc' ? 'desc' : 'asc';
         $symbol = $get['sort'][$field] == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
    }

    // очищаем гет параметры для того чтобы оставить сортировку только по 1 столбцу
    unset($get['sort']);

?>
<div class="sortable-field {{ $isSearch ? 'opened' : '' }}">
    <a href="?{{ http_build_query(array_merge($get, ['sort['.$field.']' => $type])) }}">{{ $title }} {!! $symbol !!}</a>

    <a href="#" class="search-field-form {{ $isSearch ? 'opened' : '' }}"><i class="fas fa-search"></i></a>
    <form action="" style="display: none;">
        <input type="text" name="search[{{ $field }}]" value="{{ $isSearch ? $_GET['search'][$field] : '' }}" placeholder="Поиск" class="form-control">
        @if (isset($_GET['sort'][$field]))
            <input type="hidden" name="sort[{{ $field }}]" value="{{ $_GET['sort'][$field] }}">
        @endif
    </form>
</div>
