<?php
/*
 +=============================================================================
 | 
 | 지역별 배송지 정보 수정 API
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
$area_name              = $_POST['area_name'];
$isolated_flg           = $_POST['isolated_flg'];
$start_zipcode          = $_POST['start_zipcode'];
$end_zipcode            = $_POST['end_zipcode'];
$delivery_price         = $_POST['delivery_price'];


if($sel_idx != null && $area_name != null){
    $exist_cnt = $db->count('DELIVERY_LOCATION', 'AREA_NAME = "'.$area_name.'" AND IDX != '.$sel_idx  .' ');

    if($exist_cnt == 0){
        $db->begin_transaction();
        try {
            $update_sql = "
                UPDATE DELIVERY_LOCATION
                SET
                    AREA_NAME = '".$area_name."',
                    ISOLATED_FLG = ".$isolated_flg.",
                    START_ZIPCODE = '".$start_zipcode."',
                    END_ZIPCODE = '".$end_zipcode."',
                    DELIVERY_PRICE = ".$delivery_price.",
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
            $msg = "지역별 배송지 정보 수정작업이 실패했습니다.";
            return $json_result;
        }
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = '동일 명의 지역가 이미 등록되어있습니다.';
        return $json_result;
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '필수정보를 입력해주세요.';
    return $json_result;
}