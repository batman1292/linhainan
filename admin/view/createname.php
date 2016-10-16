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
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        ?>
        <script>
            function check(id) {
                window.location = '../action/checkparent.php?id=' + id + '&type=create';
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
                        <li><a href="../../logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--        <div class=" col-xs-3 btn-material-brown">
                    <h3 class="mdi-navigation-menu"> เมนู</h3>
                    <ul class="nav nav-pills nav-stacked" >-->
        <?php print_menu(3) ?>
        <!--            </ul>
                </div>-->
        <div class=" col-xs-9">
            <center>
                <h1>สร้างชื่อจีน</h1>
                <div class="row" style="margin-top: -3px">
                    <div class="col-xs-10 col-xs-offset-1 well">
                        <form class="form-horizontal" action="createname.php" method="Get" style="margin-left:-10px; margin-top: 10px">
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-3" style="margin-top: -20px">
                                    <h2>ค้นหาข้อมูล</h2>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-xs-5 col-xs-offset-1">
                                    <input type="text" class="form-control" placeholder="กรอกข้อมูลที่ต้องการค้นหา" required autofocus name="data">
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
                                         <!--<option value="2" <?php // if (isset($_GET['search'])) {if($_GET['option']==2){echo "selected";}}    ?> >ชื่อจีน</option>-->
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
                        </form>
                        <h4 style="color: red;">*หมายเหตุ หากคนที่ต้องการค้นหามีชื่อจีนแล้วจะค้นหาไม่พบ</h4>
                    </div>
                </div>
                <?php
                connect_database();
                if (isset($_GET['search'])) {
                    $data = $_GET['data'];
                    $search_type = $_GET['option'];
                    $check = mysql_fetch_assoc(mysql_query(search_data_chinaname($data, $search_type)));
                    if (!$check) {
                        $check_chinaname = mysql_fetch_assoc(mysql_query(search_data($data, $search_type)));
//                        print_r($check_chinaname);
                        if (!$check_chinaname) {
                            echo "<script type='text/javascript'>";
                            echo "sweetAlert('ไม่พบข้อมูลที่ท่านค้นหา','', 'info');";
                            echo "</script>";
                        } else {
                            echo "<script type='text/javascript'>";
                            echo "sweetAlert('ข้อมูลที่ท่านค้นหามีชื่อจีนแล้ว','', 'info');";
                            echo "</script>";
                        }
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
        <!--                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>-->
                                    </tr>
                                </thead>
                                <?php
//                            $count = 1;
                                $urlquery_str = "data=$data&option=$search_type&search=";
                                $query = search_data_chinaname($data, $search_type);
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
//                                echo $query;
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
                                            <td><?php print_person_phone_string($id); ?></td>
                                            <td><?php echo get_person_province_string($id, 1); ?></td>
                                            <td>
                                                <?php
                                                if ($person['CHINANAME_ID'] == 0) {
                                                    ?>
                                                    <a style="color:white" class="mdi-action-spellcheck" onClick="check('<?php echo $id; ?>')">สร้างชื่อจีน</a>    
                                                    <?php
                                                } else {
                                                    echo get_person_china_full_name($id, 0);
                                                }
                                                ?>
                                            </td>
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
                    }
                }else {
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
    <!--                                        <th>&nbsp;</th>
                                    <th>&nbsp;</th>-->
                                </tr>
                            </thead>
                            <?php
//                            $count = 1;
                            $urlquery_str = "";
                            $query = search_data_chinaname_default();
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
//                                echo $query;
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
                                        <td><?php print_person_phone_string($id); ?></td>
                                        <td><?php echo get_person_province_string($id, 1); ?></td>
                                        <td>
                                            <?php
                                            if ($person['CHINANAME_ID'] == 0) {
                                                ?>
                                                <a style="color:white" class="mdi-action-spellcheck" onClick="check('<?php echo $id; ?>')">สร้างชื่อจีน</a>    
                                                <?php
                                            } else {
                                                echo get_person_china_full_name($id, 0);
                                            }
                                            ?>
                                        </td>
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
                }
                ?>
            </center>
        </div>
    </body>
</html>