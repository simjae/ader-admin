<?php
/*
 +=============================================================================
 | 
 | 전시정보 등록 - 룩북 프로젝트 수정
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
$lookbook_idx	= $_POST['lookbook_idx'];
$project_name	= $_POST['project_name'];
$project_desc	= $_POST['project_desc'];
$img_location	= $_POST['img_location'];
$updater		= $_POST['updater'];

$if ($page_idx != null) {
	$sql = "UPDATE
				dev.DISPLAY_LOOKBOOK
			SET
				PROJECT_NAME = '".$project_name."',
				PROJECT_DESC = '".$project_Desc."',
				IMG_LOCATION = '".$img_location."',
				UPDATE_DATE = NOW(),
				UPDATER = 'Admin'
			WHERE
				PAGE_IDX = ".$page_idx." AND
				IDX = ".$lookbook_idx;

	$db->query($sql);
}
?>