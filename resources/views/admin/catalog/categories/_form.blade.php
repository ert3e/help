@if (isset($model))
    {{ Form::open(['route' => ['admin.catalog.update.category', $model['id']], 'files' => true]) }}
@else
    {{ Form::open(['route' => ['admin.catalog.store.category', $parent_id], 'files' => true]) }}
@endif

<div>

    <ul class="nav nav-tabs form-group" role="tablist">
        <li class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основные параметры</a></li>
        <li><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO</a></li>
        <li><a href="#publication" aria-controls="publication" role="tab" data-toggle="tab">Публикация</a></li>
    </ul>

    <div class="tab-content" id="vue-box">
        <div role="tabpanel" class="tab-pane active" id="main">
            {{ Form::hidden('parent_id', $parent_id) }}

            <sluggable
                title="{{ issetValue($model, 'title') }}"
                slug="{{ isset($model) ? getSlug($model->slug) : '' }}"
                new="{{ !isset($model) }}"></sluggable>

            <?php
                $excluded = [];
                if (isset($model)) {
                    $excluded[] = $model->id;
                }
            ?>
            <div class="form-group">
                <label for="parent_id">Категория (родитель)</label>
                {{ Form::select('parent_id', (Category::treeOfCategories(0, $excluded) + [0 => 'Главный каталог']), isset($model) ? $model->parent_id : $parent_id, ['class' => 'choice-select']) }}
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                {{ Form::textarea('description', issetValue($model, 'description'),  ['id' => 'description', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
                @if (isset($model))
                    <div class="form-main-image">
                        <img src="{{ $model->resize($model->mainImage(), 200) }}" alt="">
                    </div>
                @endif
                <label for="image">Обложка:</label>
                {{ Form::file('image', ['id' => 'image', 'class' => 'form-control', 'accept' => 'image/*']) }}
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="seo">
            @include('templates.seo')
        </div>

        <div role="tabpanel" class="tab-pane" id="publication">

            <div class="form-group">
                {{ Form::checkbox('active', '0', true,  ['class' => 'checkbox']) }}
                {{ Form::checkbox('active', '1', isset($model) ? (bool)$model->active : true,  ['class' => 'checkbox', 'id' => 'main_check']) }}
                <label for="main_check">Активный</label>
            </div>

        </div>

    </div>
</div>



<div class="form-group">
    {{ Form::button(isset($model) ? 'Сохранить' : 'Добавить', ['type' => 'submit', 'name' => 'action', 'class' => 'btn btn-primary']) }}
    {{ Form::button((isset($model) ? 'Сохранить' : 'Добавить').' и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    <a href="{{ route('admin.catalog', $parent_id) }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}


@section('footer_js')
<script>
    CKEDITOR.replace('description');
</script>
@endsection
