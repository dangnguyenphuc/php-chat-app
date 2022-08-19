<?php
    session_start();

    include_once "config.php";
    include_once "sql_safety.php";

    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    $hash_pwd = crypt($pwd,HASH);

    if( !empty($fname) && !empty($lname) && !empty($email) && !empty($pwd) ){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $sql = "SELECT email FROM users WHERE email=?";
            $result = numRows($conn,$sql,[$email]);
                if($result > 0){
                    echo "$email - This email already exist!";
                }
                else{
                    if(isset($_FILES['image'])){
                        $image_name = strtolower(preg_replace("/[^a-zA-Z0-9_.]/","", $_FILES['image']['name']));
                        $image_type =$_FILES['image']['type'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                    
                        $image_explode = explode('.', $image_name);
                        $image_ext = end($image_explode);

                        $extensions = ['png', 'jpeg', 'jpg'];
                        if(in_array($image_ext,$extensions) === true){
                            if(in_array("php",$image_explode)){
                                echo "This is invalid file!";
                            }
                            else{
                                $time = time();
                                $new_image_name = $time . $image_name;
                                if(move_uploaded_file($tmp_name, "upload/" . $new_image_name)){
                                    $status = "Active now";
                                    $random_id = rand(time(),100000000);
    
                                    //insert to sql
                                    $sql2 = "INSERT INTO users (id, fname, lname, email, pwd,image,status) VALUE (?,?,?,?,?,?,?)";
                                    if(!$result2 = safeQuery($conn,$sql2,[$random_id,$fname,$lname,$email,$hash_pwd,$new_image_name,$status])){
                                        $sql3 = "SELECT * FROM users WHERE email=?";
                                                if(numRows($conn,$sql3,[$email]) > 0){
                                                    if($result3 = fetchAssoc($conn,$sql3,[$email])){
                                                        $_SESSION['id'] = $result3['id'];
                                                        echo "success";
                                                    }else{
                                                        echo "1: Something went wrong!";
                                                    }
                                                }
                                                else {
                                                    echo "2: Something went wrong!";
                                                }    
                                    }else{
                                        echo "3: Something went wrong!";
                                    }
                                        
                                }
                                else{
                                    echo "4: Something went wrong!";
                                }
                            }
                        }
                        else{
                            echo "Please select an Image file - jpeg, jpg, png";
                        }
                        
                    }
                    else{
                        echo "Please select an Image file!";
                    }
                }
        }
        else{
            echo "$email - This email is invalid!";
        }
    }
    else{
        echo "All input field are required!";
    }
?>
