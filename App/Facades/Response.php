<?php

namespace App\Facades;

class Response
{
    public static function json($data)
    {
        http_response_code(200);
        echo json_encode($data);
    }

    public static function error($message, $status = 401)
    {
        http_response_code($status);
        echo json_encode($message);
        die;
    }

    public static function response($data)
    {
        echo $data;
    }
}
