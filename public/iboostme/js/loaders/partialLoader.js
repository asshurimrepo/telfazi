$(function(){
    if($('div[data-partial]').length > 0){
        var loaders = $('div[data-partial]');

        loaders.each(function(e){
            var loader = $(this);
            var url     = loader.data('url');
            var type    = loader.data('type') != undefined ? loader.data('type') : 'get';
            var data    = loader.data('params') != undefined ? loader.data('params') : {};
            $.ajax({
                url     : url,
                type    : type,
                data    : data,
                dataType: 'json',
                success :function( response ){
                    console.log( response );
                    loader.hide().html( response.html ).fadeIn( 200 );
                }
            });
        });

    }
});