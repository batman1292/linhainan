<html>
    <head>
        <meta charset="utf-8">
        <link href="../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <script src="../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../helper/jquery-latest.js" type="text/javascript"></script>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();

                document.body.innerHTML = originalContents;
            }
            $(document).ready(function () {
                //                alert('loaded');
                window.printDiv("print_div");
                // do other things
//                return false;
//                window.close();
            });
        </script>
    </head>
    <body>


        <div class="bs-component">
            <!--<a class="btn btn-danger" role="button" style="margin-top: 0px" onClick="javascript:window.history.back();">ย้อนกลับ</a>-->
            <div id="print_div">
                <div class="row">
                    <div class="col-xs-3">
                        <h4>1.ข้อมูลส่วนตัว </h4>
                    </div>
                    <!--                </div>
                                    <div class="row">-->
                    <div class="col-xs-4" style="margin-top:2px">
                        <h6>ชื่อ-นามสกุลกรุณาระบุคำนำหน้านาม</h6>
                    </div>
                    <div class="col-xs-1" style="margin-top:2px">
                        <h6>เพศ</h6>
                    </div>
                    <div class="col-xs-2" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1"  <?php // if ($person["GENDER_ID"] == 1) echo "checked";   ?> >ชาย
                        <input type="checkbox" name="gender" value="2" <?php // if ($person["GENDER_ID"] == 2) echo "checked";   ?>>หญิง
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ไทย</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php // echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . ' ' . get_person_surname_string($id);   ?>">
                    </div>
                    <div class="col-xs-2">
                        <h6>เลขบัตรประชาชน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php
