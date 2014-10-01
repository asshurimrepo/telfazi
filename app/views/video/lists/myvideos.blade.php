<?php
$channel_id = $user->userChannels->first()->channel_id;

?>

@if(count($videos) > 0)
	@if(Session::get('lang') == 'ar')
	<table class="table table-striped" id="vidtable">
		<tbody>

			@foreach($videos as $v)
			<div class="line-separator"></div>
			<div class="row">
				<div class="col-md-9 col-sm-6 col-xs-6" style="padding:0; margin:0">
					<div class="pull-left video-like" style="">
						<ul class="list-inline pull-left">
							<li><i class="glyphicon glyphicon-thumbs-up"></i> {{ $v->likes() }}</li>
							<li><i class="glyphicon glyphicon-thumbs-down"></i> {{ $v->dislikes() }}</li>
						</ul>
					</div>
					<div class="pull-right video-desc">
						<span class="burb-sm">
							<a href="{{ URL::to('watch/'.$v->id) }}">
				        		<span class="burb-sm" > {{ $v->title }} </span>
				        	</a>
				    	</span>

						
						<form action="{{ URL::to('video/manage/'.$v->id ) }}" action="get">
							<div class="btn-group btn-group-xs">
						

								@if($v->trashed())
									<button type="submit" class="btn btn-danger" name="restore" value="{{ $v->id }}">Restore</button>
								@else
									<button type="submit" class="btn btn-default" name="edit" value="{{ $v->id }}">Edit</button>
									<button type="submit" class="btn btn-default" name="delete" value="{{ $v->id }}">Delete</button>

									@if(Auth::user()->isAdmin())
										asdasd
									@endif
								@endif
								
							</div>
						</form>
					</div>

					
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="vidThumb">
						<div style="background: url({{ $v->getThumbnail() }}) no-repeat center; 
							background-size:cover;">
							<a href="{{ URL::to('watch/'.$v->id) }}">
							  <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-ver ">
							</a>
						</div>
					</div>
				</div>
				
			</div>
			
			@endforeach
			
		</tbody>
	</table>
	@else 
	<table class="table table-striped" id="vidtable">
		<tbody>
			@foreach($videos as $v)
			<div class="line-separator"></div>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="vidThumb">
						<div style="background: url({{ $v->getThumbnail() }}) no-repeat center; 
							background-size:cover;">
							<a href="{{ URL::to('watch/'.$v->id) }}">
							  <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-ver ">
							</a>
						</div>
					</div>
					{{--<div class="boxy">
						@include('layouts.home.carousel.vidsmall', array('v'=>$v))
					</div>--}}
				</div>
				<div class="col-md-9 col-sm-6 col-xs-6" style="padding:0; margin:0">
					<div class="pull-left">
						<span class="burb-sm">
							<a href="{{ URL::to('watch/'.$v->id) }}">
				        		<span class="burb-sm"> {{ $v->title }} </span>
				        	</a>
				    	</span>
						<div class="date">{{ $v->getCreatedAt('F d Y')  }}</div>
						<div class="separator-space-xsm"></div>
						<div class="description" style="width:400px;"> {{ $v->getDescription() }}</div>
						
						<form action="{{ URL::to('video/manage/'.$v->id ) }}" action="get">
							<div class="btn-group btn-group-xs">
						
								@if($v->trashed())
									<button type="submit" class="btn btn-danger" name="restore" value="{{ $v->id }}">Restore</button>
								@else
									<button type="submit" class="btn btn-default" name="edit" value="{{ $v->id }}">Edit</button>
									<button type="submit" class="btn btn-default" name="delete" value="{{ $v->id }}">Delete</button>

									@if(Auth::user()->isAdmin())
										<button type="submit" class="btn btn-default" name="translate" value="{{ $v->id }}">Translate</button>
									@endif
								@endif
								
							</div>
						</form>
					</div>

					<div class="pull-right" style="padding-right: 20px;">
						<ul class="list-inline pull-right">
							<li><i class="glyphicon glyphicon-thumbs-up"></i> {{ $v->likes() }}</li>
							<li><i class="glyphicon glyphicon-thumbs-down"></i> {{ $v->dislikes() }}</li>
						</ul>
					</div>
				</div>
			</div>
			
			@endforeach
				

		</tbody>
	</table>
	@endif
	
@else
	<div class="alert alert-warning">
		<b> <i class="glyphicon glyphicon-warning-sign"></i> No Videos found </b> 
		<a href="{{ URL::to('upload') }}" class="btn btn-primary btn-xs">Upload</a>
	</div>
@endif
