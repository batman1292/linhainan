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
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <script>
            function check(id) {
                window.location = '../action/checkparent.php?id=' + id + '&type=create';
            }
            function chooseName(chinaname, pinyin, thai) {
                document.getElementById("chinaname").value = chinaname;
                document.getElementById("chinaname_pinyin").value = pinyin;
                document.getElementById("chinaname_thai").value = thai;
            }
            jQuery(document).ready(function ($) {
                $('#waypointsTable tr').hover(function () {
                    $(this).addClass('hover');
                }, function () {
                    $(this).removeClass('hover');
                });
                $('#generation').change(function ()
                {
                    var get_id = $(this).val();
                    var dataString = 'get_favorite_name=' + get_id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {

                                    $("table#waypointsTable tbody").html(html);
                                }
                            });
                });
            });
            $(document).ready(function () {
                $("#generation").change(function () {
                    var gen_id = $(this).val();
                    var dataString = 'generation=' + gen_id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    var res = html.split("/");
                                    $("#gen_pinyin").html(res[0]);
                                    $("#gen_th").html(res[1]);
                                }
                            });
                });
            });
        </script>
        <style>
            .hover { background-color:Gray; cursor:pointer ;}
        </style>
    </head>
    <?php
    include '../../helper/db_connect.php';
    include '../../helper/helper.php';

    connect_database();
    $id = $_GET['id'];
    if (isset($_GET['gen_id'])) {
        $gen_id = $_GET['gen_id'];
    } else {
        $gen_id = 0;
    }
    $persons = get_person_detial($id);
    $person = mysql_fetch_assoc($persons);
    if (isset($_POST['search']) && isset($gen_id) && $gen_id != '') {
        $chinaname = $_POST['chinaname'];
        $chinaname_pinyin = $_POST['chinaname_pinyin'];
        $chinaname_th = $_POST['chinaname_thai'];
        add_chinaname($id, $gen_id, $chinaname, $chinaname_pinyin, $chinaname_th);
        add_favorite_name($gen_id, $chinaname, $chinaname_pinyin, $chinaname_th);
        echo "<script type='text/javascript'>";
        echo "alert('สร้างชื่อจีนสำเร็จ');";
        echo "window.location.assign('createname.php')";
        echo "</script>";
    } else if (isset($_POST['search'])) {
        $chinaname = $_POST['chinaname'];
        $chinaname_pinyin = $_POST['chinaname_pinyin'];
        $chinaname_th = $_POST['chinaname_thai'];
        $gen_id = $_POST['generation'];
        add_chinaname($id, $gen_id, $chinaname, $chinaname_pinyin, $chinaname_th);
        add_favorite_name($gen_id, $chinaname, $chinaname_pinyin, $chinaname_th);
        echo "<script type='text/javascript'>";
        echo "alert('สร้างชื่อจีนสำเร็จ');";
        echo "window.location.assign('createname.php')";
        echo "</script>";
    }
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
                        <li><a href="../../logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--        <div class=" col-xs-3 btn-material-brown">
                    <h3 class="mdi-navigation-menu"> เมนู</h3>
                    <ul class="nav nav-pills nav-stacked" >-->
        <?php print_menu(3); ?>
        <!--            </ul>
                </div>-->
        <div class=" col-xs-9">
            <center>
                <div class="col-xs-10 col-xs-offset-1 well">
                    <form class="form-horizontal" action="makename.php?id=<?php echo $id; ?>&gen_id=<?php echo $gen_id; ?>" method="Post" style="margin-left:-10px; margin-top: 10px">
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2" style="margin-top: 0px">
                                <h2>สร้างชื่อจีนของ : <?php
                                    if ($person['TITLE_ID'] != 0)
                                        echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . " " . get_person_surname_string($id);
                                    else
                                        echo get_person_name_string($id) . " " . get_person_surname_string($id);
                                    ?></h2>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-xs-3">
                                <h5>อักษรจีน </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>林 </h5> 
                            </div>
                            <div class="col-xs-1">
                                <h5>- รุ่น</h5>
                            </div>
                            <div class="col-xs-3">
                                <?php
                                if (isset($gen_id) && $gen_id != "") {
                                    $generations = get_generation_detial($gen_id);
                                    $generation = mysql_fetch_assoc($generations);
                                    echo $generation['GENERATION_NAME'] . ' : ' . $generation['GENERATION_PINYIN'] . ' : ' . $generation['GENERATION_TH'];
                                } else {
                                    ?>
                                    <select class="form-control" autofocus name="generation" id="generation">
                                        <?php
                                        echo "<option disabled> รายการรุ่นสาย 1 </option>";
                                        $sql = get_gen_by_type(1);
                                        while ($rs = mysql_fetch_array($sql)) {
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                        }
                                        echo "<option disabled> รายการรุ่นสาย 2 </option>";
                                        $sql = get_gen_by_type(2);
                                        while ($rs = mysql_fetch_array($sql)) {
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                        }
                                        echo "<option disabled> รายการอื่นๆ </option>";
                                        $sql = get_gen_by_type(3);
                                        while ($rs = mysql_fetch_array($sql)) {
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-xs-1">
                                <h5>- ชื่อ</h5> 
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control"autofocus name="chinaname" id="chinaname" value="" placeholder="ชื่อตัวอักษรจีน">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>ออกเสียง pinyin</h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>lin </h5> 
                            </div>
                            <div class="col-xs-1">
                                <h5>- รุ่น</h5>
                            </div>
                            <div class="col-xs-3" >
                                <h5 id="gen_pinyin"></h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>- ชื่อ</h5> 
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control"autofocus name="chinaname_pinyin" id="chinaname_pinyin" value="" placeholder="ชื่อตัวเสียง pinyin">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>ชื่อตัวสำเนียงไทย </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>หลิน </h5> 
                            </div>
                            <div class="col-xs-1">
                                <h5>- รุ่น</h5>
                            </div>
                            <div class="col-xs-3" >
                                <h5 id="gen_th"></h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>- ชื่อ</h5> 
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control"autofocus name="chinaname_thai" id="chinaname_thai" value="" placeholder="ชื่อตัวสำเนียงไทย">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                            </div>
                            <div class="col-xs-4 col-xs-offset-3">
                                <a class="btn btn-danger" role="button" style="width: 175px;" onClick="window.location.href = 'createname.php'">ย้อนกลับ</a> 
                            </div>
                            <div class="col-xs-2" style="margin-top: 0px">
                                <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table col-xs-12" id="waypointsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ชื่อจีน</th>
                            <th>PINYIN</th>
                            <th>TH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($gen_id) && $gen_id != "") {
                            $count = 1;
                            $res = mysql_query("SELECT * FROM `favorite` WHERE `FAVORITE_GEN_ID`=$gen_id");
                            while ($datas = mysql_fetch_array($res)) {
                                ?>
                                <tr class='clickable-row' onclick="chooseName(<?php echo "'" . $datas['FAVORITE_NAME'] . "','" . $datas['FAVORITE_PINYIN'] . "','" . $datas['FAVORITE_TH'] . "'"; ?>);">
                                    <td> <?php echo $count++; ?></td> 
                                    <td> <?php echo $datas['FAVORITE_NAME']; ?></td> 
                                    <td> <?php echo $datas['FAVORITE_PINYIN']; ?></td> 
                                    <td> <?php echo $datas['FAVORITE_TH']; ?></td> 
                                </tr>


                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </center>
        </div>
    </body>
</html>