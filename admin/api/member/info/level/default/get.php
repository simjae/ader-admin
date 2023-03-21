<?php
/*
 +=============================================================================
 | 
 | 회원등급 기본설정 조회 API
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

$select_default_level_sql = "
	SELECT
		(
			SELECT
				DISTINCT DEFAULT(S_MB.LEVEL_IDX)
			FROM
				MEMBER_KR S_MB
		)				AS DEFAULT_LEVEL_KR,
		(
			SELECT
				DISTINCT DEFAULT(S_MB.LEVEL_IDX)
			FROM
				MEMBER_EN S_MB
		)				AS DEFAULT_LEVEL_EN,
		(
			SELECT
				DISTINCT DEFAULT(S_MB.LEVEL_IDX)
			FROM
				MEMBER_CN S_MB
		)				AS DEFAULT_LEVEL_CN
	FROM
		MEMBER_LEVEL LV
	GROUP BY
		DEFAULT_LEVEL_KR
";

$db->query($select_default_level_sql);

foreach($db->fetch() as $level_data) {
	$json_result['data'][] = array(
		'default_level_kr'		=>$level_data['DEFAULT_LEVEL_KR'],
		'default_level_en'		=>$level_data['DEFAULT_LEVEL_EN'],
		'default_level_cn'		=>$level_data['DEFAULT_LEVEL_CN']
	);
}

?>