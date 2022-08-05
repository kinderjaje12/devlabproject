<?php

namespace App\Http\Controllers;

use App\Mail\UserVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public static function sendMail($email)
    {
        Mail::to($email)->send(new UserVerified());
    }
}
