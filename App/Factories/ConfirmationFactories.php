<?php

namespace App\Controllers\Factories;

use App\Facades\Response;

abstract class ConfirmationFactories
{
    public static function build($type = '')
    {
        if ($type == '') {
            return throw new \Exception('Type not found');
        } else {
            $className = 'App\Controllers\Confirmations\Confirmation' . ucfirst($type);
            if (class_exists($className)) return new $className();
            return throw new \Exception('Confirmation not found');
        }
    }

    public static function getCode($type = '')
    {
        $className = 'App\Controllers\Confirmations\Confirmation' . ucfirst($type);
        $action = 'get' . ucfirst($type) . 'Code';

        if (!method_exists($className, $action))
            Response::error('Action not found', 404);

        if (class_exists($className)) {
            $class = new $className();
            $class->$action;
        };
    }
}
