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
        <section class = "users">
            <?php
                require_once "php/config.php";
                include_once "php/sql_safety.php";

                $sql = "SELECT * FROM users WHERE id =?";
                $row = fetchAssoc($conn,$sql,[$_SESSION['id']]);
            ?>
            <header>
                <div class="content">
                    <img src="php/upload/<?php echo $row['image']; ?>" alt="kobayashi_kanna.jpeg">
                    <div class="details">
                        <span><?php echo $row['fname']." ".$row["lname"]; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['id'] ?>" class="logout">Log out</a>
            </header>
            <div class="search">
                    <span class="text">Select an user to start chatting</span>
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>
    <script src="js/search.js"></script>
<?php
    include_once "footer.php";
?>