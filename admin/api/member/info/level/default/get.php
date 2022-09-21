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

/** 변수 정리 **/
$tables = $_TABLE['MEMBER_LV'];

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page)
);

	//검색항목
$sql = "SELECT
			(SELECT DISTINCT DEFAULT(LEVEL) FROM dev.MEMBER) AS DEFAULT_LEVEL,
			TITLE
		FROM
			".$tables;

$db->query($sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'default_level'=>$data['DEFAULT_LEVEL'],
		'title'=>$data['TITLE']
	);
}
?>