var GalleryLoaderAbstract = klass(function(){

    this.gallery_id = "#medialist";
    this.gallery_markup = "<li><a rel=\"lightbox[geogram]\" title=\"${caption}\" data-id=\"photo_${unique_id}\" class=\"geogram\" id=\"photo_${unique_id}\" href=\"${photo}\"><img src=\"${thumbnail}\"></a></li>";
    this.gallery_template_name = "gallery_li";
    this.gallery_template = $.template( this.gallery_template_name, this.gallery_markup );

    this.photos = [];
    this.photo_ids = [];
    this.api_url = null;
    // All available photos have been loaded
    this.complete = false;
    // Current queue of photos has been loaded
    this.done_loading = false;
    this.logging = false;

    this.onload_functions = [];

    this.percent_loaded = 0;

    this.current_number_photos_to_load = null;

    this.current_photos = [];

})
.methods({

    addOnloadFunction: function( $function ){
        this.onload_functions.push( $function );
    },

    performOnloadFunctions: function( photos ) {
        for ( var i in this.onload_functions ){
            this.onload_functions[i]( photos );
        }
    },

    enableLogging: function() {
        this.logging = true;
    },

    disableLogging: function() {
        this.logging = false;
    },

    log: function( text ) {
        if( this.logging ) {
            console.log( text );
        }
    },

    isComplete: function(){
        return this.complete;
    },

    isDoneLoading: function(){
        return this.done_loading;
    },

    deleteDuplicatesAndAddPhotos: function( data ){
        t = this;
        uniques = [];
        $.each(data.photos, function(i,v){
            if( $.inArray( v.id, t.photo_ids ) == -1 ){
                uniques.push( v );
                t.photos.push( v );
                t.photo_ids.push( v.id );
            }
       });
        return uniques;
    },

    getTotalLoadedPhotoCount: function(){
        return this.photos.length;
    },

    load: function( number_to_load, async ){
        if ( this.current_number_photos_to_load === null ) {
            this.current_number_photos_to_load = number_to_load;
        }
        number_to_load = typeof number_to_load == 'undefined' ? 20 : number_to_load;
        async = typeof async == 'undefined' ? true : async;
        this.done_loading = false;
        var t = this;
        this.log( "! Loading more photos from " + this.getApiUrl() );
        $.when(
            $.ajax({
                url: this.getApiUrl(),
                async: async,
                success: function(data){
                    data.photos = t.deleteDuplicatesAndAddPhotos( data );
                    t.current_photos = data.photos;
                    t.preloadImages( data.photos );
                    t.handleData(data);
                    t.log( "+ Added " + data.photos.length + " photos" );
                }
            })
        ).done(
            function(){
                number_to_load = number_to_load !== null ? number_to_load - t.current_photos.length : number_to_load;
                if( !t.complete && ( number_to_load === null || number_to_load > 0 ) ) {
                    t.load( number_to_load, async );
                }
                else {
                    t.done_loading = true;
                    t.current_number_photos_to_load = 0;
                }
                if ( t.onload_functions.length ) {
                    t.performOnloadFunctions( t.current_photos );
                }
            }
        );
    },

    preloadImages: function( photos ) {
        preloaded_images = [];
        for( var i in photos ){
            preloaded_images[i] = new Image();
            preloaded_images[i].src = photos[i].thumbnail;
        }
    },

    renderView: function( photos ) {
        $.tmpl( this.gallery_template, photos ).appendTo( this.gallery_id );
    }

});