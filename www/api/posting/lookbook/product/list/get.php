<?php
/*
 +=============================================================================
 | 
 | 게시물_룩북 - 룩북 이미지 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.02.10
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$project_idx = 0;
if (isset($_POST['project_idx'])) {
	$project_idx = $_POST['project_idx'];
}

$last_idx = 0;
if (isset($_POST['last_idx'])) {
	$last_idx = $_POST['last_idx'];
}

if ($project_idx == 0) {
	$json_result['code'] = 301;
	$json_result['msg'] = "부적절한 경로로 접근하셨습니다. 조회하려는 프로젝트를 확인해주세요.";
	
	return $json_result;
}

if ($project_idx > 0) {
	$select_collection_product_sql = "
		SELECT
			CP.IDX				AS C_PRODUCT_IDX,
			CP.RELEVANT_FLG		AS RELEVANT_FLG,
			(
				SELECT
					REPLACE(
						S_CI.IMG_LOCATION,
						'/var/www/admin/www',
						''
					)
				FROM
					dev.COLLECTION_IMG S_CI
				WHERE
					S_CI.PRODUCT_IDX = CP.IDX AND
					S_CI.IMG_SIZE = 'M'
			)					AS IMG_LOCATION
		FROM
			dev.COLLECTION_PRODUCT CP
		WHERE
			CP.PROJECT_IDX = ".$project_idx."
		ORDER BY
			CP.DISPLAY_NUM
	";
	
	if ($last_idx > 0) {
		$select_collection_product_sql .= " LIMIT ".$last_idx.",18 ";
	} else {
		$select_collection_product_sql .= " LIMIT 0,18 ";
	}
	
	$db->query($select_collection_product_sql);

	foreach($db->fetch() as $c_product_data) {
		$json_result['data'][] = array(
			'c_product_idx'		=>$c_product_data['C_PRODUCT_IDX'],
			'relevant_flg'		=>$c_product_data['RELEVANT_FLG'],
			'img_location'		=>$c_product_data['IMG_LOCATION']
		);
	}
}

?>