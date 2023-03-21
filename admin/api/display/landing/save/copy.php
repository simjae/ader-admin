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
$copy_type			= $_POST['copy_type'];
$country_from		= $_POST['country_from'];
$country_to			= $_POST['country_to'];

if ($copy_type != null && $country_from != null && $country_to != null) {
	if ($copy_type == "BNR") {
		$db->query("DELETE FROM TMP_MAIN_BANNER WHERE COUNTRY = '".$country_to."'");
		
		$copy_main_banner_sql = "
			INSERT INTO
				TMP_MAIN_BANNER
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
				'".$country_to."'		AS COUNTRY,
				MB.DISPLAY_NUM			AS DISPLAY_NUM,
				MB.IMG_LOCATION			AS IMG_LOCATION,
				MB.TITLE				AS TITLE,
				MB.SUB_TITLE			AS SUB_TITLE,
				MB.BACKGROUND_COLOR		AS BACKGROUND_COLOR,
				MB.BTN1_NAME			AS BTN1_NAME,
				MB.BTN1_URL				AS BTN1_URL,
				MB.BTN1_DISPLAY_FLG		AS BTN1_DISPLAY_FLG,
				MB.BTN2_NAME			AS BTN2_NAME,
				MB.BTN2_URL				AS BTN2_URL,
				MB.BTN2_DISPLAY_FLG		AS BTN2_DISPLAY_FLG,
				
				'".$session_id."'		AS CREATER,
				'".$session_id."'		AS UPDATER
			FROM
				TMP_MAIN_BANNER MB
			WHERE
				MB.COUNTRY = '".$country_from."' AND
				MB.DEL_FLG = FALSE
			ORDER BY
				MB.DISPLAY_NUM ASC
		";
		
		$db->query($copy_main_banner_sql);
		
	} else if ($copy_type == "CNT") {
		$db->query("DELETE FROM TMP_MAIN_CONTENTS WHERE COUNTRY = '".$country_to."'");
		
		$copy_main_contents_sql = "
			INSERT INTO
				TMP_MAIN_CONTENTS
			(
				COUNTRY,
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
				DEL_FLG,
				
				CREATER,
				UPDATER
			)
			SELECT
				'".$country_to."'		AS COUNTRY,
				MC.IMG_LOCATION			AS IMG_LOCATION,
				MC.TITLE				AS TITLE,
				MC.SUB_TITLE			AS SUB_TITLE,
				MC.BACKGROUND_COLOR		AS BACKGROUND_COLOR,
				MC.BTN1_NAME			AS BTN1_NAME,
				MC.BTN1_URL				AS BTN1_URL,
				MC.BTN1_DISPLAY_FLG		AS BTN1_DISPLAY_FLG,
				MC.BTN2_NAME			AS BTN2_NAME,
				MC.BTN2_URL				AS BTN2_URL,
				MC.BTN2_DISPLAY_FLG		AS BTN2_DISPLAY_FLG,
				MC.DEL_FLG				AS DEL_FLG,
				
				'".$session_id."'		AS CREATER,
				'".$session_id."'		AS UPDATER
			FROM
				TMP_MAIN_CONTENTS MC
			WHERE
				MC.COUNTRY = '".$country_from."' AND
				MC.DEL_FLG = FALSE
		";
		
		$db->query($copy_main_contents_sql);
		
		$copy_contents_product_sql = "
			INSERT INTO
				TMP_CONTENTS_PRODUCT
			(
				COUNTRY,
				DISPLAY_NUM,
				PRODUCT_IDX
			)
			SELECT
				'".$country_to."'	AS COUNTRY,
				CP.DISPLAY_NUM		AS DISPLAY_NUM,
				CP.PRODUCT_IDX		AS PRODUCT_IDX
			FROM
				TMP_CONTENTS_PRODUCT CP
			WHERE
				COUNTRY = '".$country_from."'
			ORDER BY
				CP.DISPLAY_NUM ASC
		";
		
		$db->query($copy_contents_product_sql);
		
	} else if ($copy_type == "IMG") {
		$db->query("DELETE FROM TMP_MAIN_IMG WHERE COUNTRY = '".$country_to."'");
		
		$copy_main_img_sql = "
			INSERT INTO
				TMP_MAIN_IMG
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
				'".$country_to."'		AS COUNTRY,
				MI.DISPLAY_NUM			AS DISPLAY_NUM,
				MI.IMG_LOCATION			AS IMG_LOCATION,
				MI.TITLE				AS TITLE,
				MI.BTN_NAME				AS BTN_NAME,
				MI.BTN_URL				AS BTN_URL,
				MI.BTN_DISPLAY_FLG		AS BTN_DISPLAY_FLG,
				
				'".$session_id."'		AS CREATER,
				'".$session_id."'		AS UPDATER
			FROM
				TMP_MAIN_IMG MI
			WHERE
				MI.COUNTRY = '".$country_from."' AND
				MI.DEL_FLG = FALSE
			ORDER BY
				MI.DISPLAY_NUM
		";
		
		$db->query($copy_main_img_sql);
	}
}
?>