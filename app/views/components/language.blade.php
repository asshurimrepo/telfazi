<?php

  $activeAt = array('','');
  $stack = array('en','ar');
  $key = array_search( Session::get('lang'), $stack);
  
  $activeAt[$key] = 'selected';

?>


<script type="text/javascript">
	$(function(){
		$('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
			onChange: function(evt){
				
	        }
		});
	});
</script>
<div id="polyglotLanguageSwitcher">
	<form action="#">
		<select id="polyglot-language-options">
			<option id="en" value="en" {{ $activeAt[0] }}>EN</option>
			<option id="it" value="ar" {{ $activeAt[1] }}>AR</option>
		</select>
	</form>
</div>
<style type="text/css">
	#polyglotLanguageSwitcher a{ width: 65px !important; } 
	#polyglotLanguageSwitcher a.current:link { height: 30px; }
	#polyglotLanguageSwitcher span.trigger { top: 1em; right: 5px; }
</style>


