@extends('layouts.alphaprofile')


@section('content')
<div class="row">
	<div class="col-md-12"> 
		<div class="pull-left">
		<span class="feeder-header "><b>Default Text</b></span> 	
		
		</div>

		
	</div>
</div>

<div class="separator-space-sm"></div>

<div class="form-group">
    <label for="exampleInputEmail1" class="col-sm-2 ">Title</label>
    <div class="col-sm-10">
        {{ $video->title }}
    </div>
    <div class="clearfix separator-space-sm"></div>
</div>
<div class="form-group">
	<label for="exampleInputEmail1" class="col-sm-2 ">Description</label>
	<div class="col-sm-10">
	    {{ $video->description }}
	</div>
	<div class="clearfix separator-space-sm"></div>
</div>


@if($lang_to_add)

<div class="row">
	<div class="col-md-12">
		<div class="pull-left">
				<span class="feeder-header "><b>Add Translation</b> :</span>
		</div>
	</div>
</div>
<div class="clearfix separator-space-sm"></div>

<form action="{{ URL::to('video/translate/'. $video->id) }}" method="post" style="text-align:left">
	<input type="hidden" name="video_id" value="{{ $video->id }}">
	<input type="hidden" name="language_id" value="1">
	
	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-2 ">Language</label>
	    <div class="col-sm-10">
	        {{ Form::select('language_id', $lang_to_add, null, ['class'=>'form-control']) }}
	    </div>
	    <div class="clearfix separator-space-sm"></div>
	</div>

	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-2 ">Title</label>
	    <div class="col-sm-10">
	        {{ Form::text('title', Input::old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Translation for Title']) }}
	    </div>
	    <div class="clearfix separator-space-sm"></div>
	</div>

	<div class="form-group">
	    <label for="exampleInputEmail1" class="col-sm-2 ">Description</label>
	    <div class="col-sm-10">
	    	{{ Form::text('description', Input::old('description'), ['class'=>'form-control', 'placeholder'=>'Enter Translation for Description']) }}
	    </div>
	    <div class="clearfix separator-space-sm"></div>
	</div>

	<div class="form-group">
	    <div class="col-sm-12">
	    	<div class="pull-right">
				<input type="submit" name="submit" value="Save" class="btn btn-primary " />
			</div>
	    </div>
	    <div class="clearfix separator-space-sm"></div>
	</div>
	
</form>

@endif



@if(count($video->translations))
<hr>


<table class="table table-bordered table-hover table-striped table-codensed">
	
	<thead>
		<tr>
			<th>Lang</th>
			<th>Title</th>
			<th colspan="2">Description</th>
		</tr>
	</thead>

	<tbody>
	@foreach($video->translations as $trans)
		<tr>
			<th>{{ $trans->language->language }}</th>
			<td>{{ $trans->title }}</td>
			<td>{{ $trans->description }}</td>
			<td>
				{{ Form::open(['method'=>'delete', 'url'=>'video/translate/'.$trans->id]) }}
						<div class="btn-group btn-group-xs">
							<button type="submit" class="btn btn-default">Delete</button>	
						</div>
				{{ Form::close() }}
			</td>
		</tr>
	@endforeach
	</tbody>

</table>

@endif


@stop