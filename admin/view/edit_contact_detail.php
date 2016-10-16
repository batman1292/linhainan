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
        <link href="../../css/fieldset.css" rel="stylesheet" type="text/css"/>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script>

            function del_contact(id, show) {
                var string = "คุณต้องการลบ " + show;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
                    window.location = '../action/del_contact.php?id=' + id
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "สู่ระบบ?");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=create';
                }
            }
//            function autoTab2(obj, typeCheck) {
//
//                if (typeCheck == 1) {
//                    if (obj.value.length >= 2) {
//                        if (obj.value.charAt(1) == "2") {
//                            var pattern = new String("__-_______"); // กำหนดรูปแบบในนี้
//                        } else {
//                            var pattern = new String("___-______"); // กำหนดรูปแบบในนี้
//                        }
//                    }
//                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
//                } else {
//                    var pattern = new String("___-_______"); // กำหนดรูปแบบในนี้
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
        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-12">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();


//                print_r($address);
                ?>
                <div class="row">
                    <h1>แก้ไขข้อมูลการติดต่อ 
                        <?php
//if($person['TITLE_ID'] != 0)
//                            echo get_person_title_string($person['TITLE_ID']) . ' ' . $person['NAME'] . '  ' . $person['SURNAME'];
//                        else
//                            echo $person['NAME'] . '  ' . $person['SURNAME'];
                        ?>
                    </h1>
                </div>
            </center>
            <div class="row" >
                <form class="well" action="../action/edit_contact.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                    <input type="text" name="id" hidden="hidden" value="<?php echo $id; ?>">           

                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            $homeTels = get_person_contact($id, 1);
                            $count = 1;
                            while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                ?>
                                <div class="row">
                                    <div class="col-sm-5" style="margin-top: 10px">
                                        <h5>เบอร์โทรศัพท์บ้าน<?php echo $count; ?></h5>
                                    </div>
                                    <div class="col-sm-3" style="margin-top: 10px">
                                        <input type="text" class="form-control" autofocus name="tel<?php echo $homeTel['ID']; ?>" value="<?php echo $homeTel['CONTACT_ARER_CODE'].$homeTel['CONTACT_STRING']; ?>" maxlength="10" onkeypress='validate(event)'>
                                    </div>
                                    <div class="col-xs-1" style="margin-top: 10px">
                                        ต่อ
                                    </div>
                                    <div class="col-xs-2" style="margin-top: 10px">
                                        <input type="text" class="form-control" autofocus name="tel_comment<?php echo $homeTel['ID']; ?>" value="<?php echo $homeTel['CONTACT_COMMENT']; ?>">
                                    </div>
                                    <div class="col-xs-1" style="margin-top: 20px">
                                        <a  class="mdi-action-delete" onclick="del_contact(<?php echo $homeTel['ID']; ?>, 'เบอร์โทรศัพท์บ้าน<?php echo $count; ?>')">ลบ</a>
                                    </div>
                                </div>

                                <?php
                                $count++;
                            }
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $mobileTels = get_person_contact($id, 2);
                            $count = 1;
                            while ($mobileTel = mysql_fetch_assoc($mobileTels)) {
//                            print_r($mobileTel);
                                ?>
                                <div class="row">
                                    <div class="col-sm-3" style="margin-top: 10px">
                                        <h5>มือถือ<?php echo $count; ?></h5>
                                    </div>
                                    <div class="col-sm-6" style="margin-top: 10px">
                                        <input type="text" class="form-control" autofocus name="moblie<?php echo $mobileTel['ID']; ?>" value="<?php echo $mobileTel['CONTACT_ARER_CODE'] . $mobileTel['CONTACT_STRING']; ?>" maxlength="10" onkeypress='validate(event)' > 
                                    </div>

                                    <div class="col-xs-1" style="margin-top: 20px">
                                        <a  class="mdi-action-delete" onclick="del_contact(<?php echo $mobileTel['ID']; ?>, 'มือถือ<?php echo $count; ?>')">ลบ</a>
                                    </div>
                                </div>
                                <?php
                                $count++;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1" style="margin-top: 10px">
                            <h5>e-mail</h5>
                        </div>
                        <div class="col-sm-2" style="margin-top: 10px">
                            <input type="email" class="form-control" autofocus name="email" value="<?php
                            $emails = get_person_contact($id, 3);
                            $email = mysql_fetch_assoc($emails);
                            if ($email)
                                echo $email['CONTACT_STRING'];
                            ?>">
                        </div>
                        <?php
                        if ($email)
                            echo '<div class="col-xs-1" style="margin-top: 20px"> <a  class="mdi-action-delete" onclick="del_contact(' . $email["ID"] . ',\'email\')">ลบ</a> </div>';
                        ?>
                        <div class="col-sm-1" style="margin-top: 10px">
                            <h5>Facebook</h5>
                        </div>
                        <div class="col-sm-2" style="margin-top: 10px">
                            <input type="text" class="form-control" autofocus name="facebook" value="<?php
                            $fbs = get_person_contact($id, 5);
                            $fb = mysql_fetch_assoc($fbs);
                            if ($fb)
                                echo $fb['CONTACT_STRING'];
                            ?>">
                        </div>
                        <?php
                        if ($fb)
                            echo '<div class="col-xs-1" style="margin-top: 20px"> <a  class="mdi-action-delete" onclick="del_contact(' . $fb["ID"] . ',\'facebook\')">ลบ</a> </div>';
                        ?>
                        <div class="col-sm-1" style="margin-top: 10px">
                            <h5>Line</h5>
                        </div>
                        <div class="col-sm-2" style="margin-top: 10px">
                            <input type="text" class="form-control" autofocus name="line" value="<?php
                            $lines = get_person_contact($id, 4);
                            $line = mysql_fetch_assoc($lines);
                            if ($line)
                                echo $line['CONTACT_STRING'];
                            ?>">
                        </div>
                        <?php
                        if ($line)
                            echo '<div class="col-xs-1" style="margin-top: 20px"> <a  class="mdi-action-delete" onclick="del_contact(' . $line["ID"] . ',\'line\')">ลบ</a> </div>';
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-8">
                            <a class="btn btn-material-orange" role="button" onClick="history.go(-1);
                                    return true;">ย้อนกลับ</a>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>