<?php

session_start();
include_once "config.php";
if (isset($_SESSION['unique_id'])) {
    $outgoing_id = trim($_POST['outgoing_id']);
    $incoming_id = trim($_POST['incoming_id']);
    $output = "";

    $sql = "SELECT * FROM `messages`
    LEFT JOIN `users` ON users.unique_id = messages.outgoing_msg_id
     WHERE (outgoing_msg_id=:outgoing_msg_id AND incoming_msg_id=:incoming_msg_id)
    OR (incoming_msg_id=:outgoing_msg_id AND outgoing_msg_id=:incoming_msg_id) ORDER BY msg_id";
    $statement = $db->prepare($sql);
    $statement->execute([
        'outgoing_msg_id' => $outgoing_id,
        'incoming_msg_id' => $incoming_id,
        'incoming_msg_id' => $incoming_id,
        'outgoing_msg_id' => $outgoing_id
    ]);
    if ($statement->rowCount() >  0) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if ($row['outgoing_msg_id'] == $outgoing_id) { //if this is equal to, then he is a msg sender
                $output .= "
                    <div class=\"chat outgoing\">
                        <div class=\"details\">
                            <p>" . $row['msg'] . "</p>
                        </div>
                    </div>
                ";
            } else { //he is a msg receiver
                $output .= "
                    <div class=\"chat incoming\">
                    <img src=\"php/images/" . $row['img'] . "\" alt=\"\">
                    <div class=\"details\">
                       <p>" . $row['msg'] . "</p>
                    </div>
                </div>
                ";
            }
        }

        echo $output;
    }
} else {
    header("loaction: login.php");
}