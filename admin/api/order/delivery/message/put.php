<?php
/*
 +=============================================================================
 | 
 | 배송 메세지 정보 수정 API
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
$msg_type               = $_POST['msg_type'];
$delivery_msg           = $_POST['delivery_msg'];


if($country != null && is_array($msg_type) && is_array($delivery_msg)){
    $msg_arr = array();
    $db->begin_transaction();
	try {
        foreach($msg_type as $type_idx => $type_val){
            $put_sql = "
                UPDATE
                    DELIVERY_MSG
                SET
                    DELIVERY_MSG = '".$delivery_msg[$type_idx]."',
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$session_id."'
                WHERE
                    COUNTRY = '".$country."'
                AND
                    MSG_TYPE = '".$type_val."'
            ";

            $db->query($put_sql);
        }
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
    $json_result['msg'] = '잘못된 경로입니다.';
    return $json_result;
}