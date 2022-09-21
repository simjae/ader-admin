<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$contents_type		= $_POST['contents_type'];
$contents_title		= $_POST['contents_title'];

$tables = "";
if ($contents_type == "IMG") {
	$tables = " dev.DISPLAY_CONTENTS_IMG ";
} else if ($contents_type == "VID") {
	$tables = " dev.DISPLAY_CONTENTS_VID ";
}

//검색 유형 - 디폴트
$where = '1=1';
$where .= " AND (".$contents_type."_TITLE = '".$contents_title."') ";

$sql = 	"SELECT
			COUNT(IDX) AS CONTENTS_CNT
		FROM 
			".$tables."
		WHERE 
			".$where;

$db->query($sql);
foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'contents_cnt'	=>$data['CONTENTS_CNT']
		);
	}
?>