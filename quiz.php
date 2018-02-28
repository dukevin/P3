<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit("Session Lost");
	}
	$name = $_SESSION['user'];
	$words = json_decode(file_get_contents("library/SAT=$name.json"), true);
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
	<script src="js/home.js"></script>
	<script src="js/audio.js"></script>
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
	<div id="body">
	<div class="title">Last 7 day's words</div>
	<?php
		$times = 0;
		while(++$times <= 7) {
			$ans = mt_rand(1,3);
			$word = get_word_by_seed_offset($times);
	?>
		<div class="card">
			<h2 class="word"><?=$word?></h2>
			<table class=<?=$word?>>
			<tr>
				<td colspan=2><div class="pronounce radio-text">Test pronunciation</div></td>
				<td class="result result1"></td>
			</tr>
			<tr>
				<td class="<?=$ans==1?"ans":"mis"?> tdrad"><div class="radio"></div></td>
				<td class="<?=$ans==1?"ans":"mis"?>"><div class="radio-text"><?=$ans == 1 ? defineWord($word) : randomDef()?></div></td>
				<td rowspan=3 class="result result2"></td>
			</tr>
			<tr>
				<td class="<?=$ans==2?"ans":"mis"?> tdrad"><div class="radio"></div></td>
				<td class="<?=$ans==2?"ans":"mis"?>"><div class="radio-text"><?=$ans == 2 ? defineWord($word) : randomDef()?></div></td>
			</tr>
			<tr>
				<td class="<?=$ans==3?"ans":"mis"?> tdrad"><div class="radio"></div></td>
				<td class="<?=$ans==3?"ans":"mis"?>"><div class="radio-text"><?=$ans == 3 ? defineWord($word) : randomDef()?></div></td>
			</tr>
			</table>
		</div>
		<?php } ?>
	</div>
</body>
<?php 
    function get_word_by_seed_offset($offset = 0)
    {
		global $name, $words;
        srand(((int)date("Ymd")-$offset)+ord($name[0])+ord($name[strlen($name)-1]));
        $r = rand(0, sizeof($words["results"]));
        return $words["results"][$r]["word"];
	}
	function randomDef()
	{
		global $words;
		$wds = $words["results"];
		return $wds[array_rand($wds)]["definition"];
	}
	function defineWord($word)
	{
		global $words;
		$wds = $words["results"];
		foreach($wds as $w)
        {
            if($w["word"] == $word) {
                return $w["definition"];
            }
        }
	}
?>
</html>