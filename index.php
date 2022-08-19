<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("location: users.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="view/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <section class = "form signup">
            <header>SIGN UP</header> 
            <form action=# enctype="multipart/form-data" autocomplete="off">
                <div class="error-txt"></div>
                <div class="name-detail">
                    <div class="field input">
                        <lable>First Name</lable>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <lable>Last Name</lable>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
            <div class="field input">
                <lable>Email Address</lable>
                <input type="text" name="email" placeholder="Enter your email" required>
            </div>
            <div class="field input">
                <lable>Password</lable>
                <input type="password" name="pwd" placeholder="Enter your password" required>
                <i class="fas fa-eye"></i>
            </div>
            <div class="field image">
                <lable>Choose your avatar</lable>
                <input type="file" name="image" required>
            </div>
            <div class="field button">
                <input type="submit" value="Continue to Chat">
            </div>
            </form>
        <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>
    <script src="js/show-hide-pwd.js"></script>
    <script src="js/signup.js"></script>
<?php
    include_once "footer.php";
?>