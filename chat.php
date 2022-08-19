<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }
?>

<?php
    include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class = "chat-area">
            <header>
                <?php
                    require_once "php/config.php";
                    include_once "php/sql_safety.php";

                    $id = mysqli_real_escape_string($conn,$_GET['user_id']);

                    $sql = "SELECT * FROM users WHERE id =?";
                    $row = allFetchAssoc($conn,$sql,['i'],[$id]);
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="php/upload/<?php echo $row['image']?>" alt="kobayashi_kanna.jpeg">
                    <div class="details">
                        <span><?php echo $row['fname']. " ". $row['lname'] ?></span>
                        <p><?php echo $row['status'] ?></p>
                    </div>
            </header>
            <div class="chat-box">
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing-id" value="<?php echo $_SESSION["id"]; ?>" hidden>
                <input type="text" name="incoming-id" value="<?php echo $row["id"]; ?>" hidden>
                <input class="input-field" type="text" name="message" placeholder="Type your message...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>

        </section>
    </div>
    <script src="js/chat.js"></script>
<?php
    include_once "footer.php";
?>