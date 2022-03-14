@if (isset($model))
    {{ Form::open(['route' => ['admin.sliders.update', $model['id']], 'files' => true]) }}
@else
    {{ Form::open(['route' => ['admin.sliders.store', $parent_id], 'files' => true]) }}
@endif

<div>

    <ul class="nav nav-tabs form-group" role="tablist">
        <li class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основные параметры</a></li>
        <li><a href="#publication" aria-controls="publication" role="tab" data-toggle="tab">Публикация</a></li>
    </ul>

    <div class="tab-content" id="vue-box">
        <div role="tabpanel" class="tab-pane active" id="main">

            {{ Form::hidden('parent_id', $parent_id) }}

            <div class="form-group">
                <label for="title">Заголовок</label>
                {{ Form::input('text', 'title', issetValue($model, 'title'),  ['id' => 'title', 'class' => 'form-control']) }}
            </div>

            @if ($parent_id == 0)

                <div class="form-group">
                    <label for="alias">Алиас</label>
                    {{ Form::input('text', 'alias', issetValue($model, 'alias'),  ['id' => 'alias', 'class' => 'form-control']) }}
                </div>

            @else

                <div class="form-group">
                    <label for="description">Описание слайда</label>
                    {{ Form::textarea('description', issetValue($model, 'description'),  ['id' => 'description', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="url">Ссылка на ролик youtube</label>
                    {{ Form::input('text', 'youtube_url', issetValue($model, 'youtube_url'),  ['id' => 'youtube_url', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="product_id">Укажите товар (если необходимо)</label>
                    {{ Form::select('product_id', (['0' => 'Не указано'] + Product::all()->pluck('title', 'id')->toArray()), issetValue($model, 'product_id'),  ['id' => 'product_id', 'class' => 'form-control choice-select']) }}
                </div>

                <div class="form-group">
                    <label for="url">Ссылка (куда введет слайд)</label>
                    {{ Form::input('text', 'url', issetValue($model, 'url'),  ['id' => 'url', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="button_text">Текст кнопки: (не обязательно)</label>
                    {{ Form::input('text', 'button_text', issetValue($model, 'button_text'),  ['id' => 'button_text', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    @if (isset($model))
                        <div class="form-main-image">
                            <img src="{{ $model->resize($model->mainImage(), 400) }}" alt="">
                        </div>
                    @endif
                    <label for="image">Слайд:</label>
                    {{ Form::file('image', ['id' => 'image', 'class' => 'form-control', 'accept' => 'image/*']) }}
                </div>

            @endif

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
    <a href="{{ route('admin.sliders') }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}

