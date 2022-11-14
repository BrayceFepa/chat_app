<?php

$you = '';

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $sql2 = "SELECT * FROM `messages` WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $statement2 = $db->query($sql2);
    $row2 = $statement2->fetch(PDO::FETCH_ASSOC);
    if ($statement2->rowCount() > 0) {
        $result = $row2['msg'];
        //adding you before text msg if login id sent msg
        if ($outgoing_id == $row2['outgoing_msg_id']) {
            $you = "You: ";
        }
    } else {
        $result = "No message available";
    }

    //trimming message if words are more than 28
    (strlen($result) > 25) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;


    //check user is online or not
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                        <img src="php/images/' . $row["img"] . '" alt="">
                        <div class="details">
                            <span> ' . $row['fname'] . ' ' . $row['lname'] . ' </span>
                            <p>' . $you .  $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '">
                        <i class="fa fa-circle"></i>
                    </div>
                </a>';
}