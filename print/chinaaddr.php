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
//                window.printDiv("print_div");
                window.print();
                // do other things
//                return false;
//                window.close();
            });
        </script>
    </head>
    <body>
        <?php
//        echo "sdfa";
        $id = $_GET['id'];

        include '../helper/db_connect.php';
        include '../helper/helper.php';
        connect_database();
        $persons = get_person_detial($id);
        $person = mysql_fetch_assoc($persons);
        $personname = get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . ' ' . get_person_surname_string($id);
        
        $chinahouses = get_chinahouse_data($person['CHINAHOUSE_ID']);
        $chinahouse = mysql_fetch_assoc($chinahouses);
        
        $chinahouse_villages = get_china($chinahouse['CHINAHOUSE_VILLAGE_ID']);
        $chinahouse_village = mysql_fetch_assoc($chinahouse_villages);

        $chinahouse_districts = get_china($chinahouse['CHINAHOUSE_DISTRICT_ID']);
        $chinahouse_district = mysql_fetch_assoc($chinahouse_districts);

        $chinahouse_amphurs = get_china($chinahouse['CHINAHOUSE_AMPHUR_ID']);
        $chinahouse_amphur = mysql_fetch_assoc($chinahouse_amphurs);

        $chinahouse_provinces = get_china($chinahouse['CHINAHOUSE_PROVINCE_ID']);
        $chinahouse_province = mysql_fetch_assoc($chinahouse_provinces);
        
//        echo 
        ?>
    </body>
</html>