<?php
/*
 +=============================================================================
 | 
 | 회원등급 리스트 갱신 API
 | ----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

/** 변수 정리 **/
$session_id			= sessionCheck();
$level_idx			= $_POST['level_idx'];
$level_title		= $_POST['title'];
$mileage_per		= $_POST['mileage_per'];

if (isset($level_idx) === true) {
	$exist_cnt = $db->count('MEMBER_LEVEL', "TITLE = '".$level_title."' AND IDX != ".$level_idx." ");
	if($exist_cnt == 0){
        $update_level_sql = "
			UPDATE
				MEMBER_LEVEL
			SET
				TITLE = '".$level_title."',
				MILEAGE_PER = ".$mileage_per.",
				UPDATE_DATE = NOW(),
				UPDATER = '".sessionCheck()."'
			WHERE
				IDX = ".$level_idx."
		";
		$db->query($update_level_sql);
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = '이미 동일명의 회원등급이 존재합니다.';
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '회원등급명을 입력해주세요';
}

?>