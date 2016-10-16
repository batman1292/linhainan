<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$data_id = $_POST["id"];

    if (isset($_POST["tel"]) && !empty($_POST["tel"])) {
        $tel = $_POST["tel"];
        if (isset($_POST["tel_comment"]) && !empty($_POST["tel_comment"])) {
            $tel_comment = $_POST["tel_comment"];
            add_contact($data_id, $tel, $tel_comment, 1);
        } else {
            add_contact($data_id, $tel, "", 1);
        }
    }
    if (isset($_POST["moblie"]) && !empty($_POST["moblie"])) {
        $moblie = $_POST["moblie"];
        add_contact($data_id, $moblie, '', 2);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = $_POST["email"];
        add_contact($data_id, $email, '', 3);
    }
    if (isset($_POST["line"]) && !empty($_POST["line"])) {
        $line = $_POST["line"];
        add_contact($data_id, $line, '', 4);
    }
    if (isset($_POST["facebook"]) && !empty($_POST["facebook"])) {
        $facebook = $_POST["facebook"];
        add_contact($data_id, $facebook, '', 5);
    }
echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
?>