@if (isset($model))
    {{ Form::open(['route' => ['admin.attributes.update', $model['id']], 'files' => true]) }}
@else
    {{ Form::open(['route' => 'admin.attributes.store', 'files' => true]) }}
@endif

<div>

    <div class="form-group">
        <label for="title">Название атрибута</label>
        {{ Form::input('text', 'title', issetValue($model, 'title'),  ['id' => 'title', 'class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label for="slug">Тип атрибута</label>
        {{ Form::select('type', Attribute::$types, issetValue($model, 'type'), ['class' => 'choice-select form-control']) }}
    </div>

    <div class="form-group">
        <label for="postfix">Постфикс (например: кг., шт.)</label>
        {{ Form::input('text', 'postfix', issetValue($model, 'postfix'),  ['id' => 'postfix', 'class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label for="alias">Алиас</label>
        {{ Form::input('text', 'alias', issetValue($model, 'alias'),  ['id' => 'alias', 'class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label for="category_id">Категории (выберите, если нужно привязать к определенным категориям, иначе применятся ко всем категориям)</label>
        {{ Form::select('categories[]', Category::treeOfCategories(), isset($model) ? $model->categories->pluck('category_id')->toArray() : '',  ['id' => 'category_id', 'class' => 'choice-select form-control', 'multiple' => true]) }}
    </div>

</div>

<div class="form-group">
    {{ Form::button(isset($model) ? 'Сохранить' : 'Добавить', ['type' => 'submit', 'name' => 'action', 'class' => 'btn btn-primary']) }}
    {{ Form::button((isset($model) ? 'Сохранить' : 'Добавить').' и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    <a href="{{ route('admin.attributes') }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}


