<?php
/*
 +=============================================================================
 | 
 | 프리오더 관리 화면 - 프리오더 등록
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

$session_id			= sessionCheck();
$country			= $_POST['country'];

$member_level		= $_POST['member_level'];
$product_idx		= $_POST['product_idx'];
$sales_price		= $_POST['sales_price'];

$entry_start_date	= $_POST['entry_start_date'];
$entry_end_date		= $_POST['entry_end_date'];

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
		$entry_end_date = "'" . $entry_end_date . " 00:00'";
	}
}
*/
$qty_info			= $_POST['qty_info'];

if ($country != null && $product_idx != null && $qty_info != null) {
	try {
		$insert_preorder_sql = "
			INSERT INTO
				PAGE_PREORDER
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
				CREATER,
				UPDATER
			)
			SELECT
				'".$country."'			AS COUNTRY,
				'".$member_level."'		AS MEMBER_LEVEL,
				1						AS DISPLAY_NUM,
				PR.IDX					AS PRODUCT_IDX,
				PR.PRODUCT_CODE			AS PRODUCT_CODE,
				PR.PRODUCT_NAME			AS PRODUCT_NAME,
				".$sales_price."		AS SALES_PRICE,
				FALSE					AS DISPLAY_FLG,
				STR_TO_DATE('".$entry_start_date."','%Y-%m-%d %H:%i')		AS ENTRY_START_DATE,
				STR_TO_DATE('".$entry_end_date."','%Y-%m-%d %H:%i')			AS ENTRY_END_DATE,
				'".$session_id."',
				'".$session_id."'
			FROM
				SHOP_PRODUCT PR
			WHERE
				PR.IDX = ".$product_idx."
		";
		$db->query($insert_preorder_sql);
		
		$preorder_idx = $db->last_id();
		
		if (!empty($preorder_idx)) {
			$db_result = 0;
			for ($i=0; $i<count($qty_info); $i++) {
				if($qty_info[$i][3] == null){
					$qty_info[$i][3] = 0;
				}
				if($qty_info[$i][4] == null){
					$qty_info[$i][4] = 0;
				}
				$insert_qty_sql = "
					INSERT INTO
						QTY_PREORDER
					(
						COUNTRY,
						PREORDER_IDX,
						PRODUCT_IDX,
						OPTION_IDX,
						OPTION_NAME,
						BARCODE,
						PRODUCT_QTY,
						PRODUCT_QTY_LIMIT
					) VALUES (
						'".$country."',
						".$preorder_idx.",
						".$product_idx.",
						".$qty_info[$i][0].",
						'".$qty_info[$i][1]."',
						'".$qty_info[$i][2]."',
						".$qty_info[$i][3].",
						".$qty_info[$i][4]."
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
				$json_result['code'] = "프리오더 판매수량 등록처리중 오류가 발생했습니다. 등록하려는 상품과 옵션을 확인해주세요.";
				return $json_result;
			}
			*/
			$select_preorder_sql = "
				SELECT
					PP.IDX				AS PREORDER_IDX
				FROM
					PAGE_PREORDER PP
				WHERE
					PP.IDX != ".$preorder_idx." AND
					PP.DEL_FLG = FALSE
				ORDER BY
					PP.IDX DESC
			";
			
			$db->query($select_preorder_sql);
			
			$display_num = 2;
			foreach($db->fetch() as $preorder_data) {
				$tmp_idx = $preorder_data['PREORDER_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_preorder_sql = "
						UPDATE
							PAGE_PREORDER
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx."
					";
					
					$db->query($update_preorder_sql);
					
					$display_num++;
				}
			}
		}
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "신규 프리오더 등록에 실패했습니다.";
	}
}

?>