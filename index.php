<html>
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php
    $error = 0;
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
    }
    ?>
    <body class="btn-material-red">
        <div class="container">
            <div class= "bs-component" style="margin-top: 20px">
                <div class="navbar navbar-material-orange">
                    <center>
                        <div class="navbar-header">
                            <a class="navbar-brand">ระบบลงทะเบียนและจัดการฐานข้อมูลสมาชิกมูลนิธิไทยนำ-ลิมป์์ศรีสวัสดิ์</a>
                        </div>
                    </center>
                </div>
            </div>
            <div class="bs-component" style="margin-top: 50px">
                <div class="row">
<!--                    <div class="col-sm-2">&nbsp;</div>-->
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="well bs-component">
                            <form class="form-horizontal" action="signin.php" method="Post">
                                <fieldset >
                                    <legend><h1>กรุณา Login </h1></legend>
                                    <?php
                                    if ($error == 1) {
                                        ?>
                                        <div class="alert alert-dismissable alert-danger">
                                            <h4><strong>ผิดพลาด</strong> username หรือ password ไม่ถูกต้อง</h4>
                                        </div>
                                        <?php
                                    } else if ($error == 2) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>ผิดพลาด</strong> usename นี้กำลังใช้งานอยู่
                                        </div>
                                        <?php
                                    } else if ($error == 3) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>ผิดพลาด</strong> คุณยังไม่ได้ทำการ login 
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <h3>
                                            <label for="inputLogin" class="col-xs-4 control-label">Username</label>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" id="inputLogin" placeholder="กรอก Username" name='username'>
                                            </div>
                                        </h3>
                                    </div>
                                    <div class="form-group">
                                        <h3>
                                            <label for="inputPassword" class="col-xs-4 control-label">Password</label>
                                            <div class="col-xs-7">
                                                <input type="password" class="form-control" id="inputPassword" placeholder="กรอก Password" name='pass'>
                                            </div>
                                        </h3>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-10 col-xs-offset-6">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                            <button class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>