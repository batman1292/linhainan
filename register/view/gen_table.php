<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if (!isset($ses_user_id)) {
    header("Location: ../index.php?error=3");
}
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
    </head>
    <?php
    include '../../helper/db_connect.php';
    connect_database();
    ?>
    <!--<body class="btn-danger">-->
    <body class="btn-material-red">
        <div class=" col-sm-12">
            <div class="well">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-5">
                        <h3>รายละเอียดลำดับรุ่น</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <h4>สาย 1</h4>
                        <?php
                        $gen_others = get_gen_by_type(2);
                        $check = mysql_fetch_assoc($gen_others);
                        if ($check) {
                            ?>
                            <table class="table" style="color:black">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>อักษรจีน</th>
                                        <th>pinyin</th>
                                        <th>อักษรไทย</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $gen_others = get_gen_by_type(2);
                                    while ($gen_other = mysql_fetch_assoc($gen_others)) {
                                        $id = $gen_other['ID'];
                                        ?>
                                        <tr>
                                            <td><?php echo $gen_other['GENERATION_INDEX']; ?></td>
                                            <td><?php echo $gen_other['GENERATION_NAME']; ?></td>
                                            <td><?php echo $gen_other['GENERATION_PINYIN']; ?></td>
                                            <td><?php echo $gen_other['GENERATION_TH']; ?></td>
                                        </tr>    
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            ?>
                            <h4>ไม่มีข้อมูลกรุณาเพิ่มข้อมูล</h4>    
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <h4>สาย 2</h4>
                        <?php
                        $gen_others = get_gen_by_type(1);
                        $check = mysql_fetch_assoc($gen_others);
                        if ($check) {
                            ?>
                            <table class="table" style="color:black">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>อักษรจีน</th>
                                        <th>pinyin</th>
                                        <th>อักษรไทย</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $gen_others = get_gen_by_type(1);
                                    while ($gen_other = mysql_fetch_assoc($gen_others)) {
                                        $id = $gen_other['ID'];
                                        ?>
                                        <tr>
                                            <td><?php echo $gen_other['GENERATION_INDEX']; ?></td>
                                            <td><?php echo $gen_other['GENERATION_NAME']; ?></td>
                                            <td><?php echo $gen_other['GENERATION_PINYIN']; ?></td>
                                            <td><?php echo $gen_other['GENERATION_TH']; ?></td>
                                        </tr>    
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            ?>
                            <h4>ไม่มีข้อมูลกรุณาเพิ่มข้อมูล</h4>    
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>