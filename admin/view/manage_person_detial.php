<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
$id = $_GET['id'];
if (isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = '123';
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
        <link href="../../css/fieldset.css" rel="stylesheet" type="text/css"/>
        <script src="../../css/bootstrap-filestyle-1.2.1/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        ?>
        <script>
            var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
            function ValidateSingleInput(oInput) {
                if (oInput.type == "file") {
                    var sFileName = oInput.value;
                    if (sFileName.length > 0) {
                        var blnValid = false;
                        for (var j = 0; j < _validFileExtensions.length; j++) {
                            var sCurExtension = _validFileExtensions[j];
                            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                blnValid = true;
                                break;
                            }
                        }

                        if (!blnValid) {
                            alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                            oInput.value = "";
                            return false;
                        }
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                    }
                }
                return true;
            }
            function del(data, id, table) {
                swal({title: "ลบสมาชิก", text: "คุณต้องการลบ '" + data　 + "' ออกจากฐานข้อมูลใช่ไหม?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบสมาชิกเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/del.php?table=' + table + '&id=' + id;
                    }
                });
//
//                var string = "คุณต้องการลบ " + data;
//                var r = confirm(string + "\n" + "ออกจากระบบ?");
//                if (r === true) {
////                    add data to db
////                window.location = 'adding.php?code=' + code + '&department=' + department;
//                    window.location = '../action/del.php?table=' + table + '&id=' + id;
//                }
            }
            function check(id, data) {
                swal({title: "เพิ่มชื่อจีน", text: "คุณต้องการเพิ่มชื่อจีนของ '" + data　 + "' เข้าสู่ฐานข้อมูล?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบข้อมูลพี่น้องเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/checkparent.php?id=' + id + '&type=create';
                    }
                });

//                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
//                var r = confirm(string + "\n" + "สู่ระบบ?");
//                if (r === true) {
//                    window.location = '../action/checkparent.php?id=' + id + '&type=create';
//                }
            }
            function del_child(data, id, b_id) {
                swal({title: "ลบข้อมูลบุตร-ธิดา", text: "คุณต้องการลบ '" + data　 + "' ออกจากรายชื่อบุตร-ธิดา?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบข้อมูลบุตร-ธิดาเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/del_child.php?id=' + id + '&p_id=' + b_id;
                    }
                });
//                var string = "คุณต้องการลบ " + data;
//                var r = confirm(string + "\n" + "ออกจากรายชื่อพี่น้อง?");
//                if (r === true) {
//                    window.location = '../action/del_brother.php?id=' + id + '&b_id=' + b_id;
//                }
            }
            function del_brother(data, id, b_id) {
                swal({title: "ลบข้อมูลพี่น้อง", text: "คุณต้องการลบ '" + data　 + "' ออกจากรายชื่อพี่น้อง?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบข้อมูลพี่น้องเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/del_brother.php?id=' + id + '&b_id=' + b_id;
                    }
                });
//                var string = "คุณต้องการลบ " + data;
//                var r = confirm(string + "\n" + "ออกจากรายชื่อพี่น้อง?");
//                if (r === true) {
//                    window.location = '../action/del_brother.php?id=' + id + '&b_id=' + b_id;
//                }
            }

            function del_parent(data, id, p_id) {

                swal({title: "ลบข้อมูลบิดา", text: "คุณต้องการลบ '" + data　 + "' ออกรายชื่อบิดาใช่ไหม?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบข้อมูลบิดาเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/del_parent.php?id=' + id + '&p_id=' + p_id;
                    }
                });

//                var string = "คุณต้องการลบ " + data;
//                var r = confirm(string + "\n" + "ออกจากรายชื่อบิดา?");
//                if (r === true) {
//                    window.location = '../action/del_parent.php?id=' + id + '&p_id=' + p_id;
//                }
            }
            function del_mother(data, id, p_id) {
                swal({title: "ลบข้อมูลมารดา", text: "คุณต้องการลบ '" + data　 + "' ออกรายชื่อมารดาใช่ไหม?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบข้อมูลมารดาเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/del_mother.php?id=' + id + '&p_id=' + p_id;
                    }
                });

//                var string = "คุณต้องการลบ " + data;
//                var r = confirm(string + "\n" + "ออกจากรายชื่อมารดา?");
//                if (r === true) {
//                    window.location = '../action/del_mother.php?id=' + id + '&p_id=' + p_id;
//                }
            }
            function del_chinahouse(id, data) {
                swal({title: "คุณต้องการลบที่อยู่บรรพบุรุษที่ประเทศจีน", text: "คุณต้องการลบที่อยู่บรรพบุรุษที่ประเทศจีนของ '" + data　 + "' ใช่ไหม?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบที่อยู่บรรพบุรุษที่ประเทศจีนเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/del_chinahouse.php?id=' + id;
                    }
                });

