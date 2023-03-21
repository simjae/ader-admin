<?php
/*
 +=============================================================================
 | 
 | 배송업체 수정 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

$session_id			    = sessionCheck();
$sel_idx                = $_POST['sel_idx'];
$company_name           = $_POST['company_name'];
$delivery_country       = $_POST['delivery_country'];
$company_tel            = $_POST['company_tel'];
$company_sub_tel        = $_POST['company_sub_tel'];
$company_email          = $_POST['company_email'];
$delivery_price         = $_POST['delivery_price'];
$homepage               = $_POST['homepage'];
$default_flg            = $_POST['default_flg'];


if($sel_idx != null && $company_name != null){
    $exist_cnt = $db->count('DELIVERY_COMPANY', 'COMPANY_NAME = "'.$company_name.'" AND IDX != '.$sel_idx  .' ');

    if($exist_cnt == 0){
        $db->begin_transaction();
        try {
            $update_sql = "
                UPDATE DELIVERY_COMPANY
                SET
                    COMPANY_NAME = '".$company_name."',
                    DELIVERY_COUNTRY = '".$delivery_country."',
                    COMPANY_TEL = '".$company_tel."',
                    COMPANY_SUB_TEL = '".$company_sub_tel."',
                    COMPANY_EMAIL = '".$company_email."',
                    DELIVERY_PRICE = ".$delivery_price.",
                    HOMEPAGE = '".$homepage."',
                    DEFAULT_FLG = ".$default_flg.",
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$session_id."'
                WHERE
                    IDX = ".$sel_idx;
            $db->query($update_sql);
            $db->commit();
        }
        catch(mysqli_sql_exception $exception){
            echo $exception->getMessage();
            $json_result['code'] = 301;
            $db->rollback();
            $msg = "배송 메세지 수정작업이 실패했습니다.";
            return $json_result;
        }
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = '동일 명의 업체가 이미 등록되어있습니다.';
        return $json_result;
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '필수정보를 입력해주세요.';
    return $json_result;
}