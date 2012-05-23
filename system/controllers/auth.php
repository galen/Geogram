<?php

$auth = new Instagram\Auth( $config['auth'] );

if ( isset( $_GET['code'] ) ) {
    try {
        $_SESSION['instagram_access_token'] = $auth->getAccessToken( $_GET['code'] );
        header( 'Location: /me' );
        exit;
    }
    catch ( \Instagram\Core\ApiException $e ) {
        die( $e->getMessage() );
    }
}
else {
    $auth->authorize();
}