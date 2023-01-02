<?php
/*
 +=============================================================================
 | 
 | 쇼핑백 화면 - 리오더 상품 추가
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.17
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$country = null;
if (isset[$_POST['country']]) {
	$country = $_POST['country'];
}

$member_idx = 1;
//$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = 'adertest4';
//$member_id = null;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$add_type = $_POST['add_type'];

$basket_idx = 0;
if (isset($_POST['basket_idx'])) {
	$basket_idx = $_POST['basket_idx'];
}

$product_idx = 0;
if (isset($_POST['product_idx'])) {
	$product_idx = $_POST['product_idx'];
}

$option_idx = 0;
if (isset($_POST['option_idx'])) {
	$option_idx = $_POST['option_idx'];
}

if ($country == "" || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "부적절한 방법으로 접근하셨습니다. 사이트 내의 링크를 확인해주세요.";
	return $json_result;
}

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($add_type == "basket") {
	if ($basket_idx != null && $product_idx != null && $option_idx != null) {
		//선택한 상품/옵션이 구매 가능한 상태인지 체크
		$product_result = checkProduct($db,$product_idx,$country,$member_idx);
		
		if ($product_result == true) {
			//선택 한 상품의 재고가 남아있는지 확인 => 선택한 상품/옵션의 재고 = 전체 상품 재고 - 주문 상품 재고
			$stock_result = checkProductStockQty($db,$product_idx,$option_idx);
			
			if ($stock_result == true) {
				$db->begin_transaction();
				
				try {
					$insert_reorder_sql = "
						INSERT INTO
							dev.PRODUCT_REORDER
						(
							MEMBER_IDX,
							MEMBER_ID,
							PRODUCT_IDX,
							PRODUCT_CODE,
							PRODUCT_NAME,
							OPTION_IDX,
							BARCODE,
							OPTION_NAME,
							CREATER,
							UPDATER
						)
						SELECT
							".$member_idx."		AS MEMBER_IDX,
							'".$member_id."'	AS MEMBER_ID,
							PR.IDX				AS PRODUCT_IDX,
							PR.PRODUCT_CODE		AS PRODUCT_CODE,
							PR.PRODUCT_NAME		AS PRODUCT_NAME,
							OO.IDX				AS OPTION_IDX,
							OO.BARCODE			AS BARCODE,
							OO.OPTION_NAME		AS OPTION_NAME,
							'".$member_id."'	AS CREATER,
							'".$member_id."'	AS UPDATER
						FROM
							dev.SHOP_PRODUCT PR
							LEFT JOIN dev.ORDERSHEET_OPTION OO ON
							PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
						WHERE
							PR.IDX = ".$product_idx." AND
							OO.IDX = ".$option_idx."
					";
					
					$db->query($insert_reorder_sql);
					
					$reorder_idx = $db->last_id();
					
					if (!empty($reorder_idx)) {
						$delete_basket_sql = "
							UPDATE
								dev.BASKET_INFO
							SET
								DEL_FLG = TRUE,
								UPDATE_DATE = NOW(),
								UPDATER = '".$member_id."'
							WHERE
								IDX = ".$basket_idx." AND
								MEMBER_IDX = ".$member_id."
						";
						
						$db->query($delete_basket_sql);
						
						$db->commit();
						
						$json_result['code'] = 200;
						return $json_result;
					}
				} catch {
					$db->rollback();
					
					$json_result['code'] = 301;
					$json_result['msg'] = '리오더 상품등록에 실패했습니다.';
					return $json_result;
				}
			} else {
				$json_result['code'] = 401;
				$json_result['msg'] = "선택한 상품의 재고가 모두 소진되었습니다. 동일한 상품의 다른 사이즈를 확인해주세요.";
				return $json_result;
			}
		} else {
			$json_result['code'] = 401;
			$json_result['msg'] = "부적절한 위시리스트 상품이 선택되었습니다. 위시리스트의 상품을 확인해주세요.";
			return $json_result;
		}
	}
}
?>