<html>
    <head>
        <meta charset="utf-8">
        <title>ไทยนำ-ลิมป์ศรีสวัสดิ์</title>
        <link href="../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="../css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/fieldset.css" rel="stylesheet" type="text/css"/>
        <script src="../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <link href="../css/menu.css" rel="stylesheet" type="text/css"/>
                <!--<script src="../css/bootstrap-material-design-master/dist/js/material.min.js" type="text/javascript"></script>-->
        <script type="text/javascript">
            var tabs = ["stat", "provice", "gen"];
            function change_to_type_1() {
                document.getElementById("2").style.display = "none";
                document.getElementById("1").style.display = "";
            }
            function change_to_type_2() {
                document.getElementById("1").style.display = "none";
                document.getElementById("2").style.display = "";
            }
            function show_stat(tab) {
                for (x in tabs) {
                  //  console.log(x);
                    document.getElementById(tabs[x]).style.display = "none";
                }
                document.getElementById(tab).style.display = "";
            }
        </script>
    </head>
    <?php
    session_start();
    $ses_user_id = $_SESSION['ses_user_id'];
    if ($ses_user_id == "") {
        header("Location: ../index.php?error=3");
    }
    include '../helper/db_connect.php';
    connect_database();
    if(isset($_GET['tab'])){
      $tab = $_GET['tab'];
      ?>
      <script type="text/javascript">
        show_stat('<?php echo $tab; ?>')
      </script>
      <?php
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
                        <li><a href="../logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--        <div class=" col-xs-3 btn-material-brown">
                    <h3 class="mdi-navigation-menu"> เมนู</h3>
                    <ul class="nav nav-pills nav-stacked" >
                        <li class="active" ><a href="index.php" class="mdi-action-home"> จำนวนสมาชิกและสถิติ</a></li>
                        <li class="dropdown active">
                            <h4><a class="dropdown-toggle mdi-action-home" href="index.php" data-toggle="dropdown" style="color:white"> จำนวนสมาชิกและสถิติ<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><h4><a onclick="show_stat('stat')"> สถิติ</a></h4></li>
                                    <li><h4><a onclick="show_stat('provice')">สมาชิกที่อยู่แต่ละจังหวัด</a></h4></li>
                                    <li><h4><a onclick="show_stat('gen')">จำนวนแต่ละลำดับรุ่น</a></h4></li>
                                </ul>
                            </h4>
                        </li>
                        <li><h4><a href="view/manage_person_table.php" class="mdi-file-cloud" style="color:white"> ทะเบียนฐานข้อมูลสมาชิก</a></h4></li>
                        <li><h4><a href="view/export_excel.php" class="mdi-action-flip-to-front" style="color:white"> Export Excel</a></h4></li>
                        <li><h4><a href="view/print.php" class="mdi-action-find-in-page" style="color:white"> พิมพ์ข้อมูล</a></h4></li>
                        <li><h4><a href="view/createname.php" class="mdi-action-translate" style="color:white"> สร้างชื่อจีน</a></h4></li>
                        <li><h4><a href="view/ancestorsaddr.php" class="mdi-maps-navigation" style="color:white"> ค้นหาที่อยู่บรรพบุรุษที่ประเทศจีน</a></h4></li>
                        <li><h4><a href="view/register_day.php" class="mdi-action-assessment" style="color:white"> ดูข้อมูลคนมาร่วมงานประจำปี</a></h4></li>
                        <li><h4><a href="view/serach_family_tree.php" class="mdi-social-people" style="color:white"> Family Tree</a></h4></li>
                        <li><h4><a href="view/export_sql.php" class="mdi-action-backup"</h4></li>
                        <li>&nbsp;</li>

                    </ul>
                </div>-->
        <ul id="sidebar" class=" col-xs-3 nav nav-pills nav-stacked" style="max-width: 400px;">
            <li class="active"><a href="#" style="color: white"><span class="glyphicon glyphicon-stats" style="font-size:130%;">   จำนวนสมาชิกและสถิติ</a></span></li>
            <ul>
                <li><h4><a onclick="show_stat('stat')" style="color: white"> สถิติ</a></h4></li>
                <li><h4><a onclick="show_stat('provice')" style="color: white" >สมาชิกที่อยู่แต่ละจังหวัด</a></h4></li>
                <li><h4><a onclick="show_stat('gen')" style="color: white" >จำนวนแต่ละลำดับรุ่น</a></h4></li>
            </ul>
            <li><a href="view/manage_person_table.php" style="color: white"><span class="glyphicon glyphicon-user" style="font-size:130%;"> ทะเบียนฐานข้อมูลสมาชิก</a></span>  </li>
            <li><a href="view/export_excel.php" style="color: white"><span class="glyphicon glyphicon-export" style="font-size:130%;"> Export Excel</a></span> </li>
            <li><a href="view/print.php" style="color: white"><span class="glyphicon glyphicon-print" style="font-size:130%;"> พิมพ์ข้อมูล</a></span></li>
            <li><a href="view/createname.php" style="color: white"><span class="glyphicon glyphicon-pencil" style="font-size:130%;">  สร้างชื่อจีน</a></span></li>
            <li><a href="view/ancestorsaddr.php" style="color: white"><span class="glyphicon glyphicon-home" style="font-size:130%;">   ค้นหาที่อยู่บรรพบุรุษที่ประเทศจีน</a></span></li>
            <li><a href="view/register_day.php" style="color: white"><span class="glyphicon glyphicon-comment" style="font-size:130%;">   ข้อมูลผู้มาร่วมงานประจำปี</a></span></li>
            <li><a href="view/serach_family_tree.php" style="color: white"><span class="glyphicon glyphicon-earphone" style="font-size:130%;">   Family Tree</a></span></li>
            <li><a href="view/export_sql.php"><span class="glyphicon glyphicon-inbox" style="font-size:130%;">  สำรองฐานข้อมูล</a></span> </li>
            <li><a href="view/setting.php"><span class="glyphicon glyphicon-cog"  style="font-size:130%;"> จัดการระบบ</a></span> </li>
        </ul>
        <div class="col-xs-9">
            <center>
                <div class="row stats">
                    <h1>สถิติข้อมูลสมาชิกมูลนิธิไทยนำ-ลิมป์ศรีสวัสดิ์</h1>
                </div>
                <div class="row" id="stat" style="display :<?php
                if (isset($_GET['tab'])) {
                    if ($_GET['tab'] != "stat") {
                        // echo "none";
                    }
                } else {
                    // echo "none";
                }
                ?> ">
                    <div class="col-xs-10 col-xs-offset-1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><h3>รายการ</h3></th>
                            <th style='text-align:right'><h3>จำนวน</h3></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h3>ข้อมูลสมาชิกทั้งหมด</h3></td>
                                    <td style='text-align:right'>
                                        <h3>
                                            <?php
                                            $results = count_all_person_detial();
                                            while ($result = mysql_fetch_row($results)) {
//                                                echo $result[0];
                                                ?>
                                                <a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=1&type=all')"><?php echo $result[0]; ?></a>
                                                <?php
                                            }
                                            ?>
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h3>ข้อมูลสมาชิกที่ยังมีชีวิต</h3></td>
                                    <td style='text-align:right'>
                                        <h3>
                                            <?php
                                            $results = count_person_by_status(1);
                                            while ($result = mysql_fetch_row($results)) {
//                                                echo $result[0];
                                                ?>
                                                <a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=1&type=live')"><?php echo $result[0]; ?></a>
                                                <?php
                                            }
                                            ?>
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h3>ข้อมูลสมาชิกที่เสียชีวิตแล้ว</h3></td>
                                    <td style='text-align:right'>
                                        <h3>
                                            <?php
                                            $results = count_person_by_status(2);
                                            while ($result = mysql_fetch_row($results)) {
//                                                echo $result[0];
                                                ?>
                                                <a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=2&type=die')"><?php echo $result[0]; ?></a>
                                                <?php
                                            }
                                            ?>
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h3>ข้อมูลสมาชิกที่ไม่ทราบสถานะมีชืวิต/เสียชีวิต</h3></td>
                                    <td style='text-align:right'>
                                        <h3>
                                            <?php
                                            $results = count_person_by_status(0);
                                            while ($result = mysql_fetch_row($results)) {
//                                                echo $result[0];
                                                ?>
                                                <a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=0&type=unknow')"><?php echo $result[0]; ?></a>
                                                <?php
                                            }
                                            ?>
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h3>ข้อมูลที่ไม่อยู่ในตระกูลลิ้ม</h3></td>
                                    <td style='text-align:right'>
                                        <h3>
                                            <?php
                                            $results = count_person_by_gen_type(3);
                                            while ($result = mysql_fetch_row($results)) {
//                                                echo $result[0]; get_province_string
                                                ?>
                                                <a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=3&type=gen_type')"><?php echo $result[0]; ?></a>
                                                <?php
                                            }
                                            ?>
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row stats" id="provice" style="display : <?php
                if (isset($_GET['tab'])) {
                    if ($_GET['tab'] != "provice") {
                        echo "none";
                    }
                } else {
                    echo "none";
                }
                ?>;">
                    <h1>สถิติข้อมูลสมาชิกประจำภาคต่างๆ</h1>
                    <div class="col-xs-10 col-xs-offset-1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><h3>รายการ</h3></th>
                            <th style='text-align:right'><h3>จำนวน</h3></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
//                                for ($i = 1; $i < 77; $i++) {
//                                    $counts = count_person_by_provice_id($i);
//                                    $count = mysql_fetch_row($counts);
//                                    if ($count[0] != 0) {
//
                                ?>
<!--                                        <tr>
                                            <td><h3>//<?php echo get_province_string($i); ?></h3></td>
                                            <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=//<?php echo $i; ?>&type=province')"><?php echo $count[0]; ?></a></h3></td>
                                        </tr>-->
                                <?php
//                                    }
//                                }
                                ?>
                                <?php
                                $counts = count_person_by_provice_sector_id(0);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>กรุงเทพมหานคร</h3></td>
                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=1&type=province')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_person_by_provice_sector_id(1);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคกลาง</h3></td>
                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=1&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_person_by_provice_sector_id(2);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคเหนือ</h3></td>
                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=2&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_person_by_provice_sector_id(3);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคตะวันออกเฉียงเหนือ</h3></td>
                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=3&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_person_by_provice_sector_id(4);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคตะวันออก</h3></td>
                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=4&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_person_by_provice_sector_id(5);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคตะวันตก</h3></td>
                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=5&type=sector')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                                <?php
                                $counts = count_person_by_provice_sector_id(6);
                                $count = mysql_fetch_row($counts);
                                ?>
                                <tr>
                                    <td><h3>ภาคใต้</h3></td>
                                    <td style='text-align:right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/stat_detail.php?data=6&type=province')"><?php echo $count[0]; ?></a></h3></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" id="gen" style="display : <?php
                if (isset($_GET['tab'])) {
                    if ($_GET['tab'] != "gen") {
                        echo "none";
                    }
                } else {
                    echo "none";
                }
                ?>;">
                    <h1>จำนวนข้อมูลบุคคลในแต่ละลำดับรุ่น(<?php echo "林"; ?>) </h1>
                    <div class="row" id="1" class="row" style="display : ">
                        <div class="col-xs-10 col-xs-offset-1">
                            <div class="row">
                                <div class="col-xs-2 col-xs-offset-4">
                                    <h2>สาย 1</h2>
                                </div>
                                <div class="col-xs-2">
                                    <h2><a style="color: black;" style="margin-top: 0px;" onclick="change_to_type_2()">สาย 2</a></h2>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><h3>ลำดับรุ่น</h3></th>
                                <th><h3>ชื่อ</h3></th>
                                <th><h3>pinyin</h3></th>
                                <th><h3>ไทย</h3></th>
                                <th style='text-align:right'><h3>จำนวน</h3> </th>
                            <!--<th>&nbsp;</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $results = getGenDetailByType(1);
                                    while ($result = mysql_fetch_assoc($results)) {
                                        $gen_id = $result['ID'];
                                        $counts = count_gen_data($gen_id);
                                        $countGen = mysql_fetch_row($counts);
//                                        if ($countGen[0] > 0) {
                                        ?>
                                        <tr style="line-height: 14px">
                                            <td style="height: 14px"><h3><?php echo $result['GENERATION_INDEX']; ?></h3></td>
                                            <td><h3><?php echo $result['GENERATION_NAME']; ?></h3></td>
                                            <td><h3><?php echo $result['GENERATION_PINYIN']; ?></h3></td>
                                            <td><h3><?php echo $result['GENERATION_TH']; ?></h3></td>
                                            <td align='right'><h3><a style="color: white;" onClick="javascript:window.location.assign('view/gen_detial.php?gen_id=<?php echo $gen_id; ?>')"><?php echo $countGen[0]; ?></a></h3></td>
                                            <td>
                                                <!--<a style="color: white;" class="mdi-action-find-in-page"onClick="javascript:window.location.assign('view/view_gen.php?gen_id=////<?php //  echo $gen_id;                                             ?>')">view</a>-->
                                            </td>
                                        </tr>
                                        <?php
                                    }
