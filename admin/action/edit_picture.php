<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date('Y-m-d H:i:s', time());
$data_id = $_GET["id"];
if (isset($_FILES["picture"])) {
    $time = date('Y-m-d H:i:s', time());
    $target_dir = "../../picture/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $newfilename = basename($_FILES["picture"]["name"]);
    $picture_name = get_picture($data_id);
    echo '1';
    if (file_exists($target_file)) {
        $temp = explode(".", $_FILES["picture"]["name"]);

        $last = mysql_query("SELECT `ID` FROM `picture` ORDER BY ID DESC LIMIT 1");
        $last_id = mysql_fetch_assoc($last);

        print_r($temp);
        $newfilename = $temp[0] . "_" . ($last_id['ID'] + 1) . '.' . end($temp);
        $target_file = $target_dir . $newfilename;
        echo $target_file;
    }
    echo $target_dir;
    if ($picture_name) {
        echo $query = "UPDATE `picture` SET `PICTURE_THRU_DATE`='$time' WHERE `PICTURE_OWNER_ID`=$data_id AND `PICTURE_THRU_DATE`=''";
        mysql_query($query);
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo $sql = "INSERT INTO `picture`( `PICTURE_OWNER_ID`, `PICTURE_NAME`, `PICTURE_FROM_DATE`) VALUES ('$data_id','" . $newfilename . "','$time')";
            mysql_query($sql);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo $sql = "INSERT INTO `picture`( `PICTURE_OWNER_ID`, `PICTURE_NAME`, `PICTURE_FROM_DATE`) VALUES ('$data_id','" . $newfilename . "','$time')";
            mysql_query($sql);
            echo "not old ,The file " . basename($_FILES["picture"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
//$time = date('Y-m-d H:i:s', time());
//$target_dir = "../../picture/";
//$target_file = $target_dir . basename($_FILES["picture"]["name"]);
//echo "รูป " . $target_file;
//if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
////    $sql = "SELECT * FROM `picture` WHERE `PICTURE_OWNER_ID`='$id' and `PICTURE_NAME`='" . basename($_FILES["picture"]["name"]) . "'";
////
////    $res = mysql_query($sql);
////    $result_name = mysql_fetch_assoc($res);
////    if (!$result_name) {
////        $sql = "INSERT INTO `picture`( `PICTURE_OWNER_ID`, `PICTURE_NAME`, `PICTURE_FROM_DATE`) VALUES ('$id','" . basename($_FILES["picture"]["name"]) . "','$time')";
////        set_updatetime($id);
////        mysql_query($sql);
////    }
//    echo "The file " . basename($_FILES["picture"]["name"]) . " has been uploaded.";
//} else {
//    echo "Sorry, there was an error uploading your file.";
//}

    set_updatetime($data_id);
}


header('Location:' . $_SERVER['HTTP_REFERER']);
?>