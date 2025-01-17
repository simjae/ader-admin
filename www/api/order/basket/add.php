<?php
/*
 +=============================================================================
 | 
 | 쇼핑백 화면 - 품절 상품 리오더 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.14
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/www/api/common/common.php");
include_once("/var/www/www/api/common/check.php");

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_level = 0;
if (isset($_SESSION['LEVEL_IDX'])) {
	$member_level = $_SESSION['LEVEL_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$add_type = null;
if (isset($_POST['add_type'])) {
	$add_type = $_POST['add_type'];
}

$product_idx = 0;
if (isset($_POST['product_idx'])) {
	$product_idx = $_POST['product_idx'];
}

$option_idx = 0;
if (isset($_POST['option_idx'])) {
	$option_idx = $_POST['option_idx'];
}

$whish_info = array();
if (isset($_POST['whish_info'])) {
	$whish_info = $_POST['whish_info'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해주세요.";
	
	return $json_result;
}

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	
	return $json_result;
}

if ($add_type == "product" && $member_idx > 0 && $country != null && $product_idx > 0 && $option_idx != null) {
	$db->begin_transaction();
	
	try {
		$basket_cnt = 0;
		for ($i=0; $i<count($option_idx); $i++) {
			$tmp_cnt = $db->count("BASKET_INFO","MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND OPTION_IDX = ".$option_idx[$i]." AND DEL_FLG = FALSE ");
			$basket_cnt += $tmp_cnt;
		}
		
		if ($basket_cnt > 0) {
			$json_result['code'] = 401;
			$json_result['msg'] = "이미 쇼핑백에 추가된 상품입니다.";
			
			return $json_result;
		}
		
		$check_result_level = checkProductLevel($db,$member_level,"PRD",$product_idx);
		if ($check_result_level['result'] == false) {
			$json_result['code'] = 401;
			$json_result['msg'] = "현재 회원 등급으로 구매할 수 없는 상품이 선택되었습니다. 쇼핑백에 담으려는 상품을 확인해주세요.";
			
			return $json_result;
		}
		
		for ($i=0; $i<count($option_idx); $i++) {
			$check_result_qty = checkQtyLimit($db,$member_idx,"PRD",$product_idx,$option_idx[$i],1);
			if ($check_result_qty['result'] == false) {
				$json_result['code'] = 401;
				$json_result['msg'] = $check_result_qty['msg'];
				
				return $json_result;
			}
		}
		
		$check_result_id = checkIdReorder($db,$member_idx,"PRD",$product_idx);
		if ($check_result_id['result'] == false) {
			$json_result['code'] = 401;
			$json_result['msg'] = "ID당 1개씩만 구매 가능합니다.";
			
			return $json_result;
		}
		
		for ($i=0; $i<count($option_idx); $i++) {
			//선택 한 상품의 재고가 남아있는지 확인 => 선택한 상품/옵션의 재고 = 전체 상품 재고 - 주문 상품 재고
			$stock_result = checkProductStockQty($db,$product_idx,$option_idx[$i]);
			
			if ($stock_result == true) {
				$insert_basket_sql = "
					INSERT INTO
						BASKET_INFO
					(
						COUNTRY,
						MEMBER_IDX,
						MEMBER_ID,
						PRODUCT_IDX,
						PRODUCT_CODE,
						PRODUCT_NAME,
						OPTION_IDX,
						BARCODE,
						OPTION_NAME,
						PRODUCT_QTY,
						CREATER,
						UPDATER
					)
					SELECT
						'".$country."'		AS COUNTRY,
						".$member_idx."		AS MEMBER_IDX,
						'".$member_id."'	AS MEMBER_ID,
						PR.IDX				AS PRODUCT_IDX,
						PR.PRODUCT_CODE		AS PRODUCT_CODE,
						PR.PRODUCT_NAME		AS PRODUCT_NAME,
						OO.IDX				AS OPTION_IDX,
						OO.BARCODE			AS BARCODE,
						OO.OPTION_NAME		AS OPTION_NAME,
						1					AS PRODUCT_QTY,
						'".$member_id."'	AS CREATER,
						'".$member_id."'	AS UPDATER
					FROM
						SHOP_PRODUCT PR
						LEFT JOIN ORDERSHEET_OPTION OO ON
						PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
					WHERE
						PR.IDX = ".$product_idx." AND
						OO.IDX = ".$option_idx[$i]."
				";
				
				$db->query($insert_basket_sql);
			} else {
				$json_result['code'] = 401;
				$json_result['msg'] = "선택한 상품 중 재고가 모두 소진된 상품이 폼함되어있습니다. 구매하려는 상품의 사이즈를 확인해주세요.";
				
				return $json_result;
			}
		}
		
		$db->commit();
		
		$json_result['code'] = 200;
	} catch(mysqli_sql_exception $exception){
		print_r($exception);
		
		$db->rollback();
		$json_result['code'] = 301;
		
	}
}

if ($add_type == "whish" && $member_idx > 0 && $country != null && count($whish_info) > 0) {
	//해당 멤버의 위시리스트중 선택 한 상품이 존재하는지 확인
	$check_whish_result = checkWhishList($db,$member_idx,$whish_info);
	if ($check_whish_result == false) {
		$json_result['code'] = 301;
		$json_result['msg'] = "이미 위시리스트에 추가 한 상품입니다. 위시리스트의 상품을 확인해주세요.";
		
		return $json_result;
	}
	
	$check_basket_result = checkWhishListDuplicate($db,$member_idx,$whish_info);
	if ($check_basket_result == false) {
		$json_result['code'] = 302;
		$json_result['msg'] = "이미 쇼핑백에 추가된 상품이 포함되어있습니다.";
		
		return $json_result;
	}
	
	for ($i=0; $i<count($whish_info); $i++) {
		$whish_idx = $whish_info[$i]['whish_idx'];
		$option_idx = $whish_info[$i]['option_idx'];
		
		$check_result_level = checkProductLevel($db,$member_level,"WSH",$whish_idx);
		if ($check_result_level['result'] == false) {
			$json_result['code'] = 303;
			$json_result['msg'] = "부적절한 상품이 선택되었습니다. 쇼핑백에 담으려는 상품을 확인해주세요.";
			
			return $json_result;
		}
		for ($j=0; $j<count($option_idx); $j++) {
			$check_result_qty = checkQtyLimit($db,$member_idx,"WSH",$whish_idx,$option_idx[$j],1);
			if ($check_result_qty['result'] == false) {
				$json_result['code'] = 304;
				$json_result['msg'] = $check_result_qty['msg'];
				
				return $json_result;
			}
		}
		
		$check_result_id = checkIdReorder($db,$member_idx,"WSH",$whish_idx);
		if ($check_result_id['result'] == false) {
			$json_result['code'] = 305;
			$json_result['msg'] = "ID당 1개씩만 구매 가능합니다.";
			
			return $json_result;
		}
	}
	
	$stock_result = checkWhishListStockQty($db,$whish_info);
	
	//선택 한 상품의 재고가 남아있는지 확인 => 선택한 상품/옵션의 재고 = 전체 상품 재고 - 주문 상품 재고
	if ($stock_result == true) {
		for ($i=0; $i<count($whish_info); $i++ ) {
			$whish_idx = $whish_info[$i]['whish_idx'];
			$option_idx_arr = $whish_info[$i]['option_idx'];
			
			for ($j=0; $j<count($option_idx_arr); $j++) {
				$insert_basket_sql = "
					INSERT INTO
						BASKET_INFO
					(
						COUNTRY,
						MEMBER_IDX,
						MEMBER_ID,
						PRODUCT_IDX,
						PRODUCT_CODE,
						PRODUCT_NAME,
						OPTION_IDX,
						BARCODE,
						OPTION_NAME,
						PRODUCT_QTY,
						CREATER,
						UPDATER
					)
					SELECT
						'".$country."'		AS COUNTRY,
						".$member_idx."		AS MEMBER_IDX,
						'".$member_id."'	AS MEMBER_ID,
						PR.IDX				AS PRODUCT_IDX,
						PR.PRODUCT_CODE		AS PRODUCT_CODE,
						PR.PRODUCT_NAME		AS PRODUCT_NAME,
						OO.IDX				AS OPTION_IDX,
						OO.BARCODE			AS BARCODE,
						OO.OPTION_NAME		AS OPTION_NAME,
						1					AS PRODUCT_QTY,
						'".$member_id."'	AS CREATER,
						'".$member_id."'	AS UPDATER
					FROM
						WHISH_LIST WL
						LEFT JOIN SHOP_PRODUCT PR ON
						WL.PRODUCT_IDX = PR.IDX
						LEFT JOIN ORDERSHEET_OPTION OO ON
						PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
					WHERE
						WL.IDX = ".$whish_idx." AND
						OO.IDX = ".$option_idx_arr[$j]."
				";
				
				$db->query($insert_basket_sql);
			}
		}
	} else {
		$json_result['code'] = 401;
		$json_result['msg'] = "선택한 상품의 재고가 모두 소진되었습니다. 동일한 상품의 다른 사이즈를 확인해주세요.";
		
		return $json_result;
	}
}

function checkWhishList($db,$member_idx,$whish_info) {
	$check_result = false;
	
	$err_cnt = 0;
	
	for ($i=0; $i<count($whish_info); $i++) {
		$whish_idx = $whish_info[$i]['whish_idx'];
		
		$whish_cnt = $db->count("WHISH_LIST","MEMBER_IDX = ".$member_idx." AND IDX = ".$whish_idx);
		
		if ($whish_cnt == 0) {
			$err_cnt++;
		}
	}
	
	if ($err_cnt == 0) {
		$check_result = true;
	}
	
	return $check_result;
}

function checkWhishListDuplicate($db,$member_idx,$whish_info) {
	$check_result = false;
	
	$err_cnt = 0;
	
	for ($i=0; $i<count($whish_info); $i++) {
		$whish_idx = $whish_info[$i]['whish_idx'];
		$option_idx = $whish_info[$i]['option_idx'];
		
		for ($j=0; $j<count($option_idx); $j++) {
			$check_basket_cnt = $db->count(
				"BASKET_INFO BI",
				"
					BI.MEMBER_IDX = ".$member_idx." AND
					BI.PRODUCT_IDX = (
						SELECT
							PRODUCT_IDX
						FROM
							WHISH_LIST
						WHERE
							IDX = ".$whish_idx."
					) AND
					OPTION_IDX = ".$option_idx[$j]." AND
					BI.DEL_FLG = FALSE
				"
			);
		}
		
		if ($check_basket_cnt > 0) {
			$err_cnt++;
		}
	}
	
	if ($err_cnt == 0) {
		$check_result = true;
	}
	
	return $check_result;
}

function checkWhishListStockQty($db,$whish_info) {
	$stock_result = false;
	
	$sold_out_cnt = 0;
	for ($i=0; $i<count($whish_info); $i++) {
		$whish_idx = $whish_info[$i]['whish_idx'];
		$option_idx_arr = $whish_info[$i]['option_idx'];
		
		for ($j=0; $j<count($option_idx_arr); $j++) {
			$select_stock_sql = "
				SELECT
					(
						SELECT
							IFNULL(SUM(STOCK_QTY),0)
						FROM
							PRODUCT_STOCK S_PS
						WHERE
							S_PS.PRODUCT_IDX = PR.IDX AND
							S_PS.OPTION_IDX = ".$option_idx_arr[$j]." AND
							S_PS.STOCK_DATE <= NOW()
					)	AS STOCK_QTY,
					(
						SELECT
							IFNULL(SUM(S_OP.PRODUCT_QTY),0)
						FROM
							ORDER_PRODUCT S_OP
						WHERE
							S_OP.PRODUCT_IDX = PR.IDX AND
							S_OP.OPTION_IDX = ".$option_idx_arr[$j]." AND
							S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
					)	AS ORDER_QTY
				FROM
					WHISH_LIST WL
					LEFT JOIN SHOP_PRODUCT PR ON
					WL.PRODUCT_IDX = PR.IDX
				WHERE
					WL.IDX = ".$whish_idx."
			";

			$db->query($select_stock_sql);

			$product_qty = 0;
			foreach($db->fetch() as $stock_data) {
				$stock_qty = $stock_data['STOCK_QTY'];
				$order_qty = $stock_data['ORDER_QTY'];
				
				$product_qty = (intval($stock_qty) - intval($order_qty));
			}
			
			if ($product_qty == 0) {
				$sold_out_cnt++;
			}
		}
	}
	
	if ($sold_out_cnt == 0) {
		$stock_result = true;
	}
	
	return $stock_result;
}
?>