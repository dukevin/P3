<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		echo "Session Active";
	}
	$name = $_SESSION['user'];
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/quiz.css">
	<link rel="stylesheet" type="text/css" href="css/flashcards.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
	<script src="js/quiz.js"></script>
	<script src="js/flashcards.js"></script>
</head>

<body>
	<div id="header">
		<div id="nav">
			<a href="home.php">
				<p>‹ Back</p>
			</a>
		</div>
		<div id="title">
			<p>Flash Cards</p>
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
	<div id="body">
        <div class="head"><label><input type="checkbox" checked name="speak"> Speak Words</label></div>
		<div class="card">
            <div class="flip">⮎</div>
			<h2 class="word">Fathom</h2>
			</div>
		</div>
        <div id="footer">
            <div id="footer-container">
                <div class="back">&#8249;</div>
                <div class="forward">&#8250;</div>
            </div>
        </div>
	</div>
</body>

</html>