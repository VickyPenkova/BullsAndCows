<?php

class App
{
    public function __construct()
    {
        $splitUrl = Mage::splitUrl();

        $controllerClass = Mage::getControllerClass();
        $controllerPath = Mage::getControllerPath();

        $actionName = Mage::getActionName();

        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $controllerClass = new $controllerClass();

            if (method_exists($controllerClass, $actionName)) {
                $controllerClass->{$actionName}();
            } else {
                $controllerClass;
            }
        } else {
            // invalid URL, so simply redirect to home page
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
    }
}
