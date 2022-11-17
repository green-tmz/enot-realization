<?php

namespace App\Controllers\Confirmations;

use App\Facades\Response;
use App\Controllers\Confirmations\Interfaces\Email;
use App\Controllers\Factories\ConfirmationFactories;

class ConfirmationEmail extends ConfirmationFactories implements Email
{
    public function getEmailCode()
    {
        $code = rand(1000, 9999);
        $_SESSION['email_code'] = $code;
        return Response::response($code);
    }

    public function checkEmailCode($code)
    {
        if ($_SESSION['email_code'] == $code) return true;

        return false;
    }
}
