@if (isset($model))
    {{ Form::open(['route' => ['admin.informations.update', $model['id']], 'files' => true]) }}
@else
    {{ Form::open(['route' => ['admin.informations.store', $parent_id], 'files' => true]) }}
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
                <label for="title">Название</label>
                {{ Form::input('text', 'title', issetValue($model, 'title'),  ['id' => 'title', 'class' => 'form-control']) }}
            </div>


            @if ($parent && $parent->parent_id != 0)
            <div class="form-group">
                <label for="image">Файл:</label>
                @if (isset($model))
                    <?php
                    $file = glob('storage/informations/'.$model->id.'/*.*');
                    ?>
                    @if (isset($file[0]))
                        <a href="/{{ $file[0] }}" class="badge badge-primary">загруженный файл</a>
                    @endif
                @endif
                {{ Form::file('file', ['id' => 'image', 'class' => 'form-control']) }}
            </div>
            @endif

        </div>


        <div role="tabpanel" class="tab-pane" id="publication">

            <div class="form-group">
                {{ Form::checkbox('active', '0', true,  ['class' => 'checkbox']) }}
                {{ Form::checkbox('active', '1', isset($model) ? (bool)$model->active : true,  ['class' => 'checkbox', 'id' => 'main_check']) }}
                <label for="main_check">Активный</label>
            </div>

            @if ($parent_id == 0 || ($parent && $parent->parent_id == 0))
            <div class="form-group">
                <label for="caption">Привязать категорию к модулю</label>
                {{ Form::select('caption', ['' => 'Не привязывать'] + config('modules.types.Site.Informations.links'), isset($model) ? $model->caption : '',  ['id' => 'caption', 'class' => 'form-control']) }}
            </div>
            @endif

        </div>

    </div>
</div>



<div class="form-group">
    {{ Form::button(isset($model) ? 'Сохранить' : 'Добавить', ['type' => 'submit', 'name' => 'action', 'class' => 'btn btn-primary']) }}
    {{ Form::button((isset($model) ? 'Сохранить' : 'Добавить').' и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    <a href="{{ route('admin.informations') }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}


@section('footer_js')
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
