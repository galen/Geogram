<?php

define( 'DIR_BASE',                     dirname( __DIR__ ) );
define( 'DIR_SYSTEM',                   DIR_BASE . '/system' );
define( 'DIR_CONTROLLERS',              DIR_SYSTEM . '/controllers' );
define( 'DIR_VIEWS',                    DIR_SYSTEM . '/views' );
define( 'DIR_LIB',                      DIR_SYSTEM . '/lib' );

define( 'INSTAGRAM_CLIENT_ID',          '' );
define( 'INSTAGRAM_CLIENT_SECRET',      '' );
define( 'INSTAGRAM_REDIRECT_URI',       '' );

define( 'INSTAGRAM_MAX_DISTANCE',       5000 );
define( 'INSTAGRAM_DEFAULT_DISTANCE',   500 );

$config = array(
	'auth'	=> array(
	    'client_id'         => INSTAGRAM_CLIENT_ID,
    	'client_secret'     => INSTAGRAM_CLIENT_SECRET,
	    'redirect_uri'      => INSTAGRAM_REDIRECT_URI,
    	'scope'             => array( 'likes', 'comments', 'relationships' )
    )
);