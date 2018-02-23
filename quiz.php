<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		echo "Session Active";
	}
	$name = $_SESSION['user'];
?>