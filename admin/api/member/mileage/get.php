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
$search_date    = $_POST['search_date'];
$reserve_from   = $_POST['reserve_from'];
$reserve_to     = $_POST['reserve_to'];
$tab_num        = $_POST['tab_num'];
$mileage_type   = $_POST['mileage_type'];
$member_level   = $_POST['member_level'];
$id             = $_POST['id'];

$rows = $_POST['rows'];
$page = $_POST['page'];

$tables =   ' 	dev.MILEAGE_INFO 	AS MILEAGE 	LEFT JOIN
				dev.MILEAGE_CODE	AS CODE
			ON	MILEAGE.MILEAGE_CODE = CODE.MILEAGE_CODE ';
$where =    ' 1=1 ';

if($tab_num != null){
    switch($tab_num){
        case '01':
            $where .= " AND 
                            MILEAGE.MILEAGE_UNUSABLE = 0 
                        AND 
                            MILEAGE.MILEAGE_USABLE_INC != 0 ";
            $where_cnt = $where;
            break;
        case '02':
            $where .= " AND 
                            MILEAGE.MILEAGE_UNUSABLE != 0 
                        AND 
                            ( MILEAGE.MILEAGE_USABLE_INC = 0 AND MILEAGE.MILEAGE_USABLE_DEC = 0) 
						AND 
							MILEAGE.MILEAGE_USABLE_DATE > NOW() ";
            $where_cnt = $where;
            break;
        case '03':
            $where .= " AND 
                            MILEAGE.MILEAGE_UNUSABLE = 0 
                        AND 
                            MILEAGE.MILEAGE_USABLE_DEC > 0 ";
            $where_cnt = $where;
            break;
    }
}

if($member_level != null){
    $where .= " AND MILEAGE.ID IN (SELECT ID FROM dev.MEMBER WHERE LEVEL = '".$member_level."')";
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
if($mileage_type != null){
    $where .= " AND MILEAGE.MILEAGE_CODE  = '".$mileage_type."' ";
}
if ($reserve_from != null && $reserve_to != null) {
	$where .= " AND (MILEAGE.CREATE_DATE BETWEEN '".$reserve_from."' AND '".$reserve_to."') ";
}

$order = ' MILEAGE.IDX DESC ';

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables, $where_cnt),
	'page' => $page
);
$limit_start = (intval($page)-1)*$rows;

$sql = '
	SELECT 
		MILEAGE.IDX										AS IDX, 
		MILEAGE.ID										AS ID,
		MILEAGE.MILEAGE_CODE							AS MILEAGE_CODE,
		CODE.MILEAGE_TYPE								AS MILEAGE_TYPE,
		CODE.MILEAGE_CONTENT							AS MILEAGE_CONTENT,
		MILEAGE.MILEAGE_UNUSABLE						AS MILEAGE_UNUSABLE,
        MILEAGE.MILEAGE_USABLE_INC						AS MILEAGE_USABLE_INC,
        MILEAGE.MILEAGE_USABLE_DEC						AS MILEAGE_USABLE_DEC,
        MILEAGE.MILEAGE_BALANCE			            	AS MILEAGE_BALANCE,
        MILEAGE.ORDERNUM							    AS ORDERNUM,
        MILEAGE.MILEAGE_USABLE_DATE_INFO				AS MILEAGE_USABLE_DATE_INFO,
        MILEAGE.MILEAGE_USABLE_DATE						AS MILEAGE_USABLE_DATE,
        MILEAGE.CREATE_DATE								AS CREATE_DATE
	FROM 
		'.$tables.'
	WHERE 
		'.$where.'
    ORDER BY 
        '.$order.'
	';	
if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}
$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'idx'                       => $data['IDX'],
		'id'                        => $data['ID'],
		'mileage_code'		        => $data['MILEAGE_CODE'],
		'mileage_type'              => $data['MILEAGE_TYPE'],
		'mileage_content'           => $data['MILEAGE_CONTENT'],
		'mileage_unusable'		    => $data['MILEAGE_UNUSABLE'],
		'mileage_usable_inc'		=> $data['MILEAGE_USABLE_INC'],
		'mileage_usable_dec'	    => $data['MILEAGE_USABLE_DEC'],
        'mileage_balance'           => $data['MILEAGE_BALANCE'],
		'ordernum'		            => $data['ORDERNUM'],
		'mileage_usable_date_info'  => $data['MILEAGE_USABLE_DATE_INFO'],
		'mileage_usable_date'       => $data['MILEAGE_USABLE_DATE'],
		'create_date'		        => $data['CREATE_DATE']
	);
}
?>