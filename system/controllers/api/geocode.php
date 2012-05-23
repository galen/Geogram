<?php

$map_loader = new SplClassLoader('PHPGoogleMaps', DIR_LIB );
$map_loader->register();

$output = array();

$geocode_result = \PHPGoogleMaps\Service\Geocoder::geocode( $_GET['location'] );

if ( $geocode_result instanceof \PHPGoogleMaps\Service\GeocodeResult ) {
    // If more than one result was found we are going to give the user an option to pick one
    foreach( $geocode_result->response->results as $location ){
        $output[] = array(
            'location'          => $location->formatted_address,
            'location_encoded'  => urlencode( $location->formatted_address ),
            'lat'               => $location->geometry->location->lat,
            'lng'               => $location->geometry->location->lng,
        );
    }
    die( json_encode( $output ) );
}
else {
    die( json_encode( array( 'error' => 'Error geocoding location' ) ) );
}