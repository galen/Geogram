<?php

$gmap_loader = new SplClassLoader( 'PHPGoogleMaps', DIR_LIB );
$gmap_loader->register();

//$lat = floatval( $_GET['lat'] );
//$lng = floatval( $_GET['lng'] );

if ( !isset( $_GET['distance'] ) ) {
    $distance = INSTAGRAM_DEFAULT_DISTANCE;
}
else {
    $distance = intval( $_GET['distance'] ) > INSTAGRAM_MAX_DISTANCE || intval( $_GET['distance'] ) < 0
        ? INSTAGRAM_DEFAULT_DISTANCE
        : intval( $_GET['distance'] );
}

$max_id = isset( $_GET['max_id'] ) ? $_GET['max_id'] : null;

$instagram = new Instagram\Instagram;
if ( isset( $_SESSION['instagram_access_token'] ) ) {
    $instagram->setAccessToken( $_SESSION['instagram_access_token'] );
}else {
    $instagram->setClientId( INSTAGRAM_CLIENT_ID );
}

$tag = $instagram->getTag( $_GET['tag'] );
$tag_media_count = $tag->getMediaCount();

if ( !$tag_media_count ) {
    die( json_encode( array( 'error' => 'Tag does not exist.' ) ) );
}

$params = array(
   'distance'       => $distance,
   'max_id'         => $max_id
);

$media = $tag->getMedia( $params );

$output = array();
$output['unlocated'] = 0;
$output['photos'] = array();
$output['total_photos'] = $tag->getMediaCount();
foreach( $media as $m_i => $m ) {
    //$m_latlng = new \PHPGoogleMaps\Core\LatLng( $m->getLocation()->getLat(), $m->getLocation()->getLng() );
    if ( $m->hasLocation() ) {
        $caption = $m->getCaption();
        $output['photos'][] = array(
            'thumbnail'         => $m->getThumbnail()->url,
            'user'              => $m->getUser()->getUserName(),
            'created_time'      => $m->getCreatedTime(),
            'caption'           => $caption ? $caption->getText() : null,
            'link'              => $m->getLink(),
            'lat'               => $m->getLocation()->getLat(),
            'lng'               => $m->getLocation()->getLng(),
            'photo'             => $m->getStandardRes()->url,
            'id'                => $m->getId(),
            'marker_id'         => $m_i
        );
    }
    else {
        $output['unlocated']++;
    }
}

$output['max_id'] = $media->getNext();

header( 'Content-type: application/json' );
die( json_encode( $output ) );

