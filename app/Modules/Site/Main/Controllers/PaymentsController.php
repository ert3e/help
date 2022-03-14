<?php

namespace App\Modules\Site\Main\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Site\Main\Models\Payment;
use YooKassa\Model\NotificationEventType;
use YooKassa\Model\PaymentStatus;

class PaymentsController extends SiteController
{

    private $client;

    public function __construct()
    {
        $this->client = Payment::yooKassa();
    }

    public function update() {
        // останавливаем скрипт чтобы успеть записать автоплатежи в базу данных, прежде чем сработает http уведомление от Яндекса,
        // так как нужно фиксировать все платежи и сохранять
        sleep(5);

        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);

        \Log::info($requestBody);

        // ищем платеж в системе
        if ($payment = Payment::wherePaymentId($requestBody['object']['id'])->first()) {

            // обрабатываем событие когда платеж ожидает подтверждения
            if ($requestBody['event'] === NotificationEventType::PAYMENT_WAITING_FOR_CAPTURE) {
                $this->client->capturePayment(
                    [
                        'amount' => [
                            'value' => $payment->amount,
                            'currency' => 'RUB',
                        ],
                    ],
                    $payment->payment_id,
                    uniqid('', true)
                );
            }

            // обрабатываем событие когда платеж выполнен
            if ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED) {
                $payment->update([
                    'paid'                  => true, // оплачено
                    'payment_status'        => PaymentStatus::SUCCEEDED, // статус
                    'save_payment_method'   => $requestBody['object']['payment_method']['saved'], // сохранение способа оплаты
                ]);
            }

        } else {
            \Log::info('Платеж с ID '.$requestBody['object']['id'].' - удален или еще не создан');
        }

    }

}