//                var string = "คุณต้องการลบที่อยู่บรรพบุรุษที่ประเทศจีนของ" + data;
//                var r = confirm(string + "\n" + "ออกจากข้อมูล");
//                if (r === true) {
//                    window.location = '../action/del_chinahouse.php?id=' + id;
//                }
            }
            function del_picture(id) {
                swal({title: "ลบรูประจำตัว", text: "คุณต้องการลบรูปประจำตัวใช่รึไม่?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false},
                function (isConfirm) {
                    if (isConfirm) {
                        swal({title: "ลบรูประจำตัวเสร็จสิ้น", text: "", timer: 2000, showConfirmButton: false});
                        window.location = '../action/del_picture.php?id=' + id;
                    }
                });
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
                                var check = str.search("reload");
                                if (check != -1) {
                                    window.location.reload();
                                }
                            }
                        });
            }, 1000);


        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class= "bs-component" style="margin-bottom: -20px">
            <div class="navbar navbar-material-orange">
                <div class="navbar-header">
                    <a class="navbar-brand">ระบบจัดการฐานข้อมูลสมาชิกมูลนิธิไทยนำ-ลิมป์์ศรีสวัสดิ์</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../index.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--<div class=" col-xs-3 btn-material-brown    ">-->
        <!--<h3 class="mdi-navigation-menu"> เมนู</h3>-->
        <!--<ul class="nav nav-pills nav-stacked" >-->
        <?php
        if ($type == 'gen') {
            print_menu(1);
            ?>
            <!--                    <li class="active" ><a href="../index.php" class="mdi-action-home"> หน้าแรก</a></li>
                                <li ><a href="manage_person_table.php" class="mdi-file-cloud"> ฐานข้อมูลสมาชิก</a></li>
                                <li><a href="print.php" class="mdi-action-find-in-page"> พิมพ์ข้อมูล</a></li>
                                <li><a href="createname.php" class="mdi-action-translate"> สร้างชื่อจีน</a></li>
                                <li><a href="ancestorsaddr.php" class="mdi-maps-navigation"> ค้นหาที่อยู่บรรพบุรุษ</a></li>
                                <li><a href="register_day.php" class="mdi-action-assessment"> ดูข้อมูลคนมาร่วมงานประจำปี</a></li>
                                <li>&nbsp;</li> -->
            <?php
        } else {
            ?>
            <?php
            print_menu(1);
        }
        ?>
        <!--</ul>-->
        <!--</div>-->
        <div class=" col-xs-9">
            <center>
                <?php
                connect_database();

                $persons = get_person_detial($id);
                $person = mysql_fetch_assoc($persons);
