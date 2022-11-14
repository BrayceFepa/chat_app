<?php

session_start();
if (isset($_SESSION['unique_id'])) { //if user is logged in then come to this page otherwise go to login page
    include_once "config.php";
    $logout_id = trim($_GET['logout_id']);
    if (isset($logout_id)) { //if logout_id is set
        $status = "Offline now";
        try {
            $statement = $db->prepare("UPDATE `users` SET status =:status WHERE unique_id = {$logout_id}");
            $statement->execute(['status' => $status]);
            session_unset();
            session_destroy();
            header("location: ../login.php");
        } catch (Exception $e) {
            die("Something went wrong" . $e->getMessage());
        }
    } else {
        header("location: ../users.php");
    }
} else {
    header("location: ../login.php");
}