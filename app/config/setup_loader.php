<?php
    
    define('SYSTEM_MODE' , $system['mode']);
    define('UI_THEME' , $ui['vendor']);

    switch(SYSTEM_MODE)
    {
        case 'local':
            define('URL' , 'http://dev.cmaticmvc');
            define('DBVENDOR' , 'mysql');
            define('DBHOST' , 'localhost');
            define('DBUSER' , 'root');
            define('DBPASS' , '');
            define('DBNAME' , 'stv_dev');

            define('BASECONTROLLER' , 'AuthController');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');


            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        break;

        case 'dev':
            define('URL' , '');
            define('DBVENDOR' , '');
            define('DBHOST' , '');
            define('DBUSER' , '');
            define('DBPASS' , '');
            define('DBNAME' , '');

            define('BASECONTROLLER' , 'Pages');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');


            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        break;

        case 'down':
            define('URL' , '');
            define('DBVENDOR' , '');
            define('DBHOST' , '');
            define('DBUSER' , '');
            define('DBPASS' , '');
            define('DBNAME' , '');

            define('BASECONTROLLER' , 'Maintenance');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        break;

        case 'up':
            define('URL' , 'https://www.archivecatalog.directory');
            define('DBVENDOR' , 'mysql');
            define('DBHOST' , 'localhost');
            define('DBUSER' , 'korpzpru_th_main');
            define('DBPASS' , 'Y[@h=Ytz;(f}');
            define('DBNAME' , 'korpzpru_archive');

            define('BASECONTROLLER' , 'AuthController');
            define('BASEMETHOD' , 'index');

            define('DB_PREFIX' , 'hr_');
        break;
    }
