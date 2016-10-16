<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if (!isset($ses_user_id)) {
    header("Location: ../index.php?error=3");
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
        <script type="text/javascript">
            function autoTab2(obj, typeCheck) {

                if (typeCheck == 1) {
                    if (obj.value.length >= 2) {
                        if (obj.value.charAt(1) == "2") {
                            var pattern = new String("__-___-____"); // กำหนดรูปแบบในนี้
                        } else {
                            var pattern = new String("___-___-___"); // กำหนดรูปแบบในนี้
                        }
                    }
                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
                } else {
                    var pattern = new String("___-___-____"); // กำหนดรูปแบบในนี้
                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้					
                }
                var returnText = new String("");
                var obj_l = obj.value.length;
                var obj_l2 = obj_l - 1;
                for (i = 0; i < pattern.length; i++) {
                    if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                        returnText += obj.value + pattern_ex;
                        obj.value = returnText;
                    }
                }
                if (obj_l >= pattern.length) {
                    obj.value = obj.value.substr(0, pattern.length);
                }
            }
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
                    }
                }
                return true;
            }
            $(document).ready(function () {
                $(".province").change(function ()
                {
                    var id = $(this).val();
                    var dataString = 'province_id=' + id;
                    console.log("dslfk");
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".amphur").html(html);
                                }
                            });
                    $(".district").html('<option selected="selected">เลือกอำเภอก่อน</option>');
                });

                $(".amphur").change(function ()
                {
                    var id = $(this).val();
                    var dataString = 'AMPHUR_ID=' + id;

                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".district").html(html);
                                }
                            });

                });

                $(".organization_province").change(function ()
                {
                    var id = $(this).val();
                    var dataString = 'province_id=' + id;
                    console.log("dslfk");
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".organization_amphur").html(html);
                                }
                            });
                    $(".organization_district").html('<option selected="selected">เลือกอำเภอก่อน</option>');
                });

                $(".organization_amphur").change(function ()
                {
                    var id = $(this).val();
                    var dataString = 'AMPHUR_ID=' + id;

                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".organization_district").html(html);
                                }
                            });

                });

                $(".parent_list").keyup(function () {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".list_parent").html(html);
                                }
                            });

                });
                $(".namebro1").keyup(function () {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".list_bro1").html(html);
                                }
                            });

                });

                $(".namebro2").keyup(function () {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".list_bro2").html(html);
                                }
                            });

                });

                $(".namebro3").keyup(function () {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".list_bro3").html(html);
                                }
                            });

                });

                $(".namebro4").keyup(function () {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".list_bro4").html(html);
                                }
                            });

                });

                $(".namebro5").keyup(function () {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    $(".list_bro5").html(html);
                                }
                            });

                });
            });
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
    </head>
    <body class="btn-material-red">
        <div class="bs-component">
            <form class="form-horizontal well" action="../action/add_parent_person.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h2>เพิ่มข้อมูลบิดา</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h5>ชื่อ-นามสกุล</h5>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" list="list_parent" class="parent_list form-control" name="parent" />
                        <datalist id="list_parent" class="list_parent">

                        </datalist> 
                    </div>
                    <div class="col-xs-1 col-xs-offset-1">
                        <h5>สถานะ</h5>
                    </div>
                    <div class="col-xs-3" style="margin-top: 5px;">
                        <input type="radio" name="parent_status" value="1" >ยังมีชีวิตอยู่
                        <input type="radio" name="parent_status" value="2" >เสียชีวิต


                    </div>
                </div>
                <div class="row" style="margin-top: 0px">
                    <div class="col-xs-2 col-xs-offset-8">
                        <a class="btn btn-danger" role="button" onClick="javascript
                                :window.close()">ยกเลิก</a>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>