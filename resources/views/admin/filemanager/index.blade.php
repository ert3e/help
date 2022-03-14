@extends('layouts.app')

@section('content')

    {{ Form::open(['route' => 'admin.filemanager.store', 'files' => true]) }}
        <file-upload init-files="" multiple="true" name="files" id="filemanager" all-files="true"></file-upload>
        <div class="form-group">
            {{ Form::submit('Загрузить', ['class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}

    <file-manager route-get="{{ route('admin.filemanager.files') }}" route-delete="{{ route('admin.filemanager.delete') }}"></file-manager>

@endsection
