<?php
/*
 +=============================================================================
 | 
 | 멤버 : 검색별 적립금 내역 통계 취득 API
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
$country    	= $_POST['country'];
$search_date    = $_POST['search_date'];
$reserve_from   = $_POST['reserve_from'];
$reserve_to     = $_POST['reserve_to'];
$member_level   = $_POST['member_level'];
$id             = $_POST['id'];

$tables =   ' 	MILEAGE_INFO 	AS MILEAGE 	LEFT JOIN
				MILEAGE_CODE	AS CODE
			ON	MILEAGE.MILEAGE_CODE = CODE.MILEAGE_CODE ';
$where =    ' 1=1 ';

$member_table = '';
switch($country){
	case 'KR':
		$member_table = 'MEMBER_KR'; 
		break;
	case 'EN':
		$member_table = 'MEMBER_EN';
		break;
	case 'CN':
		$member_table = 'MEMBER_CN';
		break;
}

if($country != null){
    $where .= " AND MILEAGE.COUNTRY = '".$country."' ";
}
else{
	$where .= " AND MILEAGE.COUNTRY = NULL ";
}

if($member_level != null){
    $where .= " AND MILEAGE.MEMBER_IDX IN (SELECT IDX FROM ".$member_table." WHERE LEVEL_IDX = ".$member_level.")";
}

if($id != null){
    $where .= " AND MILEAGE.ID LIKE '%".$id."%' ";
}

if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (MILEAGE.CREATE_DATE = CURDATE()) ';
			break;
		
		case "01d" :
			$where .= ' AND (MILEAGE.CREATE_DATE >= (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		
		case "03d" :
			$where .= ' AND (MILEAGE.CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		
		case "07d" :
			$where .= ' AND (MILEAGE.CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		
		case "15d" :
			$where .= ' AND (MILEAGE.CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		
		case "01m" :
			$where .= ' AND (MILEAGE.CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		
		case "03m" :
			$where .= ' AND (MILEAGE.CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
	}
}
if ($reserve_from != null && $reserve_to != null) {
	$where .= " AND (MILEAGE.CREATE_DATE BETWEEN '".$reserve_from."' AND '".$reserve_to."') ";
}

$sql = '
	SELECT 
        SUM(MILEAGE_USABLE_INC)     AS SUM_INC,
        SUM(MILEAGE_USABLE_DEC)     AS SUM_DEC,
        SUM(MILEAGE_USABLE_INC) - SUM(MILEAGE_USABLE_DEC)        
                                    AS SUM_BALANCE,
        SUM(MILEAGE_UNUSABLE)       AS UNUSABLE
	FROM 
		'.$tables.'
	WHERE 
		'.$where.'
	';	
$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'sum_inc'                   => $data['SUM_INC'],
		'sum_dec'                   => $data['SUM_DEC'],
		'sum_balance'		        => $data['SUM_BALANCE'],
		'unusable'                  => $data['UNUSABLE']
	);
}
?>