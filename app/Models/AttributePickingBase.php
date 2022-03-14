<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class AttributePickingBase extends BaseModel
{

    public $table = 'attributes_pickings';

    public $fillable = ['attribute_id', 'picking_id', 'value', 'option_id'];

    public $timestamps = false;

    public $incrementing = false;

    public $primaryKey = ['picking_id', 'attribute_id'];

    public function parent() {
        return $this->belongsTo('App\Models\AttributeBase', 'attribute_id');
    }

    public function getValue() {

        $value = false;

        if ($parent = $this->parent) {
            if ($parent->isSelect() && $attributeOption = AttributeOptionBase::find($this->option_id)) {
                $value = $attributeOption->title;
            } else {
                $value = $this->value;
            }

            if ($parent->postfix) {
                $value.= ' '.$parent->postfix;
            }
        }

        return $value;
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();

        if (!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

}
