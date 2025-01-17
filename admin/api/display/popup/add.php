<?php
/*
 +=============================================================================
 | 
 | 팝업 등록
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$web_idx            = $_POST['web_idx'];			//웹 idx
$product_idx        = $_POST['product_idx'];		//상품 idx

$country            = $_POST['country'];			//국가
$title              = $_POST['title'];			    //페이지 타이틀
$contents		    = $_POST['contents'];		    //페이지 내용
$contents		    = str_replace("<p>&nbsp;</p>","",$contents);

$display_date     	    = $_POST['display_date'];
$display_start_date     = $_POST['display_start_date'];
$display_end_date       = $_POST['display_end_date'];

$close_flg	        = $_POST['close_flg'];
$align		        = $_POST['align'];
$location_height	= $_POST['location_height'];
$location_width		= $_POST['location_width'];
$size_width			= $_POST['size_width'];
$size_height	    = $_POST['size_height'];

$table = " DISPLAY_POPUP ";

if ($web_idx != null) {
	$web_idx_list = implode(',',$web_idx);
}
if ($product_idx != null) {
	$product_idx_list = implode(',',$product_idx);
}

if($display_date != null){
	if ($display_date == "true") {
		$display_start_date = "NOW()";
		$display_end_date = "'9999-12-31 23:59'";
	} else {
		$display_start_date = 'STR_TO_DATE("'.$display_start_date.'","%Y-%m-%d %H:%i")';
		$display_end_date = 'STR_TO_DATE("'.$display_end_date.'","%Y-%m-%d %H:%i")';
	}
}
$db->begin_transaction();
try {
    $sql = "
        INSERT INTO ".$table." (
            COUNTRY,
            TITLE,
            CONTENTS,
            CE,
            DISPLAY_START_DATE,
            DISPLAY_END_DATE,

            LOCATION_WIDTH,
            LOCATION_HEIGHT,
            SIZE_WIDTH,
            SIZE_HEIGHT,
            POPUP_TYPE,
            ALIGN,
            CLOSE_FLG,
            CREATER,
            UPDATER
        )
        VALUES (
            '".$country."',
            '".$title."',
            '".$contents."',
            '".$ce."',
            ".$display_start_date.",
            ".$display_end_date.",

            ".$location_width.",
            ".$location_height.",
            ".$size_width.",
            ".$size_height.",
            '".$popup_type."',
            '".$align."',
            '".$close_flg."',

            '".$session_id."',
            '".$session_id."'
        )";
    $db->query($sql);
    $popup_idx = $db->last_id();

    if ($popup_idx != null) {
        if ($web_idx != null && count($web_idx) > 0) {
            $web_sql = "
                INSERT INTO POPUP_URL (
                    POPUP_IDX,
                    FRONT_IDX,
                    POPUP_URL_TYPE,
                    PAGE_TITLE,
                    URL,
                    CREATER,
                    UPDATER
                )
                SELECT
                    ".$popup_idx.",
                    IDX,
                    'WEB',
                    PAGE_TITLE,
                    PAGE_URL,
                    '".$session_id."',
                    '".$session_id."'
                FROM
                    FRONT_PAGE_URL
                WHERE
                    IDX IN (".$web_idx_list.")";
            $db->query($web_sql);
        }

        if ($product_idx != null && count($product_idx) > 0) {
            $product_sql = "
                INSERT INTO POPUP_URL (
                    POPUP_IDX,
                    PRODUCT_IDX,
                    POPUP_URL_TYPE,
                    PRODUCT_CODE,
                    PRODUCT_NAME,
                    URL,
                    CREATER,
                    UPDATER
                )
                SELECT
                    ".$popup_idx."		AS POPUP_IDX,
                    IDX					AS PRODUCT_IDX,
                    'PRODUCT'			AS POPUP_URL_TYPE,
                    PRODUCT_CODE		AS PRODUCT_CODE,
                    PRODUCT_NAME		AS PRODUCT_NAME,
                    CONCAT(
                        '/test/product/detail?product_idx=',
                        IDX
                    )					AS URL,
                    '".$session_id."'	AS CREATER,
                    '".$session_id."'	AS UPDATER
                FROM
                    SHOP_PRODUCT
                WHERE
                    IDX IN (".$product_idx_list.")";
            
            $db->query($product_sql);
            
        }
    }
    else{
        $db->rollback();
        $json_result['code'] = 301;
        $json_result['msg'] = '팝업 생성에 실패했습니다.';
        return $json_result;
    }
    $db->commit();
}
catch(mysqli_sql_exception $exception){
    $json_result['code'] = 301;
    $db->rollback();
    $json_result['msg'] = '팝업 등록작업이 실패했습니다.';
    return $json_result;
}

?>