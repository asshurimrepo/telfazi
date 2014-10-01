@extends('layouts.alphaprofile')



<?php
if($user->information){
    $profilepicture = $user->information->getProfilePicture();
}else{
    $profilepicture = asset('assets/img/profile_placeholder.jpg');
}
?>
@section('content')
 <h4 style="margin-top:0px; ">My Profile</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="vidThumb">
                <div style="background: url({{ $user->getThumbnail() }}) no-repeat center; 
                background-size:cover;">
                    <a href="#">
                        <img src="{{ asset('assets/img/profile_cover.png') }}">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <style>
    .user-form label { color:#fff }
    </style>
    <div class="row">
        <div class="col-md-6">
        {{ Form::open([
            'url' => 'mytv/profile/image',
            'method' => 'post',
            'encrypt' => 'multipart/form-data',
            'class' => 'user-form'
        ]) }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    {{ Form::file('image', ['style'=>'display:inline']) }}
                    {{ $errors->first('image') }}
                    {{ Form::submit('Upload', ['name' => 'submit', 'class' => 'btn btn-orange btn-sm', 'style'=>'width:34%']) }}
                </div>
            </div>

        {{ Form::close() }}
        </div>
    </div>
    <div class="clearfix separator-space-sm"></div>
    <div class="row">
        <div class="col-md-6">
        {{-- Iterate over a user data --}}
        @if(isset($user))
            {{ Form::open([
                'url' => 'mytv/profile/save',
                'method' => 'POST',
                'class' => 'user-form',

            ]) }}
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-2 ">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" value="{{ $user->first_name }}"> 
                    </div>
                     {{ $errors->first('firstname') }} <br>
                </div>
                <div class="clearfix separator-space-sm"></div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-2">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" value="{{ $user->last_name }}">
                    </div>

                    {{ $errors->first('lastname') }} <br>
                </div>
                <div class="clearfix separator-space-sm"></div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-2">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    </div>
                    {{ $errors->first('username') }} <br>
                </div>
                <div class="clearfix separator-space-sm"></div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                    {{ $errors->first('email') }} <br>
                </div>
                <div class="clearfix separator-space-sm"></div>
                
                <div class="row">
                    <div class="col-md-3">
                        <input type="submit" name="edit_user" value="Update" class="btn btn-orange btn-sm btn-block" />
                    </div>
                </div>
            {{ Form::close() }}
        @endif
        </div>
    </div>

    <div class="separator-space"></div>
@stop

