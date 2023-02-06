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
$default_level = $_POST['default_level'];


/** DB 처리 **/

//수정항목
$sql = "ALTER TABLE
			dev.MEMBER_KR
		ALTER
			LEVEL_IDX SET DEFAULT '".$default_level."'";

$db->query($sql);

$sql = "ALTER TABLE
			dev.MEMBER_EN
		ALTER
			LEVEL_IDX SET DEFAULT '".$default_level."'";

$db->query($sql);

$sql = "ALTER TABLE
			dev.MEMBER_CN
		ALTER
			LEVEL_IDX SET DEFAULT '".$default_level."'";

$db->query($sql);
?>