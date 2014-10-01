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
			<div class="col-md-12" style="padding:12px">

				@include('components.validate')

			</div>
		</div>

		<div class="separator-space"></div>
		
		<div class="row ">
			<div class="col-md-2 col-sm-3" >
    			<div class="widget-box admin-nav">
					@include('user.sidebar.sidebar')
				</div>
			</div>
			
			<div class="col-md-10 col-sm-9">
				
				<div class="widget-box">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
</div>

@include('layouts.others.footer')




