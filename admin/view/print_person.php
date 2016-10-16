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
                <h1>พิมพ์ข้อมูลรายบุคคล</h1>
                <div class="row" style="margin-top: -3px">
                    <div class="col-xs-10 col-xs-offset-1 well">
                        <form class="form-horizontal" action="print_person.php" method="Get" style="margin-left:-10px; margin-top: 10px">
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-3" style="margin-top: -20px">
                                    <h2>ค้นหาข้อมูล</h2>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-xs-4 col-xs-offset-1">
                                    <input type="text" class="form-control" placeholder="กรอกข้อมูลที่ต้องการค้นหา" required autofocus name="data">
                                </div>
                                <div class="col-xs-3">
                                    <select class="form-control" id="select" style="margin-top: 5px" name="option">
                                        <option value="1">ชื่อ-นามสกุล</option>
                                        <option value="2">ชื่อจีน</option>
                                        <option value="3">จังหวัดที่อยู่</option>
                                        <option value="4">เบอร์โทรศัพท์</option>
                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <button class="btn btn-success" type="submit" style="margin-top: -10px" name="search">ค้นหา</button>
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
                        $data = $_GET['data'];
                        $search_type = $_GET['option'];
                        $check = mysql_fetch_assoc(mysql_query(search_data($data, $search_type)));
                        if (!$check) {
                            echo "<script type='text/javascript'>";
                            echo "alert('ไม่พบข้อมูลที่ท่านค้นหา');";
                            echo "</script>";
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>ชื่อจีน</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>จังหวัดที่อยู่</th>
                                                <th>&nbsp;</th>
                                                <!--<th>&nbsp;</th>-->
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
                                                            echo '-';
                                                            ?>
                                                                <!--<a style="color:white" class="mdi-action-spellcheck" onClick="check('<?php echo $id; ?>', '<?php echo get_person_name_string($id) . " " . get_person_surname_string($id); ?>')">สร้างชื่อจีน</a>-->    
                                                            <?php
                                                        } else {
                                                            echo get_person_china_full_name($id, 0);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php print_person_phone_string($id); ?></td>
                                                    <td><?php echo get_person_province_string($id, 1); ?></td>
                                                    <td><a style="color: white;" class="mdi-action-print" onClick="javascript:window.open('../../print/edit.php?id=<?php echo $person['ID']; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">พิมพ์แบบฟอร์ม</a></td>

                                                            <!--<td><a style="color: white;" class="mdi-action-delete" onClick="del('<?php echo get_person_name_string($id) . " " . get_person_surname_string($id); ?>', '<?php echo $id; ?>')">ลบ</a></td>-->

                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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