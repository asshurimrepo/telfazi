<form action="{{ URL::to('search')}}" method="get">
	<div class="input-group input-group-sm"> <!-- input group -->
		<!-- <input type="text" class="form-control" placeholder="search"> -->
		
		<input type="text" id="" name="q" placeholder="Search videos..." class="form-control" />
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">
			 Go!
			</button>
		</span>
		
	</div><!-- /input-group -->
</form>
