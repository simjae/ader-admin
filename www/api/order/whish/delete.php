<?php
/*
 +=============================================================================
 | 
 | 위시 리스트 - 위시 리스트 상품 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx = 1;
//$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = "adertest4";
//$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$whish_idx = $_POST['whish_idx'];

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

$cnt = $db->count("dev.WHISH_LIST","IDX = ".$whish_idx." AND MEMBER_IDX = ".$member_idx);

if ($cnt == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "존재하지 않는 위시리스트 상품이 선택되었습니다. 삭제하려는 상품을 다시 확인해주세요.";
	return $json_result;
}

$sql = "UPDATE
			dev.WHISH_LIST
		SET
			DEL_FLG = TRUE,
			UPDATER = '".$member_id."',
			UPDATE_DATE = NOW()
		WHERE
			IDX = ".$whish_idx." AND
			MEMBER_IDX = ".$member_idx;

$db->query($sql);
?>