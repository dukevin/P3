<?php
    $db = new PDO("sqlite:users.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name VARCHAR(60) NOT NULL, password VARCHAR(60) NOT NULL, email VARCHAR(60), library INT)");
?>