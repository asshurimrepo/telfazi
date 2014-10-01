@extends('layouts.alphaprofile')

@section('content')

<div class="row">
  <div class="col-md-12">

    @if( !$isViewing )
    <div class="pull-right">
      <button class="btn btn-primary " data-toggle="modal" data-target="#myModal">
        Create New Channel
      </button>
    </div>
    @endif

  </div>
</div>
  
  <div class="separator-space-sm"></div>

  {{-- @include('channel.lists.mychannels') --}}


<div class="row vidlist">
               
  @if(count($channels) > 0 )
    @foreach( $channels as $c )
      @include('layouts.home.carousel.chansmall', array('c' => $c)) 
    @endforeach
  @endif
  
</div>



  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ URL::to('mytv/channels/create') }}" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Channel</h4>
      </div>
      <div class="modal-body"> 
            <div class="form-group">
                    <label for="" class="col-sm-2">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="channel_name" value="">
                    </div>
                    {{ $errors->first('channel_name') }} <br>
                </div>

                <div class="separator-space"></div>

                <div class="form-group">
                    <label for="" class="col-sm-2">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="channel_description" value="">
                    </div>
                    {{ $errors->first('channel_description') }} <br>
                </div>

                <div class="separator-space"></div>

                <div class="form-group">
                    <label for="" class="col-sm-2">Category</label>
                    <div class="col-sm-10">
                         <?php $cats = array(); ?>
                          @foreach(Category::getAll(Session::get('lang_id')) as $cat)
                            <?php $cats[$cat->id] = $cat->name; ?>  
                          @endforeach

                          {{ Form::select('category', $cats, '' ,array('class'=>"form-control")) }}<br>
                    </div>
                    {{ $errors->first('category') }} <br>
                </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="create_channel" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
  </form>
  </div>
@stop


