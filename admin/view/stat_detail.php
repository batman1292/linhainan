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
        <link href="../../css/fieldset.css" rel="stylesheet" type="text/css"/>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php
    session_start();
    $ses_user_id = $_SESSION['ses_user_id'];
    if ($ses_user_id == "") {
        header("Location: ../../index.php?error=3");
    }

    include '../../helper/db_connect.php';
    include '../../helper/helper.php';
    connect_database();
    $data = $_GET['data'];
    if ($_GET['type'] == 'die') {
        $results = get_person_by_status($data);
        $headder_str = "รายละเอียดข้อมูลสมาชิกที่เสียชีวิตแล้ว";
    } else if ($_GET['type'] == 'gen_type') {
        $results = get_person_by_gen_type($data);
        $headder_str = "รายละเอียดข้อมูลที่ไม่อยู่ในตระกูลลิ้ม";
    } else if ($_GET['type'] == 'province') {
        $results = get_person_by_provice_id($data);
//        echo $results;
        $headder_str = "รายละเอียดข้อมูลสมาชิกที่อยู่ในจังหวัด" . get_province_string($data);
    } else if ($_GET['type'] == 'live') {
        $results = get_person_by_status($data);
//        echo $results;
        $headder_str = "รายละเอียดข้อมูลสมาชิกที่ยังมีชีวิต";
    } else if ($_GET['type'] == 'unknow') {
        $results = get_person_by_status($data);
//        echo $results;
        $headder_str = "รายละเอียดข้อมูลสมาชิกที่ไม่ทราบสถานะมีชืวิต หรือ เสียชีวิต";
    } else if ($_GET['type'] == 'all') {
        $results = "SELECT * FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID ORDER BY PERSONNAME_NAME ";
//        echo $results;
        $headder_str = "รายละเอียดข้อมูลสมาชิกทั้งหมด";
    } else if ($_GET['type'] == 'sector') {
//        $results = "SELECT * FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID ORDER BY PERSONNAME_NAME ";
//        echo $results;
        $headder_str = "รายละเอียดข้อมูลสมาชิกที่อยู่ในภาค";
        if ($_GET['data'] == 1) {
            $headder_str .= 'กลาง';
        } else if ($_GET['data'] == 2) {
            $headder_str .= 'เหนือ';
        } else if ($_GET['data'] == 3) {
            $headder_str .= 'ตะวันออกเฉียงเหนือ';
        } else if ($_GET['data'] == 4) {
            $headder_str .= 'ตะวันออก';
        } else if ($_GET['data'] == 5) {
            $headder_str .= 'ตะวันตก';
        } else if ($_GET['data'] == 6) {
            $headder_str .= 'ใต้';
        }
    }
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
                    <ul class="nav nav-pills nav-stacked" >
                        <li class="active" ><a href="../index.php" class="mdi-action-home" style="color:white"> จำนวนสมาชิกและสถิติ</a></li>
                        <li><h4><a href="manage_person_table.php" class="mdi-file-cloud" style="color:white"> ทะเบียนฐานข้อมูลสมาชิก</a></h4></li>
                        <li><h4><a href="export_excel.php" class="mdi-action-flip-to-front" style="color:white"> Export Excel</a></h4></li>
                        <li><h4><a href="print.php" class="mdi-action-find-in-page" style="color:white"> พิมพ์ข้อมูล</a></h4></li>
                        <li><h4><a href="createname.php" class="mdi-action-translate" style="color:white"> สร้างชื่อจีน</a></h4></li>
                        <li><h4><a href="ancestorsaddr.php" class="mdi-maps-navigation" style="color:white"> ค้นหาที่อยู่บรรพบุรุษที่ประเทศจีน</a></h4></li>
                        <li><h4><a href="register_day.php" class="mdi-action-assessment" style="color:white"> ดูข้อมูลคนมาร่วมงานประจำปี</a></h4></li>
                        <li><h4><a href="serach_family_tree.php" class="mdi-social-people" style="color:white"> Family Tree</a></h4></li>
                        <li><h4><a href="export_sql.php" class="mdi-action-backup" style="color:white"> สำรองฐานข้อมูล </a></h4></li>
                        <li>&nbsp;</li>
                    </ul>
                </div>-->
        <ul id="sidebar" class=" col-xs-3 nav nav-pills nav-stacked" style="max-width: 400px;">
            <li class="active"><a href="../index.php" style="color: white"><span class="glyphicon glyphicon-stats" style="font-size:130%;">   จำนวนสมาชิกและสถิติ</a></span></li>
            <ul>
                <li><h4><a onclick="show_stat('stat')" style="color: white"> สถิติ</a></h4></li>
                <li><h4><a onclick="show_stat('provice')" style="color: white" >สมาชิกที่อยู่แต่ละจังหวัด</a></h4></li>
                <li><h4><a onclick="show_stat('gen')" style="color: white" >จำนวนแต่ละลำดับรุ่น</a></h4></li> 
            </ul>
            <li><a href="manage_person_table.php" style="color: white"><span class="glyphicon glyphicon-user" style="font-size:130%;"> ทะเบียนฐานข้อมูลสมาชิก</a></span>  </li>
            <li><a href="export_excel.php" style="color: white"><span class="glyphicon glyphicon-export" style="font-size:130%;"> Export Excel</a></span> </li>
            <li><a href="print.php" style="color: white"><span class="glyphicon glyphicon-print" style="font-size:130%;"> พิมพ์ข้อมูล</a></span></li>
            <li><a href="createname.php" style="color: white"><span class="glyphicon glyphicon-pencil" style="font-size:130%;">  สร้างชื่อจีน</a></span></li>
            <li><a href="ancestorsaddr.php" style="color: white"><span class="glyphicon glyphicon-home" style="font-size:130%;">   ค้นหาที่อยู่บรรพบุรุษที่ประเทศจีน</a></span></li>
            <li><a href="register_day.php" style="color: white"><span class="glyphicon glyphicon-comment" style="font-size:130%;">   ข้อมูลผู้มาร่วมงานประจำปี</a></span></li>
            <li><a href="serach_family_tree.php" style="color: white"><span class="glyphicon glyphicon-earphone" style="font-size:130%;">   Family Tree</a></span></li>
            <li><a href="export_sql.php"><span class="glyphicon glyphicon-inbox" style="font-size:130%;">  สำรองฐานข้อมูล</a></span> </li>
            <li><a href="setting.php"><span class="glyphicon glyphicon-cog"  style="font-size:130%;"> จัดการระบบ</a></span> </li>
        </ul>
        <div class="col-xs-9">
            <center>
                <div class="row">
                    <div class="row">
                        <h1><?php echo $headder_str; ?></h1>
                    </div>
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1">
                            <?php
                            if ($_GET['type'] == 'sector') {
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><h3>รายชื่อจังหวัด</h3></th>
                                    <th style='text-align:right'><h3>จำนวน</h3></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $provinces = get_province_id_by_province_sector_id($_GET['data']);
                                        $table_count = 0;
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
                                        $noperson = '';
                                        while ($province = mysql_fetch_assoc($provinces)) {
                                            $counts = count_person_by_provice_id($province['PROVINCE_ID']);
                                            $count = mysql_fetch_row($counts);
                                            if ($count[0] != 0) {
                                                ?>
                                                <tr>
                                                    <td><h3><?php echo get_province_string($province['PROVINCE_ID']); ?></h3></td>
                                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('stat_detail.php?data=<?php echo $province['PROVINCE_ID']; ?>&type=province')"><?php echo $count[0]; ?></a></h3></td>
                                                </tr>
                                                <?php
                                            } else {
                                                $noperson .= get_province_string($province['PROVINCE_ID']) . " ";
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><h3>จังหวัดที่ไม่มีข้อมูลที่อยู่สมาชิก</h3></td>
                                            <td>
                                                <h3>
                                                    <?php
                                                    if ($noperson == '') {
                                                        echo '-';
                                                    } else {
                                                        echo $noperson;
                                                    }
                                                    ?>
                                                </h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><h3>ลำดับ</h3></th>
                                    <th><h3>ชื่อ-นามสกุล</h3></th>
                                    <th><h3>ชื่อจีน</h3></th>
                                    <th><h3>&nbsp;</h3></th>

                            <!--<th>&nbsp;</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $type = $_GET['type'];
                                        $urlquery_str = "data=$data&type=$type";
//                                    $results = getGenDetailByType(1);
//                                    $person = get_per
                                        $query = $results;
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
//                                    echo $query;

                                        $persons = mysql_query($query);
                                        $count = 1;
                                        while ($person = mysql_fetch_assoc($persons)) {
//                                        print_r($person);
                                            if ($_GET['type'] == 'province') {
//                                            print_r($person);
                                                $prints = get_person_detial($person['ADDRESSLIST_OWNER_ID']);
                                                $print = mysql_fetch_assoc($prints);
                                                ?>
                                                <tr>
                                                    <td><h3><?php echo $print['ID']; ?></h3></td>
                                                    <td><h3><?php echo get_person_title_string($print['TITLE_ID']) . ' ' . get_person_name_string($print['ID']) . ' ' . get_person_surname_string($print['ID']); ?></h3></td>
                                                    <td><h3><?php echo get_person_china_full_name($print['ID'], 0); ?></h3></td>
                                                    <td align='right'><h3><a style="color: white;" class="mdi-action-pageview" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $print['ID']; ?>&type=gen')">ดูรายละเอียด</a></h3></td>
                                                    <td>
                                                        <!--<a style="color: white;" class="mdi-action-find-in-page"onClick="javascript:window.location.assign('view/view_gen.php?gen_id=////<?php //  echo $gen_id;                            ?>')">view</a>-->
                                                    </td>
                                                </tr>    
                                                <?php
                                            } else {
                                                ?>
                                                <tr>
                                                    <td><h3><?php echo $person['ID']; ?></h3></td>
                                                    <td><h3><?php echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($person['ID']) . ' ' . get_person_surname_string($person['ID']); ?></h3></td>
                                                    <td><h3><?php echo get_person_china_full_name($person['ID'], 0); ?></h3></td>
                                                    <td align='right'><h3><a style="color: white;" class="mdi-action-pageview" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $person['ID']; ?>&type=gen')">ดูรายละเอียด</a></h3></td>
                                                    <td>
                                                        <!--<a style="color: white;" class="mdi-action-find-in-page"onClick="javascript:window.location.assign('view/view_gen.php?gen_id=////<?php //  echo $gen_id;                            ?>')">view</a>-->
                                                    </td>
                                                </tr>    
                                                <?php
                                            }
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                    <div class="row">
                        <a class="btn btn-danger" role="button" style="width: 175px;" onClick="javascript:window.history.back();">ย้อนกลับ</a> 
                    </div>
                </div>
            </center>
        </div>
        <!--</div>-->
    </body>
</html>