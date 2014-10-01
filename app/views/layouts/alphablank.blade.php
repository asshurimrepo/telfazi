@include('layouts.others.headerclean')

<div class="squad">
	<div class="container">
		<div class="separator-space-sm"></div>
		
		<div class="row" style="min-height:270px;">
			<div class="col-md-12">

				<div class="text-center">

					@yield('content')

				</div>

			</div>
		</div>

		<div class="separator-space"></div>
	</div>
</div>

@include('layouts.others.footerclean')