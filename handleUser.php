<?php
require_once("connect_users.php");

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$name = isset($_POST["name"]) ? $_POST["name"] : "" ;
$password = isset($_POST["password"]) ? $_POST["password"] : "";

if($_POST["request"] == "register")
{
    if(user_exists($name, $db))
        die("Error: Username already exists!");
    if(strlen($name) < 3)
        die("Error: Username less than 3 characters");
    if(strpos($name, '=') !== false)
        die("Your username cannot contain the character: =");
    if(strlen($password) < 3)
        die("Error: Password less than 3 characters");
    $query = $db->query("INSERT INTO users (name, password, email) VALUES ('$name', '$password', '{$_POST["email"]}')");
    copy("library/SAT.json", "library/SAT=$name.json");
    die("Ok: Successfully registered, $name! Please login");
}
if($_POST["request"] == "login")
{
    if(!user_exists($name,$db))
        die("Error: That username does not exist!");
    $result = $db->query("SELECT password FROM users WHERE name = '$name'");
    foreach($result as $r)
        if($r["password"] == $password) {
            session_start();
            $_SESSION["user"] = $name;
            $_SESSION["id"] = session_id();
            echo("Ok: Hello, $name!");
            return;
        }
    die("Error: Invalid password!");
}
if($_POST["request"] == "logout")
{
    session_start();
    session_destroy();
    die("Ok: Logged out");
}
function user_exists($user, $db)
{
    $result = $db->query("SELECT name FROM users");
    foreach($result as $r)
        if( $r["name"] == $user)
            return true;
    return false;
}
?>