//                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="2" class="row" style="display : none;"/>
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <h2><a style="color: white;" style="margin-top: 0px;" onclick="change_to_type_1()">สาย 1</a></h2>
                            </div>
                            <div class="col-xs-2">
                                <h2 style="color:black;">สาย 2</h2>

                            </div>
                        </div>
                        <table class="table" style="color:black;">
                            <thead>
                                <tr>
                                    <th><h3>ลำดับรุ่น</h3></th>
                            <th><h3>ชื่อ</h3></th>
                            <th><h3>pinyin</h3></th>
                            <th><h3>ไทย</h3></th>
                            <th style='text-align:right'><h3>จำนวน</h3> </th>
                            <!--<th>&nbsp;</th>-->
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $results = getGenDetailByType(2);
                                while ($result = mysql_fetch_assoc($results)) {
                                    $gen_id = $result['ID'];
                                    $counts = count_gen_data($gen_id);
                                    $countGen = mysql_fetch_row($counts);
//                                    if ($countGen[0] > 0) {
                                    ?>
                                    <tr>
                                        <td><h3><?php echo $result['GENERATION_INDEX']; ?></h3></td>
                                        <td><h3><?php echo $result['GENERATION_NAME']; ?></h3></td>
                                        <td><h3><?php echo $result['GENERATION_PINYIN']; ?></h3></td>
                                        <td><h3><?php echo $result['GENERATION_TH']; ?></h3></td>
                                        <td align='right'><h3><a style="color: black;" onClick="javascript:window.location.assign('view/gen_detial.php?gen_id=<?php echo $gen_id; ?>')"><?php echo $countGen[0]; ?></a></h3></td>
                                        <td>
                                            <!--<a style="color: white;" class="mdi-action-find-in-page"onClick="javascript:window.location.assign('view/view_gen.php?gen_id=////<?php //  echo $gen_id;                                             ?>')">view</a>-->
                                        </td>
                                    </tr>
                                    <?php
                                }
//                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </center>
        </div>
        <!--</div>-->
    </body>
    <?php
    if(isset($_GET['tab'])){
      $tab = $_GET['tab'];
      ?>
      <script type="text/javascript">
        show_stat('<?php echo $tab; ?>')
      </script>
      <?php
    }
    ?>
</html>