//                print_r($person);
                ?>
                <div class="row">
                    <h1>รายละเอียดข้อมูลสมาชิก
                    </h1>
                </div>
            </center>
            <div class="well">
                <div class="row">
                    <center>
                        <input type="text" name="data_id" id="data_id" style="visibility:hidden"  value="<?php echo $id; ?>">
                        <input type="text" name="time_old" id="time_old" style="visibility:hidden"  value="<?php echo get_last_update($id); ?>">
                        <div class="col-xs-4" style="margin-top: 95px">
                            <div class="row">
                                <a class="btn btn-primary" role="button" style="width: 175px;" onClick="javascript:window.open('../../print/edit.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">พิมพ์ข้อมูลทั้งหมด</a>
                            </div>
                            <div class="row">
                                <a class="btn btn-danger" role="button" style="width: 175px;" onClick="javascript:window.location.href = './manage_person_table.php';">ย้อนกลับ</a>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <?php
                            $picture_name = get_picture($id);
                            if ($picture_name) {
                                ?>
                                <img id="output" src="../../picture/<?php echo $picture_name; ?>" class="img-rounded" alt="Responsive image" width=200px height=200px >
                                <?php
                            } else {
                                if ($person['GENDER_ID'] == 0) {
                                    ?>
                                    <img id="output"  src="../../picture/Non.jpg" class="img-rounded" alt="Responsive image" width=200px height=200px >
                                    <?php
                                }
                                if ($person['GENDER_ID'] == 1) {
                                    ?>
                                    <img id="output"  src="../../picture/Male.jpg" class="img-rounded" alt="Responsive image" width=200px height=200px >
                                    <?php
                                } else if ($person['GENDER_ID'] == 2) {
                                    ?>
                                    <img id="output"  src="../../picture/Female.jpg" class="img-rounded" alt="Responsive image" width=200px height=200px >
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-xs-4" style="margin-top: 75px;">
                            <form action="../action/edit_picture.php?id=<?php echo $id; ?>" method="Post" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="file" name="picture" id="picture" data-input="false"  class="filestyle" data-buttonText="เปลี่ยนรูปประจำตัว" required accept="image/*" value="fasfs" onchange="ValidateSingleInput(this);">
                                </div>
                                <div class="row">
                                    <button class="btn btn-success" style="width: 175px;" type="submit">บันทึกรูปประจำตัว</button>
                                    <a class="btn btn-material-deeporange" role="button" style="width: 175px;" onClick="window.location.href = ''" >ยกเลิก</a>
                                </div>

                                <div class="row">
                                    <a class="btn btn-material-deeporange" role="button" style="width: 175px;" onClick="del_picture(<?php echo $id; ?>)">ลบรูปประจำตัว</a>
                                </div>
                            </form>
                            <!--                        <div class="row">
                                                        <a class="btn btn-primary" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">พิมพ์ข้อมูลทั้งหมด</a>
                                                    </div>
                                                    <div class="row">
                                                        <a class="btn btn-primary" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">พิมพ์ข้อมูลที่อยู่</a>
                                                    </div>-->

                        </div>
                    </center>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-4">
                        <h4 style="color: red;">แก้ไขข้อมูลล่าสุดเมื่อ <?php
//                            $strDate = "2008-08-14 13:42:44";
//                            echo "ThaiCreate.Com Time now : " . DateThai($strDate);
                            echo DateThai($person['LASTUPDATE']);
                            ?> </h4>
                    </div>
                </div>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h4>1) ข้อมูลส่วนตัว</h4></legend>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ชื่อ-นามสกุลไทย</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 1px">
                            <!--<p>-->
                            <h6>
                                <?php
                                if ($person['TITLE_ID'] != 0)
                                    echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . " " . get_person_surname_string($id);
                                else
                                    echo get_person_name_string($id) . " " . get_person_surname_string($id);
                                ?>
                            </h6>
                            <!--</p>-->
                        </div>
                        <div class="col-xs-2">
                            <h5>ชื่อจีน</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 1px">
                            <h6>
                                <?php
                                if ($person['CHINANAME_ID'] != 0)
                                    echo get_person_china_full_name($id, 0) . '( ' . get_person_china_full_name($id, 1) . ', ' . get_person_china_full_name($id, 2) . ' )';
                                else {
                                    echo '-';
                                }
                                ?>
                            </h6>
                        </div>
                        <!--                    <div class="col-xs-1">
                                                <h4>เพศ</h4>
                                            </div>
                                            <div class="col-xs-1" style="margin-top: 10px">
                        <?php // echo get_person_gender_string($person['GENDER_ID']);  ?>
                                            </div>-->
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>รหัสบัตรประจำตัวประชาชน </h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 1px">
                            <h6>
                                <?php
                                if ($person['PERSONALID'] != '')
                                    echo get_personalID($id);
                                else {
                                    echo '-';
                                }
                                ?>
                            </h6>
                        </div>
                        <div class="col-xs-3">
                            <h5>สถานะ </h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 1px">
                            <h6>
                                <?php
                                if ($person['STATUS'] == 1) {
                                    echo "ยังมีชีวิต";
                                } elseif ($person['STATUS'] == 2) {

                                    echo "เสียชีวิต";
                                } else {
                                    echo 'ไม่ระบุ';
                                }
                                ?>
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>เพศ</h5>
                        </div>
                        <div class="col-xs-1" style="margin-top: 1px">
                            <h6>
                                <?php echo get_person_gender_string($person['GENDER_ID']); ?>
                            </h6>
                        </div>
                        <div class="col-xs-2">
                            <h5>วันเดือนปีเกิด(ค.ศ.)</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top: 1px">
                            <h6>
                                <?php
                                echo display_birthday($person['BIRTHDAY']);
                                ?>
                            </h6>
                        </div>
                        <div class="col-xs-1">
                            <h5>อายุ</h5>
                        </div>
                        <div class="col-xs-1" style="margin-top: 1px">
                            <h6>
                                <?php
                                if ($person['BIRTHDAY'] != '')
                                    echo (cal_age($person['BIRTHDAY'])) . "ปี";
                                else
                                    echo '-';
                                echo " ";
                                ?>
                            </h6>
                        </div>
                        <div class="col-xs-2">
                            <h5>สถานภาพ</h5>
                        </div>
                        <div class="col-xs-1" style="margin-top: 1px">
                            <h6>
                                <?php echo get_person_marital_string($person['MARITALSTATUS_ID']); ?>
                            </h6>
                        </div>
                        <!--                    <div class="col-xs-2">
                                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">แก้ไขข้อมูลส่วนตัว</a>
                                            </div>    -->
                    </div>
                    <!--                <div class="row">
                                        <div class="col-xs-4 col-xs-offset-4">
                                            <div class="col-xs-4 col-xs-offset-8">
                                            <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">แก้ไขข้อมูลส่วนตัว</a>
                                            <a class="btn btn-primary" role="button" style="margin-top: 0px" onClick="javascript:window.open('../../print/edit.php?id=<?php echo$person['ID']; ?>&page=admin', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">พิมพ์ข้อมูลทั้งหมด</a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="btn btn-primary" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">พิมพ์ข้อมูลทั้งหมด</a>
                                            <a class="btn btn-material-deeporange" role="button" style="margin-top: 0px" onClick="javascript:window.open('edit_person_detail.php?id=<?php echo $id ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">แก้ไขข้อมูลส่วนตัว</a>
                                        </div>
                                    </div>-->
                    <div class="row">
                        <!--                    <div class="col-xs-4">
                                                <h4>1) ข้อมูลส่วนตัว</h4>
                                            </div>-->
                        <div class="col-xs-4 col-xs-offset-8">
                            <a class="btn btn-material-deeporange" role="button" style="margin-top: 0px" onClick="javascript:window.open('edit_person_detail.php?id=<?php echo $id ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=400,top=0,left=150 ')">แก้ไขข้อมูลส่วนตัว</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h4>2) ข้อมูลการติดต่อ</h4></legend>
                    <!--                    <div class="row">
                                            <div class="col-xs-4 col-xs-offset-8">
                                                <a href="edit_address_detail.php">8;pppp</a>
                                            </div>
                                        </div>-->
                    <?php
                    $homeAddrs = get_person_all_address($id, 1);
                    $count = 1;
                    while ($homeAddr = mysql_fetch_assoc($homeAddrs)) {
//                    print_r($homeAddr);
                        ?>
                        <div class="row">
                            <div class="col-xs-2">
                                <h5>ที่อยู่บ้าน<?php echo $count; ?></h5>
                            </div>
                            <div class="col-xs-8" style="margin-top: 1px">
                                <h6>
                                    <?php
                                    echo get_addr_string($homeAddr);
// echo $homeAddr['ADDRESS_NUM'] . ' ' . $homeAddr['ADDRESS_VILLAGE'] . ' ' . $homeAddr['ADDRESS_ALLEY'] . ' หมู่ ' . $homeAddr['ADDRESS_MOO'] . ' ' . $homeAddr['ADDRESS_ROAD'] . ' ' . get_district_string($homeAddr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($homeAddr['ADDRESS_PROVINCE_ID']) . ' ' . $homeAddr['ADDRESS_ZIPCODE'];
                                    ?>
                                </h6>
                            </div>
                            <!--                        <div class="col-sm-2">
                                                        <a class="btn btn-danger" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">ลบที่อยู่บ้าน</a>
                                                    </div>-->
                        </div>
                        <?php
                        $count++;
                    }
                    ?>
                    <!--                <div class="row">
                                        <div class="col-sm-2 col-sm-offset-9">
                                            <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">แก้ไขที่อยู่บ้าน</a>
                                        </div>
                                    </div>-->
                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            $homeTels = get_person_contact($id, 1);
                            $count = 1;
                            while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                ?>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5>เบอร์โทรศัพท์บ้าน<?php echo $count; ?></h5>
                                    </div>
                                    <div class="col-xs-6" style="margin-top: 1px">
                                        <h6>
                                            <?php echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING']; ?>
                                        </h6>
                                    </div>
                                </div>
                                <?php
                                $count++;
                            }
                            if ($count == 1) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5>เบอร์โทรศัพท์บ้าน</h5>
                                    </div>
                                    <div class="col-xs-6" style="margin-top: 1px">
                                        <h6>
                                            <?php echo '-'; ?>
                                        </h6>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            $mobileTels = get_person_contact($id, 2);
                            $count = 1;
                            while ($mobileTel = mysql_fetch_assoc($mobileTels)) {
//                            print_r($homeTel);
                                ?>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5>มือถือ<?php echo $count; ?></h5>
                                    </div>
                                    <div class="col-xs-6" style="margin-top: 1px">
                                        <h6>
                                            <?php echo $mobileTel['CONTACT_ARER_CODE'] . '-' . $mobileTel['CONTACT_STRING']; ?>
                                        </h6>
                                    </div>
                                </div>
                                <?php
                                $count++;
                            }
                            if ($count == 1) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5>มือถือ</h5>
                                    </div>
                                    <div class="col-xs-6" style="margin-top: 1px">
                                        <h6>
                                            <?php echo '-'; ?>
                                        </h6>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>E mail</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top: 1px">
                            <h6>
                                <?php
                                $emails = get_person_contact($id, 3);
                                $email = mysql_fetch_assoc($emails);
                                if ($email)
                                    echo $email['CONTACT_STRING'];
                                else
                                    echo '-';
                                ?>
                            </h6>
                        </div>
                        <div class="col-xs-2">
                            <h5>Facebook</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top: 1px">
                            <h6>
                                <?php
                                $fbs = get_person_contact($id, 5);
                                $fb = mysql_fetch_assoc($fbs);
                                if ($fb)
                                    echo $fb['CONTACT_STRING'];
                                else
                                    echo '-';
                                ?>
                            </h6>
                        </div>
                        <div class="col-xs-1">
                            <h5>Line</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top: 1px">
                            <h6>
                                <?php
                                $lines = get_person_contact($id, 4);
                                $line = mysql_fetch_assoc($lines);
                                if ($line)
                                    echo $line['CONTACT_STRING'];
                                else
                                    echo '-';
                                ?>
                            </h6>
                        </div>
                        <!--                    <div class="col-xs-2">
                                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">แก้ไขข้อมูลการติดต่อ</a>
                                            </div>-->
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <!--<div class="col-xs-4 col-xs-offset-8">-->
                            <!--<a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">แก้ไขข้อมูลส่วนตัว</a>-->
                            <a class="btn btn-primary" role="button" style="margin-top: 0px" onClick="javascript:window.open('../../print/letter.php?id=<?php echo$person['ID']; ?>&page=admin', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">พิมพ์ข้อมูลที่อยู่</a>
                        </div>
                        <div class="col-xs-4 col-xs-offset-4">
                            <!--<a class="btn btn-primary" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">พิมพ์ข้อมูลทั้งหมด</a>-->
                            <a class="btn btn-material-deeporange" role="button" style="margin-top: 0px" onClick="javascript:window.open('detail_address.php?id=<?php echo $id ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=0,left=150 ')">ดูข้อมูลการติดต่อทั้งหมด</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h4>3) อาชีพ/ธุรกิจหลัก</h4></legend>
                    <?php
                    $checkOrganizations = get_person_organization($id);
                    $checkOrganization = mysql_fetch_assoc($checkOrganizations);
                    if (!$checkOrganization) {
                        ?>
                        <div class="row">
                            <div class="col-xs-6 col-xs-offset-2">
                                <h4 class="text-danger">ไม่พบข้อมูลอาชีพ กรุณากดปุ่มเพิ่มข้อมูลอาชีพ</h4>
                            </div>
                            <div class="col-xs-4">
                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('new_organization.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลอาชีพ</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        $organizationroles = get_person_organization($id);
                        $count = 1;
                        while ($organizationrole = mysql_fetch_assoc($organizationroles)) {
//                        print_r($organizationrole);
                            $organization_id = $organizationrole['ORGANIZATION_ID'];

                            $organizations = get_organization_data($organization_id);
                            $organization = mysql_fetch_assoc($organizations);
                            ?>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border"><h5>อาชีพ/ธุรกิจ<?php echo $count; ?></h5></legend>
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
                                        <h6> <?php echo $organizationrole['ORGANIZATION_ROLE']; ?></h6>
                                    </div>
                                </div>
                                <?php
                                $organizationAddrs = get_person_all_address($organization_id, 2);
                                $count_addr = 1;
                                while ($organizationAddr = mysql_fetch_assoc($organizationAddrs)) {
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h5>ที่อยู่</h5>
                                        </div>
                                        <div class="col-sm-10">
                                            <h6> <?php echo $organizationAddr['ADDRESS_NUM'] . ' ' . $organizationAddr['ADDRESS_VILLAGE'] . ' ' . $organizationAddr['ADDRESS_ALLEY'] . ' ' . $organizationAddr['ADDRESS_MOO'] . ' ' . $organizationAddr['ADDRESS_ROAD'] . ' ' . get_district_string($organizationAddr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($organizationAddr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($organizationAddr['ADDRESS_PROVINCE_ID']) . ' ' . $organizationAddr['ADDRESS_ZIPCODE']; ?> </h6>
                                        </div>
                                    </div>
                                    <?php
                                    $count_addr++;
                                }
                                if ($count_addr == 1) {
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>ไม่พบข้อมูลที่อยู่</h5>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
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
                                                <div class="col-sm-6">
                                                    <h6>
                                                        <?php
                                                        echo $homeTel['CONTACT_ARER_CODE'] . $homeTel['CONTACT_STRING'];
                                                        if ($homeTel['CONTACT_COMMENT'] != '')
                                                            echo " ต่อ " . $homeTel['CONTACT_COMMENT']
                                                            ?>
                                                    </h6>
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
                                    <div class="col-sm-6">
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
                                                <div class="col-sm-6">
                                                    <h6>
                                                        <?php
                                                        echo $homeTel['CONTACT_ARER_CODE'] . $homeTel['CONTACT_STRING'];
                                                        if ($homeTel['CONTACT_COMMENT'] != '')
                                                            echo " ต่อ " . $homeTel['CONTACT_COMMENT']
                                                            ?>
                                                    </h6>
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
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5>เว็บไซต์ที่ทำงาน</h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>
                                                    <?php
                                                    $emails = get_person_contact($organization_id, 7);
                                                    $email = mysql_fetch_assoc($emails);
                                                    if ($email)
                                                        echo $email['CONTACT_STRING'];
                                                    else
                                                        echo '-';
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--email-->
                                    <div class="col-sm-6">
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
                                                <div class="col-sm-6">
                                                    <h6><?php echo $mobileTel['CONTACT_STRING']; ?></h6>
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
                                                <div class="col-sm-6">
                                                    <h6><?php echo '-'; ?></h6>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <?php
                            $count++;
                        }
                        ?>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <a class="btn btn-material-deeporange" role="button" style="margin-top: 0px" onClick="javascript:window.open('detail_organization.php?id=<?php echo $id ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=0,left=150 ')">ดูข้อมูลอาชีพ/ธุรกิจทั้งหมด</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h4>4) เครือญาติ</h4></legend>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><h5>บิดา-มารดา</h5></legend>
                        <?php
                        if ($person['MOTHER_ID'] == 0) {
                            ?>
                            <div class="col-xs-6 col-xs-offset-2">
                                <h5 class="text-danger">ไม่พบข้อมูลมารดา กรุณากดปุ่มเพิ่มข้อมูลมารดา</h5>
                            </div>
                            <div class="col-xs-4 ">
                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_mother_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=225,top=200,left=200 ')">เพิ่มข้อมูลมารดา</a>
                            </div>
                            <?php
                        } else {
                            $mother = get_person_detial($person['MOTHER_ID']);
                            $mother = mysql_fetch_assoc($mother);
                            ?>
                            <div class="col-xs-2">
                                <h5>ชื่อ-นามสกุล มารดา</h5>
                            </div>
                            <div class="col-xs-4">
                                <h5><?php echo get_person_title_string($mother['TITLE_ID']) . ' ' . get_person_name_string($person['MOTHER_ID']) . ' ' . get_person_surname_string($person['MOTHER_ID']); ?></h5>
                            </div>
                            <div class="col-xs-4 col-xs-offset-2">
                                <h5>
                                    <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $person['MOTHER_ID']; ?>')">แก้ไขข้อมูล</a>

                                    <a class="mdi-content-remove" onClick="del_mother('<?php echo get_person_title_string($mother['TITLE_ID']) . ' ' . get_person_name_string($mother['ID']) . ' ' . get_person_surname_string($mother['ID']); ?>', '<?php echo $id; ?>', '<?php echo $mother['ID']; ?>')">ลบข้อมูล</a>
                                </h5>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if ($person['PARENT_ID'] == 0) {
                            ?>
                            <div class="col-xs-6 col-xs-offset-2">
                                <h5 class="text-danger">ไม่พบข้อมูลบิดา กรุณากดปุ่มเพิ่มข้อมูลบิดา</h5>
                            </div>
                            <div class="col-xs-4 ">
                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_parent_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=225,top=200,left=200 ')">เพิ่มข้อมูลบิดา</a>
                            </div>
                            <?php
                        } else {
                            $parents = get_person_detial($person['PARENT_ID']);
                            $parent = mysql_fetch_assoc($parents);
                            ?>
                            <div class="col-xs-2">
                                <h5>ชื่อ-นามสกุล บิดา</h5>
                            </div>
                            <div class="col-xs-4">
                                <h5>

                                    <?php echo get_person_title_string($parent['TITLE_ID']) . ' ' . get_person_name_string($person['PARENT_ID']) . ' ' . get_person_surname_string($person['PARENT_ID']); ?>
                                </h5>
                            </div>
                            <div class="col-xs-4 col-xs-offset-2">
                                <h5>
                                    <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $parent['ID']; ?>')">แก้ไขข้อมูล</a>

                                    <a class="mdi-content-remove" onClick="del_parent('<?php echo get_person_title_string($parent['TITLE_ID']) . ' ' . get_person_name_string($parent['ID']) . ' ' . get_person_surname_string($parent['ID']); ?>', '<?php echo $id; ?>', '<?php echo $parent['ID']; ?>')">ลบข้อมูล</a>
                                </h5>
                            </div>
                            <?php
                        }
                        ?>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">
                            <h5>พี่น้อง  &Tab;
                                <a class="mdi-content-add" onClick="javascript:window.open('add_brother_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มพี่น้อง</a>
                            </h5>
                        </legend>
                        <?php
                        if ($person['PARENT_ID'] == 0 && $person['BROTHER_LIST'] == '') {
                            ?>
                            <div class="col-xs-6 col-xs-offset-2">
                                <h5 class="text-danger">ไม่พบข้อมูลพี่น้อง กรุณากดปุ่มเพิ่มข้อมูลพี่น้อง</h5>
                            </div>
                            <!--                            <div class="col-xs-4 ">
                                                            <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_brother.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>
                                                        </div>-->
                            <?php
                        } else {
                            $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $id);
                            $count = 1;
                            while ($brother = mysql_fetch_assoc($brothers)) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <h5><?php echo $count; ?> ชื่อ-นามสกุล</h5>
                                    </div>
                                    <div class="col-xs-4">
                                        <h5><?php echo get_person_title_string($brother['TITLE_ID']) . ' ' . get_person_name_string($brother['ID']) . ' ' . get_person_surname_string($brother['ID']); ?></h5>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-0">
                                        <h5>
                                            <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $brother['ID']; ?>')">แก้ไขข้อมูล</a>
                                        </h5>
                                    </div>
                                    <div class="col-xs-4 col-xs-offset-0">
                                        <h5>
                                            <a class="mdi-content-remove" onClick="del_brother('<?php echo get_person_title_string($brother['TITLE_ID']) . ' ' . get_person_name_string($brother['ID']) . ' ' . get_person_surname_string($brother['ID']); ?>', '<?php echo $id; ?>', '<?php echo $brother['ID']; ?>')">ลบข้อมูล</a>
                                        </h5>
                                    </div>
                                </div>
                                <?php
                                $count++;
                            }
                            if ($count == 1) {
                                ?>
                                <div class="col-xs-6 col-xs-offset-2">
                                    <h5 class="text-danger">ไม่พบข้อมูลพี่น้อง กรุณากดปุ่มเพิ่มข้อมูลพี่น้อง</h5>
                                </div>
                                <!--                            <div class="col-xs-4 ">
                                                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_brother.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>
                                                            </div>-->
                                <?php
                            }
//                            print_r($brother);
                        }
                        ?>
                    </fieldset>
                    <fieldset class="scheduler-border" >
                        <legend class="scheduler-border">
                            <h5 >ข้อมูลบุตร-ธิดา  &Tab;
                                <a class="mdi-content-add" onClick="javascript:window.open('add_child_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลบุตร-ธิดา</a> </h5>
                        </legend>

                        <?php
                        $query = "SELECT * FROM person WHERE PARENT_ID = $id OR MOTHER_ID = $id Order by `BIRTHDAY` ASC";
                        $check = mysql_fetch_assoc(mysql_query($query));
                        if (!$check) {
                            ?>
                            <center>
                                <div class="row">
                                    <div class="col-xs-5 col-xs-offset-2">
                                        <h5 class="text-danger">ไม่พบข้อมูลบุตร-ธิดา กรุณากดปุ่มเพิ่มข้อมูลบุตร-ธิดา</h5>
                                    </div>
                                    <div class="col-xs-4 ">
                                        <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_child_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลบุตร-ธิดา</a>
                                    </div>
                                </div>
                            </center>
                            <?php
                        } else {
                            $childs = mysql_query($query);
                            $count = 1;
                            while ($child = mysql_fetch_assoc($childs)) {
                                ?>
                                                                            <!--<center>-->
                                <div class="row">
                                    <div class="col-xs-2">
                                        <h5><?php echo $count; ?> ชื่อ-นามสกุล</h5>
                                    </div>
                                    <div class="col-xs-4">
                                        <h5><?php echo get_person_title_string($child['TITLE_ID']) . ' ' . get_person_name_string($child['ID']) . ' ' . get_person_surname_string($child['ID']); ?></h5>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-0">
                                        <h5>
                                            <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $child['ID']; ?>')">แก้ไขข้อมูล</a>
                                        </h5>
                                    </div>
                                    <div class="col-xs-4 col-xs-offset-0">
                                        <h5>
                                            <a class="mdi-content-remove" onClick="del_child('<?php echo get_person_title_string($child['TITLE_ID']) . ' ' . get_person_name_string($child['ID']) . ' ' . get_person_surname_string($child['ID']); ?>', '<?php echo $id; ?>', '<?php echo $child['ID']; ?>')">ลบข้อมูล</a>
                                        </h5>
                                    </div>
                                </div>
                                <!--</center>-->
                                <?php
//                                echo $count;
                                $count++;
                            }
                            if ($count == 1) {
                                ?>
                                <center>
                                    <div class="col-xs-4 col-xs-offset-2">
                                        <h5 class="text-danger">ไม่พบข้อมูลบุตร-ธิดา กรุณากดปุ่มเพิ่มข้อมูลบุตร-ธิดา</h5>
                                    </div>

                                    <div class="col-xs-4 ">
                                        <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_child.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลบุตร-ธิดา</a>
                                    </div>
                                </center>
                                <?php
                            }
                        }
                        ?>
                    </fieldset>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h4>5) ที่อยู่บรรพบุรุษที่ประเทศจีน</h4></legend>
                    <?php
                    $check_chinahouse = check_chinahouse($person);
//                    echo "check chinahouse : " . $check_chinahouse;
                    if ($check_chinahouse == 0) {
                        ?>
                        <div class="row">
                            <div class="col-xs-6 col-xs-offset-2">
                                <h4 class="text-danger">ไม่พบข้อมูล กรุณาเพิ่มข้อมูลบรรพบุรุษที่จีน</h4>
                            </div>
                            <div class="col-xs-4 ">
                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_chinahouse_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=350,top=150,left=150 ')">เพิ่มข้อมูลที่อยู่บรรพบุรุษที่จีน</a>
                            </div>
                        </div>
                        <?php
                    } else {
//                        echo "check chinahouse : " . $check_chinahouse;
//                            add_chinahouse($id, $check_chinahouse);
                        $chinahouses = get_chinahouse_data($check_chinahouse);
                        $chinahouse = mysql_fetch_assoc($chinahouses);
                        ?>
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>ผู้ที่ติดต่อได้ : </h5>
                            </div>
                            <div class="col-xs-3">
                                <h5>
                                    <?php
                                    if ($chinahouse['CHINAHOUSE_NAME'] == '')
                                        echo '-';
                                    else
                                        echo $chinahouse['CHINAHOUSE_NAME'];
                                    ?>
                                </h5>
                            </div>
                            <div class="col-xs-3">
                                <h5>เบอร์ติดต่อ : </h5>
                            </div>
                            <div class="col-xs-3">
                                <h5>
                                    <?php
                                    if ($chinahouse['CHINAHOUSE_TEL'] == '')
                                        echo '-';
                                    else
                                        echo $chinahouse['CHINAHOUSE_TEL'];
                                    ?>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                              <h5>ความสัมพันธ์</h5>
                            </div>
                            <div class="col-xs-4">
                                 <h5>
                                    <?php
                                    if ($chinahouse['CHINAHOUSE_LINK'] == '')
                                        echo '-';
                                    else
                                        echo $chinahouse['CHINAHOUSE_LINK'];
                                    ?>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <h5>地址 : </h5>
                            </div>
                            <div class="col-xs-10">
                                <h5><?php echo get_full_chinahouse_string($check_chinahouse, 'china'); ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <h5>ภาษาไทย </h5>
                            </div>
                            <div class="col-xs-10">
                                <h5><?php echo get_full_chinahouse_string($check_chinahouse, 'thai'); ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('edit_chinahouse_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=350,top=150,left=150 ')">แก้ไขข้อมูลที่อยู่บรรพบุรุษที่จีน</a>
                            </div>
                            <div class="col-xs-4">
                                <a class="btn btn-danger" role="button" style="margin-top: 0px" onClick="del_chinahouse('<?php echo $id; ?>', '<?php echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . " " . get_person_surname_string($id); ?>')">ลบข้อมูลที่อยู่บรรพบุรุษที่จีน</a>
                            </div>
                        </div>
                        <?php
                        add_chinahouse($id, $check_chinahouse);
                    }
                    ?>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h4>6) หมายเหตุ</h4></legend>

                    <div class="row">
                        <div class="col-xs-3 col-xs-offset-1">
                            <?php
                            echo get_remark($id);
                            ?>
                        </div>
                        <div class="col-xs-4 col-xs-offset-4">
                            <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('edit_remark_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=350,top=150,left=150 ')">แก้ไขหมายเหตุ</a>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </body>
</html>
