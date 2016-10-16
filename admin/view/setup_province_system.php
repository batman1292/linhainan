<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}

include '../../helper/db_connect.php';
include '../../helper/helper.php';

connect_database();

if ($_GET['type'] == "sector") {
    $data = $_GET['s_id'];
    $headder_str = "รายละเอียดข้อมูลจังหวัดของ ภาค";
    $add_str = "เพื่มข้อมูลจังหวัดในภาค";
    if ($_GET['s_id'] == 1) {
        $headder_str .= 'กลาง';
        $add_str .= 'กลาง';
    } else if ($_GET['s_id'] == 2) {
        $headder_str .= 'เหนือ';
        $add_str .= 'เหนือ';
    } else if ($_GET['s_id'] == 3) {
        $headder_str .= 'ตะวันออกเฉียงเหนือ';
        $add_str .= 'ตะวันออกเฉียงเหนือ';
    } else if ($_GET['s_id'] == 4) {
        $headder_str .= 'ตะวันออก';
        $add_str .= 'ตะวันออก';
    } else if ($_GET['s_id'] == 5) {
        $headder_str .= 'ตะวันตก';
        $add_str .= 'ตะวันตก';
    } else if ($_GET['s_id'] == 6) {
        $headder_str .= 'ใต้';
        $add_str .= 'ใต้';
    }
    $querys = get_province_id_by_province_sector_id($data);
} else if ($_GET['type'] == "province") {
    $data = $_GET['p_id'];
    $s_id = $_GET['s_id'];
    $headder_str = "รายละเอียดข้อมูลอำเภอ/เขตของ จังหวัด" . get_province_string($data);
    $querys = get_amphur_id_by_province_id($data);
} else if ($_GET['type'] == "amphur") {
    $data = $_GET['a_id'];
    $p_id = $_GET['p_id'];
    $s_id = $_GET['s_id'];
    $headder_str = "รายละเอียดข้อมูลตำบล/แขวงของ อำเภอ" . get_amphur_string($data);
    $querys = get_district_id_by_province_id($data);
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
            function del(id, show, type, data, p_id) {
                var string = "คุณต้องการลบข้อมูล " + show;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
                    window.location = '../action/province_system.php?action=del&type=' + type + '&id=' + id + '&data=' + data + '&p_id=' + p_id;
                }
            }

        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-12">
            <center>                
                <div class="row">
                    <h1>จัดการข้อมูลจังหวัด อำเภอ และ ตำบล</h1>
                </div>
            </center>
            <div class="well">
                <div class="row">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><?php echo $headder_str; ?>
                            <?php
                            if ($_GET['type'] == "sector") {
                                ?>
                                <a onClick="javascript:window.location.assign('setup_province_system_form.php?type=1&action=add&s_id=<?php echo $data; ?>')">เพิ่มข้อมูลจังหวัด</a>
                                <?php
                            } else if ($_GET['type'] == "province") {
                                ?>
                                <a onClick="javascript:window.location.assign('setup_province_system_form.php?type=2&action=add&p_id=<?php echo $data; ?>')">เพิ่มข้อมูลอำเภอ</a>
                                <?php
                            } else if ($_GET['type'] == "amphur") {
                                ?>
                                <a onClick="javascript:window.location.assign('setup_province_system_form.php?type=3&action=add&p_id=<?php echo $p_id; ?>&a_id=<?php echo $data; ?>')">เพิ่มข้อมูลตำบล</a>
                                <?php
                            }
                            ?>

                        </legend>
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1">
                                <table class="table" style="color:black">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php
                                                if ($_GET['type'] == "sector") {
                                                    echo "จังหวัด";
                                                } else if ($_GET['type'] == "province") {
                                                    echo "อำเภอ/เขต";
                                                } else if ($_GET['type'] == "amphur") {
                                                    echo "ตำบล/แขวง";
                                                }
                                                ?>
                                            </th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($query = mysql_fetch_assoc($querys)) {
//                                    print_r($query);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if ($_GET['type'] == "sector") {
                                                        echo $query['PROVINCE_NAME'];
                                                    } else if ($_GET['type'] == "province") {
                                                        echo $query['AMPHUR_NAME'];
                                                    } else if ($_GET['type'] == "amphur") {
                                                        echo $query['DISTRICT_NAME'];
                                                    }
                                                    ?>
                                                </td>
                                                <!--เรียกดู-->
                                                <td>
                                                    <?php
                                                    if ($_GET['type'] == "sector") {
//                                                        echo $query['PROVINCE_NAME'];
                                                        ?>
                                                        <a onClick="javascript:window.location.assign('setup_province_system.php?p_id=<?php echo $query['PROVINCE_ID']; ?>&s_id=<?php echo $data; ?>&type=province')">เรียกดูข้อมูลอำเภอ/เขต</a>
                                                        <?php
                                                    } else if ($_GET['type'] == "province") {
                                                        ?>
                                                        <a onClick="javascript:window.location.assign('setup_province_system.php?a_id=<?php echo $query['AMPHUR_ID']; ?>&p_id=<?php echo $data; ?>&s_id=<?php echo $s_id; ?>&type=amphur')">เรียกดูข้อมูลตำบล/แขวง</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <!--edit-->
                                                <td>
                                                    <?php
                                                    if ($_GET['type'] == "sector") {
//                                                        echo $query['PROVINCE_NAME'];
                                                        ?>
                                                        <a onClick="javascript:window.location.assign('setup_province_system_form.php?type=1&action=edit&p_id=<?php echo $query['PROVINCE_ID']; ?>&s_id=<?php echo $data; ?>')">แก้ไขข้อมูลจังหวัด</a>
                                                        <?php
                                                    } else if ($_GET['type'] == "province") {
                                                        ?>
                                                        <a onClick="javascript:window.location.assign('setup_province_system_form.php?type=2&action=edit&a_id=<?php echo $query['AMPHUR_ID']; ?>&p_id=<?php echo $data; ?>')">แก้ไขข้อมูลอำเภอ/เขต</a>
                                                        <?php
                                                    } else if ($_GET['type'] == "amphur") {
                                                        ?>
                                                        <a onClick="javascript:window.location.assign('setup_province_system_form.php?type=3&action=edit&a_id=<?php echo $data; ?>&p_id=<?php echo $p_id; ?>&d_id=<?php echo $query['DISTRICT_ID']; ?>')">แก้ไขข้อมูลตำบล/แขวง</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <!--del-->
                                                <td>
                                                    <?php
                                                    if ($_GET['type'] == "sector") {
//                                                        echo $query['PROVINCE_NAME'];
                                                        ?>
                                                        <a onclick="del('<?php echo $query['PROVINCE_ID']; ?>', '<?php echo $query['PROVINCE_NAME']; ?>', '1', '<?php echo $data; ?>')">ลบข้อมูลจังหวัด</a>
                                                        <?php
                                                    } else if ($_GET['type'] == "province") {
                                                        ?>
                                                        <a onclick="del('<?php echo $query['AMPHUR_ID']; ?>', '<?php echo $query['AMPHUR_NAME']; ?>', '2', '<?php echo $data; ?>')">ลบข้อมูลอำเภอ/เขต</a>
                                                        <?php
                                                    } else if ($_GET['type'] == "amphur") {
                                                        ?>
                                                        <a onclick="del('<?php echo $query['DISTRICT_ID']; ?>', '<?php echo $query['DISTRICT_NAME']; ?>', '3', '<?php echo $data; ?>', '<?php echo $p_id; ?>')">ลบข้อมูลตำบล/แขวง</a>
                                                        <?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-5">
                                <?php
                                if ($_GET['type'] == "sector") {
                                    ?>
                                    <a onClick="javascript:window.location.assign('setup_sector.php')"  role="button" class="btn btn-danger">ย้อนกลับ</a>
                                    <?php
                                } else if ($_GET['type'] == "province") {
                                    if ($s_id == 0) {
                                        ?>
                                        <a onClick="javascript:window.location.assign('setup_sector.php')"  role="button" class="btn btn-danger">ย้อนกลับ</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a onClick="javascript:window.location.assign('setup_province_system.php?s_id=<?php echo $s_id; ?>&type=sector')"  role="button" class="btn btn-danger">ย้อนกลับ</a>
                                        <?php
                                    }
                                } else if ($_GET['type'] == "amphur") {
                                    ?>
                                    <a onClick="javascript:window.location.assign('setup_province_system.php?s_id=<?php echo $s_id; ?>&p_id=<?php echo $p_id; ?>&type=province')" role="button" class="btn btn-danger">ย้อนกลับ</a>
                                    <?php
                                }
                                ?>
                                <!--<a onClick="javascript:window.history.back()" role="button" class="btn btn-danger">ย้อนกลับ</a>-->
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </body>
</html>