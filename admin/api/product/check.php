<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$product_code     = $_POST['product_code'];

//검색 유형 - 디폴트
$where = '1=1';
$where .= " AND (PRODUCT_CODE = '".$product_code."') ";

$sql = 	'
		SELECT
			COUNT(IDX) AS PRODUCT_CNT
		FROM 
			SHOP_PRODUCT
		WHERE 
			'.$where.'
		';

$db->query($sql);
foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'product_cnt'	=>$data['PRODUCT_CNT']
		);
	}
?>