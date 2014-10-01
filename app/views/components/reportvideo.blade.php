@if( !$isReported )
	<div class="list-group">
		<form action="" method="post" id="reportForm">
			<input type="hidden" name="video_id" value="{{ $video->id }}" />
			@foreach( $reports as $re )
				<div class="radio">
				  <label>
				    <input type="radio" name="report" id="optionsRadios1" class="radiobtn" value="{{ $re->id }}">
				    {{ $re->report_name }}
				  </label>
				</div>
				
			@endforeach
		</form>
		<div class="separator-space-sm"></div>
		<input type="submit" name="submit" id="reportSubmit" class="btn btn-danger btn-sm" value="Submit Report"/>
	</div>
@else
	<div class="text-center"> This video is reported as. 
		<span class="btn btn-danger btn-xs">{{ $videoReport->report->report_name }}</span> 
	</div>
@endif
<script type="text/javascript">
	$('#reportSubmit').click(function(e){
		e.preventDefault();

		var formdata = $('#reportForm').serializeArray();

		$.ajax({
			url: "{{ URL::to('reportTo') }}",
			data : formdata
		}).done(function( response ){
			console.log(response);
		});

	});

</script>