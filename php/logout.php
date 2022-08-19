<?php
    session_start();
    if(isset($_SESSION['id'])){
        include_once "config.php";
        include_once "sql_safety.php";
        $logout_id = mysqli_real_escape_string($conn,$_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $query = "UPDATE users SET status=? WHERE id =?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si",$status, $logout_id);
            $stmt->execute();
                session_unset();
                session_destroy();
                header("location: ../login.php");
        }
        else{
            header("location: ../users.php");
        }
        echo $logout_id;
    }
    else{
        header("location: ../login.php");
    }
?>