<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];

$output = "";

$searchTerm = trim($_POST['searchTerm']);
$query = $db->prepare("SELECT * FROM `users` WHERE NOT unique_id = {$outgoing_id} AND (`fname` LIKE :keyword OR `lname` LIKE :keyword)");
$searchTerm = "%" . $searchTerm . "%";
$query->bindParam(":keyword", $searchTerm, PDO::PARAM_STR);
$query->bindParam(":keyword", $searchTerm, PDO::PARAM_STR);
$query->execute();

if ($query->rowCount() > 0) {
    include "data.php";
} else {
    $output .= "No user found related to your search";
}

echo $output;