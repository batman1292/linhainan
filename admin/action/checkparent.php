<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <script src="../../helper/jquery-latest.js" type="text/javascript"></script>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <script type='text/javascript'>
        </script>
    </head>
    <body>
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        connect_database();
        $id = $_GET['id'];
        $check = $_GET['type'];
        $persons = get_person_detial($id);
        $person = mysql_fetch_assoc($persons);
//print_r($person);
        if ($check == 'create' || $check == 'add') {
            if ($person['PARENT_ID'] == 0 && $person['BROTHER_LIST'] == '') {
                echo "<script type='text/javascript'>";

                echo '$(document).ready(function() {'
                . 'swal({title: "ข้อมูลไม่เพียงพอ บิดาไม่ได้ระบุรุ่นในตระกูล", text:  " ",' .
                'type: "warning",' .
                'showCancelButton: true,' .
                'confirmButtonColor: "#DD6B55",' .
                'confirmButtonText: "สร้างชื่อจีนโดยไม่ทราบรุ่นบิดา",' .
                'cancelButtonText: "สร้างชื่อจีนจากรุ่นบิดา",' .
                'closeOnConfirm: false, closeOnCancel: false},' .
                'function(isConfirm) {' .
                'if (isConfirm) {' .
                'window.location.assign("../view/makename.php?id=' . $id . '&gen_id=");' .
                '}else {window.location.assign("../view/findparent.php?id=' . $id . '&type=' . $check . '");}' .
                '});});';
                echo "</script>";
                echo "<script type='text/javascript'>";
                echo "</script>";
            } else if ($person['PARENT_ID'] != 0) {
                $parent_id = $person['PARENT_ID'];
                $parents = get_person_detial($parent_id);
                $parent = mysql_fetch_assoc($parents);
                if ($parent['GENERATION_ID'] == 0) {
                    $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $id);
                    while ($brother = mysql_fetch_assoc($brothers)) {
                        if ($brother['GENERATION_ID'] != 0) {
                            $gen_id = $brother['GENERATION_ID'];
                            header("Location: ../view/makename.php?id=$id&gen_id=$gen_id");
                        }
                    }
                    $index = 1;
                    $gen_id = 0;
                    $loop_id = $parent['ID'];
                    while (1) {
                        $loop_parents = get_person_detial($loop_id);
                        $loop_parent = mysql_fetch_assoc($loop_parents);
                        $gen_id = check_gen_id($loop_parent, $index);
                        if ($gen_id == 0) {
                            break;
                        } else if ($gen_id == 1) {
                            $index++;
                            $loop_parents = get_person_detial($loop_id);
                            $loop_parent = mysql_fetch_assoc($loop_parents);
                            $loop_id = $loop_parent['PARENT_ID'];
                        } else {
                            header("Location: ../view/makename.php?id=$id&gen_id=$gen_id");
                        }
                    }
                    echo "<script type='text/javascript'>";
                    echo '$(document).ready(function() {'
                    . 'swal({title: "ข้อมูลไม่เพียงพอ บิดาไม่ได้ระบุรุ่นในตระกูล", text:  " ",' .
                    'type: "warning",' .
                    'showCancelButton: true,' .
                    'confirmButtonColor: "#DD6B55",' .
                    'confirmButtonText: "สร้างชื่อจีนโดยไม่ทราบรุ่นบิดา",' .
                    // 'cancelButtonText: "สร้างชื่อจีนจากรุ่นบิดา",' .
                    'closeOnConfirm: false, closeOnCancel: false},' .
                    'function(isConfirm) {' .
                    'if (isConfirm) {' .
                    'window.location.assign("../view/makename.php?id=' . $id . '&gen_id=");' .
                    '}else {window.location.assign("../view/createname.php");}' .
                    '});});';
                    echo "</script>";
                } else {
                    $gen_id = $parent['GENERATION_ID'] + 1;
                    header("Location: ../view/makename.php?id=$id&gen_id=$gen_id");
                }
            } else {
                $has_parent = false;
                $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $id);
                while ($brother = mysql_fetch_assoc($brothers)) {
                    if ($brother['PARENT_ID'] != 0) {
                        $has_parent = true;
//                    $parent_id = $brother['PARENT_ID'];
                        add_parent_id($id, $brother['PARENT_ID']);
                    }
                    if ($brother['GENERATION_ID'] != 0) {
                        $gen_id = $brother['GENERATION_ID'];
                        header("Location: ../view/makename.php?id=$id&gen_id=$gen_id");
                    }
                }
                if ($has_parent) {
                    header("Location:'checkparent.php?id=$id&type=$check'");
                } else {
                    echo "<script type='text/javascript'>";
                    echo '$(document).ready(function() {'
                    . 'swal({title: "ข้อมูลไม่เพียงพอ บิดาไม่ได้ระบุรุ่นในตระกูล", text:  " ",' .
                    'type: "warning",' .
                    'showCancelButton: true,' .
                    'confirmButtonColor: "#DD6B55",' .
                    'confirmButtonText: "สร้างชื่อจีนโดยไม่ทราบรุ่นบิดา",' .
                    // 'cancelButtonText: "สร้างชื่อจีนจากรุ่นบิดา",' .
                    'closeOnConfirm: false, closeOnCancel: false},' .
                    'function(isConfirm) {' .
                    'if (isConfirm) {' .
                    'window.location.assign("../view/makename.php?id=' . $id . '&gen_id=");' .
                    '}else {window.location.assign("../view/createname.php");}' .
                    '});});';
                    echo "</script>";
                }
            }
        } else if ($check == 'addr') {
            if ($person['PARENT_ID'] == 0 && $person['BROTHER_LIST'] == '') {
                echo "<script type='text/javascript'>";
//                echo "alert('ไม่พบข้อมูลบิดา กรุณาค้นหาและเลือกบิดา');";
                echo '$(document).ready(function() {';
                echo "swal('ไม่พบข้อมูลบิดา', 'กรุณาค้นหาและเลือกบิดา')";

                echo '});';
                echo "window.location.assign('../view/findparent.php?id=$id&type=$check')";
                echo "</script>";
            } else if ($person['PARENT_ID'] != 0) {
                $parent_id = $person['PARENT_ID'];
                $parents = get_person_detial($parent_id);
                $parent = mysql_fetch_assoc($parents);
                if ($parent['CHINAHOUSE_ID'] == 0) {
                    $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $id);
                    while ($brother = mysql_fetch_assoc($brothers)) {
                        if ($brother['CHINAHOUSE_ID'] != 0) {
                            add_chinahouse($id, $brother['CHINAHOUSE_ID']);
                            echo "<script type='text/javascript'>";
                            echo "window.location.assign('../view/chinaaddr.php?id=$id')";
                            echo "</script>";
                        }
                    }
                    $index = 1;
                    $gen_id = 0;
                    $loop_id = $parent['ID'];
                    while (1) {
                        $loop_parents = get_person_detial($loop_id);
                        $loop_parent = mysql_fetch_assoc($loop_parents);
                        $chinahouse_id = check_chinahouse($loop_parent);
                        if ($chinahouse_id == 0) {
                            break;
                        } else if ($chinahouse_id == 1) {
                            $loop_parents = get_person_detial($loop_id);
                            $loop_parent = mysql_fetch_assoc($loop_parents);
                            $loop_id = $loop_parent['PARENT_ID'];
                        } else {
                            add_chinahouse($chinahouse_id, $brother['CHINAHOUSE_ID']);
                            echo "<script type='text/javascript'>";
                            echo "window.location.assign('../view/chinaaddr.php?id=$id')";
                            echo "</script>";
                        }
                    }
                    echo "<script type='text/javascript'>";
                    echo '$(document).ready(function() {'
                    . 'swal({title: "ข้อมูลไม่เพียงพอ บิดาไม่ได้ระบุที่อยู่บรรพบุรุษที่ประเทศจีน",' .
                    'type: "warning",' .
                    'showCancelButton: true,' .
                    'confirmButtonColor: "#DD6B55",' .
                    'confirmButtonText: "เพื่มข้อมูลที่อยู่บรรพบุรุษที่ประเทศจีนด้วยมือ",' .
                    // 'cancelButtonText: "เพื่มข้อมูลที่อยู่บรรพบุรุษที่ประเทศจีนด้วยข้อมูลบิดา",' .
                    'closeOnConfirm: false, closeOnCancel: false},' .
                    'function(isConfirm) {' .
                    'if (isConfirm) {' .
                    'window.location.assign("../view/add_chinahouse.php?id=' . $id . '&gen_id=");' .
                    '}else {window.location.assign("../view/ancestorsaddr.php");}' .
                    '});});';
                    echo "</script>";
                } else {
                    add_chinahouse($id, $parent['CHINAHOUSE_ID']);
                    echo "<script type='text/javascript'>";
                    echo "window.location.assign('../view/chinaaddr.php?id=$id')";
                    echo "</script>";
                }
            } else {
                $has_parent = false;
//            $parent_id = 0;
                $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $id);
                while ($brother = mysql_fetch_assoc($brothers)) {
                    if ($brother['PARENT_ID'] != 0) {
                        $has_parent = true;
//                    $parent_id = $brother['PARENT_ID'];
                        add_parent_id($id, $brother['PARENT_ID']);
                    }
                    if ($brother['CHINAHOUSE_ID'] != 0) {
                        add_chinahouse($id, $brother['CHINAHOUSE_ID']);
                        echo "<script type='text/javascript'>";
                        echo "window.location.assign('../view/chinaaddr.php?id=$id')";
                        echo "</script>";
                    }
                }
                if ($has_parent) {
                    header("Location:'checkparent.php?id=$id&type=$check'");
                } else {
                    echo "<script type='text/javascript'>";
                    echo '$(document).ready(function() {'
                    . 'swal({title: "ข้อมูลไม่เพียงพอ บิดาไม่ได้ระบุที่อยู่บรรพบุรุษที่ประเทศจีน",' .
                    'type: "warning",' .
                    'showCancelButton: true,' .
                    'confirmButtonColor: "#DD6B55",' .
                    'confirmButtonText: "เพื่มข้อมูลที่อยู่บรรพบุรุษที่ประเทศจีนด้วยมือ",' .
                    // 'cancelButtonText: "เพื่มข้อมูลที่อยู่บรรพบุรุษที่ประเทศจีนด้วยข้อมูลบิดา",' .
                    'closeOnConfirm: false, closeOnCancel: false},' .
                    'function(isConfirm) {' .
                    'if (isConfirm) {' .
                    'window.location.assign("../view/add_chinahouse.php?id=' . $id . '&gen_id=");' .
                    '}else {window.location.assign("../view/ancestorsaddr.php");}' .
                    '});});';

                    echo "</script>";
                }
            }
        }
        ?>
    </body>
</html>
