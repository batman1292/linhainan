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
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>    
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <script>
            $(document).ready(function () {
                $("#select").change(function () {

                    if (document.getElementById('select').value == 2) {
                        document.getElementById('gen_list').style.display = 'block';          // Show
                    } else {
                        document.getElementById('gen_list').style.display = 'none';          // hidden
                    }
                });
                $("#gen_list").change(function () {
                    document.getElementById('data').value = document.getElementById('gen_list').value;
                });
            });
            function add(id, p_id, data, type) {
                swal({title: "เพิ่มบิดา", text:  "ต้องการเพิ่ม '" + data　+"' เป็นบิดาหรือไม่?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function(isConfirm) {
                    if (isConfirm) {
                        swal({   title: "เพิ่มบิดาเสร็จสิ้น",   text: "",   timer: 2000,   showConfirmButton: false });
                        window.location = '../action/add_parent.php?id=' + id + '&type=' + type + '&p_id=' + p_id;
                    }
                });
//                var string = "ต้องการเพิ่ม " + data;
//                var r = confirm(string + "\n" + "เป็นบิดาหรือไม่?");
//                if (r === true) {
////                    add data to db
////                            window.location = 'adding.php?code=' + code + '&department=' + department;
////                    window.location = '../action/addparent.php?id=' + id + '&p_id=' + p_id +'&type=' + type ;
//                    window.location = '../action/add_parent.php?id=' + id + '&type=' + type + '&p_id=' + p_id;
//                }
//                window.location = '../action/addparent.php?id=' + id + '&p_id=' + p_id;
            }
        </script>
    </head>
    <?php
    include '../../helper/db_connect.php';
    include '../../helper/helper.php';

    connect_database();
    $id = $_GET['id'];
    $type = $_GET['type'];
//    echo $type;
    ?>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class= "bs-component" style="margin-bottom: -20px">
            <div class="navbar navbar-material-orange">
                <div class="navbar-header">
                    <a class="navbar-brand">ระบบจัดการฐานข้อมูลสมาชิกมูลนิธิไทยนำ-ลิมป์์ศรีสวัสดิ์</a>
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
                <?php
                if ($type == 'add') {
                    print_menu(2);
                } else if ($type == 'addr') {
                    print_menu(4);
                } else {
                    print_menu(3);
                }
                ?>
