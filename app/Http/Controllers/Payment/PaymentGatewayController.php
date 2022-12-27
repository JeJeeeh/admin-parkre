<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Utilities\PaymentHelper;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        return response(PaymentHelper::doPayment(), 200);
    }
}
