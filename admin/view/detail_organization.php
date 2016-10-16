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
        <script>
            function del_organiztion(id, organization_id, show) {
                var string = "คุณต้องการลบ " + show;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
                    window.location = '../action/del_organiztion.php?id=' + id + '&organization_id=' + organization_id;
                }
            }
            function del_addr(id, addr_id, show) {
                var string = "คุณต้องการลบ " + show;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
                    window.location = '../action/del_address.php?id=' + id + '&addr_id=' + addr_id + '&type=2';
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "สู่ระบบ?");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=create';
                }
            }
            setInterval(function () {
                var id = document.getElementById('data_id').value;
                var time = document.getElementById('time_old').value;
                var dataString = "id=" + id + "&time=" + time;
                $.ajax
                        ({
                            url: "../../helper/dbupdate_ajax.php",
                            type: "POST",
                            data: dataString,
                            cache: false,
                            success: function (html) {
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
        <div class=" col-sm-12">
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
                    <h1>แก้ไขข้อมูลอาชีพ/ธุรกิจ
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
                        <h3>ข้อมูลที่ทำงาน</h3>
                        <a onClick="javascript:window.location.assign('new_organization.php?id=<?php echo $id; ?>')">เพิ่มที่ทำงาน</a>
                    </div>
                    <?php
//                    $organizationAddrs = get_person_organization_all($id);
//                    $count = 1;
//                    while ($organizationAddrss = mysql_fetch_assoc($organizationAddrs)) {
////                    print_r($organizationAddrss);
//                        $organization_id = $organizationAddrss['ORGANIZATION_ID'];
//
//                        $organi = get_organization($id, $organization_id);
//                        $addresscount = 1;
//                        while($organizationAddr = mysql_fetch_assoc($organi)){

                    $organizationroles = get_person_organization($id);
                    $count = 1;
                    while ($organizationrole = mysql_fetch_assoc($organizationroles)) {
//                        print_r($organizationrole);
                        $organization_id = $organizationrole['ORGANIZATION_ID'];

                        $organizations = get_organization_data($organization_id);
                        $organization = mysql_fetch_assoc($organizations);
                        ?>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">อาชีพ/ธุรกิจ<?php echo $count; ?></legend>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border"><h5>รายละเอียดงาน</h5></legend>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h5>ธุรกิจ</h5>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6><?php echo get_organization_type_string($organization['ORGANIZATION_TYPE_ID']); ?></h6>
                                    </div>
                                    <div class="col-sm-2">
                                        <h5>ประเภทธุรกิจ</h5>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6><?php echo $organization['ORGANIZATION_COMMENT']; ?></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h5>ชื่อ</h5>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6><?php echo $organization['ORGANIZATION_NAME']; ?></h6>
                                    </div>
                                    <div class="col-sm-2">
                                        <h5>ตำแหน่งงาน</h5>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6><?php echo $organizationrole['ORGANIZATION_ROLE']; ?></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                    </div>
                                    <div class="col-sm-3" style="margin-top: 10px">
                                        <a class="mdi-action-pageview"onClick="javascript:window.location.assign('edit_organization_detail.php?id=<?php echo $id; ?>&organization_id=<?php echo $organization_id; ?>')">แก้ไขรายละเอียดงาน</a>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">
                                    <h5>ที่อยู่ที่ทำงาน &Tab;
                                        <a class="mdi-content-add" onClick="javascript:window.location.assign('new_address.php?id=<?php echo $organization_id; ?>&type=2&p_id=<?php echo $id; ?>')">เพิ่มที่อยู่ที่ทำงาน</a>
                                    </h5>
                                </legend>
                                <?php
                                $Addrs = get_person_all_address($organization_id, 2);
                                $addresscount = 1;
                                while ($Addr = mysql_fetch_assoc($Addrs)) {
//                                    print_r($Addr);
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h5>ที่อยู่<?php echo $addresscount; ?></h5>
                                        </div>
                                        <div class="col-sm-6" style="margin-top: 10px">
                                            <?php echo $Addr['ADDRESS_NUM'] . ' ' . $Addr['ADDRESS_VILLAGE'] . ' ' . $Addr['ADDRESS_ALLEY'] . ' ' . $Addr['ADDRESS_MOO'] . ' ' . $Addr['ADDRESS_ROAD'] . ' ' . get_district_string($Addr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($Addr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($Addr['ADDRESS_PROVINCE_ID']) . ' ' . $Addr['ADDRESS_ZIPCODE']; ?>
                                        </div>
                                        <div class="col-sm-2" style="margin-top: 10px">
                                            <a class="mdi-action-pageview"onClick="javascript:window.location.assign('edit_address_detail.php?id=<?php echo $organization_id; ?>&addr_id=<?php echo $Addr['ADDRESSLIST_ADDRESS_ID']; ?>&type=2&p_id=<?php echo $id; ?>')">แก้ไขข้อมูลที่อยู่</a>
                                        </div>
                                        <div class="col-sm-2" style="margin-top: 10px">
                                            <a class="mdi-action-delete" onclick="del_addr(<?php echo $organization_id; ?>,<?php echo $Addr['ADDRESSLIST_ADDRESS_ID']; ?>, 'ที่อยู่<?php echo $addresscount; ?>')">ลบข้อมูลที่อยู่</a>
                                        </div>
                                    </div>

                                    <?php
                                    $addresscount++;
                                }
                                if ($addresscount == 1) {
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            ไม่พบข้อมูลที่อยู่กรุณาเพิ่มที่อยู่
                                        </div>
                                    </div>    
                                    <?php
                                }
                                ?>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php
                                        $homeTels = get_person_contact($organization_id, 6);
                                        $count_temp = 1;
                                        while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>เบอร์โทรศัพท์ที่ทำงาน<?php echo $count_temp; ?></h5>
                                                </div>
                                                <div class="col-sm-6" style="margin-top: 10px">
                                                    <?php
                                                    echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];
                                                    if ($homeTel['CONTACT_COMMENT'] != '')
                                                        echo " ต่อ " . $homeTel['CONTACT_COMMENT']
                                                        ?>

                                                </div>
                                            </div>
                                            <?php
                                            $count_temp++;
                                        }
                                        if ($count_temp == 1) {
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>เบอร์โทรศัพท์ที่ทำงาน</h5>
                                                </div>
                                                <div class="col-sm-6" style="margin-top: 10px">
                                                    <?php echo '-'; ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php
                                        $homeTels = get_person_contact($organization_id, 9);
                                        $count_temp = 1;
                                        while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>faxที่ทำงาน<?php echo $count_temp; ?></h5>
                                                </div>
                                                <div class="col-sm-6" style="margin-top: 10px">
                                                    <?php
                                                    echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];
                                                    if ($homeTel['CONTACT_COMMENT'] != '')
                                                        echo " ต่อ " . $homeTel['CONTACT_COMMENT']
                                                        ?>

                                                </div>
                                            </div>
                                            <?php
                                            $count_temp++;
                                        }
                                        if ($count_temp == 1) {
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>faxที่ทำงาน</h5>
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
                                    <!--เวป-->
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5>เว็บไซต์ที่ทำงาน</h5>
                                            </div>
                                            <div class="col-sm-6" style="margin-top: 10px">
                                                <?php
                                                $emails = get_person_contact($organization_id, 7);
                                                $email = mysql_fetch_assoc($emails);
                                                if ($email)
                                                    echo $email['CONTACT_STRING'];
                                                else
                                                    echo '-';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--email-->
                                    <div class="col-sm-12">
                                        <?php
                                        $mobileTels = get_person_contact($organization_id, 8);
                                        $count_temp = 1;
                                        while ($mobileTel = mysql_fetch_assoc($mobileTels)) {
//                            print_r($homeTel);
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>E-mailที่ทำงาน<?php echo $count_temp; ?></h5>
                                                </div>
                                                <div class="col-sm-6" style="margin-top: 10px">
                                                    <?php echo $mobileTel['CONTACT_STRING']; ?>
                                                </div>
                                            </div>
                                            <?php
                                            $count_temp++;
                                        }
                                        if ($count_temp == 1) {
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>E-mailที่ทำงาน</h5>
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
                                    <div class="col-sm-5 col-sm-offset-7" style="margin-top: 10px">
                                        <a class="mdi-action-pageview"onClick="javascript:window.location.assign('edit_organization_contact.php?id=<?php echo $id; ?>&organization_id=<?php echo $organization_id; ?>')">แก้ไขข้อมูลการติดต่อ</a>
                                        <a class="mdi-action-delete" onclick="del_organiztion(<?php echo $id; ?>,<?php echo $organization_id; ?>, 'อาชีพ/ธุรกิจ<?php echo $count; ?>')">ลบอาชีพ/ธุรกิจ</a>

                                    </div>
                                </div>
                            </fieldset>
                        </fieldset>
                        <?php
                        $count++;
                    }
                    ?>
            </div>
        </div>
    </body>
</html>