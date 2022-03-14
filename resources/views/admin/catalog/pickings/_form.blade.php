@if (isset($model))
    {{ Form::open(['route' => ['admin.catalog.update.picking', $model['id']], 'files' => true]) }}
@else
    {{ Form::open(['route' => ['admin.catalog.store.picking', $category_id], 'files' => true]) }}
@endif

<div>

    <ul class="nav nav-tabs form-group" role="tablist">
        <li class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основные параметры</a></li>
        <li><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">Атрибуты</a></li>
        <li><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO</a></li>
        <li><a href="#publication" aria-controls="publication" role="tab" data-toggle="tab">Публикация</a></li>
        @if (isset($model))
        <li><a href="#pays" aria-controls="pays" role="tab" data-toggle="tab">Платежи</a></li>
        @endif
    </ul>

    <div class="tab-content" id="vue-box">
        <div role="tabpanel" class="tab-pane active" id="main">
            {{ Form::hidden('category_id', $category_id) }}


            <sluggable
                title="{{ issetValue($model, 'title') }}"
                slug="{{ isset($model) ? getSlug($model->slug) : '' }}"
                new="{{ !isset($model) }}"></sluggable>

            @if (isset($model))
            <div class="form-group">
                <label for="category_id">Основная категория</label>
                {{ Form::select('category_id', Category::treeOfCategories() + [0 => 'Главный каталог'], issetValue($model, 'category_id'),  ['id' => 'category_id', 'class' => 'choice-select form-control']) }}
            </div>
            @endif

            {{--<div class="form-group">
                <label for="additional_categories">Дополнительные категории (выберите, если нужно привязать к определенным категориям)</label>
                {{ Form::select('additional_categories[]', Category::treeOfCategories(), isset($model) ? $model->additionalCategories->pluck('category_id')->toArray() : '',  ['id' => 'additional_categories', 'class' => 'choice-select form-control', 'multiple' => true]) }}
            </div>--}}

            <div class="form-group">
                <label for="description">Описание</label>
                {{ Form::textarea('description', issetValue($model, 'description'),  ['id' => 'description', 'class' => 'form-control']) }}
            </div>

            <file-upload :init-files="{{ isset($model) ? $model->getImagesComponent() : '[]' }}"
                 @if (isset($model)) sortable-url="{{ route('admin.catalog.edit.picking.sortableImages', $model->id) }}" @endif
                 multiple="false"
                 max="1"
                 name="files"
                 title="Фотографии"
                 id="images"
                 :all-files="false">
            </file-upload>

        </div>

        <div role="tabpanel" class="tab-pane" id="attributes">

            <div class="form-group">
                <label for="price">Сумма сбора: </label>
                <div class="input-group mb-3">
                    {{ Form::input('number', 'price', issetValue($model, 'price'),  ['id' => 'price', 'class' => 'form-control', 'required' => 'required']) }}
                    <div class="input-group-append">
                        <span class="input-group-text">руб.</span>
                    </div>
                </div>
            </div>

            @include('templates.attributes')
        </div>

        <div role="tabpanel" class="tab-pane" id="seo">
            @include('templates.seo', [
                'fields' => [
                    'meta_tagline' => [
                        'title' => 'Текст под заголовком в обложке',
                    ]
                ]
            ])
        </div>

        <div role="tabpanel" class="tab-pane" id="publication">

            <div class="form-group">
                {{ Form::checkbox('active', '0', true,  ['class' => 'checkbox']) }}
                {{ Form::checkbox('active', '1', isset($model) ? (bool)$model->active : true,  ['class' => 'checkbox', 'id' => 'main_check']) }}
                <label for="main_check">Активный</label>
            </div>

        </div>

        @if (isset($model))
        <div role="tabpanel" class="tab-pane" id="pays">

            <div class="form-group">
                Собрано: {{ $model->pays()->wherePaid(true)->sum('amount') }} / {{ $model->price }}
            </div>

            <div class="form-group">
                {{ Form::input('number', 'pay_amount', 0,  ['id' => 'price', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::button('Добавить', ['type' => 'submit', 'name' => 'action', 'value' => 'addPay', 'class' => 'btn btn-primary']) }}
            </div>

            <table class="table table-categories table-list-items">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Дата</th>
                    <th>Сумма</th>
                    <th>Тип</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($model->pays()->wherePaid(true)->orderByDesc('id')->get() as $pay)
                    <tr>
                        <td>{{ $pay->id }}</td>
                        <td>{{ $pay->created_at }}</td>
                        <td>{{ $pay->amount }}</td>
                        <td>{{ $pay->payment_id ? 'Онлайн оплата' : 'Вручное внесение' }}</td>
                        <td>
                            @if (!$pay->payment_id)
                            <a class="btn btn-danger btn-xs" href="javascript:confirmRequest('{{ route('admin.catalog.edit.picking', $model->id) }}?paymentDelete={{ $pay->id }}')" role="button">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        @endif

    </div>
</div>



<div class="form-group">
    {{ Form::button(isset($model) ? 'Сохранить' : 'Добавить', ['type' => 'submit', 'name' => 'action', 'class' => 'btn btn-primary']) }}
    {{ Form::button((isset($model) ? 'Сохранить' : 'Добавить').' и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    <a href="{{ route('admin.catalog', $category_id) }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}


@section('footer_js')
<script>
    CKEDITOR.replace('description');
</script>
@endsection


