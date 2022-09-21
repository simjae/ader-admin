<?php
/*
 +=============================================================================
 | 
 | 공지사항 등록 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$country            = $_POST['country'];
$category           = $_POST['category'];
$title              = $_POST['title'];
$contents           = $_POST['contents'];
$contents	        = str_replace("<p>&nbsp;</p>","",$contents);

$display_flg        = $_POST['display_flg'];
$display_from       = $_POST['display_from'];
$display_from_h     = $_POST['display_from_h'];
$display_from_m     = $_POST['display_from_m'];
$display_to         = $_POST['display_to'];
$display_to_h       = $_POST['display_to_h'];
$display_to_m       = $_POST['display_to_m'];
$fix_flg            = $_POST['fix_flg'];

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

if($title != null){
    $sql = "
            INSERT dev.DISPLAY_BOARD(
                COUNTRY,
                BOARD_TYPE,
                CATEGORY,
                MEMBER_NAME,
                IP,
                TITLE,
                CONTENTS,
                EXPOSURE_FLG,
                EXPOSURE_START_DATE,
                EXPOSURE_END_DATE,
                FIX_FLG,
                CREATER,
                UPDATER
            )
            VALUES(
                '".$country."',
                'NOT',
                '".$category."',
                '홍길동',
                '127.0.0.8',
                '".$title."',
                '".$contents."',
                true,
                ".$display_start_date.",
                ".$display_end_date.",
                ".$fix_flg.",
                'Admin',
                'Admin'
            ) 
    ";
    $db->query($sql);
}
else{
    $code = 500;
}


?>