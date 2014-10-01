@include('layouts.others.header', array('fixed_top' => true))

<style type="text/css">
.header-menu .feat:hover { color:#fff !important; background: none; }
.header-menu .feat:hover, .header-menu .active {
  color:#fff !important; 
  -webkit-box-shadow: none;
  -moz-box-shadow:    none;
  box-shadow:         none;
  background: none;
}
</style>

<div class="squad">
	<div class="container-fluid profile-fluid">
		
		
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar nopadd">
				@include('user.components.sidebar')
	        </div>


			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				@include('components.validate')

				<div style="margin-top:50px;"></div>
				
				@include('user.components.profilestats')

				<div class="separator-space-sm"></div>

				@yield('content')

			</div>
		</div>
	</div>
</div>
<style type="text/css">

</style>
@include('layouts.others.footer', array('enable_footer' => false))




