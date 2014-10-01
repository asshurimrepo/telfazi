@if ( $errors->count() > 0 )
  <p>The following errors have occurred:</p>

  <ul>
    @foreach( $errors->all() as $message )
      <li>{{ $message }}</li>
    @endforeach
  </ul>
@endif