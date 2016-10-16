<?php

include('db_connect.php');
connect_database();
if (isset($_POST['province_id'])) {

    $province_id = $_POST['province_id'];
    $sqlstring = "SELECT * FROM `amphur` WHERE `PROVINCE_ID` = $province_id";
    $sql = mysql_query($sqlstring);
    echo '<option value="0">--เลือกอำเภอ--</option>';
    while ($row = mysql_fetch_array($sql)) {
        $id = $row['AMPHUR_ID'];
        $data = $row['AMPHUR_NAME'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}

if (isset($_POST['AMPHUR_ID'])) {
    $AMPHUR_ID = $_POST['AMPHUR_ID'];
    $sqlstring = "SELECT * FROM `district` WHERE `AMPHUR_ID` = $AMPHUR_ID";
    $sql = mysql_query($sqlstring);
    echo '<option value="0">--เลือกตำบล--</option>';
    while ($row = mysql_fetch_array($sql)) {
        $id = $row['DISTRICT_ID'];
        $data = $row['DISTRICT_NAME'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
//    echo ' <script type="text/javascript"> alert('.$AMPHUR_ID.') </script>';
}
if (isset($_POST['DISTRICT_ID'])) {
    $DISTRICT_ID = $_POST['DISTRICT_ID'];
    $sqlstring = "SELECT * FROM `zipcode` WHERE `DISTRICT_ID` = $DISTRICT_ID";
    $sql = mysql_query($sqlstring);
    while ($row = mysql_fetch_array($sql)) {
        //     $id = $row['ZIPCODE_ID'];
        $data = $row['ZIPCODE'];
        echo $data;
    }
}
if (isset($_POST['parent_search'])) {
    $data = $_POST['parent_search'];
    $sqlstring = "SELECT * FROM personname WHERE PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%' LIMIT 0,5";
    $sql = mysql_query($sqlstring);
    while ($row = mysql_fetch_array($sql)) {
        echo '<option value="' . $row['PERSONNAME_NAME'] . ' ' . $row['PERSONNAME_SURNAME'] . '"></option>';
    }
}

if (isset($_POST['birthday_search'])) {
    $iparr = split("\ ", $_POST["birthday_search"]);
    $name = $iparr[0];
    $surname = $iparr[1];
    $id = get_person($name, $surname);
    if ($id != -1) {
        $sqlstring = "SELECT * FROM person WHERE ID=$id";
        $sql = mysql_query($sqlstring);
        while ($row = mysql_fetch_array($sql)) {
            echo $row['BIRTHDAY'];
        }
    }
}

if (isset($_POST['status_search'])) {
    $iparr = split("\ ", $_POST["status_search"]);
    $name = $iparr[0];
    $surname = $iparr[1];
    $id = get_person($name, $surname);
    if ($id != -1) {
        $sqlstring = "SELECT * FROM person WHERE ID=$id";
        $sql = mysql_query($sqlstring);
        while ($row = mysql_fetch_array($sql)) {
            echo $row['STATUS'];
        }
    }
}

if (isset($_POST['get_favorite_name'])) {
    $gen_id = $_POST['get_favorite_name'];
    $res = mysql_query("SELECT * FROM `favorite` WHERE `FAVORITE_GEN_ID`=$gen_id");
    $count = 1;
    while ($datas = mysql_fetch_array($res)) {

        echo '<tr class="clickable-row" onclick="chooseName(\'' . $datas['FAVORITE_NAME'] . '\',\'' . $datas['FAVORITE_PINYIN'] . '\',\'' . $datas['FAVORITE_TH'] . "' );\">
                                    <td>  $count </td> 
                                    <td>  " . $datas["FAVORITE_NAME"] . "</td> 
                                    <td>  " . $datas['FAVORITE_PINYIN'] . "</td> 
                                    <td> " . $datas['FAVORITE_TH'] . "</td> 
                                </tr>";
        $count++;
    }
}

if (isset($_POST['china_str'])) {
    $china_str = $_POST['china_str'];
    $res = mysql_query("SELECT * FROM `chainachar` WHERE `CHAINACHAR_STR`='$china_str'");
//    echo "SELECT * FROM `chainachar` WHERE `CHAINACHAR_STR`='$china_str'";
    while ($row = mysql_fetch_array($res)) {

        echo $row['CHAINACHAR_PINYIN'];
    }
}
if (isset($_POST['generation'])) {
    $gen_id = $_POST['generation'];
    $gen = get_generation_detial($gen_id);
    $result = "";
    while ($row = mysql_fetch_array($gen)) {
        $result = $row['GENERATION_PINYIN'] . "/" . $row['GENERATION_TH'];
    }
    echo $result;
}

if (isset($_POST['persondata_search'])) {
    $iparr = split("\ ", $_POST["persondata_search"]);
    $name = $iparr[0];
    $surname = $iparr[1];
    $id = get_person($name, $surname);
    $result = "";
    if ($id != -1) {
        $sqlstring = "SELECT * FROM person WHERE ID=$id";
        $sql = mysql_query($sqlstring);
        while ($row = mysql_fetch_array($sql)) {
            $result = $row['BIRTHDAY'];
        }
        $result .= ",";
        $sqlstring = "SELECT * FROM person WHERE ID=$id";
        $sql = mysql_query($sqlstring);
        while ($row = mysql_fetch_array($sql)) {
            $result .= $row['STATUS'];
        }
        echo  $result;
    }
}
?>