@if (isset($model))
    {{ Form::open(['route' => ['admin.navigations.update', $model['id']]]) }}
@else
    {{ Form::open(['route' => ['admin.navigations.store', $parent_id]]) }}
@endif

<div>
    {{ Form::hidden('parent_id', $parent_id) }}

    <div class="form-group">
        <label for="title">Название</label>
        {{ Form::input('text', 'title', issetValue($model, 'title'),  ['id' => 'title', 'class' => 'form-control']) }}
    </div>

    @if ($parent_id == 0)
        <div class="form-group">
            <label for="alias">Алиас</label>
            {{ Form::input('text', 'alias', issetValue($model, 'alias'),  ['id' => 'alias', 'class' => 'form-control']) }}
        </div>
    @else
        <div class="form-group">
            <label for="url">Ссылка (url)</label>
            {{ Form::input('text', 'url', issetValue($model, 'url'),  ['id' => 'url', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label for="class">СSS класс (если необходимо)</label>
            {{ Form::input('text', 'class', issetValue($model, 'class'),  ['id' => 'class', 'class' => 'form-control']) }}
        </div>
    @endif

</div>


<div class="form-group">
    {{ Form::button(isset($model) ? 'Сохранить' : 'Добавить', ['type' => 'submit', 'name' => 'action', 'class' => 'btn btn-primary']) }}
    {{ Form::button((isset($model) ? 'Сохранить' : 'Добавить').' и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    <a href="{{ route('admin.navigations') }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}


{{--
<script type="text/javascript">

    var pages = {!! json_encode(Page::getPagesList(), JSON_UNESCAPED_UNICODE) !!},
        input = $('#url'),
        selectList = $('#selectChangeList');

    selectList.change(function() {
        var sid = $(this).val();

        input.val(pages[sid]);
    });

</script>--}}
