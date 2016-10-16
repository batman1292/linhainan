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
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <script>
            function del(id, show) {
                swal({title: "คุณต้องการชื่อมงคล", text:  "คุณต้องการลบ '" + show　+"' ออกจากฐานข้อมูลใช่ไหม?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function(isConfirm) {
                    if (isConfirm) {
                        swal({   title: "ลบสมาชิกเสร็จสิ้น",   text: "",   timer: 2000,   showConfirmButton: false });
                        window.location = '../action/gen_menu.php?action=3&id=' + id;
                    }
                });
                
                
//                var string = "คุณต้องการลบรุ่น " + show;
//                var r = confirm(string + "\n" + "ออกจากระบบ?");
//                if (r === true) {
//                    window.location = '../action/gen_menu.php?action=3&id=' + id;
//                }
            }
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
                $gen_id = $_GET['id'];
                $res = get_generation_detial($gen_id);
                $gen;
                while ($row = mysql_fetch_assoc($res)) {
                    $gen = $row;
                }
                ?>
                <div class="row">
                    <h1>จัดการข้อมูลเมนูรุ่น <?php echo $gen['GENERATION_NAME'];?>
                    </h1>
                </div>
            </center>
            <div class="well">

                <div class="row">
                    <div class="col-xs-10 ">
                        <h3>รายละเอียดข้อมูล สายตระกูล<?php echo $gen['GENERATION_TYPE'];?> ลำดับที่<?php echo $gen['GENERATION_INDEX'];?></h3>
                    </div>
                    <div class="col-xs-2 ">
                        <a onClick="javascript:window.location.assign('setup_fevoritname.php')" role="button" class="btn btn-danger">ย้อนกลับ</a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <a onClick="javascript:window.location.assign('setup_fevoritname_formedit.php?action=1&id=<?php echo $gen_id; ?>')">เพิ่มข้อมูล</a>
                            </legend>
                            <?php
                            $gen_others = get_favorite_name($gen_id);
                            $check = mysql_fetch_assoc($gen_others);
                            if ($check) {
                                ?>
                                <table class="table" style="color:black">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>อักษรจีน</th>
                                            <th>pinyin</th>
                                            <th>อักษรไทย</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $gen_others = get_favorite_name($gen_id);
                                        while ($gen_other = mysql_fetch_assoc($gen_others)) {
                                            $id = $gen_other['ID'];
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $gen_other['FAVORITE_NAME']; ?></td>
                                                <td><?php echo $gen_other['FAVORITE_PINYIN']; ?></td>
                                                <td><?php echo $gen_other['FAVORITE_TH']; ?></td>
                                                <td><a onClick="javascript:window.location.assign('setup_fevoritname_formedit.php?action=2&id=<?php echo $id; ?>&gen=<?php echo $gen_id; ?>')">แก้ไข</a></td> 
                                                <td><a onclick="del('<?php echo $gen_other['ID']; ?>', '<?php echo $gen_other['FAVORITE_NAME']; ?>')">ลบ</a></td>
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