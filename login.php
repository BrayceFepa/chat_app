<?php

session_start();

if (isset($_SESSION['unique_id'])) { //if user is logged in
    header("location: users.php");
}
include_once "header.php";


?>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="#">
                <div class="error-txt"></div>

                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" placeholder="Email " />
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter your Password" />
                    <i class="fa fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat" />
                </div>
            </form>
            <div class="link">Not yet signed up ? <a href="index.php">Signup Now</a></div>
        </section>
    </div>
    <script src="javaScript/pass-show-hide.js"></script>
    <script src="javaScript/login.js"></script>
</body>

</html>