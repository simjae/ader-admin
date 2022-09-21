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

$refund_category = $_POST['refund_category'];
$refund_idx = $_POST['refund_idx'];

$select = "";
$where = "";

if ($refund_category != null || $refund_idx != null) {
	$select = "
		IDX,
		REFUND_CATEGORY,
		REFUND_TITLE,
		REFUND_CONTENT_KR,
		REFUND_CONTENT_EN,
		REFUND_CONTENT_CN
	";
	
	if ($refund_category != null) {
		$where = " WHERE REFUND_CATEGORY = '".$refund_category."'";
	} else if ($refund_idx != null) {
		$where = " WHERE IDX = ".$refund_idx;
	}
} else {
	$select = "
		DISTINCT REFUND_CATEGORY
	";
}

//검색 유형 - 디폴트
$sql = "SELECT
			".$select."
		FROM
			dev.PRODUCT_REFUND
			".$where;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'idx'				=>intval($data['IDX']),
		'refund_category'	=>$data['REFUND_CATEGORY'],
		'refund_title'		=>$data['REFUND_TITLE'],
		'refund_content_kr'	=>$data['REFUND_CONTENT_KR'],
		'refund_content_en'	=>$data['REFUND_CONTENT_EN'],
		'refund_content_cn'	=>$data['REFUND_CONTENT_CN']
	);
}
?>