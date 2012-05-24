<?php

$gmap_loader = new SplClassLoader( 'PHPGoogleMaps', DIR_LIB );
$gmap_loader->register();

$lat = floatval( $_GET['lat'] );
$lng = floatval( $_GET['lng'] );

if ( !isset( $_GET['distance'] ) ) {
    $distance = INSTAGRAM_DEFAULT_DISTANCE;
}
else {
    $distance = intval( $_GET['distance'] ) > INSTAGRAM_MAX_DISTANCE || intval( $_GET['distance'] ) < 0
        ? INSTAGRAM_DEFAULT_DISTANCE
        : intval( $_GET['distance'] );
}

$max_timestamp = isset( $_GET['max_timestamp'] ) ? $_GET['max_timestamp'] : null;

$latlng = new \PHPGoogleMaps\Core\LatLng( $lat, $lng );

$instagram = new Instagram\Instagram;
if ( isset( $_SESSION['instagram_access_token'] ) ) {
    $instagram->setAccessToken( $_SESSION['instagram_access_token'] );
}else {
    $instagram->setClientId( INSTAGRAM_CLIENT_ID );
}

$params = array(
   'distance'       => $distance,
   'max_timestamp'  => $max_timestamp
);
$media = $instagram->searchMedia( $lat, $lng, $params );
/*
if( !count( $media ) ) {
    header( 'Content-type: application/json' );
    die( json_encode( array( 'error' => 'Error loading the photos' ) ) );
}*/
$output = array();
$output['photos'] = array();
$photos = array();
foreach( $media as $m_i => $m ) {
    $m_latlng = new \PHPGoogleMaps\Core\LatLng( $m->getLocation()->getLat(), $m->getLocation()->getLng() );
    $caption = $m->getCaption();
    $photos[] = array(
        'thumbnail'         => $m->getThumbnail()->url,
        'distance'          => $latlng->getDistanceFrom( $m_latlng, 'f', 1 ),
        'user'              => $m->getUser()->getUserName(),
        'created_time'      => $m->getCreatedTime(),
        'caption'           => $caption ? $caption->getText() : null,
        'link'              => $m->getLink(),
        'lat'               => $m->getLocation()->getLat(),
        'lng'               => $m->getLocation()->getLng(),
        'photo'             => $m->getStandardRes()->url,
        'id'                => $m->getId(),
        'unique_id'         => md5( $m->getLink() )
    );
}

$output = array(
    'photos'        => $photos,
    'max_timestamp' => $media->getNext()
);

header( 'Content-type: application/json' );
die( json_encode( $output ) );

