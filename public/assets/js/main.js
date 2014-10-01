$(function(){
    var user_id = $('#set_user_id').data('value');
    var video_id = $('#set_video_id').data('value');
    if($('.stats').length > 0){
        $.ajax({
            url: base_url + "/getprofilestats",
            type: "get",
            data: { user_id: user_id  },
            success: function( data ){

                $('#get_total_subscribes').hide().html( data.subscribes ).fadeIn(200);
                $('#get_total_videos').hide().html( data.videos ).fadeIn(200);

            }
        });
    }

    if($('.video-tags').length > 0){
        $.ajax({
            url: base_url + "/getvideotags",
            type: "get",
            data: { video_id: video_id  },
            success: function( data ){

                var html = '';
                if(data.length > 0){
                    html += '<ul class="list-unstyled list-inline">';


                    for (var i = 0; i < data.length; i++) {
                        html += '<li class="tag"><a href="'+ base_url + '/videotag/'+data[i].name+'" class="btn">'+data[i].name+',</a></li>';


                    }

                    html += '</ul>';

                    $('.video-tags').hide().html( html ).fadeIn(200);

                    $('.tag').css({'padding': '0'});
                    $('.tag a').css({'color': '#fff', 'font-weight': 'bold'});
                    $('.tag .btn').css({'padding': '0 3px'});
                }



            }
        });
    }

    //jscroll initialize
    $('.infinite-scroll').jscroll();

    console.log('scripts/main');
});