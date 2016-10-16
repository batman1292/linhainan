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
<link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <?php
        include '../../helper/db_connect.php';
        include '../../helper/helper.php';
        ?>
        <script>
            function del(data, id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
//                    add data to db
//                window.location = 'adding.php?code=' + code + '&department=' + department;
                    window.location = '../action/del.php?id=' + id;
                }
            }
            function del_brother(data, id, b_id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากรายชื่อพี่น้อง?");
                if (r === true) {
                    window.location = '../action/del_brother.php?id=' + id + '&b_id=' + b_id;
                }
            }
            function del_parent(data, id, p_id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากรายชื่อบิดา?");
                if (r === true) {
                    window.location = '../action/del_parent.php?id=' + id + '&p_id=' + p_id;
                }
            }
            function del_mother(data, id, p_id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากรายชื่อมารดา?");
                if (r === true) {
                    window.location = '../action/del_mother.php?id=' + id + '&p_id=' + p_id;
                }
            }
            function del_child(data, id, p_id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากรายชื่อลูก?");
                if (r === true) {
                    window.location = '../action/del_child.php?id=' + id + '&p_id=' + p_id;
                }
            }
            setInterval(function () {

                var id = document.getElementById('data_id').value;
                var time = document.getElementById('time_old').value;
                var dataString = "id=" + id + "&time=" + time;
                console.log(dataString);
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
<!--        <div class=" col-xs-3 btn-material-brown    ">
            <h3 class="mdi-navigation-menu"> เมนู</h3>
            <ul class="nav nav-pills nav-stacked" >-->
                <?php print_menu(7); ?>
<!--            </ul>
        </div>-->
        <div class=" col-xs-9">
            <?php
            connect_database();

            $persons = get_person_detial($id);
            $person = mysql_fetch_assoc($persons);
//            print_r($person);
            ?>
            <center>
                <input type="text" name="data_id" id="data_id" style="visibility:hidden"  value="<?php echo $id; ?>">
                <input type="text" name="time_old" id="time_old" style="visibility:hidden"  value="<?php echo get_last_update($id); ?>">
                <h1>Family tree ของ <?php
                    if ($person['TITLE_ID'] != 0)
                        echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . " " . get_person_surname_string($id);
                    else
                        echo get_person_name_string($id) . " " . get_person_surname_string($id);
                    ?></h1>
            </center>
            <!--พ่อ แม่-->
            <div class="row">
                <h3>ข้อมูลบิดา - มารดา</h3>
                <div class="col-xs-4 col-xs-offset-1 well">
                    <h4>บิดา</h4>
                    <center>

                        <?php
                        if ($person['PARENT_ID'] == 0) {
                            ?>
                            <h5 class="text-danger">ไม่พบข้อมูลบิดา กรุณากดปุ่มเพิ่มข้อมูลบิดา</h5>
                            <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_parent_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=225,top=200,left=200 ')">เพิ่มบิดา</a>  
                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <?php
                                $picture_name = get_picture($person['PARENT_ID']);
                                $parents = get_person_detial($person['PARENT_ID']);
                                $parent = mysql_fetch_assoc($parents);
                                if ($picture_name) {
                                    ?>
                                    <img src="../../picture/<?php echo $picture_name; ?>" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                    <?php
                                } else {
                                    if ($parent['GENDER_ID'] == 0) {
                                        ?>
                                        <img src="../../picture/Non.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                        <?php
                                    }
                                    if ($parent['GENDER_ID'] == 1) {
                                        ?>
                                        <img src="../../picture/Male.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                        <?php
                                    } else if ($parent['GENDER_ID'] == 2) {
                                        ?>
                                        <img src="../../picture/Female.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <h5>ชื่อ-นามสกุล</h5>
                                </div>
                                <div class="col-xs-8">
                                    <h5><?php echo get_person_title_string($parent['TITLE_ID']) . ' ' . get_person_name_string($parent['ID']) . ' ' . get_person_surname_string($parent['ID']); ?></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <h5>ชื่อจีน</h5>
                                </div>
                                <div class="col-xs-9">
                                    <?php
                                    if ($person['CHINANAME_ID'] != 0)
                                        echo get_person_china_full_name($parent['ID'], 0) . '<br/>( ' . get_person_china_full_name($parent['ID'], 1) . ', ' . get_person_china_full_name($parent['ID'], 2) . ' )';
                                    else {
                                        echo '-';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <h5>
                                        <a class="mdi-social-people" onClick="javascript:window.location.assign('family_tree_detail.php?id=<?php echo $parent['ID']; ?>')">family tree</a>
                                    </h5>
                                </div>
                                <div class="col-xs-4 col-xs-offset-0">
                                    <h5>
                                        <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $parent['ID']; ?>')">แก้ไขข้อมูล</a>
                                    </h5>
                                </div>
                                <div class="col-xs-4">
                                    <h5>
                                        <a class="mdi-content-remove" onClick="del_parent('<?php echo get_person_title_string($parent['TITLE_ID']) . ' ' . get_person_name_string($parent['ID']) . ' ' . get_person_surname_string($parent['ID']); ?>', '<?php echo $id; ?>', '<?php echo $parent['ID']; ?>')">ลบข้อมูล</a>
                                    </h5>
                                </div>
                            </div>  
                            <?php
                        }
                        ?>
                    </center>
                </div>
                <div class="col-xs-4 col-xs-offset-2 well">
                    <h4>มารดา</h4>
                    <center>

                        <?php
                        if ($person['MOTHER_ID'] == 0) {
                            ?>

                            <h5 class="text-danger">ไม่พบข้อมูลมารดา กรุณากดปุ่มเพิ่มข้อมูลมารดา</h5>

                            <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_mother_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=225,top=200,left=200 ')">เพิ่มมารดา</a>  
                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <?php
                                $picture_name = get_picture($person['MOTHER_ID']);
                                $mothers = get_person_detial($person['MOTHER_ID']);
                                $mother = mysql_fetch_assoc($mothers);
                                if ($picture_name) {
                                    ?>
                                    <img src="../../picture/<?php echo $picture_name; ?>" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                    <?php
                                } else {
                                    if ($mother['GENDER_ID'] == 0) {
                                        ?>
                                        <img src="../../picture/Non.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                        <?php
                                    }
                                    if ($mother['GENDER_ID'] == 1) {
                                        ?>
                                        <img src="../../picture/Male.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                        <?php
                                    } else if ($mother['GENDER_ID'] == 2) {
                                        ?>
                                        <img src="../../picture/Female.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <h5>ชื่อ-นามสกุล</h5>
                                </div>
                                <div class="col-xs-8">
                                    <h5><?php echo get_person_title_string($mother['TITLE_ID']) . ' ' . get_person_name_string($mother['ID']) . ' ' . get_person_surname_string($mother['ID']); ?></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <h5>ชื่อจีน</h5>
                                </div>
                                <div class="col-xs-9">
                                    <?php
                                    if ($mother['CHINANAME_ID'] != 0)
                                        echo get_person_china_full_name($mother['ID'], 0) . '<br/>( ' . get_person_china_full_name($mother['ID'], 1) . ', ' . get_person_china_full_name($mother['ID'], 2) . ' )';
                                    else {
                                        echo '-';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <h5>
                                        <a class="mdi-social-people" onClick="javascript:window.location.assign('family_tree_detail.php?id=<?php echo $mother['ID']; ?>')">family tree</a>
                                    </h5>
                                </div>
                                <div class="col-xs-4 col-xs-offset-0">
                                    <h5>
                                        <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $mother['ID']; ?>')">แก้ไขข้อมูล</a>
                                    </h5>     
                                </div>
                                <div class="col-xs-4">
                                    <h5>
                                        <a class="mdi-content-remove" onClick="del_mother('<?php echo get_person_title_string($mother['TITLE_ID']) . ' ' . get_person_name_string($mother['ID']) . ' ' . get_person_surname_string($mother['ID']); ?>', '<?php echo $id; ?>', '<?php echo $mother['ID']; ?>')">ลบข้อมูล</a>
                                    </h5>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </center>
                </div>
            </div>
            <!--พี่น้อง-->
            <div class="row">
                <div class="col-xs-12 well">
                    <fieldset class="scheduler-border" >
                        <legend class="scheduler-border">
                            <h4 >ข้อมูลพี่น้อง  &Tab;
                                <a class="mdi-content-add" onClick="javascript:window.open('add_brother_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มพี่น้อง</a>
                            </h4>
                        </legend>

                        <?php
                        if ($person['PARENT_ID'] == 0 && $person['BROTHER_LIST'] == '') {
                            ?>
                            <center>
                                <div class="col-xs-4 col-xs-offset-2">
                                    <h5 class="text-danger">ไม่พบข้อมูลพี่น้อง กรุณากดปุ่มเพิ่มข้อมูลพี่น้อง</h5>
                                </div>

                                <div class="col-xs-4 ">
                                    <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_brother_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>  
                                </div>
                            </center>
                            <?php
                        } else {
                            $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $id);
                            $count = 0;
                            while ($brother = mysql_fetch_assoc($brothers)) {
                                ?>
                                <center>
                                    <?php
                                    if ($count % 3 == 2) {
                                        ?>
                                        <div class="row">
                                            <?php
                                        }
                                        ?>

                                        <div class="col-xs-4">
                                            <?php
                                            $picture_name = get_picture($brother['ID']);
                                            if ($picture_name) {
                                                ?>
                                                <img src="../../picture/<?php echo $picture_name; ?>" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                <?php
                                            } else {
                                                if ($brother['GENDER_ID'] == 0) {
                                                    ?>
                                                    <img src="../../picture/Non.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                    <?php
                                                }
                                                if ($brother['GENDER_ID'] == 1) {
                                                    ?>
                                                    <img src="../../picture/Male.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                    <?php
                                                } else if ($brother['GENDER_ID'] == 2) {
                                                    ?>
                                                    <img src="../../picture/Female.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h5> ชื่อ-นามสกุล</h5>
                                                </div>    
                                                <div class="col-xs-8">
                                                    <h5><?php echo get_person_title_string($brother['TITLE_ID']) . ' ' . get_person_name_string($brother['ID']) . ' ' . get_person_surname_string($brother['ID']); ?></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <h5>ชื่อจีน</h5>
                                                </div>
                                                <div class="col-xs-9">
                                                    <?php
                                                    if ($brother['CHINANAME_ID'] != 0)
                                                        echo get_person_china_full_name($brother['ID'], 0) . '<br/>( ' . get_person_china_full_name($brother['ID'], 1) . ', ' . get_person_china_full_name($brother['ID'], 2) . ' )';
                                                    else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h5>
                                                        <a class="mdi-social-people" onClick="javascript:window.location.assign('family_tree_detail.php?id=<?php echo $brother['ID']; ?>')">family tree</a>
                                                    </h5>
                                                </div>
                                                <div class="col-xs-4 col-xs-offset-0">
                                                    <h5>
                                                        <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $brother['ID']; ?>')">แก้ไขข้อมูล</a>
                                                    </h5>
                                                </div>
                                                <div class="col-xs-4">
                                                    <h5>
                                                        <a class="mdi-content-remove" onClick="del_brother('<?php echo get_person_title_string($brother['TITLE_ID']) . ' ' . get_person_name_string($brother['ID']) . ' ' . get_person_surname_string($brother['ID']); ?>', '<?php echo $id; ?>', '<?php echo $brother['ID']; ?>')">ลบข้อมูล</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($count % 3 == 2) {
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </center><?php
//                                echo $count;
                                $count++;
                            }
                            if ($count == 0) {
                                ?>
                                <center>
                                    <div class="col-xs-4 col-xs-offset-2">
                                        <h5 class="text-danger">ไม่พบข้อมูลพี่น้อง กรุณากดปุ่มเพิ่มข้อมูลพี่น้อง</h5>
                                    </div>

                                    <div class="col-xs-4 ">
                                        <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_brother_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>  
                                    </div>
                                </center>
                                <?php
                            }
                        }
                        ?>
                    </fieldset>
                </div>
            </div>
            <!--ลูกหลาน--> 
            <div class="row">
                <div class="col-xs-12 well">
                    <fieldset class="scheduler-border" >
                        <legend class="scheduler-border">
                            <h4 >ข้อมูลลูก  &Tab;
                                <a class="mdi-content-add" onClick="javascript:window.open('add_child_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มลูก</a> </h4>
                        </legend>

                        <?php
                        $query = "SELECT * FROM person WHERE PARENT_ID = $id OR MOTHER_ID = $id";
                        $check = mysql_fetch_assoc(mysql_query($query));
                        if (!$check) {
                            ?>
                            <center>
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-2">
                                        <h5 class="text-danger">ไม่พบข้อมูลลูก กรุณากดปุ่มเพิ่มข้อมูลลูก</h5>
                                    </div>
                                    <div class="col-xs-4 ">
                                        <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_child_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>  
                                    </div>
                                </div>
                            </center>
                            <?php
                        } else {
                            $childs = mysql_query($query);
                            $count = 0;
                            while ($child = mysql_fetch_assoc($childs)) {
                                ?>
                                <center>
                                    <?php
                                    if ($count % 3 == 2) {
                                        ?>
                                        <div class="row">
                                            <?php
                                        }
                                        ?>

                                        <div class="col-xs-4">
                                            <?php
                                            $picture_name = get_picture($child['ID']);
                                            if ($picture_name) {
                                                ?>
                                                <img src="../../picture/<?php echo $picture_name; ?>" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                <?php
                                            } else {
                                                if ($child['GENDER_ID'] == 0) {
                                                    ?>
                                                    <img src="../../picture/Non.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                    <?php
                                                }
                                                if ($child['GENDER_ID'] == 1) {
                                                    ?>
                                                    <img src="../../picture/Male.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                    <?php
                                                } else if ($child['GENDER_ID'] == 2) {
                                                    ?>
                                                    <img src="../../picture/Female.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h5> ชื่อ-นามสกุล</h5>
                                                </div>    
                                                <div class="col-xs-8">
                                                    <h5><?php echo get_person_title_string($child['TITLE_ID']) . ' ' . get_person_name_string($child['ID']) . ' ' . get_person_surname_string($child['ID']); ?></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <h5>ชื่อจีน</h5>
                                                </div>
                                                <div class="col-xs-9">
                                                    <?php
                                                    if ($child['CHINANAME_ID'] != 0)
                                                        echo get_person_china_full_name($child['ID'], 0) . '<br/>( ' . get_person_china_full_name($child['ID'], 1) . ', ' . get_person_china_full_name($child['ID'], 2) . ' )';
                                                    else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h5>
                                                        <a class="mdi-social-people" onClick="javascript:window.location.assign('family_tree_detail.php?id=<?php echo $child['ID']; ?>')">family tree</a>
                                                    </h5>
                                                </div>
                                                <div class="col-xs-4 col-xs-offset-0">
                                                    <h5>
                                                        <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $child['ID']; ?>')">แก้ไขข้อมูล</a>
                                                    </h5>
                                                </div>
                                                <div class="col-xs-4">
                                                    <h5>
                                                        <a class="mdi-content-remove" onClick="del_child('<?php echo get_person_title_string($child['TITLE_ID']) . ' ' . get_person_name_string($child['ID']) . ' ' . get_person_surname_string($child['ID']); ?>', '<?php echo $id; ?>', '<?php echo $child['ID']; ?>')">ลบข้อมูล</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($count % 3 == 2) {
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </center><?php
//                                echo $count;
                                $count++;
                            }
                            if ($count == 0) {
                                ?>
                                <center>
                                    <div class="col-xs-4 col-xs-offset-2">
                                        <h5 class="text-danger">ไม่พบข้อมูลลูก กรุณากดปุ่มเพิ่มข้อมูลลูก</h5>
                                    </div>

                                    <div class="col-xs-4 ">
                                        <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_child.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>  
                                    </div>
                                </center>
                                <?php
                            }
                        }
                        ?>
                    </fieldset>
                </div>
            </div>
            <!--                                              </div>
              
                                </div>
                            </div>
                            ลูกหลาน
                            <div class="col-xs-4">
                                <div class="well">
                                    <h3>ข้อมูลลูก</h3>
                                    <h5><a class="mdi-content-add" onClick="javascript:window.open('add_child_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มลูก</a>
                                    </h5>
            <?php
            $query = "SELECT * FROM person WHERE PARENT_ID = $id OR MOTHER_ID = $id";
            $check = mysql_fetch_assoc(mysql_query($query));
            if (!$check) {
//                        echo $query;
//                        if ($person['PARENT_ID'] == 0 && $person['BROTHER_LIST'] == '') {
                ?>
                                                                                                                                                                                                                            <div class="row">
                                                                                                                                                                                                                            <div class="col-xs-12 col-xs-offset-0">
                                                                                                                                                                                                                            <h5 class="text-danger">ไม่พบข้อมูลลูก กรุณากดปุ่มเพิ่มข้อมูลลูก</h5>
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                            <div class="col-xs-4 ">
                                                                                                                                                                                                                            <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_brother.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>  
                                                                                                                                                                                                                            </div>
                <?php
            } else {
                $brothers = mysql_query($query);
                $count = 1;
                while ($brother = mysql_fetch_assoc($brothers)) {
                    ?>
                                                                                                                                                                                                                                                <div class="row">
                                                                                                                                                                                                                                                <div class="col-xs-6">
                                                                                                                                                                                                                                                <h5><?php echo $count; ?> ชื่อ-นามสกุล</h5>
                                                                                                                                                                                                                                                </div>    
                                                                                                                                                                                                                                                <div class="col-xs-6">
                                                                                                                                                                                                                                                <h5><?php echo get_person_title_string($brother['TITLE_ID']) . ' ' . get_person_name_string($brother['ID']) . ' ' . get_person_surname_string($brother['ID']); ?></h5>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                <div class="row">
                                                                                                                                                                                                                                                <div class="col-xs-4">
                                                                                                                                                                                                                                                <h5>
                                                                                                                                                                                                                                                <a class="mdi-social-people" onClick="javascript:window.location.assign('family_tree_detail.php?id=<?php echo $brother['ID']; ?>')">family tree</a>
                                                                                                                                                                                                                                                </h5>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                <div class="col-xs-4 col-xs-offset-0">
                                                                                                                                                                                                                                                <h5>
                                                                                                                                                                                                                                                <a class="mdi-editor-mode-edit" onClick="javascript:window.location.assign('manage_person_detial.php?id=<?php echo $brother['ID']; ?>')">แก้ไขข้อมูล</a>
                                                                                                                                                                                                                                                </h5>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                <div class="col-xs-4">
                                                                                                                                                                                                                                                <h5>
                                                                                                                                                                                                                                                <a class="mdi-content-remove" onClick="del_child('<?php echo get_person_title_string($brother['TITLE_ID']) . ' ' . get_person_name_string($brother['ID']) . ' ' . get_person_surname_string($brother['ID']); ?>', '<?php echo $id; ?>', '<?php echo $brother['ID']; ?>')">ลบข้อมูล</a>
                                                                                                                                                                                                                                                </h5>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                </div>
                    <?php
                    $count++;
                }
                if ($count == 1) {
                    ?>
                                                                                                                                                                                                                                                <div class="row">
                                                                                                                                                                                                                                                <div class="col-xs-12 col-xs-offset-0">
                                                                                                                                                                                                                                                <h5 class="text-danger">ไม่พบข้อมูลพี่น้อง กรุณากดปุ่มเพิ่มข้อมูลพี่น้อง</h5>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                <div class="col-xs-4 ">
                                                                                                                                                                                                                                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_brother.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">เพิ่มข้อมูลพี่น้อง</a>  
                                                                                                                                                                                                                                                </div>
                    <?php
                }
//                            print_r($brother);
            }
            ?>
                </div>
            </div>
        </div>-->
            <div class="row">
                <center>
                    <div class="col-xs-4 col-xs-offset-4 well">
                        <a class="btn btn-danger" role="button" style="width: 175px;" onClick="javascript:window.history.back();">ย้อนกลับ</a> 
                    </div>
                </center>
            </div>
        </div>
    </center>            
</div>
</body>
</html>