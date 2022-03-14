<?php
$category = Category::find($category_id);
// получаем всех родителей категории в виде массива
$categoryParents = [];

if ($category) {
    $categoryParents = Category::getParents($category);
}
?>
@foreach(Attribute::orderPosition()->get() as $attribute)

    <?php
        // получаем все категории атрибута в виде массива
        $attributeCategories = $attribute->categoriesToArray();

        if (count(array_intersect($categoryParents, $attributeCategories)) == 0 && count($attributeCategories) != 0) {
            continue;
        }

        $value = '';

        if (isset($model)) {
            $attrPicking = $model->attributeById($attribute->id);
            if ($attrPicking) {
                if ($attribute->isSelect()) {
                    $value = $attrPicking->option_id;
                } else {
                    $value = $attrPicking->value;
                }
            }
        }
    ?>

    @switch($attribute['type'])
        @case(Attribute::TEXT)
            <div class="form-group">
                <label for="attr_{{ $attribute['id'] }}">{{ $attribute['title'] }}: <small>(ID - {{ $attribute['id'] }})</small></label>
                <div class="input-group mb-3">
                    {{ Form::input('text', 'picking_attributes['.$attribute['id'].']', $value,  ['id' => 'attr_'.$attribute['id'], 'class' => 'form-control']) }}
                    @if ($attribute['postfix'] != '')
                    <div class="input-group-append">
                        <span class="input-group-text">{{ $attribute['postfix'] }}</span>
                    </div>
                    @endif
                </div>
            </div>
        @break

        @case(Attribute::TEXTAREA)
            <div class="form-group">
                <label for="attr_{{ $attribute['id'] }}">{{ $attribute['title'] }}: <small>(ID - {{ $attribute['id'] }})</small></label>
                {{ Form::textarea('picking_attributes['.$attribute['id'].']', $value,  ['id' => 'attr_'.$attribute['id'], 'class' => 'form-control']) }}
            </div>
        @break

        @case(Attribute::CHECKBOX)
            <div class="form-group">
                {{ Form::checkbox('picking_attributes['.$attribute['id'].']', 'true', $value,  ['class' => 'checkbox', 'id' => 'attr_'.$attribute['id']]) }}
                <label for="attr_{{ $attribute['id'] }}">{{ $attribute['title'] }} <small>(ID - {{ $attribute['id'] }})</small></label>
            </div>
        @break

        @case(Attribute::SELECT)
            <div class="form-group">
                <label for="attr_{{ $attribute['id'] }}">{{ $attribute['title'] }}: <small>(ID - {{ $attribute['id'] }})</small></label>
                {{ Form::select('picking_attributes['.$attribute['id'].']', $attribute->getOptionsList(), $value,  ['class' => 'form-control', 'id' => 'attr_'.$attribute['id']]) }}
            </div>
        @break

    @endswitch

@endforeach
