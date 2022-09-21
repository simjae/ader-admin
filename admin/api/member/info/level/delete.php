<?php
/*
 +=============================================================================
 | 
 | 회원등급 삭제처리 API
 | ----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$select_lv = $_POST['select_lv'];

$where = " 1=1 ";
$lv_list="";
if ($select_lv != null) {
	$lv_list = implode(',',$select_lv);
	$where .= " AND LV IN (".$lv_list.")";
}

$tables = $_TABLE['MEMBER_LV'];

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page)
);

	//수정항목
for ($i=0; $i<count($select_lv); $i++) {
	$member_sql = "UPDATE dev.MEMBER SET LEVEL = '일반회원' WHERE LEVEL = (SELECT TITLE FROM dev.MEMBER_LEVEL WHERE LV = ".$select_lv[$i].")";
	$db->query($member_sql);
}

$sql = "DELETE FROM
			".$tables."
		WHERE
			".$where;

$db->query($sql);
?>