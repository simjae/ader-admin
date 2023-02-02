<?php
/*
 +=============================================================================
 | 
 | 바우처 등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.01.10
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$voucher_issue_code = null;
if (isset($_POST['voucher_issue_code'])) {
	$voucher_issue_code = $_POST['voucher_issue_code'];
}

if($member_idx == 0){
    $json_result['code'] = 401;
    $json_result['msg'] = '비로그인 상태입니다.';
	
	return $json_result;
} 

if ($country != null && $member_idx != null && $voucher_issue_code != null) {
	$select_verify_sql = "
		SELECT 
			VI.IDX					AS ISSUE_IDX,
			VI.VOUCHER_ADD_DATE		AS VOUCHER_ADD_DATE,
			VM.VOUCHER_TYPE			AS VOUCHER_TYPE,
			VM.MEMBER_LEVEL			AS MEMBER_LEVEL,
			CASE
				WHEN 
					VM.VOUCHER_END_DATE < NOW()
					THEN 
						FALSE
				ELSE
					TRUE
			END						AS ISSUE_DATE_FLG,
			MB.MEMBER_ID			AS MEMBER_ID,
			MB.LEVEL_IDX			AS LEVEL_IDX,
			ML.TITLE				AS TITLE
		FROM
			dev.VOUCHER_ISSUE VI
			LEFT JOIN dev.VOUCHER_MST VM ON
			VI.VOUCHER_IDX = VM.IDX
			LEFT JOIN dev.MEMBER_".$country." MB ON
			VI.MEMBER_IDX = MB.IDX
			LEFT JOIN dev.MEMBER_LEVEL ML ON
			MB.LEVEL_IDX = ML.IDX
		WHERE
			VI.VOUCHER_ISSUE_CODE = '".$voucher_issue_code."'
	";
	
	$db->query($select_verify_sql);
	
	$exist_flg = false;
	$error_msg = null;
	
	foreach($db->fetch() as $verify_data){
		if($verify_data['VOUCHER_ADD_DATE'] != NULL){
			$error_msg = '이미 등록된 바우처입니다.';
			break;
		}
		
		if($verify_data['ISSUE_DATE_FLG'] == FALSE){
			$error_msg = "바우처 기한이 만료 되었습니다.";
			break;
		}
		
		if($verify_data['MEMBER_LEVEL'] != 'ALL'){
			if(!strpos($verify_data['MEMBER_LEVEL'], strval($verify_data['LEVEL_IDX']))){
				$error_msg = "바우처 대상 회원등급이 아닙니다.";
				break;
			}
		}
		
		if($verify_data['VOUCHER_TYPE'] != 'OFF'){
			if($verify_data['MEMBER_ID'] != $member_id){
				$error_msg = "바우처 대상 대상회원이 아닙니다.";
				break;
			}
		}
		
		if ($error_msg == null) {
			$exist_flg = true;
			$update_voucher_issue_sql = "
				UPDATE 
					dev.VOUCHER_ISSUE VI, 
					dev.VOUCHER_MST VM
				SET       
					VI.MEMBER_IDX = ".$member_idx.",
					VI.MEMBER_ID = '".$member_id."',
					VI.COUNTRY = '".$country."',
					VI.VOUCHER_ADD_DATE = NOW(),
					VI.USABLE_START_DATE = 
					CASE
						WHEN 
							VM.VOUCHER_DATE_TYPE = 'FXD' 
							THEN 
								VM.VOUCHER_START_DATE 
						WHEN 
							VM.VOUCHER_DATE_TYPE = 'PRD' 
							THEN 
								NOW() 
					END,
					VI.USABLE_END_DATE = 
					CASE
						WHEN 
							VM.VOUCHER_DATE_TYPE = 'FXD' 
							THEN 
								VM.VOUCHER_END_DATE 
						WHEN 
							VM.VOUCHER_DATE_TYPE = 'PRD' 
							THEN 
								NOW() + INTERVAL VM.VOUCHER_DATE_PARAM DAY  
					END,
					VI.UPDATE_DATE = NOW(),
					VI.UPDATER = '".$member_id."'
				WHERE  
					VI.VOUCHER_IDX = VM.IDX
				AND
					VI.VOUCHER_ISSUE_CODE = '".$voucher_issue_code."';
			";
			
			$db->query($update_voucher_issue_sql);
			
			$json_result['data'] = array(
				'update_cnt'		=>$db->affectedRows()
			);
		} else {
			$json_result['code'] = 301;
			if ($exist_flg == false) {
				$json_result['msg'] = '존재하지 않는 바우처 코드입니다'; 
			} else {
				$json_result['msg'] = $error_msg;
			}
			
			return $json_result;
		}
	}
}

?>