@if (isset($model))
    {{ Form::open(['route' => ['admin.positions.update', $model['id']]]) }}
@else
    {{ Form::open(['route' => 'admin.positions.store']) }}
@endif

<div class="form-group">
    <div class="form-group">
        <label for="title">Должность</label>
        {{ Form::input('text', 'title', issetValue($model, 'title'),  ['id' => 'title', 'class' => 'form-control']) }}
    </div>

    <h4>Привилегии:</h4>

    @foreach(Privilege::all() as $privilege)
        <div class="mb-2">
            {{ Form::checkbox('privileges['.$privilege->id.']', '1', !isset($model) ? false : $model->hasPrivilege($privilege),  [
                'class' => 'checkbox',
                'id' => 'privilege_'.$privilege->id,
                'disabled' => (isset($model) && in_array($model->id, [User::ROOT, User::USER]) ? true : false),
            ]) }}
            <label for="privilege_{{ $privilege->id }}">{{ $privilege->title }}</label>
        </div>
    @endforeach
</div>



<div class="form-group">
    {{ Form::button(isset($model) ? 'Сохранить' : 'Добавить', ['type' => 'submit', 'name' => 'action', 'class' => 'btn btn-primary']) }}
    {{ Form::button((isset($model) ? 'Сохранить' : 'Добавить').' и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    <a href="{{ route('admin.positions') }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}

