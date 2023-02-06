<?php
/*
 +=============================================================================
 | 
 | 바우처 등록 
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country                = $_POST['country'];
$voucher_name	        = $_POST['voucher_name'];
$voucher_code	        = $_POST['voucher_code'];
$on_off_type	        = $_POST['on_off_type'];
$voucher_type	        = $_POST['voucher_type'];
$birth_month            = $_POST['birth_month'];
$issue_start_date	    = $_POST['issue_start_date'];
$issue_end_date	        = $_POST['issue_end_date'];
$voucher_date_type	    = $_POST['voucher_date_type'];
$voucher_date_param	    = $_POST['voucher_date_param'];
$voucher_start_date	    = $_POST['voucher_start_date'];
$voucher_end_date	    = $_POST['voucher_end_date'];
$sale_type	            = $_POST['sale_type'];
$sale_price	            = $_POST['sale_price'];
$min_price	            = $_POST['min_price'];
$description	        = $_POST['description'];
$member_level_flg	    = $_POST['member_level_flg'];
$member_level	        = $_POST['member_level'];


$values = "";

if ($country != null) {
    $country_arr = array();
    $country_arr[0] = "COUNTRY,";
    $country_arr[1] = "'".$country."',";
}

if ($voucher_name != null) {
    $voucher_name_arr = array();
    $voucher_name_arr[0] = "VOUCHER_NAME,";
    $voucher_name_arr[1] = "'".$voucher_name."',";
}

if ($voucher_code != null) {
    $voucher_code_arr = array();
    $voucher_code_arr[0] = "VOUCHER_CODE,";
    $voucher_code_arr[1] = "'".$voucher_code."',";
}

if ($on_off_type != null) {
    $on_off_type_arr = array();
    $on_off_type_arr[0] = "ON_OFF_TYPE,";
    $on_off_type_arr[1] = "'".$on_off_type."',";
}

if ($voucher_type != null) {
    $voucher_type_arr = array();
    $voucher_type_arr[0] = "VOUCHER_TYPE,";
    $voucher_type_arr[1] = "'".$voucher_type."',";
    if($voucher_type == 'BR'){
        if($birth_month != null){
            $birth_start_date = "(SELECT DATE('".$birth_month."-01"."')),";
            $birth_end_date = "(LAST_DAY(DATE('".$birth_month."-01"."')) + INTERVAL 1 DAY - INTERVAL 1 SECOND),";

            $issue_start_date_arr = array();
            $issue_start_date_arr[0] = "ISSUE_START_DATE,";
            $issue_start_date_arr[1] = $birth_start_date;
            
            $issue_end_date_arr = array();
            $issue_end_date_arr[0] = "ISSUE_END_DATE,";
            $issue_end_date_arr[1] = $birth_end_date;

            $voucher_date_type_arr = array();
            $voucher_date_type_arr[0] = "VOUCHER_DATE_TYPE,";
            $voucher_date_type_arr[1] = "'FXD',";

            $voucher_start_date_arr = array();
            $voucher_start_date_arr[0] = "VOUCHER_START_DATE,";
            $voucher_start_date_arr[1] = $birth_start_date;

            $voucher_end_date_arr = array();
            $voucher_end_date_arr[0] = "VOUCHER_END_DATE,";
            $voucher_end_date_arr[1] = $birth_end_date;
        }
    }
    else{
        if ($issue_start_date != null) {
            $issue_start_date_arr = array();
            $issue_start_date_arr[0] = "ISSUE_START_DATE,";
            $issue_start_date_arr[1] = "'".$issue_start_date."',";
        }
        
        if ($issue_end_date != null) {
            $issue_end_date_arr = array();
            $issue_end_date_arr[0] = "ISSUE_END_DATE,";
            $issue_end_date_arr[1] = "'".$issue_end_date."',";
        }
        
        if ($voucher_date_type != null) {
            $voucher_date_type_arr = array();
            $voucher_date_type_arr[0] = "VOUCHER_DATE_TYPE,";
            $voucher_date_type_arr[1] = "'".$voucher_date_type."',";
        }
        
        if ($voucher_date_param == null) {
            $voucher_date_param_arr = array();
            $voucher_date_param_arr[0] = "VOUCHER_DATE_PARAM,";
            $voucher_date_param_arr[1] = "'".$voucher_date_param."',";
        }
        
        if ($voucher_start_date != null) {
            $voucher_start_date_arr = array();
            $voucher_start_date_arr[0] = "VOUCHER_START_DATE,";
            $voucher_start_date_arr[1] = "'".$voucher_start_date."',";
        }
        
        if ($voucher_end_date != null) {
            $voucher_end_date_arr = array();
            $voucher_end_date_arr[0] = "VOUCHER_END_DATE,";
            $voucher_end_date_arr[1] = "'".$voucher_end_date."',";
        }
    }
}

if ($sale_type != null) {
    $sale_type_arr = array();
    $sale_type_arr[0] = "SALE_TYPE,";
    $sale_type_arr[1] = "'".$sale_type."',";
}

if ($sale_price != null) {
    $sale_price_arr = array();
    $sale_price_arr[0] = "SALE_PRICE,";
    $sale_price_arr[1] = $sale_price.",";
}

if ($min_price != null) {
    $min_price_arr = array();
    $min_price_arr[0] = "MIN_PRICE,";
    $min_price_arr[1] = $min_price.",";
}

if ($description != null) {
    $description_arr = array();
    $description_arr[0] = "DESCRIPTION,";
    $description_arr[1] = "'".$description."',";
}

if ($member_level_flg != null) {
    $member_level_arr = array();
    $member_level_arr[0] = "MEMBER_LEVEL,";
    if($member_level_flg == 'ALL'){
        $member_level_arr[1] = "'".$member_level_flg."',";
    }
    else if($member_level_flg == 'DML'){
        $member_level_arr[1] = "'".implode(",",$member_level)."',";
    }
}
$sql = "INSERT INTO
            dev.VOUCHER_MST
            (
                ".$country_arr[0]."
                ".$voucher_name_arr[0]."
                ".$voucher_code_arr[0]."
                ".$on_off_type_arr[0]."
                ".$voucher_type_arr[0]."
                ".$issue_start_date_arr[0]."
                ".$issue_end_date_arr[0]."
                ".$voucher_date_type_arr[0]."
                ".$voucher_date_param_arr[0]."
                ".$voucher_start_date_arr[0]."
                ".$voucher_end_date_arr[0]."
                ".$sale_type_arr[0]."
                ".$sale_price_arr[0]."
                ".$min_price_arr[0]."
                ".$description_arr[0]."
                ".$member_level_arr[0]."
                CREATER,
                UPDATER
            )
            VALUES(
                ".$country_arr[1]."
                ".$voucher_name_arr[1]."
                ".$voucher_code_arr[1]."
                ".$on_off_type_arr[1]."
                ".$voucher_type_arr[1]."
                ".$issue_start_date_arr[1]."
                ".$issue_end_date_arr[1]."
                ".$voucher_date_type_arr[1]."
                ".$voucher_date_param_arr[1]."
                ".$voucher_start_date_arr[1]."
                ".$voucher_end_date_arr[1]."
                ".$sale_type_arr[1]."
                ".$sale_price_arr[1]."
                ".$min_price_arr[1]."
                ".$description_arr[1]."
                ".$member_level_arr[1]."
                'Admin',
                'Admin'
            )";

$db->query($sql);
?>