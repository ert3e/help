<?php

namespace App\Modules\Site\Main\Models;

use App\Models\PickingBase;
use App\Modules\Site\Catalog\Models\Category;
use App\Modules\Site\Catalog\Models\Picking;
use App\Modules\Site\Services\Models\Service;
use \App\Models\RelationModels\Payment as PaymentBase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use YooKassa\Common\Exceptions\InvalidPropertyValueException;
use YooKassa\Model\PaymentStatus;

class Payment extends PaymentBase
{

    public function saveCloneAutoPayment($autoPayId) {
        $newPayment = $this->replicate();
        $newPayment->paid = false;
        $newPayment->save_payment_method = false;
        $newPayment->interval_days = NULL;
        $newPayment->next_pay = NULL;
        $newPayment->payment_status = PaymentStatus::PENDING;
        $newPayment->payment_id = $autoPayId;
        $newPayment->save();
    }

    public static function validateRules() {
        return [
            'sum_ready' => 'in:'.implode(',', [100, 250, 500, 1000]),
            'sum_number' => 'integer|nullable',
            'donation_type' => 'in:'.implode(',', array_keys(self::paymentTypes())),
            'interval' => 'nullable|in:'.implode(',', array_keys(self::paymentIntervals())),
            'picking' => [
                'integer',
                'nullable',
                Rule::exists('pickings', 'id')->where('category_id', 1)
            ],
            'program' => 'integer|nullable|exists:services,id',
        ];
    }

    public static function createPay(Request $request) {

        $data['amount'] = $request->sum_ready;
        if (isset($request->sum_number) && $request->sum_number > 0) {
            $data['amount'] = $request->sum_number;
        }

        $data['save_payment_method'] = false;
        if (isset($request->interval) && $request->interval != self::INTERVAL_ONE) {
            $data['save_payment_method'] = true;

            $intervalDays = self::paymentIntervals()[$request->interval]['days'];
            $data['interval_days'] = $intervalDays;
            $data['next_pay'] = Carbon::now()->addDays($intervalDays);
        }


        $data['donation_type'] = $request->donation_type;
        switch ($request->donation_type) {
            case 'needHelp':
                $link = Picking::find($request->picking);
                $description = 'Текущие сборы - '.$link->title;
            break;

            case 'services':
                $link = Service::find($request->program);
                $description = 'Программы фонда - '.$link->title;
            break;

            case 'zakat':
                $link = null;
                $description = 'Выплата закята';
            break;

            default:
            case 'fond':
                $link = null;
                $description = 'На нужны фонда';
            break;
        }



        if ($payment = self::create($data)) {

            if (!is_null($link)) {
                $link->payments()->save($payment);
            }

            try {
                $client = self::yooKassa();

                $response = $client->createPayment(
                    [
                        'amount' => [
                            'value' => $data['amount'],
                            'currency' => 'RUB',
                        ],
                        'payment_method_data' => [
                            'type' => 'bank_card',
                        ],
                        'confirmation' => [
                            'type' => 'redirect',
                            'return_url' => route('main'),
                        ],
                        'description' => $description,
                        'save_payment_method' => $data['save_payment_method'],
                    ],
                    uniqid('', true)
                );

            } catch (InvalidPropertyValueException $invalidPropertyValueException) {
                echo 'Ошибка инициализии платежа! - ' . $invalidPropertyValueException->getMessage();
            }

            if (isset($response) && $response) {

                $payment->update(['payment_id' => $response->getId(), 'payment_status' => $response->getStatus()]);

                $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();

                return [
                    'payment_url' => $confirmationUrl,
                ];
            }


        }

        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::updated(function($model){

            // если платеж относился к сборам - регулируем если сумма собрана - переносим в категорию "Им уже помогли"
            if ($model->item && $model->item instanceof PickingBase) {
                $picking = $model->item;
                if ($picking->paymentsPaid->sum('amount') >= $picking->price) {
                    $picking->update(['category_id' => Category::TYPE_HELPED]);
                } else {
                    $picking->update(['category_id' => Category::TYPE_NEEDHELP]);
                }
            }

        });
    }

}
