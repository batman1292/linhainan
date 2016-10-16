<html>
    <meta charset="utf-8">
</html> 
<?php

function connect_database() {
    $username = "root";
    $database = "linhainan";

    $conn = mysql_connect("localhost", $username, "");

    if (!$conn)
        die('Could not connect: ' . mysql_error());

    $db_selected = mysql_select_db($database, $conn);

    if (!$db_selected)
        die('Could not connect: ' . mysql_error());

    mysql_query("set NAMES utf8");
}

function getGenDetailByType($type) {
    $query = "SELECT * FROM generation WHERE GENERATION_TYPE = $type";
    return mysql_query($query);
}

function count_gen_data($id) {
    $query = "SELECT COUNT(*) FROM person WHERE GENERATION_ID = $id";
    return mysql_query($query);
}

function search_data($data, $type) {
    if ($type == 1) {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname WHERE PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%'";
    } else if ($type == 2) {
        $query = "SELECT person.ID FROM person LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%'";
    } else if ($type == 3) {
        if(search_province_id($data) == 0){
            $query = "SELECT * FROM province WHERE PROVINCE_ID = 0";
        }else{
            $provice = implode(",",search_province_id($data));
            $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID WHERE address.ADDRESS_PROVINCE_ID IN ($provice)";
        }
    } else if ($type == 4) {
        if ($data[0] == 0 && strlen($data) < 4 ) {
            $field = "CONTACT_ARER_CODE";
        } else {
            $field = "CONTACT_STRING";
        }
//        echo $field;
        $query = "SELECT CONTACT_OWNER_ID FROM contact WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2)";
    }
    return $query;
//    $query .= "LIMIT $start, $end";
//    echo $query;
//    return mysql_query($query);
}

function search_data_chinaname($data, $type) {
    if ($type == 1) {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname LEFT JOIN person ON personname.PERSONNAME_OWNER_ID = person.ID WHERE (PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%') AND person.CHINANAME_ID = 0";
    } else if ($type == 2) {
        $query = "SELECT person.ID FROM person LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%'";
    } else if ($type == 3) {
        if(search_province_id($data) == 0){
            $query = "SELECT * FROM province WHERE PROVINCE_ID = 0";
        }else{
            $provice = implode(",",search_province_id($data));
            $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID RIGHT JOIN person ON addresslist.ADDRESSLIST_OWNER_ID = person.ID WHERE address.ADDRESS_PROVINCE_ID IN ($provice) AND person.CHINANAME_ID = 0";
        }
    } else if ($type == 4) {
        if ($data[0] == 0 && strlen($data) < 4 ) {
            $field = "CONTACT_ARER_CODE";
        } else {
            $field = "CONTACT_STRING";
        }
//        echo $field;
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) AND person.CHINANAME_ID = 0";
    }
//    echo $query;
    return $query;
//    $query .= "LIMIT $start, $end";
//    echo $query;
//    return mysql_query($query);
}

function search_data_parent($data, $type, $id) {
    if ($type == 1) {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname LEFT JOIN person ON personname.PERSONNAME_OWNER_ID = person.ID WHERE (PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%') AND person.ID != $id";
    } else if ($type == 2) {
        $query = "SELECT person.ID FROM person LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%'";
    } else if ($type == 3) {
        if(search_province_id($data) == 0){
            $query = "SELECT * FROM province WHERE PROVINCE_ID = 0";
        }else{
            $provice = implode(",",search_province_id($data));
            $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID RIGHT JOIN person ON addresslist.ADDRESSLIST_OWNER_ID = person.ID WHERE address.ADDRESS_PROVINCE_ID IN ($provice) AND person.ID != $id";
        }
    } else if ($type == 4) {
        if ($data[0] == 0 && strlen($data) < 4 ) {
            $field = "CONTACT_ARER_CODE";
        } else {
            $field = "CONTACT_STRING";
        }
//        echo $field;
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) AND person.ID != $id";
    }
//    echo $query;
    return $query;
//    $query .= "LIMIT $start, $end";
//    echo $query;
//    return mysql_query($query);
}

function search_province_id($data) {
    $query = "SELECT PROVINCE_ID FROM province WHERE PROVINCE_NAME LIKE '%$data%'";
//    echo $query;
    $checks = mysql_query($query);
    $check = mysql_fetch_assoc($checks);
    if (!$check) {
        return 0;
    } else {
        $result = array();
        $query = "SELECT PROVINCE_ID FROM province WHERE PROVINCE_NAME LIKE '%$data%'";
        $checks = mysql_query($query);
        while ($check = mysql_fetch_assoc($checks)){
            array_push($result, $check['PROVINCE_ID']);
        }
        return $result;
    }
}

