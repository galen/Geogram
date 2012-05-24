var MediaSearchGalleryLoader = GalleryLoaderAbstract.extend( function ( lat, lng, distance ) {
    this.lat = lat;
    this.lng = lng;
    this.api_url = "/api/?method=media_search&lat=" + this.lat + "&lng=" + this.lng + "&distance=" + distance + "&max_timestamp=";
    this.max_timestamp = null;
})
.methods({

    getApiUrl: function(){
        return this.api_url + this.max_timestamp;
    },

    handleData: function( data ){
        if( data.max_timestamp === this.max_timestamp ) {
            this.complete = true;
            this.log( '! Complete' );
        }
        else {
            this.max_timestamp = data.max_timestamp;
        }
        
        this.renderView( data.photos );
    }

});