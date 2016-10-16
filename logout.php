<?php
session_start();
unset ( $_SESSION['ses_userid'] );
unset ( $_SESSION['ses_username'] );
session_destroy();
//
header("Location: index.php");
?>
