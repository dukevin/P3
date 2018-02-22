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
	<div id="popup">
		<div id="closeBtn">X</div>
		<div id="popup-container">
			<div id="popup-content">
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