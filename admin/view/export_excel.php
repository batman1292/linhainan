<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
?>
<html>
    <head>
        <title>ไทยนำ-ลิมป์์ศรีสวัสดิ์</title>
        <meta charset="utf-8">
        <link href="../../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/tooltips/tooltips.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../../helper/jquery.blockUI.js" type="text/javascript"></script>
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        ?>
        <script>
            function del(data, id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
//                    add data to db
//                window.location = 'adding.php?code=' + code + '&department=' + department;
                    window.location = '../action/del.php?id=' + id;
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "แบบอัตโนมัติ");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=add';
                }
            }
            function exportExcel() {
                window.location = '../../helper/ExportMySql2Excel.php';
            }
            $(document).ready(function() {
                $('#export_excel').click(function() {
                    $.blockUI();

                });
            });
        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class= "bs-component" style="margin-bottom: -20px">
            <div class="navbar navbar-material-orange">
                <div class="navbar-header">
                    <a class="navbar-brand">ระบบจัดการฐานข้อมูลสมาชิกมูลนิธิไทยนำ-ลิมป์ศรีสวัสดิ์</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../index.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--        <div class=" col-xs-3 btn-material-brown">
                    <h3 class="mdi-navigation-menu"> เมนู</h3>
                    <ul class="nav nav-pills nav-stacked" >-->
        <?php print_menu(6); ?>
        <!--            </ul>
                </div>-->
        <div class=" col-xs-9">
            <center>
                <h1>ฐานข้อมูลสมาชิก</h1>
                <div class="row" style="margin-top: -3px">
                    <div class="col-xs-10 col-xs-offset-1 well">

                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-12">
                                <a class="btn btn-primary" id="export_excel"  role="button" style="margin-top: 0px" onClick="exportExcel()">โหลด excel</a>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </center>            
</div>
</body>
</html>