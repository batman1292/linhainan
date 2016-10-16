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
                var string = "คุณต้องการลบหมายเหตุ " + show;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
                    window.location = '../action/remark_menu.php?action=3&id=' + id;
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
        <div class=" col-sm-102">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();
                ?>
                <div class="row">
                    <h1>จัดการข้อมูลหมายเหตุ
                    </h1>
                </div>
            </center>
            <div class="well">
                <div class="row">
                    <h3>รายละเอียดข้อมูล</h3>
                </div>
                <div class="row">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">หมายเหตุ
                            <a onClick="javascript:window.location.assign('setup_remark_menu_form.php?&action=1')">เพิ่มข้อมูล</a>
                        </legend>
                        <?php
                        $remarks = get_all_remark();
                        $check = mysql_fetch_assoc($remarks);
                        if ($check) {
                            $count = 1;
                            ?>
                            <table class="table" style="color:black">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>รายละเอียด</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $remarks = get_all_remark();
                                    while ($remark = mysql_fetch_assoc($remarks)) {
                                        $id = $remark['ID'];
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $remark['REMARK_NAME']; ?></td>
                                            <td><a onClick="javascript:window.location.assign('setup_remark_menu_form.php?action=2&id=<?php echo $id; ?>')">แก้ไข</a></td> 
                                            <td><a onclick="del('<?php echo $id; ?>', '<?php echo $remark['REMARK_NAME']; ?>')">ลบ</a></td>
                                        </tr>    
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            ?>
                            <h4>ไม่มีข้อมูลกรุณาเพิ่มข้อมูล</h4>    
                            <?php
                        }
                        ?>
                    </fieldset>
                </div>

            </div>
        </form>
    </div>
</body>
</html>