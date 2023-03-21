<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 페이지 - 스탠바이 복사
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$save_type			= $_POST['save_type'];
$country			= $_POST['country'];

if ($save_type != null ) {
	if ($save_type == "BNR") {
		$db->query("DELETE FROM MAIN_BANNER WHERE COUNTRY = '".$country."'");
		
		$save_main_banner_sql = "
			INSERT INTO
				MAIN_BANNER
			(
				COUNTRY,
				DISPLAY_NUM,
				IMG_LOCATION,
				TITLE,
				SUB_TITLE,
				BACKGROUND_COLOR,
				BTN1_NAME,
				BTN1_URL,
				BTN1_DISPLAY_FLG,
				BTN2_NAME,
				BTN2_URL,
				BTN2_DISPLAY_FLG,
				
				CREATER,
				UPDATER
			)
			SELECT
				TB.COUNTRY				AS COUNTRY,
				TB.DISPLAY_NUM			AS DISPLAY_NUM,
				TB.IMG_LOCATION			AS IMG_LOCATION,
				TB.TITLE				AS TITLE,
				TB.SUB_TITLE			AS SUB_TITLE,
				TB.BACKGROUND_COLOR		AS BACKGROUND_COLOR,
				TB.BTN1_NAME			AS BTN1_NAME,
				TB.BTN1_URL				AS BTN1_URL,
				TB.BTN1_DISPLAY_FLG		AS BTN1_DISPLAY_FLG,
				TB.BTN2_NAME			AS BTN2_NAME,
				TB.BTN2_URL				AS BTN2_URL,
				TB.BTN2_DISPLAY_FLG		AS BTN2_DISPLAY_FLG,
				
				'".$session_id."',
				'".$session_id."'
			FROM
				TMP_MAIN_BANNER TB
			WHERE
				TB.COUNTRY = '".$country."' AND
				TB.DEL_FLG = FALSE
			ORDER BY
				TB.DISPLAY_NUM ASC
		";
		
		$db->query($save_main_banner_sql);
		
	} else if ($save_type == "CNT") {
		$db->query("DELETE FROM MAIN_CONTENTS WHERE COUNTRY = '".$country."'");
		
		$db->query("DELETE FROM CONTENTS_PRODUCT WHERE COUNTRY = '".$country."'");
		
		$save_main_contents_sql = "
			INSERT INTO
				MAIN_CONTENTS
			(
				COUNTRY,
				IMG_LOCATION,
				TITLE,
				SUB_TITLE,
				BACKGROUND_COLOR,
				BTN1_NAME,
				BTN1_DISPLAY_FLG,
				BTN2_NAME,
				BTN2_URL,
				BTN2_DISPLAY_FLG,
				DEL_FLG,
				
				CREATER,
				UPDATER
			)
			SELECT
				TC.COUNTRY				AS COUNTRY,
				TC.IMG_LOCATION			AS IMG_LOCATION,
				TC.TITLE				AS TITLE,
				TC.SUB_TITLE			AS SUB_TITLE,
				TC.BACKGROUND_COLOR		AS BACKGROUND_COLOR,
				TC.BTN1_NAME			AS BTN1_NAME,
				TC.BTN1_DISPLAY_FLG		AS BTN1_DISPLAY_FLG,
				TC.BTN2_NAME			AS BTN2_NAME,
				TC.BTN2_URL				AS BTN2_URL,
				TC.BTN2_DISPLAY_FLG		AS BTN2_DISPLAY_FLG,
				TC.DEL_FLG				AS DEL_FLG,
				
				'".$session_id."'		AS CREATER,
				'".$session_id."'		AS UPDATER
			FROM
				TMP_MAIN_CONTENTS TC
			WHERE
				TC.COUNTRY = '".$country."' AND
				TC.DEL_FLG = FALSE
		";
		
		$db->query($save_main_contents_sql);
		
		$save_contents_product_sql = "
			INSERT INTO
				CONTENTS_PRODUCT
			(
				COUNTRY,
				DISPLAY_NUM,
				PRODUCT_IDX
			)
			SELECT
				CP.COUNTRY			AS COUNTRY,
				CP.DISPLAY_NUM		AS DISPLAY_NUM,
				CP.PRODUCT_IDX		AS PRODUCT_IDX
			FROM
				TMP_CONTENTS_PRODUCT CP
			WHERE
				CP.COUNTRY = '".$country."'
		";
		
		$db->query($save_contents_product_sql);
		
	} else if ($save_type == "IMG") {
		$db->query("DELETE FROM MAIN_IMG WHERE COUNTRY = '".$country."'");
		
		$save_main_img_sql = "
			INSERT INTO
				MAIN_IMG
			(
				COUNTRY,
				DISPLAY_NUM,
				IMG_LOCATION,
				TITLE,
				BTN_NAME,
				BTN_URL,
				BTN_DISPLAY_FLG,
				
				CREATER,
				UPDATER
			)
			SELECT
				TI.COUNTRY				AS COUNTRY,
				TI.DISPLAY_NUM			AS DISPLAY_NUM,
				TI.IMG_LOCATION			AS IMG_LOCATION,
				TI.TITLE				AS TITLE,
				TI.BTN_NAME				AS BTN_NAME,
				TI.BTN_URL				AS BTN_URL,
				TI.BTN_DISPLAY_FLG		AS BTN_DISPLAY_FLG,
				
				'".$session_id."'		AS CREATER,
				'".$session_id."'		AS UPDATER
			FROM
				TMP_MAIN_IMG TI
			WHERE
				TI.COUNTRY = '".$country."' AND
				TI.DEL_FLG = FALSE
			ORDER BY
				TI.DISPLAY_NUM
		";
		
		$db->query($save_main_img_sql);
	}
}
?>