<?php
    session_start();
    include_once "config.php";
    include_once "sql_safety.php";
    $res = "";
    $outgoing_id = $_SESSION['id'];
    $seachTerm = strtolower(preg_replace("--","",mysqli_real_escape_string($conn,$_POST['searchTerm'])));
    
    $seachTerm = "%$seachTerm%" ;

    $sql_res = "SELECT * FROM users WHERE (fname LIKE ? OR lname LIKE ?)";
    $stmt = $conn->prepare($sql_res);
    $stmt->bind_param("ss",$seachTerm,$seachTerm);
    $stmt->execute();
    $sql_res = $stmt->get_result();
    if ( $sql_res ->num_rows > 0  ) {
        include "data.php";
    }else{
        $res = "No user found";
    }
    echo $res;
?>