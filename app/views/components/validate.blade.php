@if (Session::has('error'))
<div class="alert alert-danger session-alert">
	<span class="glyphicon glyphicon-warning-sign"></span><span> <b>{{ Session::get('error') }}</b></span>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-danger session-alert">
	<span class="glyphicon glyphicon-warning-sign"></span><span> <b>{{ Session::get('success') }}</b></span>
</div>
@endif

@include('errors.validate')