function get_person_detial($id){
    $query = "SELECT * FROM person WHERE ID = $id";
    return mysql_query($query);
}

function get_person_all_address($id, $type){
    $query = "SELECT * FROM address LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID WHERE addresslist.ADDRESSLIST_OWNER_ID = $id AND addresslist.ADDRESSLIST_TYPE_ID = $type";
//    echo $query;
    return mysql_query($query);
}

function get_address_data($address_id){
    $query = "SELECT * FROM address WHERE ID = $address_id";
//    echo $query;
    return mysql_query($query);
}

function get_person_contact($id, $type){
    $query = "SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = $type";
//    echo $query;
    return mysql_query($query);
}

function get_person_china_name($id){
    $query = "SELECT * FROM chinaname LEFT JOIN person ON chinaname.ID = person.CHINANAME_ID WHERE person.ID = $id";
    return mysql_query($query);
}

function get_person_china_generation_name($id){
    $query = "SELECT * FROM generation LEFT JOIN person ON generation.ID = person.GENERATION_ID WHERE person.ID = $id";
    
    return mysql_query($query);
}

function get_person_gender_string($gender_id){
    $query = "SELECT GENDER_NAME FROM gender WHERE ID = $gender_id";
//    echo $query;
    $gender_strings = mysql_query($query);
    $gender_string = mysql_fetch_assoc($gender_strings);
    if($gender_string){
        return $gender_string['GENDER_NAME'];
    }else{
        return '-';
    }
}

function get_person_marital_string($marital_id){
    $query = "SELECT MARITALSTATUS_NAME FROM maritalstatus WHERE ID = $marital_id";
    $marital_strings = mysql_query($query);
    $marital_string = mysql_fetch_assoc($marital_strings);
    if($marital_string){
        return $marital_string['MARITALSTATUS_NAME'];
    }else{
        return '-';
    }
}

function get_person_title_string($title_id){
    $query = "SELECT TITLE_NAME FROM title WHERE ID = $title_id";
    $title_strings = mysql_query($query);
    $title_string = mysql_fetch_assoc($title_strings);
    if($title_string){
        return $title_string['TITLE_NAME'];
    }else{
        return '-';
    }
}

function get_district_string($district_id){
    $query = "SELECT DISTRICT_NAME FROM district WHERE DISTRICT_ID = $district_id";
    $district_strings = mysql_query($query);
    $district_string = mysql_fetch_assoc($district_strings);
    if($district_string){
        return $district_string['DISTRICT_NAME'];
    }else{
        return '';
    }
}

function get_amphur_string($amphur_id){
    $query = "SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID = $amphur_id";
    $amphur_strings = mysql_query($query);
    $amphur_string = mysql_fetch_assoc($amphur_strings);
    if($amphur_string){
        return $amphur_string['AMPHUR_NAME'];
    }else{
        return '';
    }
}

function get_province_string($province_id){
    $query = "SELECT PROVINCE_NAME FROM province WHERE PROVINCE_ID = $province_id";
//    echo $query;
    $province_strings = mysql_query($query);
    $province_string = mysql_fetch_assoc($province_strings);
    if($province_string){
        return $province_string['PROVINCE_NAME'];
    }else{
        return '';
    }
}

function get_person_name_string($id){
    $query = "SELECT PERSONNAME_NAME FROM personname WHERE PERSONNAME_OWNER_ID = $id";
//    echo $query;
    $province_strings = mysql_query($query);
    $province_string = mysql_fetch_assoc($province_strings);
    if($province_string){
        return $province_string['PERSONNAME_NAME'];
    }else{
        return '';
    }
}

function get_person_surname_string($id){
    $query = "SELECT PERSONNAME_SURNAME FROM personname WHERE PERSONNAME_OWNER_ID = $id";
//    echo $query;
    $province_strings = mysql_query($query);
    $province_string = mysql_fetch_assoc($province_strings);
    if($province_string){
        return $province_string['PERSONNAME_SURNAME'];
    }else{
        return '';
    }
}

function get_generation_detial($gen_id){
    $query = "SELECT * FROM generation WHERE id = $gen_id";
    
    return mysql_query($query);
}

//function set_person_generation_id($gen_id){
//    
//}
?>