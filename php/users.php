 <?php
    session_start();
    include_once "config.php";
    include_once "sql_safety.php";

    $outgoing_id = $_SESSION['id'];
    $sql_res = mysqli_query($conn, "SELECT * FROM users");
    $res = "";
    if(mysqli_num_rows($sql_res) == 1){
        $res = "No users are available to chat";
    }
    elseif(mysqli_num_rows($sql_res)>0){
        include "data.php";
    }
    echo $res;
 ?>