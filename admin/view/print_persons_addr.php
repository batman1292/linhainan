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
//    include '../../helper/db_connect.php';
//    connect_database();
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
            <center>
                <h1>พิมพ์ข้อมูลที่อยู่หลายบุคคล</h1>
                <div class="row" style="margin-top: -3px">
                    <div class="col-xs-10 col-xs-offset-1 well">
                        <form class="form-horizontal" action="print_persons_addr.php" method="Get" style="margin-left:-10px; margin-top: 10px">
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-3" style="margin-top: -20px">
                                    <h2>เลือกรายการที่ต้องการพิมพ์</h2>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-xs-1 col-xs-offset-1" style="margin-top: 10px">
                                    เริ่ม
                                </div>
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" placeholder="" required autofocus name="start_data">
                                </div>
                                <div class="col-xs-1" style="margin-top: 10px">
                                    ถึง
                                </div>
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" placeholder="" required autofocus name="end_data">
                                </div>
                                <div class="col-xs-3">
                                    <select class="form-control" id="select" style="margin-top: 5px" name="option">
                                        <option value="1">running number</option>
                                        <option value="2">ตัวอักษรตัวแรกของชื่อ</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" class="form-control" name="numprint" required placeholder="กรอกจำนวนที่ต้องการพิม">
                                </div>
                            </div>
                            <div class="row" style="margin-top:50px">
                                <div class="col-xs-2 col-xs-offset-3">
                                    <button class="btn btn-success" type="submit" style="margin-top: -10px" name="search">พิมพ์ข้อมูล</button>
                                </div>
                                <div class="col-xs-3 ">
                                    <a class="btn btn-material-indigo" role="button" style="margin-top: -10px" onClick="javascript:window.open('../../print/all_person_addr.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">พิมพ์ทั้งหมด</a>
                                </div>
                                <div class="col-xs-2">
                                    <a class="btn btn-material-red" role="button" style="margin-top: -10px" onClick="javascript:window.location.assign('print.php')">ย้อนกลับ</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
//                    include '../../helper/db_connect.php';
//                    include '../../helper/helper.php';

                    connect_database();
                    if (isset($_GET['search'])) {
                        $start_data = $_GET['start_data'];
                        $end_data = $_GET['end_data'];
                        $search_type = $_GET['option'];
                        $numprint = $_GET['numprint'];
                        $check = mysql_fetch_assoc(mysql_query(search_between_data($start_data, $end_data, $search_type)));
                        if (!$check) {
                            echo "<script type='text/javascript'>";
                            echo "alert('ไม่พบข้อมูลที่ท่านค้นหา');";
                            echo "</script>";
                        } else {
                            ?>
                            <script type='text/javascript'>
                                javascript:window.open('../../print/persons_addr.php?start_data=<?php echo $start_data; ?>&end_data=<?php echo $end_data; ?>&search_type=<?php echo $search_type; ?>&num_print=<?php echo $numprint; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')
                            </script>
                            <?php
                        }
                    }
                    ?>
                </div>
            </center>
        </div>
    </body>
</html>
