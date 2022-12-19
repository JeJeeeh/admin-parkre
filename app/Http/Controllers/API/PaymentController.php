<?php

namespace App\Http\Controllers\API;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function notify(Request $req)
    {
        $reservation_id = $req->reference_id;
        $status_code = $req->status_code;

        if ($status_code == 1) {
            $reservation = Reservation::where('id', $reservation_id)->first();
            $reservation->status = 1;
            $reservation->save();

            $transaction = new Transaction();
            $transaction->price = $reservation->price;
            $transaction->date = date('Y-m-d');
            $transaction->user_id = $reservation->user_id;
            $transaction->reservation_id = $reservation_id;
            $transaction->save();

            $data['message'] = 'success';
            return response()->json($data);
        }

        $data['message'] = 'failed';
        return response()->json($data);
    }
}
