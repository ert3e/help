<?php
namespace App\Utilities\PhoneAuth;
use CodersStudio\SmsRu\SmsRu;
use Ert3e\PhoneAuth\SmsServiceInterface;
use Illuminate\Support\Facades\Log;

class SentSmsRu implements SmsServiceInterface
{

    public function settings(array $settings): void
    {
        // TODO: Implement settings() method.
    }

    public function send(string $phone, string $message): bool
    {
/*        $response = new SmsRu();
        $phone = '+' . $phone;
        $response->send($phone, $message);*/

        return true;
    }
}