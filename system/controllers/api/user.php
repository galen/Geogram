<?php

$gmap_loader = new SplClassLoader( 'PHPGoogleMaps', DIR_LIB );
$gmap_loader->register();

$max_id = isset( $_GET['max_id'] ) && $_GET['max_id'] != 'null' ? $_GET['max_id'] : null;
$username = $_GET['username'];

$instagram = new Instagram\Instagram;
$instagram->setAccessToken( $_SESSION['instagram_access_token'] );

$params = array(
   'max_id'  => $max_id
);

$user = $instagram->getUserByUsername( $username );

$media = $user->getMedia( $params );

if( !count( $media ) ) {
    header( 'Content-type: application/json' );
    die( json_encode( array( 'error' => 'Error loading the photos' ) ) );
}

$tags_closure = function($m){
    return sprintf( '<a href="/tag/%s/">%s</a>', $m[1], $m[0] );
};

$mentions_closure = function($m){
    return sprintf( '<a href="/user/%s/">%s</a>', $m[1], $m[0] );
};


$output = array();
$output['unlocated'] = 0;
$output['photos'] = array();
$output['total_photos'] = $user->getMediaCount();
foreach( $media as $m_i => $m ) {

	if ( $m->hasLocation() ) {
	    $caption = $m->getCaption();
	    $output['photos'][] = array(
	        'thumbnail'         => $m->getThumbnail()->url,
	        'user'              => $m->getUser()->getUserName(),
	        'created_time'      => $m->getCreatedTime(),
	        'caption'           => $caption ? \Instagram\Helper::parseTagsAndMentions( $caption, $tags_closure, $mentions_closure ) : null,
	        'link'              => $m->getLink(),
	        'lat'               => $m->getLocation()->getLat(),
	        'lng'               => $m->getLocation()->getLng(),
            'tags'              => $m->getTags()->toArray(),
	        'photo'             => $m->getStandardRes()->url,
	        'id'                => $m->getId(),
            'unique_id'         => md5( $m->getLink() )
	    );
	}
    else {
        $output['unlocated']++;
    }
}

$output['max_id'] = $media->getNext();

header( 'Content-type: application/json' );
die( json_encode( $output ) );

