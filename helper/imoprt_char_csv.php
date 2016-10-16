
<html>
    <meta charset="utf-8">
    <script src="../../helper/jquery-latest.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
    <script>
        $(document).onload(function() {
//            alert('กำลังประมวลผล \\n\\ กรุณารอซักครู่');
        });
    </script>
</html>
<?php
include 'db_connect.php';
connect_database();
$file = fopen("char.csv", "r");

while (!feof($file)) {
    $chars = fgetcsv($file);
    $china = $chars[0];
    $pinyin = $chars[1];
    $sql = "INSERT INTO `chainachar`(`CHAINACHAR_STR`, `CHAINACHAR_PINYIN`) VALUES ('$china', '$pinyin')";
    mysql_query($sql);
}
echo "finish";
fclose($file);
?>