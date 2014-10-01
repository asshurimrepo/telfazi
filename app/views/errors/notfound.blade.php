@extends('layouts.alpha')


@section('content')
  
  <div class="notfound text-center">

    <h2><b>SORRY!</b></h2>
    <p><b>The page you were looking for could not be found</b></p>

    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="searchhub">
          <p>Try searching for videos here:</p>
          @include('components.search')
        </div>
      </div>
    </div>

  </div>

@stop


<style type="text/css">
.notfound{ color:#333; font-weight: bolder; font-family: 'Verdana' }
.notfound h2{  font-size: 50px; }
.notfound p{ color:#666; font-size: 20px;}
.notfound .searchhub p{ margin-top:60px; color:#333; text-align: left;  font-size: 14px;}
</style>