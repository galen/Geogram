<?php

if ( $page == 'location' ) {
    $l = explode( ",", $location );
    $lat = $l[0];
    $lng = $l[1];
    $title_append = sprintf( 'Photos near %s, %s', $lat, $lng );
    $title = sprintf( "Photos %s meters from %s ", $distance, $location_name );
}
else {
    $title_append = 'Photos near you';
    $title = "Photos near you";
}

require( DIR_VIEWS . '/_header.php' );
require( DIR_VIEWS . '/location.php' );
require( DIR_VIEWS . '/_footer.php' );