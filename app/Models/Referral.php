<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referral';

    protected $fillable = ['code'];
    /**
     * Get the referrals record associated with the user.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\UserBase');
    }
}
