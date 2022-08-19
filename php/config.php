<?php
 
//blacklist
$blacklist = array(
    '127.0.0.1',
    '192.168.1.1',
    // etc.
);

$ip = isset($_SERVER['REMOTE_ADDR']) ? trim($_SERVER['REMOTE_ADDR']) : '';

if (($key = array_search($ip, $blacklist)) !== false) {
    http_response_code(403);
    echo trim('<!DOCTYPE html>
                <html>
                <head>
                <title>403</title>
                </head>
                <body>You are forbidden from accessing this resource!
                </body>
                </html>');
    exit();
}


    define("HOST","localhost");
    define("USERNAME","root");
    define("PWD","");
    define("DATABASE","login_chat_app");
    define("HASH",'$2a$07$usesomesillystringforsalt$');

    $conn = mysqli_connect(HOST, USERNAME, PWD, DATABASE);

    if(!$conn){
        echo "Database not connected" . mysqli_connect_error();
    }
