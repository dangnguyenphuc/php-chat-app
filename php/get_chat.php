<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("../login.php");
    }
    include_once "config.php";
    include_once "sql_safety.php";

    $outgoing_id = mysqli_real_escape_string($conn,$_POST['outgoing-id']); //current user
    $incoming_id = mysqli_real_escape_string($conn,$_POST['incoming-id']); // user-friend

    $message_got = "";
    $sql = "SELECT * FROM messages 
    LEFT JOIN users ON users.id = messages.outgoing_msg_id
    WHERE (outgoing_msg_id=? AND incoming_msg_id=?) 
    OR (outgoing_msg_id=? AND incoming_msg_id=?) ORDER BY msg_id";


    $query = $conn->prepare($sql);
    $query->bind_param("iiii",$outgoing_id,$incoming_id,$incoming_id,$outgoing_id);
    $query->execute();
    $res = $query->get_result();
    if($res->num_rows>0){
        while($row = $res->fetch_assoc()){
            if($row["outgoing_msg_id"] == $outgoing_id ){
                $message_got .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'.$row["msg"].'</p>
                                    </div>
                                </div>';
            }else{
                $message_got .= "<div class='chat incoming'>
                                    <img src='php/upload/".$row['image']."'>
                                    <div class='details'>
                                    <p>".$row["msg"]."</p>
                                    </div>
                                </div>";
            }
        }
    }
    echo $message_got;

?>