<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 화면 - 드로우 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.15
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

$member_level			= $_POST['member_level'];
$product_idx			= $_POST['product_idx'];
$sales_price			= $_POST['sales_price'];

$entry_start_date		= $_POST['entry_start_date'];
$entry_end_date			= $_POST['entry_end_date'];
$announce_date			= $_POST['announce_date'];
$purchase_start_date	= $_POST['purchase_start_date'];
$purchase_end_date		= $_POST['purchase_end_date'];

/*
if ($entry_start_date != null) {
	if (isset($_POST['entry_start_time'])) {
		$entry_start_date = "'".$entry_start_date." ".$_POST['entry_start_time'].":00'";
	} else {
		$entry_start_date = "'".$entry_start_date." 00:00'";
	}
}

if ($entry_end_date != null){
	if (isset($_POST['entry_end_time'])) {
		$entry_end_date = "'".$entry_end_date." ".$_POST['entry_end_time'].":00'";
	} else {
		$entry_end_date = "'".$entry_end_date." 00:00'";
	}
}

if ($announce_date != null) {
	if (isset($_POST['announce_time'])) {
		$announce_date = "'".$announce_date." ".$_POST['announce_time'].":00'";
	} else {
		$announce_date = "'".$announce_date." 00:00'";
	}
}

if ($purchase_start_date != null) {
	if (isset($_POST['purchase_start_time'])) {
		$purchase_start_date = "'".$purchase_start_date." ".$_POST['purchase_start_time'].":00'";
	} else {
		$purchase_start_date = "'".$purchase_start_date." 00:00'";
	}
}

if ($purchase_end_date != null) {
	if (isset($_POST['purchase_end_time'])) {
		$purchase_end_date = "'".$purchase_end_date." ".$_POST['purchase_end_time'].":00'";
	} else {
		$purchase_end_date = "'" . $purchase_end_date . " 00:00'";
	}
}
*/
$qty_info				= $_POST['qty_info'];

if ($country != null && $product_idx != null && $qty_info != null) {
	try {
		$insert_draw_sql = "
			INSERT INTO
				PAGE_DRAW
			(
				COUNTRY,
				MEMBER_LEVEL,
				DISPLAY_NUM,
				PRODUCT_IDX,
				PRODUCT_CODE,
				PRODUCT_NAME,
				SALES_PRICE,
				DISPLAY_FLG,
				ENTRY_START_DATE,
				ENTRY_END_DATE,
				ANNOUNCE_DATE,
				PURCHASE_START_DATE,
				PURCHASE_END_DATE,
				CREATER,
				UPDATER
			)
			SELECT
				'".$country."'				AS COUNTRY,
				'".$member_level."'			AS MEMBER_LEVEL,
				1							AS DISPLAY_NUM,
				PR.IDX						AS PRODUCT_IDX,
				PR.PRODUCT_CODE				AS PRODUCT_CODE,
				PR.PRODUCT_NAME				AS PRODUCT_NAME,
				".$sales_price."			AS SALES_PRICE,
				FALSE						AS DISPLAY_FLG,
				STR_TO_DATE('".$entry_start_date."','%Y-%m-%d %H:%i')			AS ENTRY_START_DATE,
				STR_TO_DATE('".$entry_end_date."','%Y-%m-%d %H:%i')			AS ENTRY_END_DATE,
				STR_TO_DATE('".$announce_date."','%Y-%m-%d %H:%i')			AS ANNOUNCE_DATE,
				STR_TO_DATE('".$purchase_start_date."','%Y-%m-%d %H:%i')		AS PURCHASE_START_DATE,
				STR_TO_DATE('".$purchase_end_date."','%Y-%m-%d %H:%i')		AS PURCHASE_END_DATE,
				'".$session_id."',
				'".$session_id."'
			FROM
				SHOP_PRODUCT PR
			WHERE
				PR.IDX = ".$product_idx."
		";
		$db->query($insert_draw_sql);
		
		$draw_idx = $db->last_id();
		
		if (!empty($draw_idx)) {
			$db_result = 0;
			
			for ($i=0; $i<count($qty_info); $i++) {
				if($qty_info[$i][3] == null){
					$qty_info[$i][3] = 0;
				}
				$insert_qty_sql = "
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
					) VALUES (
						'".$country."',
						".$draw_idx.",
						".$product_idx.",
						".$qty_info[$i][0].",
						'".$qty_info[$i][1]."',
						'".$qty_info[$i][2]."',
						".$qty_info[$i][3]."
					)
				";
				
				$db->query($insert_qty_sql);
				
				if (!empty($db->last_id())) {
					$db_result++;
				}
			}
			/*
			if (count($qty_info) != $db_result) {
				$json_result['code'] = 301;
				$json_result['code'] = "드로우 판매수량 등록처리중 오류가 발생했습니다. 등록하려는 상품과 옵션을 확인해주세요.";
				return $json_result;
			}
			*/
			$select_draw_sql = "
				SELECT
					PD.IDX				AS DRAW_IDX
				FROM
					PAGE_DRAW PD
				WHERE
					PD.IDX != ".$draw_idx." AND
					PD.DEL_FLG = FALSE
				ORDER BY
					PD.IDX DESC
			";
			
			$db->query($select_draw_sql);
			
			$display_num = 2;
			foreach($db->fetch() as $draw_data) {
				$tmp_idx = $draw_data['DRAW_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_draw_sql = "
						UPDATE
							PAGE_DRAW
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx."
					";
					
					$db->query($update_draw_sql);
					
					$db_result = $db->affectedRows();
					
					$display_num++;
				}
			}
		}
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "신규 드로우 등록에 실패했습니다.";
	}
}

?>