<?php

define( 'DIR_BASE',                     dirname( __DIR__ ) );
define( 'DIR_SYSTEM',                   DIR_BASE . '/system' );
define( 'DIR_CONTROLLERS',              DIR_SYSTEM . '/controllers' );
define( 'DIR_VIEWS',                    DIR_SYSTEM . '/views' );
define( 'DIR_LIB',                      DIR_SYSTEM . '/lib' );

define( 'INSTAGRAM_CLIENT_ID',          '2bf09b7dbb814f22982a5f4a827dc547' );
define( 'INSTAGRAM_CLIENT_SECRET',      '83054d09115240fd9fafa21860f07af8' );
define( 'INSTAGRAM_REDIRECT_URI',       'http://sittin.dyndns.org:8888/auth/' );

define( 'INSTAGRAM_MIN_DISTANCE',       5 );
define( 'INSTAGRAM_MAX_DISTANCE',       5000 );
define( 'INSTAGRAM_DEFAULT_DISTANCE',   1000 );

$config = array(
    'auth'  => array(
        'client_id'         => INSTAGRAM_CLIENT_ID,
        'client_secret'     => INSTAGRAM_CLIENT_SECRET,
        'redirect_uri'      => INSTAGRAM_REDIRECT_URI,
        'scope'             => array( 'likes', 'comments', 'relationships' )
    )
);