

<form action="{{ URL::to('video/save/'. $video->id) }}" method="post" style="text-align:left">
		<input type="hidden" name="video_id" value="{{ $video->id }}">

		<div class="form-group">
		    <label for="exampleInputEmail1" class="col-sm-2 ">Title</label>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" name="title" value="{{ $video->title }}">
		    </div>
		    <div class="clearfix separator-space-sm"></div>
		</div>

		<div class="form-group">
		    <label for="exampleInputEmail1" class="col-sm-2 ">Description</label>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" name="description" value="{{ $video->description }}">
		    </div>
		    <div class="clearfix separator-space-sm"></div>
		</div>

		<div class="form-group">
		    <label for="exampleInputEmail1" class="col-sm-2 ">Category</label>
		    <div class="col-sm-10">
		    	<?php $cats = array(); ?>
		    	@foreach(Category::getAll(Session::get('lang_id')) as $cat)
                
                <?php $cats[$cat->id] = $cat->name; ?>  

            	@endforeach


		    	@if($video->videocategory) 
		    		{{ Form::select('category', $cats, $video->videocategory->category->id ,array('class'=>"form-control")) }}<br>
		    	@else 
		    		{{ Form::select('category', $cats, '' ,array('class'=>"form-control")) }}<br>
		    	@endif
		    </div>
		</div>

		<div class="form-group">
		    <label for="exampleInputEmail1" class="col-sm-2 ">Duration</label>
		    <div class="col-sm-10">
		        <p class="form-control-static">{{ $video->getDuration() }}</p>
		    </div>
		    <div class="clearfix separator-space-sm"></div>
		</div>

		<div class="form-group">
		    <label for="exampleInputEmail1" class="col-sm-2 ">Size</label>
		    <div class="col-sm-10">
		       <p class="form-control-static"> {{ $video->size ? Util::formatBytes($video->size, 1) : '' }}</p>
		    </div>
		    <div class="clearfix separator-space-sm"></div>
		</div>

		<div class="form-group">
		    <label for="exampleInputEmail1" class="col-sm-2 ">Tags</label>
		    <div class="col-sm-10">
		    	
		    	@include('components.tagging')
		    	
		    </div>
		    <div class="clearfix separator-space-sm"></div>
		</div>
		<div class="pull-right">
			<input type="submit" name="submit" value="Save" class="btn btn-primary btn-sm " />
		</div>
	</form>

