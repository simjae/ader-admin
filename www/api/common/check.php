<?php
/*
 +=============================================================================
 | 
 | 공통함수 - 조회 및 구매 제한 체크
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

//상품 구매 제한 조건 취득
function getProductInfo($db,$idx_type,$param_idx) {
	if ($idx_type == "PRD") {
		$where = " IDX = ".$param_idx." ";
	} else if ($idx_type == "WSH") {
		$where = "
			IDX = (
				SELECT
					WL.PRODUCT_IDX
				FROM
					dev.WHISH_LIST WL
				WHERE
					WL.IDX = ".$param_idx."
			)
		";
	} else if ($idx_type == "BSK") {
		$where = "
			IDX = (
				SELECT
					BI.PRODUCT_IDX
				FROM
					dev.BASKET_INFO BI
				WHERE
					BI.IDX = ".$param_idx."
			)
		";
	}
	
	$select_product_limit_sql = "
		SELECT
			PR.IDX							AS PRODUCT_IDX,
			PR.LIMIT_MEMBER					AS LIMIT_MEMBER,
			PR.LIMIT_PURCHASE_QTY_FLG		AS LIMIT_PURCHASE_QTY_FLG,
			PR.LIMIT_PRODUCT_QTY			AS LIMIT_PRODUCT_QTY,
			PR.LIMIT_ID_FLG					AS LIMIT_ID_FLG,
			PR.REORDER_CNT					AS REORDER_CNT
		FROM
			dev.SHOP_PRODUCT PR
		WHERE
			".$where."
	";
	
	$db->query($select_product_limit_sql);
	
	$product_info = array();
	foreach($db->fetch() as $product_data) {
		$product_info = array(
			'product_idx'				=>$product_data['PRODUCT_IDX'],
			'limit_member'				=>$product_data['LIMIT_MEMBER'],
			'limit_purchase_qty_flg'	=>$product_data['LIMIT_PURCHASE_QTY_FLG'],
			'limit_product_qty'			=>$product_data['LIMIT_PRODUCT_QTY'],
			'limit_id_flg'				=>$product_data['LIMIT_ID_FLG'],
			'reorder_cnt'				=>$product_data['REORDER_CNT']
		);
	}
	
	return $product_info;
}

//상품별 구매수량 제한
function checkQtyLimit($db,$member_idx,$idx_type,$param_idx,$option_idx,$product_qty) {
	$check_result = array();
	$check_result['result'] = false;
	
	$product_info = getProductInfo($db,$idx_type,$param_idx);
	
	$product_idx = $product_info['product_idx'];
	$limit_flg = $product_info['limit_purchase_qty_flg'];
	$limit_qty = $product_info['limit_product_qty'];
	
	if ($limit_flg == false) {
		$check_result['result'] = true;
	} else if ($limit_flg == true) {
		$select_limit_option_qty_sql = "
			SELECT
				PO.QTY					AS OPTION_QTY
			FROM
				dev.PRODUCT_OPTION PO
			WHERE
				PO.PRODUCT_IDX = ".$product_idx." AND
				PO.OPTION_IDX = ".$option_idx."
		";
		
		$db->query($select_limit_option_qty_sql);
		
		$option_qty = 0;
		foreach($db->fetch() as $option_data) {
			$option_qty = $option_data['OPTION_QTY'];
		}
		
		$basket_qty = 0;
		$select_basket_qty_sql = "
			SELECT
				SUM(BI.PRODUCT_QTY)		AS BASKET_QTY
			FROM
				dev.BASKET_INFO BI
			WHERE
				BI.MEMBER_IDX = ".$member_idx." AND
				BI.PRODUCT_IDX = ".$product_idx." AND
				BI.DEL_FLG = FALSE
		";
		
		$db->query($select_basket_qty_sql);
		
		foreach($db->fetch() as $basket_data) {
			$basket_qty = $basket_data['BASKET_QTY'];
		}
		
		$total_qty = intval($basket_qty + $product_qty);
		
		$check_cnt = 0;
		
		if ($product_qty > $option_qty) {
			$check_result['result'] = false;
			$check_result['msg'] = "해당 사이즈는 ".$option_qty."개까지 구매 가능합니다.";
			
			return $check_result;
		} else {
			$check_cnt++;
		}
		
		if ($product_qty > $limit_qty) {
			$check_result['result'] = false;
			$check_result['msg'] = "해당 상품은 ".$limit_qty."개까지 구매 가능합니다.";
			
			return $check_result;
		} else {
			$check_cnt++;
		}
		
		if ($basket_qty > $limit_qty) {
			$check_result['result'] = false;
			$check_result['msg'] = "해당 상품은 ".$limit_qty."개까지 구매 가능합니다.";
			
			return $check_result;
		} else {
			$check_cnt++;
		}
		
		if ($total_qty > $limit_qty) {
			$check_result['result'] = false;
			$check_result['msg'] = "해당 상품은 ".$limit_qty."개까지 구매 가능합니다.";
			
			return $check_result;
		} else {
			$check_cnt++;
		}
		
		if ($check_cnt == 4) {
			$check_result['result'] = true;
		}
	}
	
	return $check_result;
}

//상품 구매 멤버 제한
function checkProductLevel($db,$member_level,$idx_type,$param_idx) {
	$check_result = array();
	$check_result['result'] = false;
	
	$product_info = getProductInfo($db,$idx_type,$param_idx);
	
	$limit_level = $product_info['limit_member'];
	
	if ($limit_level != "" || $limit_level != null) {
		$limit_level = explode(",",$limit_level);
		
		if (count($limit_level) > 0) {
			if (in_array("0",$limit_level)) {
				$check_result['result'] = true;
			} else {
				if (in_array($member_level,$limit_level)) {
					$check_result['result'] = true;
				}
			}
		}
	}
	
	return $check_result;
}

//상품 진열 페이지 조회 멤버 제한
function checkListLevel($db,$member_level,$page_idx) {
	$check_result = array();
	$check_result['result'] = false;
	
	$select_limit_level_sql = "
		SELECT
			PP.DISPLAY_MEMBER_LEVEL		AS LIMIT_LEVEL
		FROM
			dev.PAGE_PRODUCT PP
		WHERE
			PP.IDX = ".$page_idx."
	";
	
	$db->query($select_limit_level_sql);
	
	$limit_level = array();
	foreach($db->fetch() as $limit_data) {
		if ($limit_data['LIMIT_LEVEL'] != null) {
			$limit_level = explode(",",$limit_data['LIMIT_LEVEL']);
		}
	}
	
	if (count($limit_level) > 0) {
		if (in_array("0",$limit_level)) {
			$check_result['result'] = true;
		} else {
			if (in_array($member_level,$limit_level)) {
				$check_result['result'] = true;
			}
		}
	}
	
	return $check_result;
}

//ID당 구매 수량 제한
function checkIdReorder($db,$member_idx,$idx_type,$param_idx) {
	$check_result = array();
	$check_result['result'] = false;
	
	$product_info = getProductInfo($db,$idx_type,$param_idx);
	
	$product_idx = $product_info['product_idx'];
	$limit_id_flg = $product_info['limit_id_flg'];
	$reorder_cnt = $product_info['reorder_cnt'];
	
	if ($limit_id_flg == true) {
		$order_cnt = $db->count("dev.ORDER_INFO OI LEFT JOIN dev.ORDER_PRODUCT OP ON OI.IDX = OP.ORDER_IDX","OP.REORDER_CNT = ".$reorder_cnt." AND OI.MEMBER_IDX = ".$member_idx." AND OP.PRODUCT_IDX = ".$product_idx." AND OP.ORDER_STATUS = 'PCP' ");
		
		if ($order_cnt == 0) {
			$check_result['result'] = true;
		}
	} else {
		$check_result['result'] = true;
	}
	
	return $check_result;
}

?>