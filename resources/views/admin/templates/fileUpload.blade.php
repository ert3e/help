<div class="upload-file-form" data-files-id="{{ $id }}">
    <div class="form-group">
        <label>{{ isset($title) ? $title : 'Файлы для загрузки' }}:</label>

        <label for="files-input-{{ $id }}" class="files-box">
            <input id="files-input-{{ $id }}" name="{{ $name }}{{ isset($multiple) && $multiple ? '[]' : '' }}" type="file" class="form-control files-input {{ isset($allFiles) && $allFiles ? 'all-files' : '' }}" {{ isset($multiple) && $multiple ? 'multiple' : '' }}>

            <span class="files-box-list">
                @if (isset($model) && $model->images)
                    @foreach($model->images as $image)
                        <div class="files-box-file local" data-key="{{ $image->id }}">
                            <img src="{{ $model->resize($image, 200) }}">
                            <a href="" class="delete-local badge badge-danger" data-url="{{ route('admin.catalog.edit.product.deleteImage', [$model->id, $image->id]) }}">удалить</a>
                        </div>
                    @endforeach
                @endif
            </span>
        </label>

        <div class="files-box-inputs">

        </div>

    </div>
</div>