<!--            </ul>
        </div>-->
        <div class=" col-xs-9">
            <div class="row" style="margin-top: 20px">
                <div class="col-xs-10 col-xs-offset-1 well">
                    <form class="form-horizontal" action="findparent.php" method="Get" style="margin-left:-10px; margin-top: 10px">
                        <div class="row">
                            <div class="col-xs-6 col-xs-offset-4" style="margin-top: 0px">
                                <h2>ค้นหาข้อมูลบิดา</h2>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-xs-2" style="margin-top: 5px">
                                <select id="gen_list" class="gen_list" hidden>
                                    <?php
                                    echo "<option disabled> รายการรุ่นสาย 1 </option>";
                                    $sql = get_gen_by_type(1);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        echo "<option value='" . $rs["GENERATION_NAME"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                    }
                                    echo "<option disabled> รายการรุ่นสาย 2 </option>";
                                    $sql = get_gen_by_type(2);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        echo "<option value='" . $rs["GENERATION_NAME"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                    }

                                    echo "<option disabled> รายการอื่นๆ </option>";
                                    $sql = get_gen_by_type(3);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        echo "<option value='" . $rs["GENERATION_NAME"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-4 col-xs-offset-1">
                                <input type="text" class="form-control" placeholder="กรอกข้อมูลที่ต้องการค้นหา" required autofocus name="data" id="data">
                            </div>
                            <div class="col-xs-3">
                                <select class="form-control" id="select" style="margin-top: 5px" name="option">
                                    <option value="1" <?php
                                    if (isset($_GET['search'])) {
                                        if ($_GET['option'] == 1) {
                                            echo "selected";
                                        }
                                    }
                                    ?> >ชื่อ-นามสกุล</option>
                                    <option value="2" <?php
                                    if (isset($_GET['search'])) {
                                        if ($_GET['option'] == 2) {
                                            echo "selected";
                                        }
                                    }
                                    ?> >ชื่อจีน</option>
                                    <option value="3" <?php
                                    if (isset($_GET['search'])) {
                                        if ($_GET['option'] == 3) {
                                            echo "selected";
                                        }
                                    }
                                    ?> >จังหวัดที่อยู่</option>
                                    <option value="4" <?php
                                    if (isset($_GET['search'])) {
                                        if ($_GET['option'] == 4) {
                                            echo "selected";
                                        }
                                    }
                                    ?> >เบอร์โทรศัพท์</option>
                                    <option value="5" <?php
                                    if (isset($_GET['search'])) {
                                        if ($_GET['option'] == 5) {
                                            echo "selected";
                                        }
                                    }
                                    ?> >เลขบัตรประจำตัวประชาชน</option>
                                    <option value="6" <?php
                                    if (isset($_GET['search'])) {
                                        if ($_GET['option'] == 6) {
                                            echo "selected";
                                        }
                                    }
                                    ?> >Line</option>
                                    <option value="7" <?php
                                    if (isset($_GET['search'])) {
                                        if ($_GET['option'] == 7) {
                                            echo "selected";
                                        }
                                    }
                                    ?> >Facebook</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-success" type="submit" style="margin-top: -10px" name="search">ค้นหา</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-sm-offset-3">
                                <a class="btn btn-material-orange" role="button" style="margin-top: -10px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">เพิ่มข้อมูล</a>
                            </div>
                            <div class="col-xs-2">
                                <?php
                                if ($type == 'add') {
                                    ?>
                                    <a class="btn btn-material-red" role="button" style="margin-top: -10px" onClick="javascript:window.location.assign('manage_person_table.php')">ย้อนกลับ</a>
                                    <?php
                                } else if ($type == 'addr') {
                                    ?>
                                    <a class="btn btn-material-red" role="button" style="margin-top: -10px" onClick="javascript:window.location.assign('ancestorsaddr.php')">ย้อนกลับ</a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="btn btn-material-red" role="button" style="margin-top: -10px" onClick="javascript:window.location.assign('createname.php')">ย้อนกลับ</a>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <!--                        <div class="row" style="margin-top: 20px">
                                                    <div class="col-xs-2 col-xs-offset-4">
                                                        <a href="createname.php" class="btn btn-danger" role="button" style="margin-top: -10px">ย้อนกลับ</a>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <a class="btn btn-material-orange" role="button" style="margin-top: -10px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=575,top=0,left=150 ')">เพิ่มข้อมูล</a>
                                                    </div>
                                                </div>-->
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="type" value="<?php echo $type; ?>">
                    </form>
                </div>
            </div>
            <?php
            if (isset($_GET['search'])) {
                $data = $_GET['data'];
                $search_type = $_GET['option'];
                $id = $_GET['id'];
                $check = mysql_fetch_assoc(mysql_query(search_data_parent($data, $search_type, $id)));
//                print_r($check);
                if (!$check) {
                    if ($type == 'add') {
                        $error_string = "กรุณาเพิ่มข้อมูลบิดา หรือ แก้ไขข้อมูลชื่อจีนในหน้าฐานข้อมูลสมาชิก";
                    } else if ($type == 'addr') {
                        $error_string = "กรุณาเพิ่มข้อมูลบิดา หรือ แก้ไขข้อมูลที่อยู่ประเทศจีนในหน้าฐานข้อมูลสมาชิก";
                    } else {
                        $error_string = "กรุณาเพิ่มข้อมูลบิดา หรือ แก้ไขข้อมูลชื่อจีนในหน้าฐานข้อมูลสมาชิก";
                    }
                    echo "<script type='text/javascript'>";
//        echo "alert('ไม่พบข้อมูลที่ท่านค้นหา\\n\\$error_string');";
                    echo "swal('ไม่พบข้อมูลที่ท่านค้นหา','$error_string')";
                    echo "</script>";
                } else {
                    ?>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>จังหวัดที่อยู่</th>
                                    <th>ชื่อจีน</th>
                                    <th>&nbsp;</th>
                        <!--<th>&nbsp;</th>-->
                                </tr>
                            </thead>
                            <?php
//                            $count = 1;
                            $urlquery_str = "id=$id&type=$type&data=$data&option=$search_type&search=";
                            $query = search_data_parent($data, $search_type, $id);
                            $table_count = mysql_num_rows(mysql_query($query));
                            $limit = 10;
                            if (isset($_GET['start'])) {
                                $start = $_GET['start'];
                                $page = $_GET['page'];
                                $count = $start + 1;
                            } else {
                                $page = 1;
                                $start = 0;
                                $count = 1;
                            }
                            $query .= " LIMIT $start, $limit";
                            $serachData = mysql_query($query);
                            while ($datas = mysql_fetch_array($serachData)) {
                                $p_id = $datas[0];
                                $persons = get_person_detial($p_id);
                                $person = mysql_fetch_assoc($persons);
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $p_id; ?></td>
                                        <td>
                                            <?php
                                            if ($person['TITLE_ID'] != 0)
                                                echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($p_id) . " " . get_person_surname_string($p_id);
                                            else
                                                echo get_person_name_string($p_id) . " " . get_person_surname_string($p_id);
                                            ?>
                                        </td>
                                        <td><?php print_person_phone_string($p_id); ?></td>
                                        <td><?php echo get_person_province_string($p_id, 1); ?></td>
                                        <td>
                                            <?php
                                            if ($person['CHINANAME_ID'] == 0) {
                                                echo "-";
                                                ?>
                                                            <!--<a style="color:white" class="mdi-action-spellcheck" onClick="check('<?php echo $p_id; ?>')">เพิ่มชื่อจีน</a>-->    
                                                <?php
                                            } else {
                                                echo get_person_china_full_name($p_id, 0);
                                            }
                                            ?>
                                        </td>
                                        <td><a style="color: white" class="mdi-action-done" onClick="add('<?php echo $id; ?>', '<?php echo $p_id; ?>', '<?php echo get_person_name_string($p_id) . " " . get_person_surname_string($p_id); ?>', '<?php echo $type; ?>')">เลือกบิดา</a></td>
            <!--                                            <td><a style="color: white;" class="mdi-action-pageview"onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $id; ?>')">ดูรายละเอียด</a></td>
                                        <td><a style="color: white;" class="mdi-action-delete" onclick="del('<?php echo $person['NAME'] . " " . $person['SURNAME']; ?>', '<?php echo $id; ?>', '<?php echo $_GET['table']; ?>')">ลบ</a></td>-->

                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="row" align="center">-->
                    <?php
                    $page_table = ceil($table_count / $limit);     //เป็นตัวแปรที่กำหนดจำนวนหน้าของข้อมูลที่ถูกตัดมาแล้ว
                    //กำหนดเงื่อนไขที่จะแสดงเลขหน้าเพื่อดึงข้อมูลถัดไป
                    if ($page_table != 1) {
                        //สร้างลูปเพื่อแสดงเลขหน้า และ กดเข้าไปดูข้อมูลได้
                        ?>
                        <div class="row">
                            <center>
                                <?php
                                for ($i = 1; $i <= $page_table; $i++) {
                                    if ($page == $i)
                                        echo "<a style=' background: white;' class='btn btn-default btn-raised disabled' href='?$urlquery_str&start=" . $limit * ($i - 1) . "&page=$i'>$i</a>";
                                    else
                                        echo "<a style=' background: white;' class='btn btn-default btn-raised' href='?$urlquery_str&start=" . $limit * ($i - 1) . "&page=$i'>$i</a>";
                                }
                                ?>
                            </center>
                        </div>
                        <?php
                    }
                    ?>

                    <!--</div>-->
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>