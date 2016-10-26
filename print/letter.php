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
            $(document).ready(function() {
                //                alert('loaded');
//                window.printDiv("print_div");
                window.print();
                // do other things
//                return false;
//                window.close();
            });
        </script>
    </head>
    <body>
    <!-- <center> -->
        <?php
        $id = $_GET['id'];

        include '../helper/db_connect.php';
        include '../helper/helper.php';
        connect_database();
        $persons = get_person_detial($id);
        $person = mysql_fetch_assoc($persons);
        $person_name = get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . ' ' . get_person_surname_string($id);
        $homeAddrs = get_person_all_address($id, 1);
        $checkHome = mysql_fetch_assoc(get_person_all_address($id, 1));
        if ($checkHome) {
            $homeAddr = mysql_fetch_assoc($homeAddrs);
        } else {
            $homeAddr = give_addr();
        }
        echo 'ชื่อที่อยู่ผู้ฝาก';
        echo '<br/>';
        echo 'มูลนิธิไทยนำ-ลิมป์์ศรีสวัสดิ์';
        echo '<br/>';
        echo '31 ซอยเพลินพิศ ถนนพระโขนง-คลองตัน';
        echo '<br/>';
        echo 'แขวงพระโขนงเหนือ เขตวัฒนา กทม';
        echo '<br/>';
        echo '10110';
        echo '<br/>';
        echo 'ชื่อและที่อยู่ผู้รับ';
        echo '<br/>';
        echo $person_name;
        $addr_string = $homeAddr['ADDRESS_NUM'];

        if ($homeAddr['ADDRESS_MOO'] != '')
            $addr_string .= ' หมู่' . $homeAddr['ADDRESS_MOO'];

        if ($homeAddr['ADDRESS_VILLAGE'] != '')
            $addr_string .= ' ' . $homeAddr['ADDRESS_VILLAGE'];

        echo '<br/>';
        ?>
        <div style="text-align: right">
        <?php
        echo $addr_string;
        $addr_string = '';
        if ($homeAddr['ADDRESS_ALLEY'] != '')
            $addr_string .= ' ซ.' . $homeAddr['ADDRESS_ALLEY'];

        if ($homeAddr['ADDRESS_ROAD'] != '')
            $addr_string .= ' ถ.' . $homeAddr['ADDRESS_ROAD'];

        echo '<br/>';
        if ($addr_string != '') {
            echo $addr_string;
            echo '<br/>';
        }
        echo get_district_string($homeAddr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($homeAddr['ADDRESS_PROVINCE_ID']);
        echo '<br/>';
        echo $homeAddr['ADDRESS_ZIPCODE'];
        echo '<br/>';
        echo get_addr_string($homeAddr);
        ?>
      </div>
    <!-- </center> -->
    </body>
</html>
