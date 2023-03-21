<?php
/*
 +=============================================================================
 | 
 | 지역별 배송비 정보 등록 API
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
$country                = $_POST['country'];
$isolated_flg           = $_POST['isolated_flg'];
$area_name              = $_POST['area_name'];
$start_zipcode          = $_POST['start_zipcode'];
$end_zipcode            = $_POST['end_zipcode'];
$delivery_price         = $_POST['delivery_price'];


if($country != null && $area_name != null){
    $exist_cnt = $db->count('DELIVERY_LOCATION', 'area_name = "'.$area_name.'" ');

    if($exist_cnt == 0){
        $db->begin_transaction();
        try {
            $add_sql = "
                INSERT INTO DELIVERY_LOCATION
                (
                    COUNTRY,
                    ISOLATED_FLG,
                    AREA_NAME,
                    START_ZIPCODE,
                    END_ZIPCODE,
                    DELIVERY_PRICE,
                    CREATER,
                    UPDATER
                )
                VALUES(
                    '".$country."',
                    ".$isolated_flg.",
                    '".$area_name."',
                    '".$start_zipcode."',
                    '".$end_zipcode."',
                    ".$delivery_price.",
                    '".$session_id."',
                    '".$session_id."'
                )
            ";
            $db->query($add_sql);
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
        $json_result['msg'] = '동일지역이 이미 등록되어있습니다.';
        return $json_result;
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '필수정보를 입력해주세요.';
    return $json_result;
}