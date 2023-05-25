<?php   

    class Config
    {
        public static $database = null;

        public static function database($key = null) {
            if(is_null(self::$database)) {
               self::$database = require_once APPROOT.DS.'config/database.php';
            }

            if(is_null($key)) 
                return $database;

            return $database[$key];
        }
    }