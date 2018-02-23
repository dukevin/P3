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
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
	<script src="js/quiz.js"></script>
</head>

<body>
	<div id="header">
		<div id="nav">
			<a href="home.php">
				<p>‹ Back</p>
			</a>
		</div>
		<div id="title">
			<p>Quiz</p>
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
	<div class="title">Last 7 day's words</div>
		<div class="card">
			<h2 class="word">Fathom</h2>
			<div class="definitions">
				<div class="row">
					<div class="radio disabled"></div>
					<div class="pronounce radio-text">Test pronunciation</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						rash; uneventful
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						Understand after much thought
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						carnivorous animal living in the jungle
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<h2 class="word">Harbingers</h2>
			<div class="definitions">
				<div class="row">
					<div class="radio disabled"></div>
					<div class="pronounce radio-text">Test pronunciation</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						halt; to stop over
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						indicators; bringers of warnings
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						think intentively
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<h2 class="word">Abstain</h2>
			<div class="definitions">
				<div class="row">
					<div class="radio disabled"></div>
					<div class="pronounce radio-text">Test pronunciation</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						desist; go without; withdraw
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						To gourge; consume in large quantities
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						To exfoliate; rub smootly
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<h2 class="word">Lackluster</h2>
			<div class="definitions">
				<div class="row">
					<div class="radio disabled"></div>
					<div class="pronounce radio-text">Test pronunciation</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						To amaze; inspire and rally
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						Produce loud noises
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						dull; monotonous; bland
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<h2 class="word">Lampoon</h2>
			<div class="definitions">
				<div class="row">
					<div class="radio disabled"></div>
					<div class="pronounce radio-text">Test pronunciation</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						ridicule; spoof
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						jump repeatedly
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						happy; gay
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<h2 class="word">Resonant</h2>
			<div class="definitions">
				<div class="row">
					<div class="radio disabled"></div>
					<div class="pronounce radio-text">Test pronunciation</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						to consume food
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						free falling
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						echoing
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<h2 class="word">Acrophobia</h2>
			<div class="definitions">
				<div class="row">
					<div class="radio disabled"></div>
					<div class="pronounce radio-text">Test pronunciation</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						fear of heights
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						a break; intermission
					</div>
				</div>
				<div class="row">
					<div class="radio"></div>
					<div class="radio-text">
						fear of spiders
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>