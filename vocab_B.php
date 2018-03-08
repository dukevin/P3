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
	<link rel="stylesheet" type="text/css" href="css/vocab.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="js/home.js"></script>
    <script src="js/audio.js"></script>
    <script src="js/vocab.js"></script>
	<script>
		$(document).ready(function(){
		  	$("#add_word").click(function(){
		  		ga('create','UA-114986182-1','auto');
		        ga('send', 'event', 'addwordB', 'duration');
		  	});
		  });
	</script>
    <style>
   	#top { display:none }
	#categories { margin-top: 100px }
#add_word {
  width: 60px;
  height: 60px;
  color: black;
  position: fixed;
  bottom: 45px;
  right: 45px;
  z-index: 100;
  background-color: black;
  color: white;
  border-radius: 100px;
  font-size: 30pt;
  text-align: center;
  line-height: 60px;
  box-shadow: 3px 3px 3px gray;
  cursor: pointer;
}
#add_word:hover {
  background-color: #444;
}
#add_word:active {
  background-color: #666;
}
    </style>
</head>

<body>
	<div id="header">
		<div id="nav">
			<a href="home.php">
				<p>‹ Back</p>
			</a>
		</div>
		<div id="title">
			<p>My Vocab</p>
		</div>
		<div id="settings">
			<p>☰</p>
		</div>
    </div>
    <div id="settings-list">
		<div class="settings-container">
			<list>
				<li id="delete_all">Delete all</li>
				<li id="logout-btn">Logout</li>
			</list>
		</div>
	</div>
	<div class="popup record">
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
	<div class="popup definition">
		<div class="closeBtn">X</div>
		<div class="popup-container">
			<div class="popup-content">
				<p>Definition goes here</p>
			</div>
		</div>
	</div>
	<div class="popup modify">
		<div class="closeBtn">X</div>
		<div class="popup-container">
			<div class="popup-content">
				<p>Edit word</p>
				<input type="text" placeholder="word" name="spelling" class="spelling">
				<input type="text" placeholder="definition" name="meaning" class="meaning">
			</div>
			<div class="popBtn-container">
				<div class="button cancel">
					<p>Close</p>
				</div>
				<div class="button" id="submit_edit">
					<p>Submit</p>
				</div>
			</div>
		</div>
	</div>
	<div class="popup del">
		<div class="closeBtn">X</div>
		<div class="popup-container">
			<div class="popup-content">
				<p>Are you sure you want to delete this word?</p>
			</div>
			<div class="popBtn-container">
				<div class="button cancel">
					<p>Cancel</p>
				</div>
				<div class="button" id="submit_delete">
					<p>Delete</p>
				</div>
			</div>
		</div>
	</div>
    <?php $results = get_words(); ?>
	<div id="body">
		<div id="top">
			<div class="button text">Add Word</div>
		</div>
		<div id="add_word">+</div>
		<table id="categories">
            <?php
                foreach($results as $res)
                {
            ?>
            <tr class="<?=trim($res["word"]);?>">
                <td class="<?=trim($res["word"]);?>"><?=trim($res["word"]);?></td>
                <td class="icon"><span class="check">🗣️</span><span class="answer">🔊</span><span class="define">📖</span></td>
                <td class="icon"><span class="edit">✏️</span><span class="delete">❌</span></td>
            </tr>
            <?php 
                }
            ?>
		</table>

	</div>
	
</body>

</html>
<?php
    function get_words()
    {
        global $name;
        $words = json_decode(file_get_contents("library/SAT=$name.json"), true);
        return $words["results"];
    }
?>
