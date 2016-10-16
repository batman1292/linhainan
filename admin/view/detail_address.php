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
            function del_addr(id, addr_id, show) {
                var string = "คุณต้องการลบ " + show;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
                    window.location = '../action/del_address.php?id=' + id + '&addr_id=' + addr_id+'&type=1';
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "สู่ระบบ?");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=create';
                }
            }
            setInterval(function() {
                var id = document.getElementById('data_id').value;
                var time = document.getElementById('time_old').value;
                var dataString = "id=" + id + "&time=" + time;
                $.ajax
                        ({
                            url: "../../helper/dbupdate_ajax.php",
                            type: "POST",
                            data: dataString,
                            cache: false,
                            success: function(html) {
                                var str = html.toString();
                                var check = str.search("1");
                                if (check != -1) {
                                    location.reload();
                                }

                            }
                        });
            }, 1000);

        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-102">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();

                $persons = get_person_detial($id);
                $person = mysql_fetch_assoc($persons);
//                print_r($person);
                ?>
                <input type="text" name="data_id" id="data_id" style="visibility:hidden"  value="<?php echo $id; ?>">
                <input type="text" name="time_old" id="time_old" style="visibility:hidden"  value="<?php echo get_last_update($id); ?>">
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
            <div class="well">
                <form  action="../action/add.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                    <div class="row">
                        <h3>ข้อมูลการติดต่อ</h3>
                    </div>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">ที่อยู่
                            <a onClick="javascript:window.location.assign('new_address.php?id=<?php echo $id; ?>&type=1')">เพิ่มที่อยู่</a>
                        </legend>
                        <?php
                        $homeAddrs = get_person_all_address($id, 1);
                        $count = 1;
                        while ($homeAddr = mysql_fetch_assoc($homeAddrs)) {
//                    print_r($homeAddr);
                            ?>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>ที่อยู่บ้าน<?php echo $count; ?></h4>
                                </div>
                                <div class="col-sm-6" style="margin-top: 10px">
                                    <?php echo $homeAddr['ADDRESS_NUM'] . ' ' . $homeAddr['ADDRESS_VILLAGE'] . ' ' . $homeAddr['ADDRESS_ALLEY'] . ' ' . $homeAddr['ADDRESS_MOO'] . ' ' . $homeAddr['ADDRESS_ROAD'] . ' ' . get_district_string($homeAddr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($homeAddr['ADDRESS_PROVINCE_ID']) . ' ' . $homeAddr['ADDRESS_ZIPCODE']; ?>
                                </div>
                                <div class="col-sm-2" style="margin-top: 10px">
                                    <a class="mdi-action-pageview"onClick="javascript:window.location.assign('edit_address_detail.php?id=<?php echo $id; ?>&addr_id=<?php echo $homeAddr['ADDRESSLIST_ADDRESS_ID']; ?>&type=1')">แก้ไขข้อมูลที่อยู่</a>
                                </div>
                                <div class="col-sm-2" style="margin-top: 10px">
                                    <a class="mdi-action-delete" onclick="del_addr(<?php echo $id; ?>,<?php echo $homeAddr['ADDRESSLIST_ADDRESS_ID']; ?>, 'ที่อยู่บ้าน<?php echo $count; ?>')">ลบข้อมูลที่อยู่</a>
                                </div>

                            </div>
                            <?php
                            $count++;
                        }
                        ?>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">เบอร์โทรศัพท์
                            <a onClick="javascript:window.location.assign('new_contact.php?id=<?php echo $id; ?>')">เพิ่มเบอร์ติดต่อ</a>
                        </legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                $homeTels = get_person_contact($id, 1);
                                $count = 1;
                                while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>เบอร์โทรศัพท์บ้าน<?php echo $count; ?></h5>
                                        </div>
                                        <div class="col-sm-6" style="margin-top: 10px">
                                            <?php echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING']; ?>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }
                                if ($count == 1) {
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>เบอร์โทรศัพท์บ้าน</h5>
                                        </div>
                                        <div class="col-sm-6" style="margin-top: 10px">
                                            <?php echo '-'; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                $mobileTels = get_person_contact($id, 2);
                                $count = 1;
                                while ($mobileTel = mysql_fetch_assoc($mobileTels)) {
//                            print_r($homeTel);
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>มือถือ<?php echo $count; ?></h5>
                                        </div>
                                        <div class="col-sm-6" style="margin-top: 10px">
                                            <?php echo $mobileTel['CONTACT_ARER_CODE'] . '-' . $mobileTel['CONTACT_STRING']; ?>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }
                                if ($count == 1) {
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>มือถือ</h5>
                                        </div>
                                        <div class="col-sm-6" style="margin-top: 10px">
                                            <?php echo '-'; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <h5>e-mail</h5>
                            </div>
                            <div class="col-sm-3" style="margin-top: 10px">
                                <?php
                                $emails = get_person_contact($id, 3);
                                $email = mysql_fetch_assoc($emails);
                                if ($email)
                                    echo $email['CONTACT_STRING'];
                                else
                                    echo '-';
                                ?>
                            </div>
                            <div class="col-sm-1">
                                <h5>Facebook</h5>
                            </div>
                            <div class="col-sm-3" style="margin-top: 10px">
                                <?php
                                $fbs = get_person_contact($id, 5);
                                $fb = mysql_fetch_assoc($fbs);
                                if ($fb)
                                    echo $fb['CONTACT_STRING'];
                                else
                                    echo '-';
                                ?>
                            </div>
                            <div class="col-sm-1">
                                <h5>Line</h5>
                            </div>
                            <div class="col-sm-3" style="margin-top: 10px">
                                <?php
                                $lines = get_person_contact($id, 4);
                                $line = mysql_fetch_assoc($lines);
                                if ($line)
                                    echo $line['CONTACT_STRING'];
                                else
                                    echo '-';
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-8" style="margin-top: 10px">
                                <a class="mdi-action-pageview"onClick="javascript:window.location.assign('edit_contact_detail.php?id=<?php echo $id; ?>')">แก้ไขข้อมูลการติดต่อ</a>
                            </div>
                        </div>
                    </fieldset>



            </div>
        </form>
    </div>
</body>
</html>