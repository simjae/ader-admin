<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 화면 - 스탠바이 수정
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();
$btn_action_flg			= $_POST['btn_action_flg'];
$display_num_flg		= $_POST['display_num_flg'];
$update_flg				= $_POST['update_flg'];

$country				= $_POST['country'];
$recent_idx				= $_POST['recent_idx'];
$recent_num				= $_POST['recent_num'];
$action_type			= $_POST['action_type'];

$country				= $_POST['country'];
$member_level			= $_POST['member_level'];
$standby_idx			= $_POST['standby_idx'];
$product_idx 			= $_POST['product_idx'];
$sales_price			= $_POST['sales_price'];
$display_flg			= $_POST['display_flg'];
$entry_start_date		= $_POST['entry_start_date'];
$entry_end_date			= $_POST['entry_end_date'];
$purchase_start_date	= $_POST['purchase_start_date'];
$purchase_end_date		= $_POST['purchase_end_date'];

$qty_info			= $_POST['qty_info'];
if($btn_action_flg == true && $country != null && $standby_idx != null){
	$standby_idx_str = '';
	if(is_array($standby_idx)){
		$standby_idx_str = implode(',', $standby_idx);
	}
	else{
		$standby_idx_str = $standby_idx;
	}
	$sql = "
		UPDATE
			PAGE_STANDBY
		SET
			DISPLAY_FLG = 	CASE WHEN
								DISPLAY_FLG = FALSE 
							THEN
								TRUE
							WHEN
								DISPLAY_FLG = TRUE
							THEN
								FALSE
							END
		WHERE
			IDX IN (".$standby_idx_str.")

	";
	$db->query($sql);
}
else if ($display_num_flg != null && $country != null && $recent_idx != null && $recent_num != null) {
	$prev_sql = "";
	$sql = "";
	switch ($action_type) {
		case "up" :
			$prev_sql ="
				UPDATE
					PAGE_STANDBY
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num - 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
					UPDATE
						PAGE_STANDBY
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
					PAGE_STANDBY
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					PAGE_STANDBY
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

if ($update_flg != null && $country != null && $standby_idx != null && $product_idx != null && $qty_info != null) {
	$entry_cnt = $db->count("ENTRY_STANDBY","STANDBY_IDX = ".$standby_idx);
	
	if ($entry_cnt > 0) {
		$json_result['code'] = 401;
		$json_result['msg'] = "현재 참가중인 스탠바이 정보는 수정할 수 없습니다.";
	} else {
		try {
			$update_standby_sql = "
				UPDATE
					PAGE_STANDBY PS,
					(
						 SELECT
							IDX				AS PRODUCT_IDX,
							PRODUCT_CODE	AS PRODUCT_CODE,
							PRODUCT_NAME	AS PRODUCT_NAME
						 FROM
							SHOP_PRODUCT
						 WHERE
							IDX = ".$product_idx."
					) AS TMP
				SET
					PS.MEMBER_LEVEL = '".$member_level."',
					PS.PRODUCT_IDX = TMP.PRODUCT_IDX,
					PS.PRODUCT_CODE = TMP.PRODUCT_CODE,
					PS.PRODUCT_NAME = TMP.PRODUCT_NAME,
					PS.SALES_PRICE = ".$sales_price.",
					PS.DISPLAY_FLG = ".$display_flg.",

					PS.ENTRY_START_DATE = STR_TO_DATE('".$entry_start_date."','%Y-%m-%d %H:%i'),
					PS.ENTRY_END_DATE = STR_TO_DATE('".$entry_end_date."','%Y-%m-%d %H:%i'),
					PS.PURCHASE_START_DATE = STR_TO_DATE('".$purchase_start_date."','%Y-%m-%d %H:%i'),
					PS.PURCHASE_END_DATE = STR_TO_DATE('".$purchase_end_date."','%Y-%m-%d %H:%i'),

					PS.UPDATE_DATE = NOW(),
					PS.UPDATER = '".$session_id."'
				WHERE
					PS.IDX = ".$standby_idx."
			";
			
			$db->query($update_standby_sql);
			
			$standby_db_result = $db->affectedRows();
			
			if ($standby_db_result > 0) {
				$db->query("DELETE FROM QTY_STANDBY WHERE STANDBY_IDX = ".$standby_idx);
				
				$qty_db_result = 0;
				for ($i=0; $i<count($qty_info); $i++) {
					if($qty_info[$i][3] == null){
						$qty_info[$i][3] = 0;
					}
					$insert_qty_sql = "
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
						) VALUES (
							'".$country."',
							".$standby_idx.",
							".$product_idx.",
							".$qty_info[$i][0].",
							'".$qty_info[$i][1]."',
							'".$qty_info[$i][2]."',
							".$qty_info[$i][3]."
						)
					";
					$db->query($insert_qty_sql);
					
					if (!empty($db->last_id())) {
						$qty_db_result++;
					}
				}
				
				if (count($qty_info) != $qty_db_result) {
					$json_result['code'] = 301;
					$json_result['code'] = "스탠바이 판매수량 등록처리중 오류가 발생했습니다. 등록하려는 상품과 옵션을 확인해주세요.";
					return $json_result;
				}
			}
			
			$db->commit();
		} catch(mysqli_sql_exception $exception){
			$db->rollback();
			
			$json_result['code'] = 301;
			$json_result['msg'] = "신규 스탠바이 등록에 실패했습니다.";
		}
	}
}
?>