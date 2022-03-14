<?php

namespace App\Console\Commands;

use App\Modules\Site\Main\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use YooKassa\Model\PaymentStatus;

class AutoPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка автоплатежей';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('max_execution_time', '900');
        ini_set('max_execution_time', '0');

        $payments = Payment::wherePaid(true)
            ->whereSavePaymentMethod(true)
            ->where('donation_type', '!=', Payment::TYPE_ZAKAT)
            ->where('next_pay', '<', Carbon::now())
            ->get();

        $yooKassa = Payment::yooKassa();

        foreach ($payments as $payment) {

            $description = Payment::paymentTypes()[$payment->donation_type]['title'];

            if ($payment->item) {
                $description.= ': '.$payment->item->title;
            }

            $autoPay = $yooKassa->createPayment(
                [
                    'amount' => [
                        'value' => $payment->amount,
                        'currency' => 'RUB',
                    ],
                    'payment_method_id' => $payment->payment_id,
                    'description' => 'Автоплатеж - '.$description,
                ],
                uniqid('', true)
            );

            if ($autoPay->getStatus() == PaymentStatus::WAITING_FOR_CAPTURE) {
                $this->info('Auto-payment waiting for capture');

                // обновляем дату следующего платежа
                $payment->update([
                    'next_pay' => Carbon::createFromTimeString($payment->next_day)->addDays($payment->interval_days)
                ]);

                // клонируем платеж и чистим данные
                $payment->saveCloneAutoPayment($autoPay->getId());

            } elseif ($autoPay->getStatus() == PaymentStatus::CANCELED) {
                $this->warn('Auto-payment cancelled, reason: '.$autoPay->getCancellationDetails()->getReason());
            }

        }

    }


}
