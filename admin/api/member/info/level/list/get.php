<?php
/*
 +=============================================================================
 | 
 | 회원등급 리스트 갱신 API
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

$select_level_sql = "
	SELECT
		LV.IDX				AS LEVEL_IDX,
		LV.TITLE			AS LEVEL_TITLE,
		LV.MILEAGE_PER		AS MILEAGE_PER
	FROM
		MEMBER_LEVEL LV
	WHERE
		LV.DEL_FLG = FALSE
";

$db->query($select_level_sql);

foreach($db->fetch() as $level_data) {
	$level_idx = $level_data['LEVEL_IDX'];
	
	$member_kr_cnt = $db->count("MEMBER_KR","LEVEL_IDX = ".$level_idx);
	$member_en_cnt = $db->count("MEMBER_EN","LEVEL_IDX = ".$level_idx);
	$member_cn_cnt = $db->count("MEMBER_CN","LEVEL_IDX = ".$level_idx);
	
	$json_result['data'][] = array(
		'level_idx'			=>$level_data['LEVEL_IDX'],
		'level_title'		=>$level_data['LEVEL_TITLE'],
		'mileage_per'		=>$level_data['MILEAGE_PER'],
		'member_kr_cnt'		=>$member_kr_cnt,
		'member_en_cnt'		=>$member_en_cnt,
		'member_cn_cnt'		=>$member_cn_cnt
	);
}

?>