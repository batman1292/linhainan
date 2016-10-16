<html>
    <head>
        <meta charset="utf-8">
        <title>ไทยนำ-ลิมป์ศรีสวัสดิ์</title>
        <link href="../../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php
    session_start();
    $ses_user_id = $_SESSION['ses_user_id'];
    if ($ses_user_id == "") {
        header("Location: ../index.php?error=3");
    }

    include '../../helper/db_connect.php';
    include '../../helper/helper.php';
    connect_database();
    ?>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class= "bs-component" style="margin-bottom: -20px">
            <div class="navbar navbar-material-orange">
                <div class="navbar-header">
                    <a class="navbar-brand">ระบบจัดการฐานข้อมูลสมาชิกมูลนิธิไทยนำ-ลิมป์ศรีสวัสดิ์</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
<!--        <div class=" col-xs-3 btn-material-brown">
            <h3 class="mdi-navigation-menu"> เมนู</h3>
            <ul class="nav nav-pills nav-stacked" >-->
                <?php print_menu(2) ?>
<!--            </ul>
        </div>-->
        <div class="col-xs-9">
            <div class="bs-component">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h1>รายการพิมพ์ข้อมูล</h1>
                    </div>
                </div>
                <div class="row col-xs-5 col-xs-offset-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th width="70%">รายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>แบบฟอร์ม</td>
                                <td><a onClick="javascript:window.open('../../print/add.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')" class="mdi-action-assignment" style="color: white"> พิมพ์แบบฟอร์มว่าง</a></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><a href="print_person.php" class="mdi-action-assignment-ind" style="color: white"> พิมพ์แบบฟอร์มรายบุคคล</a></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><a href="print_person_addr.php" class="mdi-social-person" style="color: white"> พิมพ์ที่อยู่บุคคล</a></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><a href="print_persons_addr.php" class="mdi-social-people" style="color: white"> พิมพ์ที่อยู่หลายบุคคล</a></td>
                            </tr>
                            <tr>
                                <td>รายงาน</td>
                                <td><a href="print_report.php" class="mdi-content-content-paste" style="color: white"> พิมพ์รายงานผู้ลงทะเบียนประจำปี</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>