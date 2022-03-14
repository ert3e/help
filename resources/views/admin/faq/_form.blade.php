@if (isset($model))
    {{ Form::open(['route' => ['admin.faq.update', $model['id']]]) }}
@else
    {{ Form::open(['route' => 'admin.faq.store', 'files' => true]) }}
@endif

<div>

    <ul class="nav nav-tabs form-group" role="tablist">
        <li class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основные параметры</a></li>
        <li><a href="#publication" aria-controls="publication" role="tab" data-toggle="tab">Публикация</a></li>
    </ul>

    <div class="tab-content" id="vue-box">

        <div role="tabpanel" class="tab-pane active" id="main">

            <div class="form-group">
                <label for="description">Вопрос</label>
                {{ Form::input('text', 'question', issetValue($model, 'question'),  ['id' => 'description', 'class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label for="answer">Ответ</label>
                {{ Form::textarea('answer', issetValue($model, 'answer'),  ['id' => 'answer', 'class' => 'form-control']) }}
            </div>

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
    <a href="{{ route('admin.faq') }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}


@section('footer_js')
    <script>
        CKEDITOR.replace('answer');
    </script>
@endsection
