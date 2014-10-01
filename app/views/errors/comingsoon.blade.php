<?php $directory = 'assets/template/comingsoon/'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Telfazi | Coming Soon</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="{{ asset( $directory . 'tools/style.css' )  }}" rel="stylesheet" type="text/css" />
<link href="{{ asset( $directory . 'tools/960.css' ) }}" rel="stylesheet" type="text/css" />
<!-- Jquery -->
<script src="{{ asset('assets/jquery/js/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('assets/jquery/js/jquery-ui-1.10.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset( $directory . 'js/cufon-yui.js' )  }}"></script>
<script type="text/javascript" src="{{ asset( $directory . 'js/Clarendon_LT_Std_700.font.js' )  }}"></script>
<script type="text/javascript">
	Cufon.replace('h1,h3', {fontFamily: 'Clarendon LT Std', hover:true})
</script>
</head>
<body>
<div id="shim"></div>
<div id="content" style="background: url({{ asset('assets/img/bluelight.png') }}) no-repeat bottom; background">
	<div class="logo_box">
		<h1><img src="{{ asset('assets/img/logoblue.png') }}"> 
		<span class="slogan">Your home of latest videos</span></h1>

	</div>          
	<div class="main_box">
		<h2>Our website is coming soon.<br/><span>In the mean time connect with us with the information below</span></h2>
		
		<ul class="info">
			<!-- <li>
				<h3>P</h3>
				<p>866-599-5350<br/>403-926-8331</p>
			</li>
			<li>
				<h3>A</h3>
				<p>301 Clematis. Suite 3000<br/>West Palm Beach, FL 33401</p>
			</li> -->
			<li>
				<!-- <h3>S</h3> -->
				<p class="social">
					<a href="https://twitter.com/Telfazi" class="tw"></a>
					<a href="https://www.facebook.com/telfazi" class="fb"></a>				
					<!-- <a href="#" class="li"></a> -->
				</p>
			</li>
		</ul>

	</div>
	<img src="">
</div>

</body>
</html>
