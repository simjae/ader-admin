<?php
$search_type        	= $_POST['search_type'];        	//검색 타입
$search_keyword     	= $_POST['search_keyword']; 		//검색 키워드
$eventStatus     		= $_POST['eventStatus'];

$event_no				= $_POST['event_no'];

$search_date        	= $_POST['search_date'];            
$event_apply_from  		= $_POST['event_apply_from'];        	//등록일 검색 시작일자
$event_apply_to    		= $_POST['event_apply_to'];        	//등록일 검색 종료일자

$rows 					= $_POST['rows'];
$page 					= $_POST['page'];
$sort_value 			= $_POST['sort_value'];
$sort_type 				= $_POST['sort_type'];

$where = '	EVENT.DEL_FLG = FALSE
	AND		EVENT.EVENT_NO='.$event_no;
$tables = '
	dev.EVENT 				AS EVENT		LEFT JOIN 
	dev.EVENT_INFO 			AS EVENT_INFO 
ON 	EVENT.EVENT_NO = EVENT_INFO.IDX 			LEFT JOIN
	dev.MEMBER_KR			AS MK
ON	EVENT.ID = MK.MEMBER_ID
';

if ($eventStatus != null) {
	if($eventStatus == 'true'){
		$where .= " AND EVENT.STATUS = 'Y' ";
	}
	else{
		$where .= " AND EVENT.STATUS = 'N' ";
	}
}

if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "id" :
			$where .=  " AND EVENT.ID LIKE '%".$search_keyword."%' ";
			break;
		case "name" :
			$where .=  " AND EVENT.NAME LIKE '%".$search_keyword."%' ";
			break;
		case "tel" :
			$where .=  " AND EVENT.TEL LIKE '%".$search_keyword."%' ";
			break;
		case "email" :
			$where .=  " AND EVENT.EMAIL LIKE '%".$search_keyword."%' ";
			break;
		case "instagram_id" :
			break;
	}
}
if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= " AND (EVENT.FINPUT_DATE >= CURDATE()) ";
			break;
		
		case "01d" :
			$where .= " AND (EVENT.FINPUT_DATE >= (CURDATE() - INTERVAL 1 DAY)) ";
			break;
		
		case "03d" :
			$where .= " AND (EVENT.FINPUT_DATE >= (CURDATE() - INTERVAL 3 DAY)) ";
			break;
		
		case "07d" :
			$where .= " AND (EVENT.FINPUT_DATE >= (CURDATE() - INTERVAL 7 DAY)) ";
			break;
		
		case "15d" :
			$where .= " AND (EVENT.FINPUT_DATE >= (CURDATE() - INTERVAL 15 DAY)) ";
			break;
		
		case "01m" :
			$where .= " AND (EVENT.FINPUT_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ";
			break;
		
		case "03m" :
			$where .= " AND (EVENT.FINPUT_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ";
			break;
	}
}
if ($create_from != null && $create_to != null) {
	$where .= " AND (EVENT.FINPUT_DATE BETWEEN '".$event_apply_from."' AND '".$event_apply_to."') ";
}

$rows = $_POST['rows'];
$page = $_POST['page'];

$limit_start = (intval($page)-1)*$rows;

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => $page
);
$total = $json_result['total'];
$limit_start = (intval($page)-1)*$rows;

/** 정렬 조건 **/
if ($sort_value != null && $sort_type != null) {
	$order = " ORDER BY EVENT.".$sort_value." ".$sort_type.", ";
	$order .= " EVENT.IDX DESC ";
}

$limit = " LIMIT ".$limit_start.",".$rows;

$sql = '
	SELECT 
		EVENT.IDX,
		EVENT.EVENT_NO,
		EVENT.ID,
		EVENT.NAME,
		EVENT.TEL,
		EVENT.EMAIL,
		EVENT.ZIPCODE,
		EVENT.ADDRESS1,
		EVENT.ADDRESS2,
		EVENT.TXT_1,
		EVENT.TXT_2,
		EVENT.TXT_3,
		EVENT.TXT_4,
		EVENT.TXT_5,
		EVENT.IP,
		EVENT.CONTENTS,
		IF(EVENT.STATUS = "Y", true, false) AS STATUS,
		EVENT.FINPUT_DATE,
		EVENT.LINPUT_DATE,
		EVENT_INFO.EVENT_TITLE 	AS EVENT_TITLE,
		IF(MK.MEMBER_BIRTH IS NULL, "-", MK.MEMBER_BIRTH) AS MEMBER_BIRTH
	FROM '.$tables.' 
	WHERE 
		'.$where.'
	'.$order;
//'.$limit 제거;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'		=>$total--,
		'idx'		=>intval($data['IDX']),
		'event_title'		=>$data['EVENT_TITLE'],
		'name'		=>$data['NAME'],
		'id'		=>$data['ID'],
		'email'		=>$data['EMAIL'],
		'member_birth'	=>$data['MEMBER_BIRTH'],
		'tel'		=>$data['TEL'],
		'zipcode'	=>$data['ZIPCODE'],
		'address1'	=>$data['ADDRESS1'],
		'address2'	=>$data['ADDRESS2'],
		'instagram_id'=>'',
		'info_1'	=>$data['TXT_1'],
		'info_2'	=>$data['TXT_2'],
		'info_3'	=>$data['TXT_3'],
		'status'	=>($data['STATUS']=='Y')?true:false,
		'join_date'	=>$data['FINPUT_DATE']
	);
}
?>