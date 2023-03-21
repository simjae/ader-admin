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

$event_always			= $_POST['event_always'];
$sdate             		= $_POST['sdate'];
$edate           		= $_POST['edate'];

$display_flg            = $_POST['display_flg'];
$status                 = $_POST['status'];
$winner_cnt             = $_POST['winner_cnt'];
$random_flg             = $_POST['random_flg'];
$apply_product_cnt      = $_POST['apply_product_cnt'];
$alarm_flg              = $_POST['alarm_flg'];
$excel_print_flg        = $_POST['excel_print_flg'];

$table = " dev.EVENT_INFO ";

$event_start_date = "";
$event_end_date = "";

if ($event_always == "true") {
	$sdate = "NOW()";
	$edate = "'9999-12-31 23:59'";
} else {
	$sdate = 'STR_TO_DATE("'.$sdate.'","%Y-%m-%d %H:%i")';
	$edate = 'STR_TO_DATE("'.$edate.'","%Y-%m-%d %H:%i")';
}

$winner_cnt_str = 'NULL';
if($winner_cnt != null){
	$winner_cnt_str = $winner_cnt;
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
		".$sdate.",
		".$edate.",

        ".$display_flg.",
        '".$status."',
        ".$winner_cnt_str.",
        ".$random_flg.",
        ".$apply_product_cnt.",
        ".$alarm_flg.",
        ".$excel_print_flg.",

		NOW(),
		NOW()
	)";

$db->query($sql);

?>