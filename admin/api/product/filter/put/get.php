<?php

/*
 +=============================================================================
 | 
 |  필터 관리 - 필터 리스트 조회
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

$select_filter_sql = "
	SELECT
		PF.IDX					AS FILTER_IDX,
		PF.FILTER_TYPE			AS FILTER_TYPE,
		PF.FILTER_NAME_KR		AS FILTER_NAME,
		IFNULL(
			PF.RGB_COLOR,'#000000;'
		)					AS RGB_COLOR,
		IFNULL(
			PF.SIZE_TYPE,'-'
		)					AS SIZE_TYPE
	FROM
		PRODUCT_FILTER PF
	WHERE
		DEL_FLG = FALSE
	ORDER BY
		IDX,SIZE_TYPE ASC
";

$db->query($select_filter_sql);

$filter_cl = array();
$filter_sz = array();
foreach($db->fetch() as $filter_data) {
	$filter_type = $filter_data['FILTER_TYPE'];
	if ($filter_type == "CL") {
		$filter_cl[] = array(
			'filter_idx'		=>$filter_data['FILTER_IDX'],
			'filter_type'		=>$filter_data['FILTER_TYPE'],
			'filter_name'		=>$filter_data['FILTER_NAME'],
			'rgb_color'			=>$filter_data['RGB_COLOR']
		);
	} else if ($filter_type == "SZ") {
		$filter_sz[] = array(
			'filter_idx'		=>$filter_data['FILTER_IDX'],
			'filter_type'		=>$filter_data['FILTER_TYPE'],
			'filter_name'		=>$filter_data['FILTER_NAME'],
			'size_type'			=>$filter_data['SIZE_TYPE']
		);
	}
}

$json_result['data'][] = array(
	'filter_cl'	=>$filter_cl,
	'filter_sz'	=>$filter_sz
);

?>
