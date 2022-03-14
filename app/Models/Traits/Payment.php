<?php

namespace App\Models\Traits;

use App\Models\RelationModels\Payment as PaymentBase;

trait Payment
{

    public function payments()
    {
        return $this->morphMany(PaymentBase::class, 'item');
    }

    public function paymentsPaid()
    {
        return $this->payments()->wherePaid(true);
    }

}
