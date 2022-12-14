<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        Mail::to('victor_s20@mhs.istts.ac.id')->send(new \App\Mail\TestMail());
        // Mail::raw('test', function ($msg) {
        //     $msg->to('victor_s20@mhs.istts.ac.id');
        //     $msg->subject('testing email');
        // });

        return 'Email sent';
    }
}
