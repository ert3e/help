@if (isset($model))
    {{ Form::open(['route' => ['admin.users.update', $model['id']]]) }}
@else
    {{ Form::open(['route' => 'admin.users.store']) }}
@endif

<div>
    <div class="form-group">
        <label for="name">Имя</label>
        {{ Form::input('text', 'name', issetValue($model, 'name'),  ['id' => 'name', 'class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label for="last_name">Фамилия</label>
        {{ Form::input('text', 'last_name', issetValue($model, 'last_name'),  ['id' => 'last_name', 'class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label for="address">Адрес</label>
        {{ Form::input('text', 'address', issetValue($model, 'address'),  ['id' => 'address', 'class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label for="email">E-mail (почта)</label>
        {{ Form::input('email', 'email', issetValue($model, 'email'),  ['id' => 'email', 'class' => 'form-control', 'required' => true]) }}
    </div>

    <div class="form-group">
        <label for="telephone">Номер телефона</label>
        {{ Form::input('text', 'telephone', issetValue($model, 'telephone'),  ['id' => 'telephone', 'class' => 'form-control']) }}
    </div>

    <h3>Другая информация: </h3>

    <div class="form-group">
        <label for="position_id">Позиция</label>
        {{ Form::select('position_id', Position::pluck('title', 'id')->toArray(), issetValue($model, 'position_id'), ['class' => 'choice-select form-control']) }}
    </div>

    <div class="form-group">
        <label for="password">Новый пароль</label>
        {{ Form::input('password', 'password', '',  ['id' => 'password', 'class' => 'form-control', 'required' => !isset($model) ? true : false]) }}
    </div>

</div>



<div class="form-group">
    {{ Form::button(isset($model) ? 'Сохранить' : 'Добавить', ['type' => 'submit', 'name' => 'action', 'class' => 'btn btn-primary']) }}
    {{ Form::button((isset($model) ? 'Сохранить' : 'Добавить').' и выйти', ['type' => 'submit', 'name' => 'action', 'value' => 'exit', 'class' => 'btn btn-primary']) }}
    <a href="{{ route('admin.users') }}" class="btn btn-warning">Отмена</a>
</div>

{{ Form::close() }}

