<?php
    
    define('SYSTEM_MODE' , $system['mode']);
    define('UI_THEME' , $ui['vendor']);

    define('URL' , 'http://192.168.1.20/ecrash_tool');
    define('DBVENDOR' , $database[SYSTEM_MODE]['driver']);
    define('DBHOST' , $database[SYSTEM_MODE]['host']);
    define('DBUSER' , $database[SYSTEM_MODE]['username']);
    define('DBPASS' , $database[SYSTEM_MODE]['password']);
    define('DBNAME' , $database[SYSTEM_MODE]['dbname']);
    
    switch(SYSTEM_MODE)
    {
        case 'local':

            define('BASECONTROLLER' , 'AuthController');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');


            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        break;

        case 'dev':
            define('URL' , '');
            define('BASECONTROLLER' , 'Pages');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');


            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        break;

        case 'down':
            define('URL' , '');
            define('BASECONTROLLER' , 'Maintenance');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        break;

        case 'up':
            define('URL' , 'https://www.archivecatalog.directory');
            define('BASECONTROLLER' , 'AuthController');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');
        break;
    }
