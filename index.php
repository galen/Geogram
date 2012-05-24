<?php
session_start();

ini_set( 'display_errors', 'On' );
error_reporting( E_ALL );

require( 'system/config.php' );
require( DIR_LIB . '/Slim/Slim/Slim.php' );

require( DIR_LIB . '/SplClassLoader/SplClassLoader.php' );

$instagram_loader = new SplClassLoader( 'Instagram', DIR_LIB . '/PHP-Instagram-API' );
$instagram_loader->register();

$app = new Slim;

$app->get('/', function () {
    $page = 'home';
    require( DIR_CONTROLLERS . '/home.php' );
});

$app->get('/location/me/', function () use ( $config, $app )  {
    $page = 'location_me';
    require( DIR_CONTROLLERS . '/location.php' );
});

$app->get('/location/:location(/:distance(/:location_name/))/', function ( $location, $distance ) use ( $config, $app )  {
    $page = 'location';
    require( DIR_CONTROLLERS . '/location.php' );
});

$app->get('/search/', function () use ( $config, $app )  {
	$page = 'search';
    require( DIR_CONTROLLERS . '/search.php' );
});

$app->get('/tag/:tag/', function ( $tag ) use ( $config, $app ) {
    $page = 'tag';
    require( DIR_CONTROLLERS . '/tag.php' );
});

$app->get('/auth/', function () use( $config ) {
    require( DIR_CONTROLLERS . '/auth.php' );
});

$app->get('/user/:username(/all)/', function ( $username ) use ( $config, $app ) {
    $page = 'user';
    $url_parts = explode( '/', trim( $app->request()->getResourceUri(), '/' ) );
    if( end( $url_parts ) == 'all' ) {
        $page = 'user_all';
    }
    require( DIR_CONTROLLERS . '/user.php' );
});

$app->get('/me(/all)/', function () use ( $config, $app ) {
	$page = 'user';
    $url_parts = explode( '/', trim( $app->request()->getResourceUri(), '/' ) );
    if( end( $url_parts ) == 'all' ) {
        $page = 'user_all';
    }
    require( DIR_CONTROLLERS . '/me.php' );
});

$app->get('/api(/:method)/', function () {
    require( DIR_CONTROLLERS . '/api.php' );
});

$app->notFound( function () use ( $config, $app ) {
    require( DIR_CONTROLLERS . '/error.php' );
});

$app->run();
