@if($msg = Session::get('success'))
<h4> {{ 'Success: ' . $msg }} </h4>
@endif



@if($msg = Session::get('error'))
<h4> {{ 'Error: '. $msg }} </h4>
@endif



