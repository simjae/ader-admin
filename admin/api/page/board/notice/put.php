<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 조회 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.20
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$session_id				= sessionCheck();
$country				= $_POST['country'];
$display_num_flg		= $_POST['display_num_flg'];
$recent_idx				= $_POST['recent_idx'];
$recent_num				= $_POST['recent_num'];
$action_type			= $_POST['action_type'];

$category               = $_POST['category'];
$title                  = $_POST['title'];
$contents               = $_POST['contents'];
$contents	            = str_replace("<p>&nbsp;</p>","",$contents);

$display_flg            = $_POST['display_flg'];
$display_from           = $_POST['display_from'];
$display_from_h         = $_POST['display_from_h'];
$display_from_m         = $_POST['display_from_m']; 
$display_to             = $_POST['display_to'];
$display_to_h           = $_POST['display_to_h'];
$display_to_m           = $_POST['display_to_m'];
$fix_flg                = $_POST['fix_flg'];

if ($display_num_flg != null && $country != null && $recent_idx != null && $recent_num != null) {
	$prev_sql = "";
	$sql = "";
	switch ($action_type) {
		case "up" :
			$prev_sql ="
				UPDATE
					PAGE_BOARD
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num - 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
					UPDATE
						PAGE_BOARD
					SET
						DISPLAY_NUM = ".intval($recent_num - 1)."
					WHERE
						IDX = ".$recent_idx." AND 
						COUNTRY = '".$country."' AND
						DEL_FLG = FALSE
			";
			break;
		
		case "down" :
			$prev_sql ="
				UPDATE
					PAGE_BOARD
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					PAGE_BOARD
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx." AND
					COUNTRY = '".$country."' AND
					DEL_FLG = FALSE
			";
			break;
	}
	if (strlen($prev_sql) > 0) {
		$db->query($prev_sql);
	}
	
	if (strlen($sql) > 0) {
		$db->query($sql);
	}
}

if($title != null){
    $admin_get_sql = "
        SELECT
            IDX,
            ADMIN_NAME
        FROM 
			ADMIN
        WHERE
            ADMIN_ID = '".$session_id."'
    ";
    $db->query($admin_get_sql);
    $admin_idx = 0;
    $admin_name = '';
    foreach($db->fetch() as $admin_data){
        $admin_idx = $admin_data['IDX'];
        $admin_name = $admin_data['ADMIN_NAME'];
    }

    $display_start_date = "";
    $display_end_date = "";
    if($display_flg != null){
        if ($display_flg == "true") {
            $display_start_date = "NOW()";
            $display_end_date = "'9999-12-31 23:59'";
        } else {
            $display_start_date = "'".$display_from." ".$display_from_h.":".$display_from_m."'";
            $display_end_date = "'".$display_to." ".$display_to_h.":".$display_to_m."'";
        }
    }
    $sql = "
        UPDATE
            PAGE_BOARD BOARD
        SET
            CATEGORY = '".$category."',
            ADMIN_IDX = ".$admin_idx.",
            ADMIN_NAME = '".$admin_name."',
            ADMIN_ID = '".$session_id."',
            IP = '127.0.0.8',
            TITLE = '".$title."',
            CONTENTS = '".$contents."',
            EXPOSURE_START_DATE = ".$display_start_date.",
            EXPOSURE_END_DATE = ".$display_end_date.",
            FIX_FLG = ".$fix_flg.",
            UPDATER = '".$session_id."'
        WHERE
            IDX = ".$board_idx;

    $db->query($sql);
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '필수항목값이 입력되지 않았습니다.';
}
?>