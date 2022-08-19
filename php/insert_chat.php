<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("../login.php");
    }
    include_once "config.php";
    include_once "sql_safety.php";
    $outgoing_id = mysqli_real_escape_string($conn,$_POST['outgoing-id']);
    $incoming_id = mysqli_real_escape_string($conn,$_POST['incoming-id']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);

    if( !empty($message) ){
        $sql = "INSERT INTO messages (outgoing_msg_id,incoming_msg_id,msg) VALUE (?,?,?)";
        $res = allsafeQuery($conn, $sql,['i','i','s'],[$outgoing_id,$incoming_id,$message]);
    }
?>