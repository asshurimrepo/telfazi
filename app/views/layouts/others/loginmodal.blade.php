@if(!Auth::check())

{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin:10px; position:absolute; left:auto; right:0; z-index: 99; ">&times;</button>
     	
     	<div class="modal-body">
     		<div class="row">
     			<div class="col-md-6" style="border-right: solid 1px #999;">
     				<p class="lead"><h3 style="text-align:center">Create Account <br /> <small>Create your account using</small> <br /><a href="#" onclick="checkLoginState();">{{ HTML::image('assets/img/fb.png', 'Facebook Register', array('style'=>'width:120px;')) }}</a></h3></p>

                     <p class="lead text-center" style="margin-bottom:0;">OR</p> <br>
                    
                    <form action="{{ URL::to('/user/store') }}" method="POST">
                      <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name" required autofocus name="firstname">
                      </div>
                      <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name" required autofocus name="lastname">
                      </div>
                      <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" required autofocus name="email">
                      </div>
                      <div class="form-group hide">
                            {{ Form::select('usertype', array('regular' => 'Regular', 'publisher' => 'Publisher'), null, array('class' =>'form-control hide')); }}
                      </div>
                      <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" required autofocus name="username">
                      </div>
                      <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required name="password" style="margin-bottom:15px">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" required name="password_confirmation">
                      </div>
                    <button class="btn btn-lg btn-warning btn-block" name="add_user" type="submit">
                        Sign up</button>
                    </form>

     			</div>
     			<div class="col-md-6">
     				<p class="lead"><h3 style="text-align:center">Sign In <br /> <small><b>Already Have an Account?</b></small> <br /><a href="#" onclick="checkLoginState();">{{ HTML::image('assets/img/fb-login.png', 'Facebook Login', array('style'=>'width:200px;')) }}</a></h3></p>

                     <p class="lead text-center" style="margin-bottom:0;">OR</p> <br />

                     <form action="{{ URL::to('login/auth') }}" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                       
                        <button class="btn btn-lg btn-warning btn-block" name="sign_in" type="submit">
                            Sign in</button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me">
                            Remember me
                        </label>
                        <a href="{{ URL::to('password/reset') }}" class="pull-right need-help">Forgot Password? </a>
                        <span class="clearfix"></span>
                    </form>

     			</div>
     		</div>
     	</div>
 
    </div>
  </div>
</div>

<style type="text/css">
    .lead{margin:0;}
</style>

@endif