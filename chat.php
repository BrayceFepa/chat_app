<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include_once "php/config.php";
                $user_id = trim($_GET['user_id']);
                $sql = $db->prepare("SELECT * FROM `users` WHERE unique_id =:user_id");
                $sql->execute(['user_id' => $user_id]);
                if ($sql->rowCount() > 0) {
                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
            </header>

            <div class="chat-box">

            </div>

            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; //msg_sender id 
                                                                ?>" hidden />
                <input type="text" name="incoming_id" value="<?php echo $user_id; //msg_receiver id 
                                                                ?>" hidden />
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." />
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>

        </section>
    </div>
    <script src="javaScript/chat.js"></script>
</body>

</html>