<?php
/*
 +=============================================================================
 | 
 | 이벤트 등록
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$country                = $_POST['country'];
$event_title            = $_POST['event_title'];

$event_from             = $_POST['event_from'];
$event_from_h           = $_POST['event_from_h'];
$event_from_m           = $_POST['event_from_m'];
$event_to               = $_POST['event_to'];
$event_to_h             = $_POST['event_to_h'];
$event_to_m             = $_POST['event_to_m'];

$display_flg            = $_POST['display_flg'];
$status                 = $_POST['status'];
$winner_cnt             = $_POST['winner_cnt'];
$random_flg             = $_POST['random_flg'];
$apply_product_cnt      = $_POST['apply_product_cnt'];
$alarm_flg              = $_POST['alarm_flg'];
$excel_print_flg       = $_POST['excel_print_flg'];

$table = " dev.EVENT_INFO ";

$event_start_date = "";
$event_end_date = "";

if($event_flg != null){
	if ($event_flg == "true") {
		$event_start_date = "NOW()";
		$event_end_date = "9999-12-31 23:59";
	} else {
		$event_start_date = "'".$event_from." ".$event_from_h.":".$event_from_m."'";
		$event_end_date = "'".$event_to." ".$event_to_h.":".$event_to_m."'";
	}
}
else{
    $event_start_date = "'".$event_from." ".$event_from_h.":".$event_from_m."'";
	$event_end_date = "'".$event_to." ".$event_to_h.":".$event_to_m."'";
}

$sql = "
	INSERT INTO ".$table." (
		COUNTRY,
		EVENT_TITLE,
		SDATE,
		EDATE,
		DISPLAY_FLG,
		STATUS,
		WINNER_CNT,
		RANDOM_FLG,
		APPLY_PRODUCT_CNT,
		ALARM_FLG,
		EXCEL_PRINT_FLG,
		FINPUT_DATE,
        LINPUT_DATE
	)
	VALUES (
		'".$country."',
		'".$event_title."',
		".$event_start_date.",
		".$event_end_date.",

        ".$display_flg.",
        ".$status.",
        ".$winner_cnt.",
        ".$random_flg.",
        ".$apply_product_cnt.",
        ".$alarm_flg.",
        ".$excel_print_flg.",

		NOW(),
		NOW()
	)";

$db->query($sql);

?>