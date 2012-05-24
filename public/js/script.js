$(function() {

var gallery_loader;

switch( $("body").attr( "id" ) ) {

    case 'search':
        $( "#distance_slider" ).slider({
            range: "min",
            value: location_search_distance_default,
            min: location_search_distance_min,
            max: location_search_distance_max,
            slide: function( event, ui ) {
                $("#distance_value").html( ui.value );
            },
            stop: function( event, ui ){
                $("#location_chooser li a").each(function(){
                    $(this).attr('href', $(this).data('tpl').replace('##distance##', ui.value ) );
                });
            }
        });

        search_options = [];
        search_options['user'] = {};
        search_options['tag'] = {};
        search_options['location'] = {};
        search_options['user'].api_url = '/api/?method=user_search&username=';
        search_options['user'].error = 'Please enter a username';
        search_options['user'].template = "<li><a href=\"/user/${username}/\">${username}</a></li>";
        search_options['tag'].api_url = '/api/?method=tag_search&tag=';
        search_options['tag'].error = 'Please enter a tag';
        search_options['tag'].template = "<li><a href=\"/tag/${tag}/\">${tag}</a></li>";
        search_options['location'].api_url = '/api/?method=geocode&location=';
        search_options['location'].error = 'Please enter a location';
        search_options['location'].template = "<li><a data-tpl=\"/location/${lat},${lng}/##distance##/${location_encoded}/\" href=\"/location/${lat},${lng}/${distance}/${location_encoded}/\">${location}</a></li>";
        $("#search_options form").submit(function(){
            var search_type = $(this).data("search-type");
            if ( $("#search_" + search_type +"_text").val().trim() === '' ) {
                alert( search_options[search_type].error );
                return false;
            }
            $("#search_" + search_type +"_form .ajax_loader").show();
            $.getJSON( search_options[search_type].api_url + $("#search_" + search_type +"_text").val(), function(data) {
                for ( var d in data ) {
                    data[d].distance = $("#distance_value").html();
                }
                if( data.error ){
                    alert( data.error );
                }
                else {
                    $("#" + search_type + "_chooser").empty();
                    $("#search_" + search_type + "_results").show();
                    var template = $.template( search_type + "_chooser", search_options[search_type].template );
                    $.tmpl( search_type +"_chooser", data ).appendTo( "#" + search_type +"_chooser" );
                }
                $("#search_" + search_type +"_form .ajax_loader").hide();
            });
            return false;
        });
        break;

    case 'user':
        gallery_loader = new UserGalleryLoader( username );
        gallery_loader.addOnloadFunction( function (){ if ( t.isDoneLoading() ) { $("#loader").fadeOut(); } } );
        gallery_loader.addOnloadFunction( function (){ update_map( t.current_photos ); } );
        gallery_loader.enableLogging();
        gallery_loader.load(photo_load_num);
        break;

    case 'user_all':
        gallery_loader = new UserGalleryLoader( username );
        gallery_loader.addOnloadFunction( function (){ if ( t.getTotalLoadedPhotoCount() >= photo_load_num ) { $("#loader").fadeOut(); } } );
        gallery_loader.addOnloadFunction( function (){ update_map( t.current_photos ); } );
        gallery_loader.enableLogging();
        gallery_loader.loadAll();
        break;

    case 'location':
        gallery_loader = new MediaSearchGalleryLoader( lat, lng, distance );
        gallery_loader.addOnloadFunction( function (){ if ( t.isDoneLoading() ) { $("#loader").fadeOut(); } } );
        gallery_loader.addOnloadFunction( function (){ update_map( t.current_photos ); } );
        gallery_loader.enableLogging();
        gallery_loader.load(photo_load_num);
        break;

    case 'location_me':
        geolocation_success = function(position){
            gallery_loader = new MediaSearchGalleryLoader( position.coords.latitude, position.coords.longitude );
            gallery_loader.addOnloadFunction( function (){ if ( t.isDoneLoading() ) { $("#loader").fadeOut(); } } );
            gallery_loader.addOnloadFunction( function (){ update_map( t.current_photos ); } );
            gallery_loader.enableLogging();
            gallery_loader.load(photo_load_num);
        };
        geolocation_error = function(){
            alert( 'Error finding your location' );
        };
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(geolocation_success, geolocation_error, {enableHighAccuracy: true, timeout: 10000});
        } else {
            alert('Your browser does not support geolocation');
        }
        break;

    case 'tag':
        gallery_loader = new TagGalleryLoader( tag );
        gallery_loader.addOnloadFunction( function (){ $("#loader").fadeOut(); } );
        gallery_loader.addOnloadFunction( function (){ update_map( t.current_photos ); } );
        gallery_loader.enableLogging();
        gallery_loader.load(photo_load_num);
        break;

}

$("#medialist_container").scroll(function(){
    if ( $("#medialist_container").scrollTop() == $("#medialist_container")[0].scrollHeight - $("#medialist_container").height() ) {
        if ( gallery_loader.isComplete() ) {
            return false;
        }
        gallery_loader.log("! Scrolled to the bottom. Loading more photos.");
        gallery_loader.addOnloadFunction( function (){ update_map( t.current_photos ); } );
        gallery_loader.addOnloadFunction( function (){ $("#status").html( "Loading..." ); } );
        gallery_loader.load(photo_load_num);
    }
});


});