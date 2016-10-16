<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/fieldset.css" rel="stylesheet" type="text/css"/>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script>
            function del(id, show) {
                var string = "คุณต้องการลบรุ่น " + show;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
                    window.location = '../action/gen_menu.php?action=3&id=' + id;
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "สู่ระบบ?");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=create';
                }
            }
//            setInterval(function() {
//                var id = document.getElementById('data_id').value;
//                var time = document.getElementById('time_old').value;
//                var dataString = "id=" + id + "&time=" + time;
//                $.ajax
//                        ({
//                            url: "../../helper/dbupdate_ajax.php",
//                            type: "POST",
//                            data: dataString,
//                            cache: false,
//                            success: function(html) {
//                                var str = html.toString();
//                                var check = str.search("1");
//                                if (check != -1) {
//                                    location.reload();
//                                }
//
//                            }
//                        });
//            }, 1000);

        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-12">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();
                ?>
                <div class="row">
                    <h1>จัดการข้อมูลจังหวัด อำเภอ และ ตำบล</h1>
                </div>
            </center>
            <div class="well">
                <div class="row">
                    <h3>รายละเอียดข้อมูลแต่ล่ะภาค</h3>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <table class="table" style="color:black">
                            <thead>
                                <tr>
                                    <th><h3>ภาค</h3></th>
                            <th><h3>จำนวนจังหวัด</h3></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h3>กรุงเทพมหานคร</h3></td>
                                    <td style='text-align:right'><h3><a  onClick="javascript:window.location.assign('setup_province_system.php?p_id=1&s_id=0&type=province')">1</a></h3></td>

                                </tr>
                                <?php
                                $counts = count_province_by_province_sector_id(1);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคกลาง</h3></td>
                                    <td style='text-align:right'><h3><a  onClick="javascript:window.location.assign('setup_province_system.php?s_id=1&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_province_by_province_sector_id(2);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคเหนือ</h3></td>
                                    <td style='text-align:right'><h3><a  onClick="javascript:window.location.assign('setup_province_system.php?s_id=2&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_province_by_province_sector_id(3);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคตะวันออกเฉียงเหนือ</h3></td>
                                    <td style='text-align:right'><h3><a  onClick="javascript:window.location.assign('setup_province_system.php?s_id=3&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_province_by_province_sector_id(4);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคตะวันออก</h3></td>
                                    <td style='text-align:right'><h3><a  onClick="javascript:window.location.assign('setup_province_system.php?s_id=4&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_province_by_province_sector_id(5);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคตะวันตก</h3></td>
                                    <td style='text-align:right'><h3><a  onClick="javascript:window.location.assign('setup_province_system.php?s_id=5&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_province_by_province_sector_id(6);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคใต้</h3></td>
                                    <td style='text-align:right'><h3><a  onClick="javascript:window.location.assign('setup_province_system.php?s_id=6&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>