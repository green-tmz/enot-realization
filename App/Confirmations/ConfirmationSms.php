<?php

namespace App\Controllers\Confirmations;

use App\Controllers\Confirmations\Interfaces\Sms;
use App\Controllers\Factories\ConfirmationFactories;
use App\Facades\Response;

class ConfirmationSms extends ConfirmationFactories implements Sms
{
    public function getSmsCode()
    {
        $code = rand(1000, 9999);
        $_SESSION['sms_code'] = $code;
        return Response::response($code);
    }

    public function checkSmsCode($code)
    {
        if ($_SESSION['sms_code'] == $code) return true;

        return false;
    }
}
