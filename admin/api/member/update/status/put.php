<?php
/*
 +=============================================================================
 | 
 | 회원상태 갱신
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
$action_type = $_POST['action_type'];
$select_idx = $_POST['select_idx'];

$set = "";
if ($action_type != null) {
	switch ($action_type) {
		case "member_trust" :
			$set .= " SUSPICION_FLG = FALSE ";
			break;
		
		case "member_suspicion" :
			$set .= " SUSPICION_FLG = TRUE ";
			break;
		
		case "member_default" :
			$set .= " STATUS = '정상' ";
			break;
		
		case "member_faulty" :
			$set .= " STATUS = '불량' ";
			break;
		
		case "member_drop" :
			$set .= " DROP_DATE = NOW(), ";
			$set .= " STATUS = '탈퇴', ";
			$set .= " DROP_TYPE = '강제탈퇴', ";
			$set .= " DEL_FLG = TRUE ";
			break;
	}
}

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