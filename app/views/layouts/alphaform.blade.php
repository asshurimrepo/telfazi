@include('layouts.others.header')

<div class="squad">
	<div class="container">
		<div class="row">
			@include('layouts.others.topnotify')
		</div>
		<div class="separator-space-sm"></div>
		
		@yield('content')

		<div class="separator-space"></div>
	</div>
</div>

@include('layouts.others.footer')