?>"  >
                    </div>
                    <!--                    <div class="col-xs-2">
                                            <h6>ชื่อจีน(ถ้ามี)</h6>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" value="<?php // echo $chinaname;   ?>">
                                        </div>-->

                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ชื่อจีน 林</h6>
                    </div>
                    <div class="col-xs-1">
                        <h6>รุ่น</h6> 
                    </div>
                    <div class="col-xs-3" style="margin: 5 0px">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ชื่อ</h6> 
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>เสียง pinyin lin</h6>
                    </div>
                    <div class="col-xs-1">
                        <h6>รุ่น</h6> 
                    </div>
                    <div class="col-xs-3" >
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ชื่อ</h6> 
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control"autofocus name="chinaname_pinyin" value="" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>คำอ่านไทย หลิน</h6>
                    </div>
                    <div class="col-xs-1">
                        <h6>รุ่น</h6> 
                    </div>
                    <div class="col-xs-3" >
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ชื่อ</h6> 
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control"autofocus name="chinaname_thai" value="" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h6>วัน-เดือน-ปีเกิด(ค.ศ.)</h6>
                    </div>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>อายุ</h6>
                    </div>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-2">
                        <h6>ปี สถานภาพ</h6>
                    </div>
                    <div class="col-xs-4" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" >โสด
                        <input type="checkbox" name="gender" value="2" >สมรส
                        <input type="checkbox" name="gender" value="2" >หย่าร้าง
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ที่อยู่บ้าน</h6>
                    </div>  
                    <div class="col-xs-2">
                        <h6>บ้านเลขที่</h6>
                    </div>  
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่</h6>
                    </div>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่บ้าน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>ซอย</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ถนน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ตำบล</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>อำเภอ</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>จังหวัด</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-2">
                        <h6>รหัสไปรษณีย์</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">

                    <div class="col-xs-2">
                        <h6>โทรศัพท์บ้าน</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-2">
                        <h6>เบอร์มือถือ</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control"  >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>e-mail</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="email" class="form-control">
                    </div>
                    <div class="col-xs-1">
                        <h6>facebook</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>lineID</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h4>2.อาชีพ/ธุรกิจหลัก</h4>
                    </div>
                    <div class="col-xs-9" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" >รับราชการ 
                        <input type="checkbox" name="gender" value="2" >รัฐวิสาหกิจ 
                        <input type="checkbox" name="gender" value="2" >เอกชน 
                        <input type="checkbox" name="gender" value="2" >นักเรียน / นักศึกษา 
                        <input type="checkbox" name="gender" value="2" >อิสระ 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h6>ประเภทธุรกิจหลัก</h6>
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ชื่อที่ทำงาน</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-2">
                        <h6>ตำแหน่งงาน</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ที่อยู่ที่ทำงาน</h6>
                    </div>  
                    <div class="col-xs-2">
                        <h6>บ้านเลขที่</h6>
                    </div>  
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่</h6>
                    </div>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่บ้าน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>ซอย</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ถนน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ตำบล</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>อำเภอ</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>จังหวัด</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-2">
                        <h6>รหัสไปรษณีย์</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>โทรศัพท์</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="email" class="form-control">
                    </div>
                    <div class="col-xs-1">
                        <h6>website</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-2">
                        <h6>e-mail</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10">
                        <h4>3.ครอบครัว</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        ชื่อ-นามสกุล บิดา
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>สถานะ</h6>
                    </div>
                    <div class="col-xs-4" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" >ยังมีชีวิตอยู่
                        <input type="checkbox" name="gender" value="2" >เสียชีวิตแล้ว
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        ชื่อ-นามสกุล มารดา
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>สถานะ</h6>
                    </div>
                    <div class="col-xs-4" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" >ยังมีชีวิตอยู่
                        <input type="checkbox" name="gender" value="2" >เสียชีวิตแล้ว
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10">
                        <h4>4.ที่อยู่บรรพบุรุษประเทศจีน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ชื่อนามสกุล</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_NAME" value="">
                    </div>
                    <div class="col-xs-2">
                        <h6>ความสัมพันธ์</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type='text' class="form-control" autofocus name='CHINAHOUSE_LINK' value="">
                    </div>
                    <div class="col-xs-2">
                        <h6>เบอร์ติดต่อ</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_TEL" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>หมู่บ้าน</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>ตำบล</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>อำเภอ</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                    <div class="col-xs-1">
                        <h6>มลฑล/จังหวัด</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" >
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br> 
            <div class="row">
                <div class="col-xs-10">
                    <h4>5. ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>1.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namebro1 form-control" list="list_bro1" autofocus name="namebro1" value="">
                    <datalist id="list_bro1" class="list_bro1">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="bro1_bday" id="bro1_bday" value="" >
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3">
                    <h6>2.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namebro2 form-control" list="list_bro2" autofocus name="namebro2" value="">
                    <datalist id="list_bro2" class="list_bro2">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="bro2_bday" id="bro2_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>3.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namebro3 form-control" list="list_bro3" autofocus name="namebro3" value="">
                    <datalist id="list_bro3" class="list_bro3">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="bro3_bday" id="bro3_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>4.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namebro4 form-control" list="list_bro4" autofocus name="namebro4" value="">
                    <datalist id="list_bro4" class="list_bro4">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="bro4_bday" id="bro4_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>5.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namebro4 form-control" list="list_bro4" autofocus name="namebro4" value="">
                    <datalist id="list_bro4" class="list_bro4">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="bro4_bday" id="bro4_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>6.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namebro4 form-control" list="list_bro4" autofocus name="namebro4" value="">
                    <datalist id="list_bro4" class="list_bro4">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="bro4_bday" id="bro4_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" ><h4>6. ชื่อนามสกุล ของบุตร-ธิดา</h4></div>
            </div>

            <div class="row">
                <div class="col-xs-3">
                    <h6>1.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namechild1 form-control" list="list_child1" autofocus name="namechild1" value="">
                    <datalist id="list_child1" class="list_child1">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="child1_bday" id="child1_bday" value="" >
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
                <div class="col-xs-2 col-xs-offset-0">
                    <h6>ความสัมพันธ์</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">บิดา
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">มารดา</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3">
                    <h6>2.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namechild2 form-control" list="list_child2" autofocus name="namechild2" value="">
                    <datalist id="list_child2" class="list_child2">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="child2_bday" id="child2_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
                <div class="col-xs-2 col-xs-offset-0">
                    <h6>ความสัมพันธ์</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">บิดา
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">มารดา</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>3.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namechild3 form-control" list="list_child3" autofocus name="namechild3" value="">
                    <datalist id="list_child3" class="list_child3">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="child3_bday" id="child3_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
                <div class="col-xs-2 col-xs-offset-0">
                    <h6>ความสัมพันธ์</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">บิดา
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">มารดา</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>4.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namechild4 form-control" list="list_child4" autofocus name="namechild4" value="">
                    <datalist id="list_child4" class="list_child4">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="child4_bday" id="child4_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
                <div class="col-xs-2 col-xs-offset-0">
                    <h6>ความสัมพันธ์</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">บิดา
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">มารดา</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>5.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namechild4 form-control" list="list_child4" autofocus name="namechild4" value="">
                    <datalist id="list_child4" class="list_child4">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="child4_bday" id="child4_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
                <div class="col-xs-2 col-xs-offset-0">
                    <h6>ความสัมพันธ์</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">บิดา
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">มารดา</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <h6>6.ชื่อนามสกุล</h6>
                </div>
                <div class="col-xs-4">
                    <input type="text" class="namechild4 form-control" list="list_child4" autofocus name="namechild4" value="">
                    <datalist id="list_child4" class="list_child4">

                    </datalist> 
                </div>
                <div class="col-xs-2">
                    <h6>วันเกิด</h6>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" autofocus name="child4_bday" id="child4_bday">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1 col-xs-offset-0">
                    <h6>สถานะ</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต</h6>
                </div>
                <div class="col-xs-2 col-xs-offset-0">
                    <h6>ความสัมพันธ์</h6>
                </div>
                <div class="col-xs-3" style="margin-top: -5px;">
                    <h6><input type="radio" name="bro1_status" value="1" id="bro1_status1">บิดา
                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">มารดา</h6>
                </div>
            </div>
            <div class="row" style="margin-top: 0px">
                <div class="col-xs-1" style="margin-top:10">
                    <h6>หมายเหตุ</h6>
                </div>
                <div class="col-xs-3" style="margin-top:10">
                    <input type="text" name="remark" class="form-control" autofocus>
                </div>
                <div class="col-xs-3" style="margin-top:10">
                    <h6>running number</h6>
                </div>
                <div class="col-xs-1" style="margin-top:10">
                    <input type="text" name="remark" class="form-control" autofocus>
                </div>
                <!-- div class="col-xs-2 col-xs-offset-6">
                    <a class="btn btn-danger" role="button" onClick="javascript
                                :window.history.back()">ย้อนกลับ</a>
                </div> -->
            </div>
        </div>
    </body>
</html>