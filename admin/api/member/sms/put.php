<?php
/*
 +=============================================================================
 | 
 | SMS 메세지 정보 수정 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");
$session_id		= sessionCheck();

$sms_idx_list	        = $_POST['sms_idx_list'];

$set = '';
if (is_array($sms_idx_list) == true && count($sms_idx_list) > 0) {
    $db->begin_transaction();
	try {
        foreach($sms_idx_list as $sms_idx){
            $send_target_arr = $_POST['send_target_'.$sms_idx];
            if(is_array($send_target_arr)){
                if(array_search('M',$send_target_arr) === false){
                    $set .= 'MEMBER_SEND_FLG = FALSE,';
                }
                else{
                    $set .= 'MEMBER_SEND_FLG = TRUE,';
                }

                if(array_search('A',$send_target_arr) === false){
                    $set .= 'ADMIN_SEND_FLG = FALSE,';
                }
                else{
                    $set .= 'ADMIN_SEND_FLG = TRUE,';
                }

                if(array_search('S',$send_target_arr) === false){
                    $set .= 'SUPPLIER_SEND_FLG = FALSE,';
                }
                else{
                    $set .= 'SUPPLIER_SEND_FLG = TRUE,';
                }

                if(array_search('C',$send_target_arr) === false){
                    $set .= 'CUSTOMER_SEND_FLG = FALSE,';
                }
                else{
                    $set .= 'CUSTOMER_SEND_FLG = TRUE,';
                }
            }

            $member_send_msg = $_POST['member_send_msg_'.$sms_idx];
            if(isset($member_send_msg)){
                $set .= "MEMBER_SEND_MSG = '".trim($member_send_msg)."', ";
            }
            $admin_send_msg = $_POST['admin_send_msg_'.$sms_idx];
            if(isset($admin_send_msg)){
                $set .= "ADMIN_SEND_MSG = '".trim($admin_send_msg)."', ";
            }
            $supplier_send_msg = $_POST['supplier_send_msg_'.$sms_idx];
            if(isset($supplier_send_msg)){
                $set .= "SUPPLIER_SEND_MSG = '".trim($supplier_send_msg)."', ";
            }

            $update_sms_sql = "
                UPDATE SMS_INFO
                SET
                    ".$set."
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$session_id."'
                WHERE
                    IDX = ".$sms_idx."
            ";
            $db->query($update_sms_sql);
        }
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
		echo $exception->getMessage();
		$json_result['code'] = 301;
		$db->rollback();
		$msg = "SMS 메세지 편집 처리에 실패했습니다.";
	}	
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '잘못된 경로입니다.';
}
?>