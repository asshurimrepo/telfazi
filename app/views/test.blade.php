{{--@if($v)
        {{$v->id}}
        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title"><b>New Video</b></h3>
            </div>
            <div class="panel-body">
                <div class="row recommended">
                    <div class="col-md-3">
                        <div class="vidThumb">
                            <div style="background: url({{ $v->getThumbnail() }}) no-repeat center;
                                background-size:cover;">
                                <a href="{{ URL::to('watch/'.$v->id) }}">
                                  <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-ver ">
                                </a>
                            </div>

                            <span class="date">{{ date('F d Y', strtotime($v->created_at)) }}</span>
                        </div>
                    </div>

                    <div class="col-md-9">
                        @if($v)
                            @include('video.detail.editform', array('video' => $v))
                        @endif
                    </div>

                </div>

            </div>
        </div>

        @endif--}}