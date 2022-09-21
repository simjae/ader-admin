<?php
/*
 +=============================================================================
 | 
 | 회원 탈퇴 API
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.9.7
 | 최종 수정일	: 2022.07.06
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$select_idx = $_POST['select_idx'];

$set = "";
$set .= " DROP_DATE = NOW(), ";
$set .= " STATUS = '탈퇴', ";
$set .= " DROP_TYPE = '일반탈퇴', ";
$set .= " DEL_FLG = TRUE ";

$where = " 1=1 ";
$idx_list="";
if ($select_idx != null) {
	$idx_list = implode(',',$select_idx);
	$where .= " AND IDX IN (".$idx_list.")";
}

$tables = $_TABLE['MEMBER'];

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page)
);

	//수정항목
$sql = "UPDATE
			".$tables."
		SET
			".$set."
		WHERE
			".$where;

$db->query($sql);
?>