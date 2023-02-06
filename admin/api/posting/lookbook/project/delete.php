<?php
/*
 +=============================================================================
 | 
 | 전시정보 삭제 - 룩북 프로젝트 삭제
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

if ($product_idx != null && $lookbook_idx != null) {
	$sql = "UPDATE
				dev.DISPLAY_LOOKBOOK
			SET
				DEL_FLG = TRUE
			WHERE
				PAGE_IDX = ".$page_idx." AND
				IDX = ".$lookbook_idx;
	
	$db->query($sql);
}
?>