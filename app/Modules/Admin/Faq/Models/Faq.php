<?php

namespace App\Modules\Admin\Faq\Models;

use App\Models\FaqBase;

class Faq extends FaqBase
{

    public $fillable = ['question', 'answer', 'active', 'position'];

    public static $validateRules = [
        'question'  => 'required',
        'answer'    => 'required',
        'active'    => 'boolean',
    ];

}
