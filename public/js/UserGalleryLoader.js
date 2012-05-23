var UserGalleryLoader = GalleryLoaderAbstract.extend( function ( username ) {
    this.username = username;
    this.api_url = "/api?method=user&username=" + this.username + "&max_id=";
    this.max_id = null;
    this.tag = null;
    this.total_photos = 0;
})
.methods({

    getTotalPhotos: function(){
        return this.total_photos;
    },

    getApiUrl: function(){
        return this.api_url + this.max_id;
    },

    handleData: function( data ){
        this.total_photos = data.total_photos;
        if( data.max_id === null ) {
            this.complete = true;
            this.log( '! Complete' );
        }
        else {
            this.max_id = data.max_id;
        }
        this.renderView( data.photos );
    },

    loadAll: function( async ){
        async = typeof async == 'undefined' ? true : async;
        this.load( null, async );
    }
});