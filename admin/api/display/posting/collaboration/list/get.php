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

/*$admin_idx = 0;
if (isset($_SESSION['ADMIN_IDX'])) {
	$admin_idx = $_SESSION['ADMIN_IDX'];
}*/

$country		= $_POST['country'];

$select_collaboration_sql = "
	SELECT
		PC.IDX				AS COLLABORATION_IDX,
		PC.DISPLAY_NUM		AS DISPLAY_NUM,
		PP.PAGE_TITLE		AS PAGE_TITLE,
		(
			SELECT
				COUNT(S_CB.IDX)
			FROM
				COLLABORATION_BOOKMARK S_CB
			WHERE
				S_CB.COLLABORATION_IDX = PC.IDX
		)					AS BOOKMARK_CNT
	FROM
		PAGE_POSTING PP
		LEFT JOIN POSTING_COLLABORATION PC ON
		PP.IDX = PC.PAGE_IDX
	WHERE
		PP.COUNTRY = '".$country."' AND
		PP.POSTING_TYPE = 'COLA' AND
		PP.DEL_FLG = FALSE AND
		PC.DEL_FLG = FALSE
	ORDER BY
		DISPLAY_NUM ASC
";

$db->query($select_collaboration_sql);

foreach($db->fetch() as $collaboration_data) {
	$collaboraion_idx = $collaboration_data['COLLABORATION_IDX'];
	$bookmark_cnt = $collaboration_data['BOOKMARK_CNT'];
	
	$select_main_img_sql = "
		SELECT
			CC.COLUMN_VALUE		AS MAIN_IMG_LOCATION
		FROM
			COLLABORATION_COLUMN CC
		WHERE
			CC.COLLABORATION_IDX = ".$collaboraion_idx." AND
			CC.PHS_COLUMN_NAME = 'MAIN_IMG'
	";
	
	$db->query($select_main_img_sql);
	
	$main_img_location = "/images/default_main_img.jpg";
	foreach($db->fetch() as $img_data) {
		$main_img_location = $img_data['MAIN_IMG_LOCATION'];
	}
	
	$bookmark_flg = false;
	
	if ($bookmark_cnt > 0) {
		$bookmark_flg = true;
	}
	
	$json_result['data'][] = array(
		'collaboration_idx'		=>$collaboration_data['COLLABORATION_IDX'],
		'display_num'			=>$collaboration_data['DISPLAY_NUM'],
		'page_title'			=>$collaboration_data['PAGE_TITLE'],
		'main_img_location'		=>$main_img_location,
		'bookmark_flg'			=>$bookmark_flg
	);
}

?>