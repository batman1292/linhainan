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
//                window.printDiv("print");
                window.print();
                // do other things
//                return false;
//                window.close();
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
    <body>
        <div class= "bs-component" name="print" style="margin-left: 20px;">
            <?php
            $id = $_GET['id'];
            $numprint = $_GET['numprint'];
            $row = intval($numprint/3);
//            echo $row;
            // $col = $numprint%3;
            include '../helper/db_connect.php';
            include '../helper/helper.php';
            connect_database();
            $persons = get_person_detial($id);
            $person = mysql_fetch_assoc($persons);
            $person_name = get_person_name_string($id) . ' ' . get_person_surname_string($id);
            $homeAddrs = get_person_all_address($id, 1);
            $checkHome = mysql_fetch_assoc(get_person_all_address($id, 1));
            if ($checkHome) {
                $homeAddr = mysql_fetch_assoc($homeAddrs);
            } else {
                $homeAddr = give_addr();
            }
            for ($i = 0; $i <= $row; $i++) {
                ?>
                <div class="row">
                    <?php
                    if($i == $row){
                        $col = $numprint%3;
                    }
                    else{
                        $col = 3;
                    }
                    for ($j = 0; $j < $col; $j++) {
                        ?>
                    <div class="col-xs-4">
                            <?php
                        echo 'ชื่อและที่อยู่ผู้รับ';
                        echo '<br/>';
                        echo $person_name;
                        $addr_string = "บ้านเลขที่ " . $homeAddr['ADDRESS_NUM'];

                        if ($homeAddr['ADDRESS_MOO'] != '')
                            $addr_string .= ' หมู่' . $homeAddr['ADDRESS_MOO'];
                        else {
                            $addr_string .= ' ';
                        }

                        if ($homeAddr['ADDRESS_VILLAGE'] != '')
                            $addr_string .= ' ' . $homeAddr['ADDRESS_VILLAGE'];
                        else {
                            $addr_string .= ' ';    
                        }

                        echo '<br/>';
                        echo $addr_string;
                        $addr_string = '';
                        if ($homeAddr['ADDRESS_ALLEY'] != '')
                            $addr_string .= ' ซ.' . $homeAddr['ADDRESS_ALLEY'];
                        else
                            $addr_string .= ' ';

                        if ($homeAddr['ADDRESS_ROAD'] != '')
                            $addr_string .= ' ถ.' . $homeAddr['ADDRESS_ROAD'];
                        else
                            $addr_string .= ' ';

                        echo '<br/>';
                        if ($addr_string != '') {
                            echo $addr_string;
                            echo '<br/>';
                        }
                        echo get_district_string($homeAddr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($homeAddr['ADDRESS_PROVINCE_ID']);
                        echo '<br/>';
                        echo $homeAddr['ADDRESS_ZIPCODE'];
                        echo '<br/>';
                        echo '<br/>';
//        echo get_addr_string($homeAddr);
                        ?>
                    </div>
                    <?php
                }
                
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>