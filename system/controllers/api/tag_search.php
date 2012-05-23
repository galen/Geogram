<?php

$instagram = new Instagram\Instagram;
if ( isset( $_SESSION['instagram_access_token'] ) ) {
    $instagram->setAccessToken( $_SESSION['instagram_access_token'] );
}else {
    $instagram->setClientId( INSTAGRAM_CLIENT_ID );
}

$tags = $instagram->searchTags( $_GET['tag'] );

if( !count( $tags ) ) {
    die( json_encode( array( 'error' => 'No matching tags found' ) ) );
}

foreach( $tags as $tag ) {
    $output[] = array(
        'tag'  => $tag->getName()
    );
}

die( json_encode( $output ) );
