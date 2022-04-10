<?php

namespace App\Modules\Profile\Donations\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Profile\ProfileController;
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
        $payments = DB::table('payments')->where('telephone', $phone)
            ->where('payment_status', 'succeeded')->get('amount');
        foreach ($payments as $payment) {
            $sum +=  $payment->amount;
        }

        return view('donation.index',
            [
                'donations' => $sum,
                'donations_href' => $sum,
            ]
        );
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
