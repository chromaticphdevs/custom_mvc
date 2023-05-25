<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        'username' => '#',
        'password' => '#',
        'host'     => '#',
        'name'     => '#',
        'replyTo'  => '#',
        'replyToName' => '#'
    ];



    const ITEXMO = [
        'key' => '',
        'pwd' => ''
    ];

	#################################################
	##             SYSTEM CONFIG                ##
    #################################################


    define('GLOBALS' , APPROOT.DS.'classes/globals');

    define('SITE_NAME' , 'invborrower.cloud');

    define('COMPANY_NAME' , 'TUP');
    define('APP_NAME' , 'TUP ARCHIVING');

    define('KEY_WORDS' , 'TUP ARCHIVING, Catalog archiving, Web Based');


    define('DESCRIPTION' , 'Archiving systems enable organizations to quickly conduct an initial search and review of the archive for data that is potentially responsive to a litigation request or an internal investigation.');

    define('AUTHOR' , SITE_NAME);


    define('APP_KEY' , 'TUP-ARCHIVING');
    
?>