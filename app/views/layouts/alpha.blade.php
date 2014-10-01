@include('layouts.others.header')

@include('layouts.others.subheader')

<div class="squad">
	<div class="container-fluid profile-fluid">
		<div class="row vidlist">
			
			@include('layouts.others.topnotify')
			
			
		</div>

		@include('components.mpu', array('size' => '728x90'))

		<div class="separator-space-sm"></div>

		@yield('content')

		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="separator-space"></div>
			</div>	
		</div>

		
	</div>
</div>

@include('layouts.others.footer')

