<?php

function u($string=""){
    return urlencode($string);
}

function h($string=""){
    return htmlspecialchars($string);
}

function company_name(){
    global $db;

    $sql = "SELECT company_name FROM details";
    $result = mysqli_query($db, $sql);
    if($detail = mysqli_fetch_assoc($result)) {
        $comp_name = $detail['company_name'];
        return $comp_name;
    }
}








