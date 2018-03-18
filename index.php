<?php
	session_start();
	if(isset($_SESSION['user'])) {
		header("Location: home.php");
		echo "Session Active";
	}
?>
<!doctype html>
<html>

<head>

<!-- Google Analytics Content Experiment code -->
<script>function utmx_section(){}function utmx(){}(function(){var
k='170739637-2',d=document,l=d.location,c=d.cookie;
if(l.search.indexOf('utm_expid='+k)>0)return;
function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
</script><script>utmx('url','A/B');</script>
<!-- End of Google Analytics Content Experiment code -->



<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114986182-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114986182-1');
</script>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
</head>

<body>
	<div id="header">
		<div id="nav">
			<a href="/">
				<p class="hidden">‹ Back</p>
			</a>
		</div>
		<div id="title">
			<p>P3</p>
		</div>
		<div id="settings" class="hidden">
			<p>☰</p>
		</div>
	</div>
	<div class="popup">
		<div class="closeBtn">X</div>
		<div class="popup-container">
			<div class="popup-content">
				<p>Something something something</p>
				<input type="text" placeholder="username" name="username" class="input1">
				<input type="password" placeholder="password" name="password" class="input2">
				<input type="password" placeholder="repassword" name="repassword" class="input3">
				<input type="text" placeholder="email" name="email" class="input4">
			</div>
			<div class="button" id="button1">
				<p>Button 1</p>
			</div>
			<div class="button" id="button2">
				<p>Button 2</p>
			</div>
		</div>
	</div>
	<div id="head">
		<div id="logo">
			<div class="logo-container">
				<p>P3</p>
			</div>
		</div>
	</div>
	<div id="body">
		<div class="main-button login main-button1">
			<p>Login</p>
		</div>
		<div class="main-button register main-button2">
			<p>Register</p>
		</div>
	</div>
</body>

</html>