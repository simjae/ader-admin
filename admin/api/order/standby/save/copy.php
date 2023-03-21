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
$country_from		= $_POST['country_from'];
$country_to			= $_POST['country_to'];

if ($country_from != null && $country_to != null) {
	$db->query("DELETE FROM PAGE_STANDBY WHERE COUNTRY = '".$country_to."'");
	
	$select_tmp_page_standby_sql = "
		SELECT
			PS.IDX			AS STANDBY_IDX
		FROM
			PAGE_STANDBY PS
		WHERE
			PS.COUNTRY = '".$country_from."' AND
			PS.DEL_FLG = FALSE
	";
	
	$db->query($select_tmp_page_standby_sql);
	
	$tmp_standby_idx = array();
	foreach($db->fetch() as $tmp_standby_data) {
		$tmp_standby_idx[] = $tmp_standby_data['STANDBY_IDX'];
	}
	
	for ($i=0; $i<count($tmp_standby_idx); $i++) {
		$copy_page_standby_sql = "
			INSERT INTO
				PAGE_STANDBY
			(
				COUNTRY,
				DISPLAY_NUM,
				MEMBER_LEVEL,
				PRODUCT_IDX,
				PRODUCT_CODE,
				PRODUCT_NAME,
				SALES_PRICE,
				DISPLAY_FLG,
				ENTRY_START_DATE,
				ENTRY_END_DATE,
				PURCHASE_START_DATE,
				PURCHASE_END_DATE
			)
			SELECT
				'".$country_to."'		AS COUNTRY,
				PS.DISPLAY_NUM			AS DISPLAY_NUM,
				PS.MEMBER_LEVEL			AS MEMBER_LEVEL,
				PS.PRODUCT_IDX			AS PRODUCT_IDX,
				PS.PRODUCT_CODE			AS PRODUCT_CODE,
				PS.PRODUCT_NAME			AS PRODUCT_NAME,
				PS.SALES_PRICE			AS SALES_PRICE,
				PS.DISPLAY_FLG			AS DISPLAY_FLG,
				PS.ENTRY_START_DATE		AS ENTRY_START_DATE,
				PS.ENTRY_END_DATE		AS ENTRY_END_DATE,
				PS.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
				PS.PURCHASE_END_DATE	AS PURCHASE_END_DATE
			FROM
				PAGE_STANDBY PS
			WHERE
				PS.COUNTRY = '".$country_from."' AND
				PS.IDX = ".$tmp_standby_idx[$i]."
			ORDER BY
				PS.DISPLAY_NUM ASC
		";
		
		$db->query($copy_page_standby_sql);
		
		$standby_idx = $db->last_id();
		
		if (!empty($standby_idx)) {
			$copy_qty_standby_sql = "
				INSERT INTO
					QTY_STANDBY
				(
					COUNTRY,
					STANDBY_IDX,
					PRODUCT_IDX,
					OPTION_IDX,
					OPTION_NAME,
					BARCODE,
					PRODUCT_QTY
				)
				SELECT
					'".$country_to."'		AS COUNTRY,
					".$standby_idx."		AS STANDBY_IDX,
					QS.PRODUCT_IDX,
					QS.OPTION_IDX,
					QS.OPTION_NAME,
					QS.BARCODE,
					0
				FROM
					QTY_STANDBY QS
				WHERE
					QS.STANDBY_IDX = ".$tmp_standby_idx[$i]." AND
					QS.COUNTRY = '".$country_from."'
			";
			
			$db->query($copy_qty_standby_sql);
		}
	}
}
?>