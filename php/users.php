<?php

session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];

$query = $db->query("SELECT * FROM `users` WHERE NOT unique_id = {$outgoing_id}");

$output = "";

if ($query->rowCount() == 0) {
    $output .= "No users are available to chat";
} elseif ($query->rowCount() > 0) {
    include "data.php";
}

echo $output;