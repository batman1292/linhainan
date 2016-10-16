<?php

include('db_connect.php');
connect_database();

if(isset($_POST['registerall'])){
    $old = $_POST['registerall'];
    $new = get_numall_register();
    if($old != $new){
        echo "reload";
    }
}
if (isset($_POST['id'])) {
    $id = $_POST["id"];
    $time_old = $_POST["time"];

    $new_time = get_last_update($id);

    if ($new_time != $time_old) {
        echo "reload";
    }
}
if (isset($_POST['number_old'])) {
    $number_old = $_POST['number_old'];
    $number = get_num_register();
    if ($number != $number_old) {
        echo "reload";
    }
}

?>