<?php

session_start();

include_once("config.php");

$email = trim($_POST['email']);
$password = trim($_POST['password']);


if (isset($email, $password) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //let's check users entered email & password matched to database any table row email and password
        $sql = "SELECT * FROM `users` WHERE email=:email";
        $statement = $db->prepare($sql);
        $params = ['email' => $email];
        $statement->execute($params);
        if ($statement->rowCount() > 0) { //if users credentials matched
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                unset($row['password']);
                try {
                    $status = 'Active now';
                    $query = $db->query("UPDATE `users` SET status= '{$status}' WHERE unique_id= {$row['unique_id']}");
                    $_SESSION['unique_id'] = $row['unique_id']; //using this session we used unique_id in other php file
                    echo "success";
                } catch (Exception $e) {
                    echo $e->getMessage();
                    die();
                }
            } else {
                echo "Invalid password !";
            }
        } else {
            echo 'email does not exists';
        }
    } else {
        echo "$email is not a valid email";
    }
} else {
    echo "All input fieds are required !";
}




$nbr = 2;