<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit("Session Lost");
	}
	$name = $_SESSION['user'];
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script>
		var name = "<?=$name?>";
	</script>
	<script src="js/audio.js"></script>
	<script src="js/home.js"></script>
</head>

<body>
	<div id="header">
		<div id="nav">
			<a href="/">
				<p class="hidden">‹ Back</p>
			</a>
		</div>
		<div id="title">
			<p>Hello <?=$name?>!</p>
		</div>
		<div id="settings">
			<p>⚙</p>
		</div>
	</div>
	<div id="settings-list">
		<div class="settings-container">
			<list>
				<li>Notify new word of day: <span class="editable"><input type="number" value=12></input>:<input type="number" value=00><span></li>
				<li>Remind me every: <span class="editable"><input type="number" value="6"></input> hr</span></li>
				<li id="logout-btn">Logout</li>
			</list>
		</div>
	</div>
	<div class="popup">
		<div class="closeBtn">X</div>
		<div class="popup-container">
			<div class="popup-content">
				<p>Test your pronunciation</p>
			</div>
			<canvas id="visualizer" width=260></canvas>
			<div class="popBtn-container">
				<div class="button" id="cancel">
					<p>Close</p>
				</div>
				<div class="button" id="start">
					<p>Start</p>
				</div>
			</div>
		</div>
	</div>
	<div id="head">
		<div class="icon"><span id="check">🗣️</span><span id="answer">🔊</span></div>
		<div id="word_of_day">
			<p>Today's word of the day is:</p>
			<?php $word = get_word_of_day(); ?>
			<h1><?=$word["word"]?></h1>
			<h2><?=$word["definition"]?></h2>
		</div>
	</div>
	<div id="body">
		<div class="main-button vocab">
			<p>My Vocab</p>
		</div>
		<div class="main-button flashcards">
			<p>Flashcards</p>
		</div>
		<div class="main-button quiz">
			<p>Quiz</p>
		</div>
	</div>
</body>
<footer>
	<a href="help.html">Help?</>
</footer>
</html>
<?php 
    function get_word_of_day()
    {
		global $name;
        $words = json_decode(file_get_contents("library/SAT=$name.json"), true);
        srand(((int)date("Ymd"))+ord($name[0])+ord($name[strlen($name)-1]));
        $r = rand(0, sizeof($words["results"]));
        return $words["results"][$r];
    }
?>