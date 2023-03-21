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
	$db->query("DELETE FROM PAGE_PREORDER WHERE COUNTRY = '".$country_to."'");
	
	$select_tmp_page_preorder_sql = "
		SELECT
			PP.IDX			AS PREORDER_IDX
		FROM
			PAGE_PREORDER PP
		WHERE
			PP.COUNTRY = '".$country_from."' AND
			PP.DEL_FLG = FALSE
	";
	
	$db->query($select_tmp_page_preorder_sql);
	
	$tmp_preorder_idx = array();
	foreach($db->fetch() as $tmp_preorder_data) {
		$tmp_preorder_idx[] = $tmp_preorder_data['PREORDER_IDX'];
	}
	
	for ($i=0; $i<count($tmp_preorder_idx); $i++) {
		$copy_page_preorder_sql = "
			INSERT INTO
				PAGE_PREORDER
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
				CREATER,
				UPDATER
			)
			SELECT
				'".$country_to."'		AS COUNTRY,
				PP.DISPLAY_NUM			AS DISPLAY_NUM,
				PP.MEMBER_LEVEL			AS MEMBER_LEVEL,
				PP.PRODUCT_IDX			AS PRODUCT_IDX,
				PP.PRODUCT_CODE			AS PRODUCT_CODE,
				PP.PRODUCT_NAME			AS PRODUCT_NAME,
				PP.SALES_PRICE			AS SALES_PRICE,
				PP.DISPLAY_FLG			AS DISPLAY_FLG,
				PP.ENTRY_START_DATE		AS ENTRY_START_DATE,
				PP.ENTRY_END_DATE		AS ENTRY_END_DATE,
				'".$session_id."',
				'".$session_id."'
			FROM
				PAGE_PREORDER PP
			WHERE
				PP.COUNTRY = '".$country_from."' AND
				PP.IDX = ".$tmp_preorder_idx[$i]."
			ORDER BY
				PP.DISPLAY_NUM ASC
		";
		
		$db->query($copy_page_preorder_sql);
		
		$preorder_idx = $db->last_id();
		
		if (!empty($preorder_idx)) {
			$copy_qty_preorder_sql = "
				INSERT INTO
					QTY_PREORDER
				(
					COUNTRY,
					PREORDER_IDX,
					PRODUCT_IDX,
					OPTION_IDX,
					OPTION_NAME,
					BARCODE,
					PRODUCT_QTY
				)
				SELECT
					'".$country_to."'		AS COUNTRY,
					".$preorder_idx."		AS PREORDER_IDX,
					QP.PRODUCT_IDX			AS PRODUCT_IDX,
					QP.OPTION_IDX			AS OPTION_IDX,
					QP.OPTION_NAME			AS OPTION_NAME,
					QP.BARCODE				AS BARCODE,
					0
				FROM
					QTY_PREORDER QP
				WHERE
					QP.PREORDER_IDX = ".$tmp_preorder_idx[$i]." AND
					QP.COUNTRY = '".$country_from."'
			";
			
			$db->query($copy_qty_preorder_sql);
		}
	}
}
?>