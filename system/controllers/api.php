<?php

if( !isset( $_GET['method'] ) ){
    die( json_encode( array( 'error' => 'No API method' ) ) );
}

$method = $_GET['method'];

header( 'Content-type: application/json' );

try {
    switch( $method ) {

        case 'tag':
            require( DIR_CONTROLLERS . '/api/tag.php' );
            break;
        case 'geocode':
            require( DIR_CONTROLLERS . '/api/geocode.php' );
            break;
    	case 'user':
    		require( DIR_CONTROLLERS . '/api/user.php' );
    		break;
    	case 'media_search':
    		require( DIR_CONTROLLERS . '/api/media_search.php' );
    		break;
        case 'user_search':
            require( DIR_CONTROLLERS . '/api/user_search.php' );
            break;
        case 'tag_search':
            require( DIR_CONTROLLERS . '/api/tag_search.php' );
            break;
        default:
            die('Invalid method');
    }
}
catch( \Instagram\Core\ApiException $e ) {
    die( json_encode( array( 'error' => $e->getMessage() ) ) );
}