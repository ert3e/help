<?php

namespace App\Models\Traits;

use App\Models\PickingBase;
use App\Models\RelationModels\Image;
use App\Models\RelationModels\Seo;

trait SeoManager {

    public static function defaultTemplateAttributesSeo() {
        return [
            'title' => 'подставит заголовок объекта'
        ];
    }

    public function templateAttributesSeo() {
        return self::defaultTemplateAttributesSeo();
    }

    public function seo()
    {
        return $this->morphOne('App\Models\RelationModels\Seo', 'item');
    }

    public function updateSeo($seoAttributes) {

        if (isset($this->seo)) {
            $this->seo->update($seoAttributes);
        } else {
            $seoAttributes = new Seo($seoAttributes);
            $this->seo()->save($seoAttributes);
        }
    }

    public function seoAttribute($name) {

        $seoAttribute = '';

        if (isset($this->seo->{$name})) {
            $seoAttribute = $this->seo->{$name};

            foreach ($this->templateAttributesSeo() as $template => $description) {
                $seoAttribute = str_replace('['.$template.']', $this[$template], $seoAttribute);
            }

            if ($this instanceof PickingBase) {
                $this->replacePickingAttributes($seoAttribute);
            }
        }

        if (in_array($name, ['meta_h1', 'meta_title']) && empty($seoAttribute) && $this->title) {
            $seoAttribute = $this->title;
        }

        $seoAttribute = str_replace('"', '', $seoAttribute);

        return $seoAttribute;
    }


    private function replacePickingAttributes(&$seoAttribute) {
        preg_match_all('~\[attr\_\d\]~', $seoAttribute, $matches);

        foreach($matches[0] as $match) {
            $segments = explode('_', $match);
            $id = false;

            if (isset($segments[1])) {
                $id = substr($segments[1], 0, -1);
            }

            if ($id && $attribute = $this->attributeById($id)) {
                $seoAttribute = str_replace($match, $attribute->getValue(), $seoAttribute);
            }
        }
    }

    // при удалении модели
    public static function bootSeoManager()
    {
        self::deleting(function($model){
            // удаляем записи сео с базы данных
            $model->seo()->delete();
        });
    }

}
