<?php
/*
 +=============================================================================
 | 
 | 생일일바우처 정보 수정 
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$voucher_idx	        = $_POST['voucher_idx'];
$country	            = $_POST['country'];
$date_ago_param	        = $_POST['date_ago_param'];
$date_later_param	    = $_POST['date_later_param'];

if ($voucher_idx != null && $country != null) {
	if($date_ago_param == null){
        $date_ago_param = 'NULL';
    }
    if($date_later_param == null){
        $date_later_param = 'NULL';
    }
    $set = "
        DATE_AGO_PARAM = ".$date_ago_param.",
        DATE_LATER_PARAM = ".$date_later_param.",
        UPDATE_DATE = NOW(),
        UPDATER = 'Admin'
    ";

    $sql = "
        UPDATE 
            dev.VOUCHER_MST
        SET
            " . $set . "
        WHERE
            IDX = " . $voucher_idx . "
    ";
	
	$db->query($sql);
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = "생일바우처 정보 수정 API를 수행하지 못했습니다.";
}
?>