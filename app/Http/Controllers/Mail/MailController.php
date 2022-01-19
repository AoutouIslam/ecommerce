<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendEmail()
    {
        $details = [
            'title' => 'Mail From Deco et Cado',
            'body' => 'This is a test Email',
        ];
        Mail::to("js298024@gmail.com")->send(new MyTestMail($details));
        return "email sent";
    }
}
