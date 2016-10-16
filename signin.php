<?php

session_start();
include 'helper/db_connect.php';
connect_database();

$username = $_POST['username'];
$pass = $_POST['pass'];

$query = "SELECT * FROM user WHERE USERNAME='$username' AND PASSWORD='$pass'";
$results = mysql_query($query);
$result = mysql_fetch_assoc($results);

if(!empty($result)){
    $_SESSION['ses_user_id'] = $result['TYPE'];
    if($result['TYPE'] == 0){
        header("Location: admin/index.php");
    }else if($result['TYPE'] == 1){
        header("Location: register/index.php");
    }
}else{
    // พาสผิด
    header("Location: index.php?error=1");
}
?>
