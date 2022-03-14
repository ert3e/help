<?php

namespace App\Models\RelationModels;

use App\Models\BaseModel;
use YooKassa\Client;

class Payment extends BaseModel
{

    public $table = 'payments';

    public $fillable = ['item_id', 'item_type', 'donation_type', 'telephone', 'payment_id', 'payment_status',
        'save_payment_method', 'interval_days', 'next_pay', 'comment', 'paid', 'amount'];

    /**
     * Тип платежа - нуждающемуся
     */
    const TYPE_NEEDHELP = 'needHelp';

    /**
     * Тип платежа - программы фонда
     */
    const TYPE_SERVICES = 'services';

    /**
     * Тип платежа - нужды фонда
     */
    const TYPE_FOND = 'fond';

    /**
     * Тип платежа - выплата закята
     */
    const TYPE_ZAKAT = 'zakat';


    /**
     * Интервал - Единоразовая оплата
     */
    const INTERVAL_ONE = 'one';

    /**
     * Интервал - раз в месяц
     */
    const INTERVAL_MONTH = 'month';

    /**
     * Интервал - раз в день
     */
    const INTERVAL_DAY = 'day';


    public function item()
    {
        return $this->morphTo();
    }

    public function updateRelation($model) {
        $this->update([
            'item_id' => $model->id,
            'item_type' => get_class($model),
        ]);
    }

    public static function paymentTypes() : array {
        return [
            self::TYPE_NEEDHELP  => ['title' => 'Текущие сборы',],
            self::TYPE_SERVICES  => ['title' => 'Программы фонда',],
            self::TYPE_FOND      => ['title' => 'Нужды фонда'],
        ];
    }

    public static function paymentIntervals() : array {
        return [
            self::INTERVAL_ONE   => ['title' => 'Единовременно'],
            self::INTERVAL_MONTH => ['title' => 'Ежемесячно', 'days' => 30],
            self::INTERVAL_DAY   => ['title' => 'Ежедневно', 'days' => 1],
        ];
    }

    public static function yooKassa() : Client {
        $client = new Client();
        $client->setAuth(env('YOOKASSA_SHOP'), env('YOOKASSA_KEY'));

        return $client;
    }

}
