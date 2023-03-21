<?php
/*
 +=============================================================================
 | 
 | 멤버 : 적립금 리스트 취득
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.22
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$search_date	= $_POST['search_date'];
$country		= $_POST['country'];
$reserve_from	= $_POST['reserve_from'];
$reserve_to		= $_POST['reserve_to'];
$tab_status		= $_POST['tab_status'];
$mileage_type	= $_POST['mileage_type'];
$member_level	= $_POST['member_level'];
$id				= $_POST['id'];

$rows			= $_POST['rows'];
$page			= $_POST['page'];

$tables =  '
	MILEAGE_INFO MI
	LEFT JOIN MILEAGE_CODE CODE ON
	MI.MILEAGE_CODE = CODE.MILEAGE_CODE
	LEFT JOIN ORDER_PRODUCT OP ON
	MI.ORDER_PRODUCT_CODE = OP.ORDER_PRODUCT_CODE
';

$where .= " MI.COUNTRY = '".$country."' ";

if($tab_status != null){
	switch($tab_status){
		case 'USB':
			$where .= " AND (MI.MILEAGE_USABLE_INC > 0) ";
			$where_cnt = $where;
			break;
		
		case 'UNU':
			$where .= " AND (MI.MILEAGE_UNUSABLE > 0 ) ";
			$where_cnt = $where;
			break;
		
		case 'DEC':
			$where .= " AND (MI.MILEAGE_USABLE_DEC > 0) ";
			$where_cnt = $where;
			break;
	}
}

if($member_level != null){
	$where .= " AND MI.MEMBER_IDX IN (SELECT IDX FROM MEMBER_".$country." WHERE LEVEL_IDX = ".$member_level.")";
}

if($id != null){
	$where .= " AND MI.ID LIKE '%".$id."%' ";
}

if ($search_date != null && $search_date != 'ALL') {
	$tmp_date = "DATE_FORMAT(MI.CREATE_DATE,'%Y-%m-%d')";
	
	switch ($search_date) {
		case "today" :
			$where .= " AND (".$tmp_date." = CURDATE()) ";
			break;
		
		case "01d" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 1 DAY)) ";
			break;
		
		case "03d" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 3 DAY)) ";
			break;
		
		case "07d" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 7 DAY)) ";
			break;
		
		case "15d" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 15 DAY)) ";
			break;
		
		case "01m" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 1 MONTH)) ";
			break;
		
		case "03m" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 3 MONTH)) ";
			break;
		
		case "01y" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 1 YEAR)) ";
			break;
	}
}

if($mileage_type != null){
	$where .= " AND MI.MILEAGE_CODE = '".$mileage_type."' ";
}

if ($reserve_from != null && $reserve_to != null) {
	$where .= " AND (MI.CREATE_DATE BETWEEN '".$reserve_from."' AND '".$reserve_to."') ";
} else{
	if ($reserve_from != null) {
		$where .= " AND MI.CREATE_DATE >= '".$reserve_from."' ";
	} else if ($reserve_to != null) {
		$where .= " AND MI.CREATE_DATE <= '".$reserve_to."' ";
	}
}

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables, $where_cnt),
	'page' => $page
);

$limit_start = (intval($page)-1)*$rows;

$select_mileage_info_sql = '
	SELECT 
		MI.IDX							AS IDX,
		MI.COUNTRY						AS COUNTRY,
		MI.MEMBER_IDX					AS MEMBER_IDX,
		MI.ID							AS ID,
		MI.MILEAGE_CODE					AS MILEAGE_CODE,
		CODE.MILEAGE_TYPE				AS MILEAGE_TYPE,
		CODE.MILEAGE_CONTENT			AS MILEAGE_CONTENT,
		MI.MILEAGE_UNUSABLE				AS MILEAGE_UNUSABLE,
		MI.MILEAGE_USABLE_INC			AS MILEAGE_USABLE_INC,
		MI.MILEAGE_USABLE_DEC			AS MILEAGE_USABLE_DEC,
		MI.MILEAGE_BALANCE				AS MILEAGE_BALANCE,
		IFNULL(
			MI.ORDER_CODE,"-"
		)								AS ORDER_CODE,
		IFNULL(
			MI.ORDER_PRODUCT_CODE,"-"
		)								AS ORDER_PRODUCT_CODE,
		MI.MANAGER						AS MANAGER,
		MI.MILEAGE_USABLE_DATE_INFO		AS MILEAGE_USABLE_DATE_INFO,
		MI.MILEAGE_USABLE_DATE			AS MILEAGE_USABLE_DATE,
		MI.CREATE_DATE					AS CREATE_DATE
	FROM 
		'.$tables.'
	WHERE 
		'.$where.'
	ORDER BY
		MI.IDX DESC
';
	
if ($rows != null) {
	$select_mileage_info_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_mileage_info_sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'idx'						=>$data['IDX'],
		'country'					=>$data['COUNTRY'],
		'member_idx'				=>$data['MEMBER_IDX'],
		'id'						=>$data['ID'],
		'mileage_code'				=>$data['MILEAGE_CODE'],
		'mileage_type'				=>$data['MILEAGE_TYPE'],
		'mileage_content'			=>$data['MILEAGE_CONTENT'],
		'mileage_unusable'			=>$data['MILEAGE_UNUSABLE'],
		'mileage_usable_inc'		=>$data['MILEAGE_USABLE_INC'],
		'mileage_usable_dec'		=>$data['MILEAGE_USABLE_DEC'],
		'mileage_balance'			=>$data['MILEAGE_BALANCE'],
		'order_code'				=>$data['ORDER_CODE'],
		'order_product_code'		=>$data['ORDER_PRODUCT_CODE'],
		'manager'					=>$data['MANAGER'],
		'mileage_usable_date_info'	=>$data['MILEAGE_USABLE_DATE_INFO'],
		'mileage_usable_date'		=>$data['MILEAGE_USABLE_DATE'],
		'create_date'				=>$data['CREATE_DATE']
	);
}

?>