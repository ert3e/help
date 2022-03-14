<?php

namespace App\Modules\Site\Catalog\Models;

use App\Models\PickingBase;
use App\Models\ProductOfferBase;
use App\Modules\Site\Reviews\Models\Review;
use Illuminate\Database\Eloquent\Builder;

class Picking extends PickingBase
{
    public $fillable = ['category_id', 'title', 'slug', 'description', 'path', 'price', 'price_old', 'article'];

    public function myAttributes() {
        return $this->attributes()->where(function($query) {
            return $query->where('value', '!=', '')
                ->orWhere('option_id', '!=', '0');
        });
    }

    public function videoReviews() {
        return $this->morphMany(Review::class, 'item')
            ->where('youtube_url', '!=', NULL);
    }

    public function formattedPrice($price = 'price', $currency = true) {

        if (is_numeric($price)) {
            $priceValue = $price;
        } else {
            $priceValue = $this->{$price};
        }

        $priceString = number_format($priceValue, '0', '', ' ');

        if ($currency)
            $priceString.= ' '.setting('catalog.currency');


        return $priceString;
    }

    public function percentOfDiscount() {
        return ($this->price_old - $this->price) * 100 / $this->price_old;
    }

    protected static function booted()
    {
        static::addGlobalScope('actived', function (Builder $builder) {
            $builder->actived()->orderPosition();
        });
    }
}
