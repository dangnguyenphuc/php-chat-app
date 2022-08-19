<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("location: users.php");
    }
?>
<?php
    include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class = "form login">
            <header>LOG IN</header> 
            <form action=# autocomplete="off">
                <div class="error-txt"></div>
            <div class="field input">
                <lable>Email Address</lable>
                <input type="text" name="email" placeholder="Enter your email" require>
            </div>
            <div class="field input">
                <lable>Password</lable>
                <input type="password" name="pwd" placeholder="Enter your password" require>
                <i class="fas fa-eye"></i>
            </div>
            <div class="field button">
                <input type="submit" value="Continue to chat">
            </div>
            </form>
        <div class="link">Not yet signed up? <a href="index.php">Sign up now</a></div>
        </section>
    </div>
    <script src="js/show-hide-pwd.js"></script>
    <script src="js/login.js"></script>
<?php
    include_once "footer.php";
?>