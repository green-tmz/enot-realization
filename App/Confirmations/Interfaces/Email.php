<?php

namespace App\Controllers\Confirmations\Interfaces;

interface Email
{
    public function getEmailCode();
    public function checkEmailCode($code);
}
