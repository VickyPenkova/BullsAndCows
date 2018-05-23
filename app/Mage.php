<?php

final class Mage
{
    CONST CONTROLLERS_URL = './app/code/local/controllers/';
    CONST MODELS_URL = './app/code/local/models/';
    CONST VIEWS_URL = './app/design/frontend/';
    CONST HELPERS_URL = './app/code/local/helpers/';
    CONST SKIN_URL = './skin/frontend/';

    private static $_urlController = 'Index';
    private static $_urlAction = 'indexAction';
    private static $_db = null;
    private static $_url = null;

    public static function getUrl()
    {
        if ( isset($_GET['url']) && !isset(self::$_url) ) {
            self::$_url = $_GET['url'];
        }

        return self::$_url;
    }

    public static function splitUrl()
    {
        $url = self::getUrl();

        if ( isset($url) ) {

            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            self::$_urlController = (isset($url[0]) ? ucwords(strtolower($url[0])) : self::$_urlController);
            self::$_urlAction = (isset($url[1]) ? ucwords(strtolower($url[1])) : self::$_urlAction);

            return true;
        }

        return false;
    }

    public static function getControllerName()
    {
    	return self::$_urlController;
    }

    public static function getControllerClass()
    {
        return self::convertMVCName(self::$_urlController, "controller");
    }

    public static function getControllerPath()
    {
        $controllerClass = self::convertMVCName(self::$_urlController, "controller");
        return self::CONTROLLERS_URL.$controllerClass.'.php';
    }

    public static function getActionName()
    {
        return self::convertMVCName(self::$_urlAction, "action");
    }

    public static function getHelper($helperName)
    {
        $helperClass = self::convertMVCName($helperName, "helper");
        $helperPath = self::HELPERS_URL.$helperClass.'.php';

        if ( file_exists( $helperPath ) ) {
            include $helperPath;
            $helper = new $helperClass;
            return $helper;
        }

        return false;
    }

    public static function getModel($modelName)
    {
        if ( !isset(self::$_db) ) {
            self::$_db = Database::getInstance();
        }

        $modelClass = self::convertMVCName($modelName, "model");
        $modelPath = self::MODELS_URL.$modelClass.'.php';

        if ( file_exists( $modelPath ) ) {
            require_once $modelPath;
            return new $modelClass(self::$_db);
        }

        return false;
    }

    public static function getSkinUrl($path)
    {
        return substr(self::SKIN_URL, 1).$path;
    }

    public static function convertMVCName($name, $case)
    {
        $case = ucwords(strtolower($case));

        switch ($case) {
            case 'Model':
            case 'Controller':
            case 'Helper':
                if ( strpos($name, $case) === false ) {
                    return ucwords(strtolower($name)).$case;
                }

                return $name;
                break;

            case 'Action':
                if ( strpos($name, $case) === false ) {
                    return $name.$case;
                }

                return $name;
                break;

            default:
                return false;
                break;
        }
    }

}