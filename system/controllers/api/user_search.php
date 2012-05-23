<?php

$instagram = new Instagram\Instagram;
if ( isset( $_SESSION['instagram_access_token'] ) ) {
    $instagram->setAccessToken( $_SESSION['instagram_access_token'] );
}else {
    $instagram->setClientId( INSTAGRAM_CLIENT_ID );
}

$users = $instagram->searchUsers( $_GET['username'] );

if( !count( $users ) ) {
    die( json_encode( array( 'error' => 'No matching users found' ) ) );
}

foreach( $users as $user ) {
    $output[] = array(
        'username'  => $user->getUsername()
    );
}

die( json_encode( $output ) );

