var TagGalleryLoader = GalleryLoaderAbstract.extend( function ( tag ) {
    this.tag = tag;
    this.api_url = "/api?method=tag&tag=" + this.tag + "&max_id=";
    this.max_id = null;
})
.methods({

    getApiUrl: function(){
        return this.api_url + this.max_id;
    },

    handleData: function( data ){
        if( data.max_id === null ) {
            this.complete = true;
            this.log( '! Complete' );
        }
        else {
            this.max_id = data.max_id;
        }
        this.renderView( data.photos );
    }

});