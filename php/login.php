<?php
    session_start();

    include_once "config.php";
    include_once "sql_safety.php";
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    $hash_pwd =crypt($pwd,HASH);
    if( !empty($email) && !empty($pwd) ){
        $sql = "SELECT * FROM users WHERE email=? AND  pwd=?";
        if(numRows($conn,$sql,[$email,$hash_pwd])>0){
            if($res = fetchAssoc($conn,$sql,[$email,$hash_pwd])){

                $query = "UPDATE users SET status=? WHERE id =?";
                $res2 = allsafeQuery($conn,$query,["s","i"],["Active now", $res['id']]);
                $_SESSION['id'] = $res['id'];
                echo "success";
            }else{
                echo "Something went wrong!";
            }
        }
        else{
            echo "Your email or password is incorrect!";
        }
    }
    else{
        echo "All input field are request!";
    }
?>
