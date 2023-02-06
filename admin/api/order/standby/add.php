<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 화면 - 스탠바이 등록
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

$country				= $_POST['country'];

$member_level			= $_POST['member_level'];
$product_idx			= $_POST['product_idx'];
$sales_price			= $_POST['sales_price'];
$entry_start_date		= $_POST['entry_start_date'];
$entry_end_date			= $_POST['entry_end_date'];
$purchase_start_date	= $_POST['purchase_start_date'];
$purchase_end_date		= $_POST['purchase_end_date'];

$qty_info				= $_POST['qty_info'];

if ($country != null && $product_idx != null && $qty_info != null) {
	try {
		$insert_standby_sql = "
			INSERT INTO
				dev.PAGE_STANDBY
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
				STR_TO_DATE('".$entry_start_date."','%Y%m%d%H%i%s')			AS ENTRY_START_DATE,
				STR_TO_DATE('".$entry_end_date."','%Y%m%d%H%i%s')			AS ENTRY_END_DATE,
				STR_TO_DATE('".$purchase_start_date."','%Y%m%d%H%i%s')		AS PURCHASE_START_DATE,
				STR_TO_DATE('".$purchase_end_date."','%Y%m%d%H%i%s')		AS PURCHASE_END_DATE,
				'Admin',
				'Admin'
			FROM
				dev.SHOP_PRODUCT PR
			WHERE
				PR.IDX = ".$product_idx."
		";
		
		$db->query($insert_standby_sql);
		
		$standby_idx = $db->last_id();
		
		if (!empty($standby_idx)) {
			$db_result = 0;
			
			for ($i=0; $i<count($qty_info); $i++) {
				if($qty_info[$i][3] == null){
					$qty_info[$i][3] = 0;
				}
				if($qty_info[$i][3] > 0){
					$insert_qty_sql = "
						INSERT INTO
							dev.QTY_STANDBY
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
						$db_result++;
					}
				}
			}

			/* 
				옵션 갯수와 실제 입력한 판매수량이 다를경우, 밑 조건에 해당이 되지 않으나 
				정상실행이라 판단하여 주석처리함
			*/
			/*
			if (count($qty_info) != $db_result) {
				$json_result['code'] = 301;
				$json_result['msg'] = "스탠바이 판매수량 등록처리중 오류가 발생했습니다. 등록하려는 상품과 옵션을 확인해주세요.";
				return $json_result;
			}
			*/
			$select_standby_sql = "
				SELECT
					PS.IDX				AS STANDBY_IDX
				FROM
					dev.PAGE_STANDBY PS
				WHERE
					PS.IDX != ".$standby_idx." AND
					PS.DEL_FLG = FALSE
				ORDER BY
					PS.IDX DESC
			";
			
			$db->query($select_standby_sql);
			
			$display_num = 2;
			foreach($db->fetch() as $standby_data) {
				$tmp_idx = $standby_data['STANDBY_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_standby_sql = "
						UPDATE
							dev.PAGE_STANDBY
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx."
					";
					
					$db->query($update_standby_sql);
					
					$display_num++;
				}
			}
		}
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "신규 스탠바이 등록에 실패했습니다.";
	}
}

?>