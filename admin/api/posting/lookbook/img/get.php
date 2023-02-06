<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 룩북_이미지 조회
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

$lookbook_idx	= $_POST['lookbook_idx'];

if ($lookbook != null) {
	$sql = "SELECT
				LI.IDX				AS IMG_IDX,
				LI.IMG_LOCATION		AS IMG_LOCATION,
				RELEVANT_FLG		AS RELEVANT_FLG
			FROM
				dev.LOOKBOOK_IMG LI
			WHERE
				LI.LOOKBOOK_IDX = ".$lookbook_idx;

	$db->query($sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'img_idx'			=>$data['IMG_IDX'],
			'img_location'		=>$data['IMG_LOCATION'],
			'relevant_flg'		=>$data['RELEVANT_FLG']
		);
	}
}
?>