<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 페이지 - 드로우 복사
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

$country_from		= $_POST['country_from'];
$country_to			= $_POST['country_to'];

if ($country_from != null && $country_to != null) {
	$db->query("DELETE FROM PAGE_DRAW WHERE COUNTRY = '".$country_to."'");
	
	$select_tmp_page_draw_sql = "
		SELECT
			PD.IDX			AS DRAW_IDX
		FROM
			PAGE_DRAW PD
		WHERE
			PD.COUNTRY = '".$country_from."' AND
			PD.DEL_FLG = FALSE
	";
	
	$db->query($select_tmp_page_draw_sql);
	
	$tmp_draw_idx = array();
	foreach($db->fetch() as $tmp_draw_data) {
		$tmp_draw_idx[] = $tmp_draw_data['DRAW_IDX'];
	}
	
	for ($i=0; $i<count($tmp_draw_idx); $i++) {
		$copy_page_draw_sql = "
			INSERT INTO
				PAGE_DRAW
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
				ANNOUNCE_DATE,
				PURCHASE_START_DATE,
				PURCHASE_END_DATE
				CREATER,
				UPDATER
			)
			SELECT
				'".$country_to."'		AS COUNTRY,
				PD.DISPLAY_NUM			AS DISPLAY_NUM,
				PD.MEMBER_LEVEL			AS MEMBER_LEVEL,
				PD.PRODUCT_IDX			AS PRODUCT_IDX,
				PD.PRODUCT_CODE			AS PRODUCT_CODE,
				PD.PRODUCT_NAME			AS PRODUCT_NAME,
				PD.SALES_PRICE			AS SALES_PRICE,
				PD.DISPLAY_FLG			AS DISPLAY_FLG,
				PD.ENTRY_START_DATE		AS ENTRY_START_DATE,
				PD.ENTRY_END_DATE		AS ENTRY_END_DATE,
				PD.ANNOUNCE_DATE		AS ANNOUNCE_DATE,
				PD.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
				PD.PURCHASE_END_DATE	AS PURCHASE_END_DATE,
				'".$session_id."',
				'".$session_id."'
			FROM
				PAGE_DRAW PD
			WHERE
				PD.COUNTRY = '".$country_from."' AND
				PD.IDX = ".$tmp_draw_idx[$i]."
			ORDER BY
				PD.DISPLAY_NUM ASC
		";
		
		$db->query($copy_page_draw_sql);
		
		$draw_idx = $db->last_id();
		
		if (!empty($draw_idx)) {
			$copy_qty_draw_sql = "
				INSERT INTO
					QTY_DRAW
				(
					COUNTRY,
					DRAW_IDX,
					PRODUCT_IDX,
					OPTION_IDX,
					OPTION_NAME,
					BARCODE,
					PRODUCT_QTY
				)
				SELECT
					'".$country_to."'	AS COUNTRY,
					".$draw_idx."		AS DRAW_IDX,
					QD.PRODUCT_IDX,
					QD.OPTION_IDX,
					QD.OPTION_NAME,
					QD.BARCODE,
					0
				FROM
					QTY_DRAW QD
				WHERE
					QD.DRAW_IDX = ".$tmp_draw_idx[$i]." AND
					QD.COUNTRY = '".$country_from."'
			";
			
			$db->query($copy_qty_draw_sql);
		}
	}
}
?>