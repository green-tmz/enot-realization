<?php

namespace App;

use App\Facades\Response;
use App\Controllers\Dictionaries\Settings;
use App\Controllers\Dictionaries\Confirmation;

class SettingsController
{
    public function getAll()
    {
        return Response::json(Settings::SETTINGS, 200);
    }

    private function getConfirmation($data)
    {
        if (!$data) Response::error('Confirmation not found', 200);
        return Confirmation::TYPE[$data];
    }

    private function getClass($confirmation)
    {
        if (is_null($confirmation)) Response::error('Confirmation not found', 200);
        $className = 'App\Controllers\Confirmations\Confirmation' . ucfirst($confirmation);

        if (!class_exists($className))
            Response::error('Class not found', 200);

        return $className;
    }

    public function getCode()
    {
        $confirmation = $this->getConfirmation($_POST["confirmationId"]);
        $className = $this->getClass($confirmation);

        $action = 'get' . ucfirst($confirmation) . 'Code';
        if (!method_exists($className, $action))
            Response::error('Action not found', 200);

        $class = new $className;

        return $class->$action();
    }

    public function save()
    {
        if (!$_POST["settings"]['confirmationId']) Response::error('Confirmation not found', 200);
        if (!$_POST["settings"]['settingsId']) Response::error('Settings not found', 200);
        if (!$_POST["code"]) Response::error('Code not found', 200);

        $confirmation = $this->getConfirmation($_POST["settings"]['confirmationId']);
        $className = $this->getClass($confirmation);

        $action = 'check' . ucfirst($confirmation) . 'Code';
        if (!method_exists($className, $action))
            Response::error('Action not found', 200);

        $class = new $className;

        if ($class->$action($_POST["code"])) {
            $_SESSION = array();

            // Сохранение настройки в БД

            return Response::response("Success");
        }
        return Response::error("Invalid code", 200);
    }
}
