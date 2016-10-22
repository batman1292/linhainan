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
        <link href="../../css/loading.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        ?>
        <script>
            function clear_reg() {
                swal({title: "เริ่มลงทะเบียนใหม่", text: "คุณต้องการล้างข้อมูลผู่เข้าร่วมงานของปีก่อนหน้าใช่หรือไม่?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function(isConfirm) {
                    if (isConfirm) {
                        swal({title: "ล้างข้อมูลเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/clear_reg_previous.php';
                    }
                });

//                var del = confirm("คุณต้องการล้างข้อมูลผู่เข้าร่วมงานของปีก่อนหน้าใช่หรือไม่?");
//                if (del === true) {
//                    window.location = '../action/clear_reg_previous.php';
//                    alert('ล้างข้อมูลเสร็จสิ้น');
//                }
            }
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
        <?php print_menu(9); ?>
        <!--            </ul>
                </div>-->
        <div class=" col-xs-9">
            <center>
                <h1>จัดการระบบ</h1>
                <div class="row" style="margin-top: -3px">
                    <div class="col-xs-10 col-xs-offset-1 well">

                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-3">
                                <a class="btn btn-material-deeppurple" style="color: white" role="button" style="margin-top: 0px" onClick="javascript:window.open('setup_gen_menu.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1000,height=650,top=0,left=150 ')">จัดการเมนูลำดับรุ่น</a>
                            </div>
                            <div class="col-xs-3">
                                <a class="btn btn-material-deeppurple" style="color: white" role="button" style="margin-top: 0px" onClick="javascript:window.open('setup_remark_menu.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">จัดการเมนูหมายเหตุฟอร์ม</a>
                            </div>
                            <div class="col-xs-3">
                                <a class="btn btn-material-deeppurple" style="color: white" role="button" style="margin-top: 10px" onClick="javascript:window.open('setup_fevoritname.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1000,height=650,top=0,left=150 ')">จัดการชื่อมงคล(จีน)</a>
                            </div>
                            <div class="col-xs-3">
                                <a class="btn btn-material-deeppurple" style="color: white" role="button" style="margin-top: 10px" onClick="javascript:window.open('setup_sector.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1000,height=650,top=0,left=150 ')">จัดการจังหวัดที่อยู่</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <!-- <div class="col-xs-3">
                                <a class="btn btn-material-deeppurple" style="color: white" role="button" style="margin-top: 10px" onClick="javascript:window.open('setup_user.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=1000,height=650,top=0,left=150 ')">จัดการ User</a>
                            </div> -->
                            <div class="col-xs-3 col-xs-offset-9">
                                <button class="btn btn-material-pink" style="color: white" type="button" style="margin-top: 10px" name="clear_previous" onClick="clear_reg()">เคลียผู้ร่วมงานปีที่แล้ว</button>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </center>
</div>
</body>
</html>
