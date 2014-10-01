@extends('layouts.alphaprofile')

@section('content')
<div class="row">
  <div class="col-lg-8">
  	
  </div>
  <div class="col-lg-4">
  	<form action="{{ URL::to('smv')}}" method="post" id="target" >
		<div class="input-group input-group-sm">
			<input type="text" class="form-control" name="q" placeholder="Search uploads..." id="searchfield">
				<span class="input-group-btn">
				<button type="submit" class="btn btn-default" type="button" id="searchbtn"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</form>
  </div>
</div>

<div class="separator-space-xsm"></div>

<div class="row">
	<div class="col-md-12"> 
		
		<div id="myvideos">

			@include('video.lists.myvideos')

		</div>
		@if( count($videos) >= $take)
			<div class="row">
				<div class="col-md-9 col-md-offset-2">
					<button  type="button" id="2" data-loading-text="Fetching..." class="btn btn-block btn-warning show_more">
					Show More <span class="glyhpicon glyphicon-plus" ></span>
				</button>
				</div>
			</div>
		@endif
	</div>
</div>

<script type="text/javascript">
	
	$('#target').submit(function(e){
		e.preventDefault();

		var query = $('#searchfield').val();

		$('#myvideos').load('{{ URL::to("mysearch") }}', { q: query });
	});



	var page = 0;
	$('.show_more').click(function(){
		page = this.id;
		$.ajax({
			url:"{{ url( $urlback ) }}",
			type:"post",
			data: { getLastPage: this.id },
			cache: false,
			success: function( html ){
				var npage = parseInt(page) + 1;

				console.log(html);

				if(html){
					$('#myvideos').append(html);
					$('.show_more').attr('id', npage);
				}else{
					
					$('.show_more').attr('disabled', 'disabled');
				}
				
			}
		});
	});

</script>
@stop


