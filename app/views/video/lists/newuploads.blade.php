@if(count($videos) > 0)
    @foreach($videos as $v)

        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title"><b>New Video</b></h3>
            </div>
            <div class="panel-body">
                <div class="row recommended" style="padding:20px">

                    @include('layouts.home.carousel.vidsmall', [
                        'v' => $v,
                        'disable_caption' => true,
                        'columnClass' => 'col-md-3'])

                    <div class="col-md-9">
                        @if($v)
                            @include('video.detail.editform', array('video' => $v))
                        @endif
                    </div>

                </div>

            </div>
        </div>

    @endforeach

@endif