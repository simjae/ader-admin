<?php
/*
 +=============================================================================
 | 
 | 전시정보 복사 - 콜라보레이션 전시정보 복사
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

$page_idx				= $_POST['page_idx'];
$prev_collaboration_idx	= $_POST['collaboration_idx'];

$sql = "INSERT INTO
			dev.DISPLAY_COLLABORATION
		(
			PAGE_IDX,
			POSTING_STATUS,
			DISPLAY_NUM,
			PRODUCT_LIST_FLG,
			PRODUCT_LINK_FLG,
			CREATER,
			UPDATER
		)
		SELECT
			".$page_idx.",
			'HOLD',
			MAX(DISPLAY_NUM) + 1,
			PRODUCT_LIST_FLG.
			PRODUCT_LINK_FLG,
			'".$creater."',
			'".$updater."',
		FROM
			dev.DISPLAY_COLLABORATION
		WHERE
			IDX = ".$prev_collaboration_idx." AND
			PAGE_IDX = ".$page_idx."
		);";

$db->query($sql);

$collaboration_idx = $db->last_id();
	
if (!empty($collaboration_idx)) {
	$display_num = 1;
	for ($i=0; $i<count(column_name); $i++) {
		$column_sql = "INSERT INTO
							dev.COLUMN_NAME
						(
							COLLABORATION_IDX,
							DISPLAY_NUM,
							COLUMN_NAME,
							COLUMN_VALUE
						)
						SELECT
							".$collaboration_idx.",
							".$display_num.",
							COLUMN_NAME,
							COLUMN_VALUE
						FROM
							dev.COLLABORATION_COLUMN
						WHERE
							COLLABORATION_IDX = ".$prev_collaboration_idx."
						)";
		
		$db->query($column_sql);
		$display_num++;
	}	
}
?>