<?php

namespace App\Controllers\Confirmations\Interfaces;

interface Telegram
{
    public function getTelegramCode();
    public function checkTelegramCode($code);
}
