<?php
/*
 +=============================================================================
 | 
 | 회원 비밀번호 찾기 - 가입여부 체크  / 임시 비밀번호 발송
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/

$country = null;
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

$member_id = null;
if (isset($_POST['member_id'])) {
	$member_id = $_POST['member_id'];
}

if($member_id == '' || $member_id == null){
	$json_result['result'] = false;
	$json_result['code'] = 401;
	
	return $json_result;
}

if ($country != null && $member_id != null) {
	$member_cnt = $db->count("dev.MEMBER_".$country,"MEMBER_ID = '".$member_id."'");
	
	if ($member_cnt > 0) {
		$tmp_pw = dechex(substr(time(),0,10));
		
		$update_member_sql = "
			UPDATE
				dev.MEMBER_".$country."
			SET
				MEMBER_PW = '".md5($tmp_pw)."',
				PW_DATE = NOW()
			WHERE
				MEMBER_ID = '".$member_id."'
		";
		
		$db->query($update_member_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			// php의 메일 발송 함수 mail() 
			// 미구현
		}
	} else{
		$json_result['result'] = false;
		$json_result['code'] = 300;
		
		return $json_result;
	}
}
?>