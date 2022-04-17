<?php

namespace App\Modules\Profile\Donations\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Profile\ProfileController;
use App\Models\Referral;
use App\Modules\Admin\Users\Models\User;
use App\Modules\Site\Main\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DonationController extends ProfileController
{

    public function index() {
        $this->bc->addCrumb('Личный кабинет');
        $user = Auth::user();
        $phone = $user->phone;

        $sum = 0;
        $sumRef = 0;

        $referral_link = $user->referral;

        if (!$referral_link) {
            $code = $this->generateRandomString(7);
            $referral = new Referral(['code' => $code]);
            $user->referral()->save($referral);
            $referral_link = $user->referral;
        }

        $payments = DB::table('payments')
            ->where('telephone', $phone)
            ->where('payment_status', 'succeeded')->get('amount');

        $paymentsRef = DB::table('payments')
            ->where('payment_status', 'succeeded')
            ->where('code', $referral_link->code)
            ->get('amount');

        foreach ($payments as $payment) {
            $sum += $payment->amount;
        }

        foreach ($paymentsRef as $paymentRef) {
            $sumRef += $paymentRef->amount;
        }

        return view('donation.index',
            [
                'donations' => $sum,
                'donations_code' => $referral_link->code,
                'donations_ref' => $sumRef,
            ]
        );
    }

    public function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function sortable($model, Request $request) {

        $modelPath = '\App\\Models\\'.$model.'Base';

        $items = json_decode($request['items'], true);

        $newPositions = [];
        foreach($items as $old => $new) {
            $newItem = $modelPath::find($new);

            $newPositions[$old] = $newItem['position'];
        }

        foreach($newPositions as $item => $position) {
            $model = $modelPath::find($item);
            $model->update([
                'position'  => $position,
            ]);
        }


        return $newPositions;
    }

}
