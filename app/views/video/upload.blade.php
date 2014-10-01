@extends('layouts.alpha')

@section('content')

<div class="separator-space-xsm"></div>

<div class="row admin-nav">
    <div class="col-md-2">
        @include('user.components.sidebar')
    </div>
    <div class="col-md-10">
        <h4 style="margin-top:0px; color: #fff;">Upload Videos</h4>
        <div id="videoliked">
            <script type="text/javascript">
                $(document).ready(function() {
                    var counter = 0;
                    $("#file_upload").uploadify({
                        'uploader'      : '{{ URL::to("/assets/js/uploadify/uploadify.swf") }}',
                        'buttonText'    : 'Browse',
                        'cancelImg'     : '{{ URL::to("/assets/js/uploadify/cancel.png") }}',
                        'script'        : 'http://{{ $bucket }}.s3.amazonaws.com/',
                        'scriptAccess'  : 'always',
                        'method'        : 'post',
                        'scriptData'    : {
                            "AWSAccessKeyId"            : "{{ $awsAccessKeyId }}",
                            "key"                       : "${filename}",
                            "acl"                       : "authenticated-read",
                            "policy"                    : "{{ $policy }}",
                            "signature"                 : "{{ $signature }}",
                            "success_action_status"     : "201",
                            "key"                       : encodeURIComponent(encodeURIComponent("{{ $folder }}${filename}")),
                            "fileext"                   : encodeURIComponent(encodeURIComponent("")),
                            "Filename"                  : encodeURIComponent(encodeURIComponent(""))
                        },
                        'fileExt'       : '*.*',
                        'fileDataName'  : 'file',
                        'simUploadLimit': 2,
                        'multi'         : true,
                        'auto'          : true,
                        'onError'       : function(errorObj, q, f, err) { console.log(err); },
                        'onComplete'    : function(event, ID, file, response, data) { 
                            
                            var bucket = $(response).find("Bucket").text();
                            var url = $(response).find("Location").text();
                            var key = $(response).find("Key").text();

                            $.ajax({
                                type: 'post',
                                url: '{{ URL::to("saveVideo/" . $channelID ) }}',
                                data: {
                                    fileData: JSON.stringify( file ),
                                    name: file.name,
                                    type: file.type,
                                    size: file.size,
                                    bucket: bucket,
                                    url: url,
                                    key: key
                                } })
                            .done(function( data ){
                                counter++;
                                //makes the view replace the html instead of reload the page.
                                $('#video-container').load('{{ url("recentuploads") }}');
                            });

                        } /*end onComplete*/
                    });
                });

            </script>

            

            <div class='text-center'>
                <input type='file' id='file_upload' name='file_upload' />
            </div>


            <div class="separator-space"></div>

            <div id="video-container">
                <!-- insert all the videos uploaded here -->

                @include('video.lists.newuploads')


            </div>
        </div>
    </div>
</div>

@stop


