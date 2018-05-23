<?php
    /*
    * Mysql database class - only one connection alowed
    */
    class Database
    {
        private static $_instance; // The single instance

        // Constructor
        private function __construct(){}

        /*
        Get an instance of the Database
        @return Instance
        */
        public static function getInstance()
        {
            if(!self::$_instance) {
                $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
                self::$_instance = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
            }

            return self::$_instance;
        }
    }
?>