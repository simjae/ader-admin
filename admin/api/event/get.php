<?php
/*
 +=============================================================================
 | 
 | 단일 이벤트 정보열람
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$event_idx 			= $_POST['event_idx'];

$sql = "
	SELECT 
		IDX,
		COUNTRY,
		EVENT_TITLE,
		STATUS,
		SDATE,
		EDATE,
		DISPLAY_FLG,
		WINNER_CNT,
		RANDOM_FLG,
		APPLY_PRODUCT_CNT,
		ALARM_FLG,
		EXCEL_PRINT_FLG,
		FINPUT_DATE,
		LINPUT_DATE
	FROM 
		dev.EVENT_INFO INFO
	WHERE 
		IDX = ".$event_idx."
";

$db->query($sql);

foreach($db->fetch() as $data) {
	$date = null;
	if($data['SDATE'] || $data['EDATE']) {
		$date = array(
			'start'=>$data['SDATE'],
			'end'=>$data['EDATE']
		);
	}
	$json_result['data'] = array(
		'idx' 				=> $data['IDX'],
		'country' 			=> $data['COUNTRY'],
		'event_title' 		=> $data['EVENT_TITLE'],
		'status' 			=> $data['STATUS'],
		'sdate'				=> $data['SDATE'],
		'edate'				=> $data['EDATE'],
		'display_flg' 		=> $data['DISPLAY_FLG'],
		'winner_cnt' 		=> $data['WINNER_CNT'],
		'random_flg' 		=> $data['RANDOM_FLG'],
		'apply_product_cnt' => $data['APPLY_PRODUCT_CNT'],
		'alarm_flg' 		=> $data['ALARM_FLG'],
		'excel_print_flg' 	=> $data['EXCEL_PRINT_FLG'],
		'finput_date' 		=> $data['FINPUT_DATE'],
		'linput_date' 		=> $data['LINPUT_DATE']
	);
}
?>