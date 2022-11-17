<?php

namespace App\Controllers\Confirmations;

use App\Facades\Response;
use App\Controllers\Factories\ConfirmationFactories;
use App\Controllers\Confirmations\Interfaces\Telegram;

class ConfirmationTelegram extends ConfirmationFactories implements Telegram
{
    public function getTelegramCode()
    {
        $code = rand(1000, 9999);
        $_SESSION['telegram_code'] = $code;
        return Response::response($code);
    }

    public function checkTelegramCode($code)
    {
        if ($_SESSION['telegram_code'] == $code) return true;

        return false;
    }
}
