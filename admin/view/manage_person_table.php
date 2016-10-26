<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
?>
<html>
    <head>
        <title>ไทยนำ-ลิมป์ศรีสวัสดิ์</title>
        <meta charset="utf-8">
        <link href="../../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/tooltips/tooltips.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/loading.css" rel="stylesheet" type="text/css"/>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        connect_database();
        ?>
        <script>
            $(document).ready(function() {
                $("#select").change(function() {

                    if (document.getElementById('select').value == 2) {
                        document.getElementById('gen_list').style.display = 'block';          // Show
                    } else {
                        document.getElementById('gen_list').style.display = 'none';          // hidden
                    }
                });
                $("#gen_list").change(function() {
                    document.getElementById('data').value = document.getElementById('gen_list').value;
                });
            });
            function del(data, id,  indata, type) {
                swal({title: "ลบสมาชิก", text:  "คุณต้องการลบ '" + data　+"' ออกจากฐานข้อมูลใช่ไหม?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function(isConfirm) {
                    if (isConfirm) {
                        swal({   title: "ลบสมาชิกเสร็จสิ้น",   text: "",   timer: 2000,   showConfirmButton: false });
                        window.location = '../action/del.php?id=' + id + '&data=' + indata + '&option='+type;
                    }
                });
//                var string = "คุณต้องการลบ " + data;
//                var r = confirm(string + "\n" + "ออกจากระบบ?");
//                if (r === true) {
////                    add data to db
////                window.location = 'adding.php?code=' + code + '&department=' + department;
//                    window.location = '../action/del.php?id=' + id;
//                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "แบบอัตโนมัติ");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=add';
                }
            }
            function exportExcel() {
                document.getElementById("loading").style.display = "block"
                window.location = '../../helper/ExportMySql2Excel.php';
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
<!--        <div class=" col-xs-3 btn-material-brown    ">
            <h3 class="mdi-navigation-menu"> เมนู</h3>
            <ul class="nav nav-pills nav-stacked" >-->
                <?php print_menu(1); ?>
<!--            </ul>
        </div>-->
        <div class=" col-xs-9">
            <center>
                <h1>ทะเบียนฐานข้อมูลสมาชิก</h1>
                <div class="row" style="margin-top: -3px">
                    <div class="col-xs-10 col-xs-offset-1 well">
                        <form class="form-horizontal" action="manage_person_table.php" method="Get" style="margin-left:-10px; margin-top: 10px">
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-3" style="margin-top: -20px">
                                    <h2>ค้นหาข้อมูล</h2>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-xs-1" style="margin-top: 5px">
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
                                <div class="col-xs-4 col-xs-offset-0">
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
                                <div class="col-xs-2">
                                    <a class="btn btn-material-orange" style="color: white; margin-top: -10px" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูล</a>
                                </div>
                            </div>
                            <!-- <div class="row" style="margin-top: 20px">

                                <div class="col-xs-2 col-xs-offset-10">
                                    <a class="btn btn-material-orange" style="color: white" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูล</a>
                                </div>

                                <div class="col-xs-3">

                                </div>
                            </div> -->
                            <div class="row" style="margin-top: 20px" id="loading" hidden>
                                <center>
                                    <div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>
                                </center>
                            </div>

                    </div>
                    </form>
                </div>
                <?php
                connect_database();
                if (isset($_GET['search'])) {
                    $data = $_GET['data'];
                    $search_type = $_GET['option'];
                    // echo search_data($data, $search_type);
                    $check = mysql_fetch_assoc(mysql_query(search_data($data, $search_type)));
                    if (!$check) {
                        echo "<script type='text/javascript'>";
                        echo "sweetAlert('ไม่พบข้อมูลที่ท่านค้นหา','', 'info');";
                        echo "</script>";
                    } else {
                        ?>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>ชื่อจีน</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>จังหวัดที่อยู่</th>
                                        <th>หมายเหตุ</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <?php
//                            $count = 1;
                                $urlquery_str = "data=$data&option=$search_type&search=";
                                $query = search_data($data, $search_type);
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
                                $query .= "LIMIT $start, $limit";
                                $serachData = mysql_query($query);
                                while ($datas = mysql_fetch_array($serachData)) {
                                    $id = $datas[0];
                                    $persons = get_person_detial($id);
                                    $person = mysql_fetch_assoc($persons);
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $id; ?></td>
                                            <td>
            <?php
            if ($person['TITLE_ID'] != 0)
                echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . " " . get_person_surname_string($id);
            else
                echo get_person_name_string($id) . " " . get_person_surname_string($id);
            ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($person['CHINANAME_ID'] == 0) {
                                                    ?>
                                                    <a style="color:white" class="mdi-action-spellcheck" onClick="check('<?php echo $id; ?>', '<?php echo get_person_name_string($id) . " " . get_person_surname_string($id); ?>')">สร้างชื่อจีน</a>
                <?php
            } else {
                echo get_person_china_full_name($id, 0);
            }
            ?>
                                            </td>
                                            <td><?php print_person_phone_string($id); ?></td>
                                            <td><?php echo get_person_province_string($id, 1); ?></td>
                                            <td><?php print_person_remark($id); ?></td>
                                            <td><a style="color: white;" class="mdi-action-pageview"onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $id; ?>')">ดูรายละเอียด</a></td>

                                            <td><a style="color: white;" class="mdi-action-delete" onClick="del('<?php echo get_person_name_string($id) . " " . get_person_surname_string($id); ?>', '<?php echo $id; ?>', '<?php echo $data; ?>', '<?php echo $search_type; ?>')">ลบ</a></td>

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
    }
}
?>
        </div>
    </center>
</div>
</body>
</html>
