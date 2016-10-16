<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
$id = $_GET['id'];
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script>
            function del(data, id, table) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
//                    add data to db
//                window.location = 'adding.php?code=' + code + '&department=' + department;
                    window.location = '../action/del.php?table=' + table + '&id=' + id;
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "สู่ระบบ?");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=create';
                }
            }
            function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
                var regex = /[0-9]|\./;
                if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault)
                        theEvent.preventDefault();
                }
            }
//            function autoTab2(obj, typeCheck) {
//
//                if (typeCheck == 1) {
//                    if (obj.value.length >= 2) {
//                        if (obj.value.charAt(1) == "2") {
//                            var pattern = new String("__-___-____"); // กำหนดรูปแบบในนี้
//                        } else {
//                            var pattern = new String("___-___-___"); // กำหนดรูปแบบในนี้
//                        }
//                    }
//                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
//                } else {
//                    var pattern = new String("___-___-____"); // กำหนดรูปแบบในนี้
//                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้					
//                }
//                var returnText = new String("");
//                var obj_l = obj.value.length;
//                var obj_l2 = obj_l - 1;
//                for (i = 0; i < pattern.length; i++) {
//                    if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
//                        returnText += obj.value + pattern_ex;
//                        obj.value = returnText;
//                    }
//                }
//                if (obj_l >= pattern.length) {
//                    obj.value = obj.value.substr(0, pattern.length);
//                }
//            }
        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-10">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();

                $persons = get_person_detial($id);
                $person = mysql_fetch_assoc($persons);
//                print_r($person);
                ?>
                <div class="row">
                    <h1>เพิ่มข้อมูลติดต่อ
                        <?php
//if($person['TITLE_ID'] != 0)
//                            echo get_person_title_string($person['TITLE_ID']) . ' ' . $person['NAME'] . '  ' . $person['SURNAME'];
//                        else
//                            echo $person['NAME'] . '  ' . $person['SURNAME'];
                        ?>
                    </h1>
                </div>
            </center> 
            <div class="well">
                <form  action="../action/new_contact.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                    <input type="text" name="id" hidden="hidden" value="<?php echo $id; ?>">
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>โทรศัทพ์บ้าน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="tel" value="" maxlength="10" onkeypress='validate(event)'>
                        </div>
                        <div class="col-xs-1" style="margin-top: 5">
                            ต่อ
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="tel_comment" value="">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>เบอร์มือถือ</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="moblie" value="" maxlength="10" onkeypress='validate(event)'>
                        </div>
                    </div>
                    <div class ="row">
                        <!--                        <div class="col-xs-2">
                                                    <h4>เบอร์มือถือ</h4>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" class="form-control" autofocus name="moblie" value="" onkeyup="autoTab2(this, 2)" >
                                                </div>-->
                        <div class="col-xs-2">
                            <h5>e-mail</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="email" class="form-control" autofocus name="email" value="">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-xs-2">
                            <h5>facebook</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="facebook" value="">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-xs-2">
                            <h5>lineID</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="line" value="">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2">
                            <a class="btn btn-material-orange" role="button" onClick="history.go(-1);
                                    return true;">ย้อนกลับ</a>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                        </div>    
                    </div>
                </form>
            </div>
    </body>
</html>