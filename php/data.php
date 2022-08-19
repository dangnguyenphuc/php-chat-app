<?php
    while($row = mysqli_fetch_assoc($sql_res)){
        if($row["id"]==$_SESSION['id']) continue; // users cant send message to themselves

        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id=? OR outgoing_msg_id=?)
                AND (incoming_msg_id=? OR outgoing_msg_id=?) ORDER BY msg_id DESC LIMIT 1";

        $query2 = $conn->prepare($sql2);
        $query2->bind_param("iiii",$row["id"],$row["id"],$outgoing_id,$outgoing_id);
        $query2->execute();
        $res2 = $query2->get_result();
        $row2 =  $res2->fetch_assoc();
        if($res2->num_rows > 0){
            $res_ = $row2['msg'];
            if($outgoing_id == $row2['outgoing_msg_id']){
                $res_ = "You: ". $res_;
            }
        }else{
            $res_ = "No message available!";
        }
        (strlen($res_)>40)? $msg=substr($res_,0,25)."..." : $msg = $res_;
        $offline ="";
        if($row['status']=="Offline now"){
            $offline="offline";
        }

        $res .= '<a href="chat.php?user_id='.$row['id'].'">
                <div class="content">
                    <img src="php/upload/'. $row['image'] .'" alt="kobayashi_kanna.jpeg">
                    <div class="details">
                        <span>'. $row['fname']." ".$row['lname'] .'</span>
                        <p>'.$msg.'</p>
                    </div>
                </div>
                <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>