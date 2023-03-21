<?php

/*
 +=============================================================================
 | 
 |  필터 관리 - 필터 개별 조회
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

if ($filter_idx != null) {
	$select_filter_sql = "
		SELECT
			PF.IDX					AS FILTER_IDX,
			PF.FILTER_TYPE			AS FILTER_TYPE,
			PF.FILTER_NAME_KR		AS FILTER_NAME_KR,
			PF.FILTER_NAME_EN		AS FILTER_NAME_EN,
			PF.FILTER_NAME_CN		AS FILTER_NAME_CN,
			IFNULL(
				PF.RGB_COLOR,'#000000;'
			)					AS RGB_COLOR,
			IFNULL(
				PF.SIZE_TYPE,'-'
			)					AS SIZE_TYPE
		FROM
			PRODUCT_FILTER PF
		WHERE
			PF.IDX = ".$filter_idx."
	";
	
	$db->query($select_filter_sql);
	
	foreach($db->fetch() as $filter_data) {
		$json_result['data'][] = array(
			'filter_idx'		=>$filter_data['FILTER_IDX'],
			'filter_type'		=>$filter_data['FILTER_TYPE'],
			'filter_name_kr'	=>$filter_data['FILTER_NAME_KR'],
			'filter_name_en'	=>$filter_data['FILTER_NAME_EN'],
			'filter_name_cn'	=>$filter_data['FILTER_NAME_CN'],
			'rgb_color'			=>$filter_data['RGB_COLOR'],
			'size_type'			=>$filter_data['SIZE_TYPE']
		);
	}
}

?>
