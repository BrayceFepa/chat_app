<?php

session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = trim($_POST['outgoing_id']);
    $incoming_id = trim($_POST['incoming_id']);
    $message = trim($_POST['message']);
    if (!empty($message)) {
        $statement = $db->prepare("INSERT INTO `messages` (incoming_msg_id, outgoing_msg_id, msg) 
                                    VALUES (:incoming_id, :outgoing_id, :msg)");
        $statement->execute([
            'incoming_id' => $incoming_id,
            'outgoing_id' => $outgoing_id,
            'msg' => $message
        ]);
    }
} else {
    header("loaction: login.php");
}