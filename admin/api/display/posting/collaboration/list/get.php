<?php
/*
 +=============================================================================
 | 
 | 콜라보레이션 관리 페이지 - 콜라보레이션 정보 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$admin_idx = 0;
if (isset($_SESSION['ADMIN_IDX'])) {
	$admin_idx = $_SESSION['ADMIN_IDX'];
}

$select_collaboration_sql = "
	SELECT
		PC.IDX				AS COLLABORATION_IDX,
		PC.DISPLAY_NUM		AS DISPLAY_NUM,
		PP.PAGE_TITLE		AS PAGE_TITLE,
		CC.COLUMN_VALUE		AS MAIN_IMG_LOCATION,
		(
			SELECT
				COUNT(S_CB.IDX)
			FROM
				dev.COLLABORATION_BOOKMARK S_CB
			WHERE
				S_CB.ADMIN_IDX = ".$admin_idx." AND
				S_CB.COLLABORATION_IDX = PC.IDX
		)					AS BOOKMARK_CNT
	FROM
		dev.PAGE_POSTING PP
		LEFT JOIN dev.POSTING_COLLABORATION PC ON
		PP.IDX = PC.PAGE_IDX
		LEFT JOIN dev.COLLABORATION_COLUMN CC ON
		PC.IDX = CC.COLLABORATION_IDX
	WHERE
		PP.POSTING_TYPE = 'COLA' AND
		PP.DEL_FLG = FALSE AND
		PC.DEL_FLG = FALSE AND
		CC.PHS_COLUMN_NAME = 'MAIN_IMG'
	ORDER BY
		BOOKMARK_CNT DESC,
		DISPLAY_NUM ASC
";

$db->query($select_collaboration_sql);

foreach($db->fetch() as $collaboration_data) {
	$collaboraion_idx = $collaboration_data['COLLABORATION_IDX'];
	$bookmark_cnt = $collaboration_data['BOOKMARK_CNT'];
	
	$bookmark_flg = false;
	if ($bookmark_cnt > 0) {
		$bookmark_flg = true;
	}
	
	$json_result['data'][] = array(
		'collaboration_idx'		=>$collaboration_data['COLLABORATION_IDX'],
		'display_num'			=>$collaboration_data['DISPLAY_NUM'],
		'page_title'			=>$collaboration_data['PAGE_TITLE'],
		'main_img_location'		=>$collaboration_data['MAIN_IMG_LOCATION'],
		'bookmark_flg'			=>$bookmark_flg
	);
}

?>