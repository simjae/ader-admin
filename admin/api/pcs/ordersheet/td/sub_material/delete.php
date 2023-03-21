<?php
/*
 +=============================================================================
 | 
 | 부자재 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sub_material_idx		= $_POST['sub_material_idx'];

$product_cnt = $db->count(
	"ORDERSHEET_MST OM",
	"OM.IDX IN (SELECT DISTINCT S_SM.ORDERSHEET_IDX FROM SUB_MATERIAL_MAPPING S_SM WHERE S_SM.SUB_MATERIAL_IDX = ".$sub_material_idx.") AND OM.DEL_FLG = FALSE"
);

if ($product_cnt > 0) {
	$json_result['code'] = 300;
	$json_result['msg'] = '현재 사용중인 부자재 정보는 삭제할 수 없습니다.';
} else {
	$delete_sub_material_sql = "
		DELETE FROM
			SUB_MATERIAL_INFO
		WHERE
			IDX = ".$sub_material_idx."
	";
	
	$db->query($delete_sub_material_sql);

	$delete_sub_material_img_sql = "
		DELETE FROM
			SUB_MATERIAL_IMAGE
		WHERE
			SUB_MATERIAL_IDX = ".$sub_material_idx."
	";
	$db->query($delete_sub_material_img_sql);
}

?>