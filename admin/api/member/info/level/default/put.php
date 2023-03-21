<?php
/*
 +=============================================================================
 | 
 | 회원등급 기본설정 API
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

/** 변수 정리 **/
$country				= $_POST['country'];
$default_level_idx		= $_POST['default_level_idx'];

if ($country != null && $default_level_idx != null) {
	$update_default_level_sql = "
		ALTER TABLE
			MEMBER_".$country."
		ALTER
			LEVEL_IDX SET DEFAULT '".$default_level_idx."'";

	$db->query($update_default_level_sql);
}

?>