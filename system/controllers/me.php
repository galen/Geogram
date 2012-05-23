<?php

if ( !isset( $_SESSION['instagram_access_token'] ) ) {
    require( DIR_CONTROLLERS . '/auth.php' );
    exit;
}

$instagram = new Instagram\Instagram;
$instagram->setAccessToken( $_SESSION['instagram_access_token'] );
$username = $instagram->getCurrentUser()->getUsername();

$title_append = $username;

require( DIR_VIEWS . '/_header.php' );
require( DIR_VIEWS . '/user.php' );
require( DIR_VIEWS . '/_footer.php' );