var map = new google.maps.Map(document.getElementById("map"), { mapTypeId: google.maps.MapTypeId.ROADMAP });
var map_markers = [];
var bounds = new google.maps.LatLngBounds();
google.maps.Map.prototype.clear = function() {
    for (var i = 0; i < map_markers.length; i++ ) {
        map_markers[i].setMap(null);
    }
};
function update_map( photos ){
    var map_markers = {};
    for( i=0;i<photos.length;i++ ){
        id = "photo_" + photos[i].unique_id;
        map_markers[id] = new google.maps.Marker({
            position: new google.maps.LatLng( photos[i].lat, photos[i].lng ),
            map: map,
            photo: '#' + id,
            animation: google.maps.Animation.DROP
        });
        google.maps.event.addListener( map_markers[id], 'click', function(){ $( this.photo ).trigger( "click" ); } );
        google.maps.event.addListener( map_markers[id], 'mouseover', function(){ $( this.photo ).addClass('mapover') } );
        google.maps.event.addListener( map_markers[id], 'mouseout', function(){ $( this.photo ).removeClass('mapover') } );
        bounds.extend( map_markers[id].position );
        $( '#' + id ).mouseover(function(){
            map_markers[$(this).attr("id")].setAnimation(google.maps.Animation.BOUNCE);
        });
        $( '#' + id ).mouseout(function(){
            map_markers[$(this).attr("id")].setAnimation(null);
        });

    }
    map.fitBounds(bounds);
}