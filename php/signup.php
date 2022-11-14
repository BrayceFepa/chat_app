<?php

session_start();

include_once("config.php");

$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {

    //let's encrypt the password
    $options = array('cost' => 4);
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $options);

    //let's check if user's email is valid or not
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //if email is valid
        //let's check if that email already exits in the database or not
        $statement = $db->prepare("SELECT * FROM `users` WHERE email=:email");
        $statement->execute(['email' => $email]);
        if ($statement->rowCount() > 0) { //if email already exists
            echo "$email already exists !!";
        } else {
            //let's check if user uploads file or not
            if (isset($_FILES['image'])) { //if file is uploaded
                $img_name = $_FILES['image']['name']; //getting user uploaded img name
                $tmp_name = $_FILES['image']['tmp_name']; //thi temporary name is used to save.move file in our folder

                //let's explode image and get the last extension like jpg, png or jpeg
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); //here we get the extension of an user uploaded img file
                $extensions = ['png', 'jpeg', 'jpg']; //these are some valid img ext and we've store them in array
                if (in_array($img_ext, $extensions) === true) { //if user uploaded img ext is matched with any array extensions
                    $time = time(); //this will return us current time

                    //let's move the user uploaded img to our particular folder
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) { //if user uploaded file move to our folder successfully
                        $status = "Active now"; //once user signed up then status will be active now
                        $random_id = rand(time(), 10000000); //creating random id for user

                        try {
                            //let's insert insert user data inside table
                            $sql = "INSERT INTO `users` (unique_id, fname, lname, email, password, img, status)
                                VALUES (:random_id, :fname, :lname, :email, :hash_pass, :img, :status)";
                            $statement = $db->prepare($sql);
                            $params = [
                                'random_id' => $random_id,
                                'fname' => $fname,
                                'lname' => $lname,
                                'email' => $email,
                                'hash_pass' => $hash_password,
                                'img' => $new_img_name,
                                'status' => $status
                            ];
                            $statement->execute($params);
                        } catch (Exception $e) {
                            echo "Something went wrong";
                            die();
                        }

                        $sql2 = "SELECT * FROM `users` WHERE email =:email";
                        $statement = $db->prepare($sql2);
                        $statement->execute(['email' => $email]);
                        if ($statement->rowCount() > 0) {
                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
                            echo "success";
                        }
                    }
                } else {
                    echo "Please select an Image file -jpeg, jpg, png!";
                }
            } else {
                echo "Please select an Image file ! ";
            }
        }
    } else {
        echo "$email is not a valid email !";
    }
} else {
    echo "All input fields are required !";
}