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
	<link rel="stylesheet" type="text/css" href="css/vocab.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="js/vocab.js"></script>
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
                <li>Add Word</li>
				<li>Delete all</li>
				<li id="logout-btn">Logout</li>
			</list>
		</div>
	</div>
    <?php $results = get_words(); ?>
	<div id="body">
		<div id="top">
			<div class="button text">Add Word</div>
		</div>
		<table id="categories">
            <?php
                foreach($results as $res)
                {
            ?>
            <tr>
                <td><?=trim($res["word"]);?></td>
                <td class="icon"><span id="check">🗣️</span><span id="answer">🔊</span><span>📖</span></td>
                <td class="icon"><span>✏️</span><span>🗑️</span></td>
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