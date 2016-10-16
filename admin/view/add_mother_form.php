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
            var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

            $(document).ready(function() {


                $(".mother_list").keyup(function() {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {   
                                    $(".list_mother").html(html);
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
            <form class="form-horizontal well" action="../action/add_mother_person.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-5 col-xs-offset-5">
                        <h2>เพิ่มข้อมูลมารดา</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h5>ชื่อ-นามสกุล</h5>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" list="list_mother" class="mother_list form-control" name="mother" />
                        <datalist id="list_mother" class="list_mother">

                        </datalist> 
                    </div>
                    <div class="col-xs-1 col-xs-offset-1">
                        <h5>สถานะ</h5>
                    </div>
                    <div class="col-xs-3" style="margin-top: 5px;">
                        <input type="radio" name="mother_status" value="1" >ยังมีชีวิตอยู่
                        <input type="radio" name="mother_status" value="2" >เสียชีวิต


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