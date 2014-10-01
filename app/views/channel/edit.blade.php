<div>
    <img src="{{ $channel->getThumbnail() }}" width="236">
</div> 
<div class="separator-space-sm"></div>
<form action="{{ URL::to('mytv/channels/image') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="channel_id" value="{{ $channel->channel_id }}"/>
    <div class="form-group">
        <label for="" class="col-sm-2">Thumbnail</label>
        <div class="col-sm-10">
            <p class="form-control-static pull-left">{{ Form::file('image') }}</p>

            <button type="submit" name="image-upload" class="btn btn-primary btn-sm pull-right"> Upload </button>
        </div>
        {{ $errors->first('image') }} <br>
    

    </div>
</form>

<form action="{{ URL::to('mytv/channels/save') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="channel_id" value="{{ $channel->channel_id }}"/>

    <div class="form-group">
        <label for="" class="col-sm-2">ID</label>
        <div class="col-sm-10">
            <p class="form-control-static">{{ $channel->channel_id }}</p>
        </div>
        {{ $errors->first('channel_id') }} <br>
    </div>

    <div class="separator-space"></div>

    <div class="form-group">
        <label for="" class="col-sm-2">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="channel_name" value="{{ $channel->channel_name }}">
        </div>
        {{ $errors->first('channel_name') }} <br>
    </div>

    <div class="separator-space"></div>

    <div class="form-group">
        <label for="" class="col-sm-2">Description</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="channel_description" value="{{ $channel->channel_description }}">
        </div>
        {{ $errors->first('channel_description') }} <br>
    </div>

    <div class="separator-space"></div>

    <div class="form-group">
        <label for="" class="col-sm-2">Category</label>
        <div class="col-sm-10">
            <?php $cats = array(); ?>
            <?php $cats['0'] = ''; ?>
            
            @foreach(Category::all() as $cat)
                
                <?php $cats[$cat->id] = $cat->category_name; ?>  

            @endforeach


            @if($channel->channelcategory)
                <?php  $cid = $channel->channelcategory->category_id; ?>
            @else 
                <?php $cid = ''; ?>
            @endif


              {{ Form::select('category', $cats, "$cid", array('class'=>"form-control")) }}<br>
        </div>
        {{ $errors->first('category') }} <br>
    </div>

    <div class="pull-right">
      <button type="submit" name="create_channel" class="btn btn-primary btn-sm">Save changes</button>
    </div>
  </form>