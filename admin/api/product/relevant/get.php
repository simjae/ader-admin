<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$product_idx			= $_POST['product_idx'];
$relevant_idx			= $_POST['relevant_idx'];
$relevant_type			= $_POST['relevant_type'];
$relevant_keyword		= $_POST['relevant_keyword'];

$tables = '
	'.$_TABLE['SHOP_PRODUCT'].'
';

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND (INDEPENDENCE_FLG = FALSE AND DEL_FLG = FALSE) ';

if ($product_idx != null) {
	$where .= " AND (IDX != ".$product_idx.") ";
}

if ($relevant_idx != null) {
	$where.=" AND (IDX IN (".$relevant_idx.")) ";
}

if ($relevant_type != null && $relevant_keyword != null) {
	if ($relevant_type == "product_code") {
		$where .= ' AND (PRODUCT_CODE LIKE "%'.$relevant_keyword.'%") ';
	} else if ($relevant_type == "product_name") {
		$where .= ' AND (PRODUCT_NAME LIKE "%'.$relevant_keyword.'%") ';
	} else if ($relevant_type == "product_category") {
		$where.=" AND (
					CONCAT(
						IFNULL(PL_LRG_CATEGORY,''),'|',
						IFNULL(PL_MDL_CATEGORY,''),'|',
						IFNULL(PL_SML_CATEGORY,''),'|',
						IFNULL(PL_DTL_CATEGORY,'')
					) REGEXP '".$relevant_keyword."'
				) ";
	}
}

$sql = 	'
		SELECT
			IDX,
			PRODUCT_NAME,
			PRODUCT_CODE
		FROM 
			'.$tables.'
		WHERE 
			'.$where.'
		ORDER BY
			IDX DESC';

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'					=>intval($data['IDX']),
		'product_code'			=>$data['PRODUCT_CODE'],
		'product_name'			=>$data['PRODUCT_NAME']
	);
}
?>