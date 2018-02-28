<?php
    session_start();
    if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit("Session Lost");
	}
    $name = $_SESSION['user'];
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $word = isset($_POST["word"]) ? $_POST["word"] : "";;
    $method = $_POST["request"];
    $words = json_decode(file_get_contents("library/SAT=$name.json"), true);
    $wds = &$words["results"];
    if($method == "define")
    {
        foreach($wds as $w)
        {
            if($w["word"] == $word) {
                die($w["definition"]);
            }
        }
        die("No definition found for $word");
    }
    if($method == "edit")
    {
        foreach($wds as &$w)
        {
            if($w["word"] == $_POST["oldword"]) {
                $w["word"] = $_POST["newword"];
                $w["definition"] = $_POST["definition"];
                $jse = json_encode($words);
                file_put_contents("library/SAT=$name.json", $jse);
                die("Ok");
            }
        }
    }
    if($method == "delete")
    {
        foreach($wds as $i=>&$w)
        {
            if($w["word"] == $_POST["word"]) {
                unset($w);
                unset($words["results"][$i]);
                $jse = json_encode($words);
                file_put_contents("library/SAT=$name.json", $jse);
                die("Ok");
            }
        }
    }
    if($method == "add")
    {
        $new = array();
        $new["word"] = $word;
        $new["definition"] = $_POST["definition"];
        $new["type"] = "";
        array_unshift($wds, $new);
        $jse = json_encode($words);
        file_put_contents("library/SAT=$name.json", $jse);
        die("Ok");
    }
    if($method == "deleteAll")
    {
        $new = array();
        $new["word"] = "";
        $new["definition"] = "";
        $new["type"] = "";
        $jse = json_encode($new);
        file_put_contents("library/SAT=$name.json", $jse);
        die("Ok");
    }
    if($method == "random")
    {
        die( json_encode($wds[array_rand($wds)]) );
    }
    if($method == "randomDefs")
    {
        $new['def1'] = $wds[array_rand($wds)]["definition"];
        $new['def2'] = $wds[array_rand($wds)]["definition"];
        die( json_encode($wds[array_rand($new)]) );
    }
    if($method == "randomSeed")
    {
        srand(((int)date("Ymd"))+ord($name[0])+ord($name[strlen($name)-1]));
        $r = rand(0, sizeof($words["results"]));
        return $words["results"][$r];
    }
?>