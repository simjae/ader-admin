<?php
$search_type        = $_POST['search_type'];        	//검색 타입
$search_keyword     = $_POST['search_keyword']; 		//검색 키워드
$eventStatus        = $_POST['eventStatus'];        	//검색 타입

$search_date        = $_POST['search_date'];            
$event_create_from  = $_POST['event_create_from'];        	//등록일 검색 시작일자
$event_create_to    = $_POST['event_create_to'];        	//등록일 검색 종료일자

$rows 				= $_POST['rows'];
$page 				= $_POST['page'];
$sort_value 		= $_POST['sort_value'];
$sort_type 			= $_POST['sort_type'];

$where = '  DEL_FLG = FALSE';
$tables =  '(SELECT 
				EVENT_INFO.IDX,
				EVENT_INFO.EVENT_TITLE,
				EVENT_INFO.SDATE,
				EVENT_INFO.EDATE,
				EVENT_INFO.FINPUT_DATE,
				EVENT_INFO.DEL_FLG,
				IF(EVENT.EVENT_NO IS NULL, 0, COUNT(0)) AS CNT,
				EVENT_INFO.EXCEL_PRINT_FLG
			FROM
				dev.EVENT_INFO	AS EVENT_INFO 	LEFT JOIN
				dev.EVENT		AS EVENT
			ON	
				EVENT_INFO.IDX = EVENT.EVENT_NO
			GROUP BY 
				EVENT_INFO.IDX ) AS EVENT_CNT_INFO';

if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "event_title" :
			$where .=  " AND EVENT_TITLE LIKE '%".$search_keyword."%' ";
			break;
	}
}

if ($eventStatus != null) {
	if($eventStatus == 'true'){
		$where .= " AND NOW() BETWEEN SDATE AND EDATE ";
	}
	else{
		$where .= " AND (EDATE < NOW() 
					OR  (SDATE IS NULL AND EDATE IS NULL))";
	}
}

if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= " AND CURDATE() BETWEEN SDATE AND EDATE ";
			break;
		case "01d" :
			$where .= " AND (CURDATE()-INTERVAL 1 DAY) BETWEEN SDATE AND EDATE ";
			break;
		case "03d" :
			$where .= " AND (CURDATE()-INTERVAL 3 DAY) BETWEEN SDATE AND EDATE ";
			break;
		case "07d" :
			$where .= " AND (CURDATE()-INTERVAL 7 DAY) BETWEEN SDATE AND EDATE ";
			break;
		case "15d" :
			$where .= " AND (CURDATE()-INTERVAL 15 DAY) BETWEEN SDATE AND EDATE ";
			break;
		case "01m" :
			$where .= " AND (CURDATE()-INTERVAL 1 MONTH) BETWEEN SDATE AND EDATE ";
			break;
		case "03m" :
			$where .= " AND (CURDATE()-INTERVAL 3 MONTH) BETWEEN SDATE AND EDATE ";
			break;
	}
}
if ($event_create_from != null && $event_create_to != null) {
	$where .= " AND SDATE < '".$event_create_from."'
				AND EDATE > '".$event_create_to."' ";
}

$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => intval($page)
);
$total = $json_result['total'];
$limit_start = (intval($page)-1)*$rows;

/** 정렬 조건 **/
if ($sort_value != null && $sort_type != null) {
	$order = " ORDER BY ".$sort_value." ".$sort_type.", ";
	$order .= " IDX DESC ";
}

$limit = " LIMIT ".$limit_start.",".$rows;

$sql = "
	SELECT 
		IDX,
		EVENT_TITLE,
		SDATE,
		EDATE,
		FINPUT_DATE,
		CNT,
		EXCEL_PRINT_FLG
	FROM 
		".$tables."
	WHERE 
		".$where."
	".$order."
	".$limit;
$db->query($sql);

foreach($db->fetch() as $data) {
	$date = null;
	if($data['SDATE'] || $data['EDATE']) {
		$date = array(
			'start'=>$data['SDATE'],
			'end'=>$data['EDATE']
		);
	}
	$json_result['data'][] = array(
		'num'				=>$total--,
		'idx'				=>intval($data['IDX']),
		'event_title'		=>$data['EVENT_TITLE'],
		'count'				=>intval($data['CNT']),
		'reg_date'			=>$data['FINPUT_DATE'],
		'excel_print_flg'	=>$data['EXCEL_PRINT_FLG'],
		'date'				=>$date
	);
}
?>