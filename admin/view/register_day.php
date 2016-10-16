<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");

    include '../../helper/db_connect.php';
    include '../../helper/helper.php';

    connect_database();
//    $year_list = get_reg_year_list();
//    print_r($year_list);
}
?>
<html>
    <!--<a href="../../helper/db_connect.php"></a>-->
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
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        ?>
        <script>
            function del(data, id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
//                    add data to db
//                window.location = 'adding.php?code=' + code + '&department=' + department;
                    window.location = '../action/del.php?id=' + id;
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "แบบอัตโนมัติ");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=add';
                }
            }

            function clear_reg() {
                var del = confirm("คุณต้องการล้างข้อมูลผู่เข้าร่วมงานของปีก่อนหน้าใช่หรือไม่?");
                if (del === true) {
                    window.location = '../action/clear_reg_previous.php';
                    alert('ล้างข้อมูลเสร็จสิ้น');
                }
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
                <?php print_menu(5) ?>
<!--            </ul>
        </div>-->
        <div class=" col-xs-9">
            <center>
                <?php
                connect_database();
                $year_list = get_reg_year_list();
//                print_r($year_list);
                ?>
                <h1>ข้อมูลผู้มาร่วมงานประจำปี</h1>
                <div class="row" style="margin-top: -3px">
                    <div class="col-xs-10 col-xs-offset-1 well">
                        <form class="form-horizontal" action="register_day.php" method="Get" style="margin-left:-10px; margin-top: 10px">
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-1" style="margin-top: 0px">
                                    <h2>เรียกดูข้อมูลผู้ร่วมงานประจำปี</h2>
                                </div>
                                <div class="col-xs-2">
                                    <select name="year" class="district form-control" style="margin-top: 30px">
                                        <?php
                                        foreach ($year_list as $year) {
                                            echo "<option value='" . $year . "'>" . $year . " </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <button class="btn btn-success" type="submit" style="margin-top: 20px" name="search">ค้นหา</button>
                                </div>
                                <!--<div class="col-xs-1">-->
                                    <!--<button class="btn btn-material-pink" type="button" style="margin-top: 20px" name="clear_previous" onClick="clear_reg()">ล้างข้อมูลปีก่อนหน้า</button>-->
                                <!--</div>-->
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_GET['search'])) {
                    $year = $_GET['year'];
//                        $search_type = $_GET['option'];
//                        $check = mysql_fetch_assoc(mysql_query(search_data($data, $search_type)));
                    $counts = count_reg_by_year($year);
                    $count = mysql_fetch_array($counts);
//                    print_r($count);
                    ?>
                    <div class="row">
                        <h2>ข้อมูลผู้เข้าร่วมงานประจำปี<?php echo $year; ?></h2>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-2">
                            <h3>ผู้เข้าร่วมงานทั้งหมด</h3>
                        </div>
                        <div class="col-xs-4">
                            <h3><?php echo $count[0]; ?></h3>
                        </div>
                    </div>
                <br><br>
                    <!--//---------------------- table ----------------------------/-->
                    <div class="row">
                        <table class="table col-xs-12" style="text-align: center;">
                            <thead>
                                <tr >
                                    
                                    <!--<th><center># </center></thx>-->
                                    <th><center>running number </center></th>
                                    <th><center>ชื่อ-นามสกุล </center></th>
                                    <th><center>ชื่อจีน </center></th>
                                    <th><center>เบอร์โทรศัพท์ </center></th>
                                    <th><center>จังหวัดที่อยู่ </center></th>
                                    <th><center>หมายเหตุ </center></th>
                                    <th><center>ดูข้อมูล </center></th>
                                   
                                </tr>
                            </thead>
                            <?php
//                            $count = 1;
                            $query = search_reg_by_year($year);
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
                                $id = $datas['REGISTER_OWNER_ID'];
//                                $list_data .= "$id,";
                                $persons = get_person_detial($id);
                                $person = mysql_fetch_assoc($persons);
//                                $list_time .= $person["LASTUPDATE"] . ",";
                                ?>
                                <tbody>
                                    <tr>
<!--                                        <td><?php // echo $count; ?></td>-->
                                        <td><?php echo $datas['REGISTER_NUMBER']; ?></td>
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
                                        <td><a style="color: white;" class="mdi-action-pageview"onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $id; ?>')">ดูรายละเอียด</a></td>
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