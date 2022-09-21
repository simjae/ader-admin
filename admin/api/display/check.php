<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$page_title     = $_POST['page_title'];
$page_table     = $_POST['page_table'];
$posting_type	= $_POST['posting_type'];
$country		= $_POST['country'];

//검색 유형 - 디폴트
$where = '1=1';
$where .= " AND (PAGE_TITLE = '".$page_title."') ";

$table = "";
switch ($page_table) {
	case "product" :
		$table = "dev.PAGE_PRODUCT_DISPLAY";
		break;
	
	case "posting" :
		$table = "dev.PAGE_POSTING";
		$where .= " AND (POSTING_TYPE = '".$posting_type."') ";
		if ($country != null) {
			$where .= " AND (COUNTRY = '".$country."') ";
		}
		break;
	
	case "whats" :
		$table = "dev.PAGE_WHATS_NEW";
		$where .= " AND (COUNTRY = '".$country."') ";
		break;
}


$sql = 	"SELECT
			COUNT(IDX) AS PAGE_CNT
		FROM 
			".$table."
		WHERE 
			".$where;

$db->query($sql);
foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'page_cnt'	=>$data['PAGE_CNT']
		);
	}
?>