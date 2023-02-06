<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 룩북 프로젝트 조회
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

$page_idx	= $_POST['page_idx'];

if ($page_idx != null) {
	$sql = "SELECT
				DL.IDX						AS LOOKBOOK_IDX,
				DL.PROJECT_NAME				AS PROJECT_NAME,
				DL.PROJECT_DESC				AS PROJECT_DESC,
				PP.POSTING_TITLE			AS POSTING_TITLE,
				DL.IMG_LOCATION				AS IMG_LOCATION
			FROM
				dev.PAGE_POSTING PP
				LEFT JOIN dev.DISPLAY_LOOKBOOK DL ON
				PP.IDX = DL.PAGE_IDX
			WHERE
				PP.PAGE_IDX = ".$page_idx." AND
				PP.DEL_FLG = FALSE";

	$db->query($sql);

	foreach($db->fetch() as $data) {
		$json_result[] = array(
			'lookbook_idx'		=>$data['LOOKBOOK_IDX'],
			'project_name'		=>$data['PROJECT_NAME'],
			'posting_title'		=>$data['POSTING_TITLE'],
			'project_desc'		=>$data['PROJECT_DESC'],
			'img_location'		=>$data['IMG_LOCATION']
		);
	}
}
?>