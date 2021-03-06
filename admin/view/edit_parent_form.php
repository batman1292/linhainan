<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if (!isset($ses_user_id)) {
    header("Location: ../index.php?error=3");
}
$id = $_GET['id'];
include '../../helper/db_connect.php';
include '../../helper/helper.php';

connect_database();

$persons = get_person_detial($id);
$person = mysql_fetch_assoc($persons);
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
            $(document).ready(function () {
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
            <form class="form-horizontal well" action="../action/edit_parent_person.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h2>แก้ไขข้อมูลบิดา</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h5>ชื่อ-นามสกุล</h5>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" list="list_parent" class="parent_list form-control" name="parent" value="<?php echo get_person_name_string($person['PARENT_ID']).' '.  get_person_surname_string($person['PARENT_ID']) ?>" />
                        <datalist id="list_parent" class="list_parent">

                        </datalist> 
                    </div>
                    <div class="col-xs-1 col-xs-offset-1">
                        <h5>สถานะ</h5>
                    </div>
                    <div class="col-xs-3" style="margin-top: 5px;">
                        <input type="radio" name="parent_status" value="1" <?php if(get_status($person['PARENT_ID'])==1){echo "checked";}?> >ยังมีชีวิตอยู่
                        <input type="radio" name="parent_status" value="2" <?php if(get_status($person['PARENT_ID'])==2){echo "checked";}?>  >เสียชีวิต


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