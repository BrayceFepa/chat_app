<?php

$dsn = "mysql:dbname=chat_app;host=localhost";
$user = "root";
$password = "";

try {
    $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}