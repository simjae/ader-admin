<?php

/*
 +=============================================================================
 | 
 |  필터 관리 - 필터 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$filter_idx		= $_POST['filter_idx'];
$filter_type	= $_POST['filter_type'];

if ($filter_idx != null) {
	$product_cl_cnt = $db->count("dev.SHOP_PRODUCT","FILTER_CL REGEXP '".$filter_idx."'");
	$product_sz_cnt = $db->count("dev.SHOP_PRODUCT","FILTER_SZ REGEXP '".$filter_idx."'");
	
	if ($product_cl_cnt > 0 || $product_sz_cnt > 0) {
		$json_result['code'] = 301;
		$json_result['msg'] = "다른 상품에 적용된 필터의 정보는 삭제할 수 없습니다.";
	} else {
		$delete_filter_sql = "
			UPDATE
				dev.PRODUCT_FILTER
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = 'Admin'
			WHERE
				IDX IN (".implode(",",$filter_idx).")
		";
		
		$db->query($delete_filter_sql);
	}
}

?>
