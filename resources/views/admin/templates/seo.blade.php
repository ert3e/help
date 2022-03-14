<?php
    if (isset($module)) {
        $attributes = setting($module);
        $type = 'settings['.$module.']';
    } else {
        $type = 'seo';
        if ($model && isset($model->seo)) {
            $attributes = $model->seo;
        }
    }
?>


@if (!isset($showSeoFields) || (isset($showSeoFields) && $showSeoFields))
    <h3>SEO:</h3>

@if (!isset($module))

    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a href="" class="btn btn-link" data-target="collapseOne">
                    Подсказки по SEO
                </a>
            </div>

            <div id="collapseOne" class="collapse">
                <div class="card-body">
                    <div class="alert alert-primary">

                        <div class="form-group">
                            Чтобы вручную не подставлять заголовки и другие атрибуты объектов - вы можете воспользоваться
                            шаблонными фразами, которые указаны ниже.
                        </div>

                        <?php if (isset($modelName)) {
                            $modelName = '\App\\Models\\'.$modelName;
                            $model = new $modelName;
                        } ?>

                        @foreach($model->templateAttributesSeo() as $template => $description)
                            <div><small><strong>[{{ $template }}]</strong> - {{ $description }}</small></div>
                        @endforeach

                        <div class="mt-3">
                            Постарайтесь следовать общим правилам SEO, не используйте большие текста в мета атрибутах.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

<div class="form-group">
    <label for="meta_h1">H1:</label>
    {{ Form::input('text', $type.'[meta_h1]', $attributes['meta_h1'] ?? '',  ['id' => 'meta_h1', 'class' => 'form-control']) }}
</div>

<div class="form-group">
    <label for="meta_title">Заголовок:</label>
    {{ Form::input('text', $type.'[meta_title]', $attributes['meta_title'] ?? '',  ['id' => 'meta_title', 'class' => 'form-control']) }}
</div>

<div class="form-group">
    <label for="meta_description">Мета описание:</label>
    {{ Form::input('text', $type.'[meta_description]', $attributes['meta_description'] ?? '',  ['id' => 'meta_description', 'class' => 'form-control']) }}
</div>

<div class="form-group">
    <label for="meta_keywords">Мета ключевые слова:</label>
    {{ Form::input('text', $type.'[meta_keywords]', $attributes['meta_keywords'] ?? '',  ['id' => 'meta_keywords', 'class' => 'form-control']) }}
</div>
@endif


@if (isset($fields) && count($fields) > 0)
    <h4>Дополнительные атрибуты:</h4>
    @foreach($fields as $name => $field)
        <div class="form-group">
            <label for="{{ $name }}">{{ $field['title'] }}:</label>
            @if (isset($field['textarea']) && $field['textarea'])
                {{ Form::textarea($type.'['.$name.']', $attributes[$name] ?? '',  ['id' => $name, 'class' => 'form-control']) }}
            @else
                {{ Form::input('text', $type.'['.$name.']', $attributes[$name] ?? '',  ['id' => $name, 'class' => 'form-control']) }}
            @endif
        </div>
    @endforeach
@endif
