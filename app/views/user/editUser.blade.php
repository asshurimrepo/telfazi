<h2> Account Options </h2>
<a href="{{ URL::to('users') }}"> View users </a>

<?php

// If there is a flash data session
if(Session::has('success')){
    echo  '<br>' . Session::get('success') . '<br>';
}

?>

<?php
    // Iterate over a user data
    if(isset($user)){ ?>
        <form action="{{ URL::to('/user/update') }}" method="POST">
            <input type="hidden" name="user_id" value="{{ $user->id_code }}" /><br>
            <label for="">First Name:</label><br>
            <input type="text" name="firstname" value="{{ $user->firstname }}"/><br>
            {{ $errors->first('firstname') }} <br>

            <label for="">Last Name:</label><br>
            <input type="text" name="lastname" value="{{ $user->lastname }}" /><br>
            {{ $errors->first('lastname') }}<br>

            <label for="">Username:</label><br>
            <input type="text" name="username" value="{{ $user->username }}"/><br>
            {{ $errors->first('username') }}<br>

            <label for="">Email:</label><br>
            <input type="text" name="email" value="{{ $user->email }}" /><br>
            {{ $errors->first('email') }}<br>

            <input type="submit" name="edit_user" value="Submit" />
        </form>
    <?php
    }
?>

