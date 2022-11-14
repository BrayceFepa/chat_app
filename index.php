<?php

session_start();
if (isset($_SESSION['unique_id'])) { //if user is logged in
    header("location: users.php");
}

?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt">This is an error message</div>
                <div class="name-details">
                    <div class="field input">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required />
                    </div>
                    <div class="field input">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required />
                    </div>
                </div>
                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" placeholder="Email " required />
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter new Password" required />
                    <i class="fa fa-eye"></i>
                </div>
                <div class="field image">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" placeholder="Last Name" required />
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat" />
                </div>
            </form>
            <div class="link">Already signed up ? <a href="login.php">Login Now</a></div>
        </section>
    </div>

    <script src="javaScript/pass-show-hide.js"></script>
    <script src="javaScript/signup.js"></script>

</body>

</html>