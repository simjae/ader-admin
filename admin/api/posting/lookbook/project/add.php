<?php
/*
 +=============================================================================
 | 
 | 전시정보 등록 - 룩북 프로젝트 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$page_idx		= $_POST['page_idx'];
$project_name	= $_POST['project_name'];
$project_desc	= $_POST['project_desc'];
$img_location	= $_POST['img_location'];
$creater		= $_POST['creater'];
$updater		= $_POST['updater'];

$if ($page_idx != null) {
	$sql = "INSERT INTO
				dev.DISPLAY_LOOKBOOK
			(
				PAGE_IDX,
				PROJECT_NAME,
				PROJECT_DESC,
				IMG_LOCATION,
				CREATER,
				UPDATER
			) VALUES (
				".$page_idx.",
				'".$project_name."',
				'".$project_desc."',
				'".$img_location."',
				'".$creater."',
				'".$updater."',
			);";

	$db->query($sql);
}
?>