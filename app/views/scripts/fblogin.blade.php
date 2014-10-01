<script>
//Facebook Javascript SDK
window.fbAsyncInit = function() {
  FB.init({
    appId      : '497734833686552',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });
};

// Load the SDK asynchronously
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


<script type="text/javascript">

// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {

  if (response.status === 'connected') {

    testAPI();
  } else if (response.status === 'not_authorized') {

    //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
  } else {
  
    //document.getElementById('status').innerHTML = 'Please log ' +  'into Facebook.';
  }
}


function checkLoginState() {
  console.log('adasd');
  FB.login(function(response) {
      if (response.authResponse) {

          //check if logged status.
          FB.getLoginStatus(function(response) {
              statusChangeCallback(response);
            });
      }
  }, {scope: 'email, public_profile'});

}


function testAPI() {
  console.log('Welcome!  Fetching your information.... ');
  FB.api('/me', function(response) {
    var code = JSON.stringify(response);
    
    $.ajax({
      url: "{{ URL::to('login/fb') }}",
      type: "POST",
      data: { code: code }
    }).done(function(data){

      console.log(data);

      if(data.status == 'error'){
        $('#login_status').html( data.status_message );
      }
      else{

        window.location.href = '{{ URL::to("/") }}';
      }
    });

  });
}
</script>


