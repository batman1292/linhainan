<html>
    <head>
        <title>ไทยนำ-ลิมป์ศรีสวัสดิ์</title>
        <meta charset="utf-8">
        <link href="../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <script src="../helper/jquery-1.11.1.min.js" type="text/javascript"></script>        
        <link href="../css/fieldset.css" rel="stylesheet" type="text/css"/>
        <link href="../css/tooltips/tooltips.css" rel="stylesheet" type="text/css"/>
        <script src="../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/sweetalert/sweetalert.css">
        <?php session_start(); ?>
        <script>
            function del(data, id, search_data, search_option) {
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
                        window.location = 'action/del.php?id=' + id + '&data=' + search_data + '&option=' + search_option;
                    }
                });
            }
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
            setInterval(function() {
                var numregisterall = document.getElementById('registerall').value;
                var list_data = document.getElementById('list_data').value;
                var data_all = list_data.split(",");

                var list_time = document.getElementById('list_time').value;
                var time_all = list_time.split(",");
                for (i = 0; i < data_all.length; i++) {
                    var id = data_all[i];
                    var time = time_all[i];
                    var dataString = "registerall="+numregisterall+"&id=" + id + "&time=" + time;
                    $.ajax
                            ({
                                url: "../helper/dbupdate_ajax.php",
                                type: "POST",
                                data: dataString,
                                cache: false,
                                success: function(html) {
                                   
                                    var str = html.toString();
                                    var check = str.search("reload");
                                    if (check != -1) {
                                        window.location.reload();
                                    }

                                }
                            });

                }
            }, 1000);

        </script>
    </head>
    <?php
    $ses_user_id = $_SESSION['ses_user_id'];
    if ($ses_user_id == "") {
        header("Location: ../index.php?error=3");
    }
    include '../helper/db_connect.php';
    include '../helper/helper.php';

    connect_database();
    ?>
    <body class="btn-danger">
        <div class="container">
            <div class= "bs-component" style="margin-top: 20px">
                <div class="navbar navbar-material-orange">
                    <center>
                        <div class="navbar-header">
                            <a class="navbar-brand">ระบบลงทะเบียนสมาชิกมูลนิธิไทยนำ-ลิมป์ศรีสวัสดิ์ </a>
                        </div>
                        <div class="navbar-collapse collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="../logout.php">ออกจากระบบ</a></li>
                            </ul>
                            <!--</div>-->
                        </div>

                        <div class="pull-right">
                            <!--                            <div class="navbar-brand">
                                                            <a style="margin-top: -10px; color: whitesmoke"  onClick="javascript:window.open('view/gen_table.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">ตารางลำดับรุ่น</a>
                                                        </div>-->
                            <div class="navbar-brand" id="num_register"> จำนวนผู้ลงทะเบียนเข้างาน : <?php echo get_num_register(); ?> คน</div>

                            <div class="navbar-brand" id="num_follower">จำนวนผู้ติดตาม : <?php echo get_num_follower(); ?> คน</div>

                            <div class="navbar-brand" id="">จำนวนผู้เข้างานทั้งหมด : <?php echo (get_numall_register()); ?> คน</div>
                            <input type="text" class="navbar-brand" id="registerall" hidden="" value="<?php echo (get_numall_register()); ?> ">
                        </div>
                    </center>
                </div>
            </div>
            <!--<div class="bs-component">-->
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 well">
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <img src="../img/temp_logo.PNG" class="" style="margin-top: 10px" width="256px" height="212px"/>
                        </div>
                    </div>
                    <div class="row">
                        <form class="form-horizontal" action="index.php" method="Get" style="margin-left:0px; margin-top: 20px">
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
                            <div class="col-xs-3">
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
                                <a class="btn btn-material-orange" role="button" style="margin-top: -10px" onClick="javascript:window.open('view/add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูล</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <?php
            $list_data = "";
            $list_time = "";
            if (isset($_GET['search'])) {
                $list_data = "";
                $list_time = "";
                $data = $_GET['data'];
                $search_type = $_GET['option'];
                $checks = mysql_query(search_data($data, $search_type));
                $check = mysql_fetch_assoc($checks);
                if (!$check) {
                    echo "<script type='text/javascript'>";
                    echo "sweetAlert('ไม่พบข้อมูลที่ท่านค้นหา','', 'info');";
                    echo "</script>";
                } else {
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <center><h3>ผลการค้นหา</h3></center>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table col-xs-12">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>ชื่อจีน</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>จังหวัดที่อยู่</th>
                                    <th>หมายเหตุ</th>
                                    <th>สถานะการลงทะเบียน</th>
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
//                            echo $query;
                            $serachData = mysql_query($query);
                            while ($datas = mysql_fetch_array($serachData)) {
                                $id = $datas[0];
                                $list_data .= "$id,";
                                $persons = get_person_detial($id);
                                $person = mysql_fetch_assoc($persons);
                                $list_time .= $person["LASTUPDATE"] . ",";
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
                                                echo '-';
                                                ?>
                                                                                                                                                            <!--<a style="color:white" class="mdi-action-spellcheck" onClick="check('<?php echo $id; ?>', '<?php echo $person['NAME'] . " " . $person['SURNAME']; ?>')">เพิ่มชื่อจีน</a>-->    
                                                <?php
                                            } else {
                                                echo get_person_china_full_name($id, 0);
                                            }
                                            ?>
                                        </td>
                                        <td><?php print_person_phone_string($id); ?></td>
                                        <td><?php echo get_person_province_string($id, 1); ?></td>
                                        <td><?php print_person_remark($id); ?> </td>
                                        <td>
                                            <?php
                                            $reg = get_register($person['ID']);
                                            if ($reg) {
                                                ?>
                                                <a style="color: white;" class = "mdi-action-done" onClick="javascript:window.open('view/edit_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เข้าร่วมงานแล้ว</a>

                                                <?php
                                            } else {
                                                ?>
                                                <a style="color: white;" class = "mdi-content-clear" onClick="javascript:window.open('view/edit_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">ยังไม่เข้าร่วมงาน</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><a style="color: white;" class="mdi-action-delete" onClick="del('<?php echo get_person_name_string($id) . " " . get_person_surname_string($id); ?>', '<?php echo $id; ?>', '<?php echo $data; ?>', '<?php echo $search_type ?>')">ลบ</a></td>


                                                                                                                                                <!--<td><a style="color: white;" class="mdi-action-pageview"onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $id; ?>')">ดูรายละเอียด</a></td>-->
                                                                                                                                                <!--<td><a style="color: white;" class="mdi-action-delete" onclick="del('<?php echo $person['NAME'] . " " . $person['SURNAME']; ?>', '<?php echo $id; ?>', '<?php echo $_GET['table']; ?>')">ลบ</a></td>-->

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
            <!--</div>-->
            <input type="text" id="list_data" hidden="hidden" value="<?php
            if ($list_data != "") {
                echo substr($list_data, 0, strlen($list_data) - 1);
            }
            ?>">
            <input type="text" id="list_time" hidden="hidden" value="<?php
                   if ($list_time != "") {
                       echo substr($list_time, 0, strlen($list_time) - 1);
                   }
                   ?>">
        </div>

    </body>
</html>