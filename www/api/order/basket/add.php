<?php
/*
 +=============================================================================
 | 
 | 상품 상세 - 장바구니 상품 등록
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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$add_type		= $_POST['add_type'];

$whish_idx		= $_POST['whish_idx'];

$product_idx	= $_POST['product_idx'];
$option_idx		= $_POST['option_idx'];
$product_qty	= $_POST['product_qty'];

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($add_type != null) {
	$sql = "";
	$err_cnt = 0;
	
	if ($add_type == "whish") {
		if ($whish_idx != null) {
			$sql = "INSERT INTO
					dev.BASKET_INFO
				(
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
					".$member_idx."			AS MEMBER_IDX,
					'".$member_id."'		AS MEMBER_ID,
					WL.PRODUCT_IDX			AS PRODUCT_IDX,
					WL.PRODUCT_CODE			AS PRODUCT_CODE,
					WL.PRODUCT_NAME			AS PRODUCT_NAME,
					WL.OPTION_IDX			AS OPTION_IDX,	
					WL.BARCODE				AS BARCODE,
					WL.OPTION_NAME			AS OPTION_NAME,
					".$product_qty."		AS PRODUCT_QTY,
					'".$member_id."'		AS CREATER,
					'".$member_id."'		AS UPDATER
				FROM
					dev.WHISH_LIST WL
				WHERE
					WL.IDX IN (".$whish_idx.")";
			
		} else {
			$err_cnt++;
		}
	} else if ($add_type == "product") {
		if ($product_idx != null && $option_idx != null && product_qty != null) {
			//장바구니 등록 전 동일 상품 중복체크
			$basket_cnt => $db->count("dev.BASKET"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND OPTION_IDX = ".$option_idx);
			
			if ($basket_cnt > 0) {
				$json_result['code'] = 402;
				$json_result['msg'] = "해당 상품은 이미 위시 리스트에 등록된 상품입니다.";
				return $json_result;
			} else {
				$sql = "INSERT INTO
							dev.BASKET_INFO
						(
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
							".$member_idx."		AS MEMBER_IDX,
							'".$member_id."'	AS MEMBER_ID,
							PR.IDX				AS PRODUCT_IDX,
							PR.PRODUCT_CODE		AS PRODUCT_CODE,
							PR.PRODUCT_NAME		AS PRODUCT_NAME,
							OO.IDX				AS OPTION_IDX,	
							OO.BARCODE			AS BARCODE,
							OO.OPTION_NAME		AS OPTION_NAME,
							".$product_qty."	AS PRODUCT_QTY,
							'".$member_id."'	AS CREATER,
							'".$member_id."'	AS UPDATER
						FROM
							dev.SHOP_PRODUCT PR
							LEFT JOIN dev.ORDERSHEET_OPTION OO ON
							PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX AND
							OO.IDX = ".$option_idx."
						WHERE
							PR.IDX = ".$product_idx;
			}
		} else {
			$err_cnt++;
		}
	}
	
	if ($err_cnt > 0) {
		$json_result['code'] = 402;
		$json_result['msg'] = "올바르지 않은 유형의 상품이 선택되었습니다. 장바구니에 담으려는 상품을 다시 선택해 주세요.";
		return $json_result;
	} else {
		$db->query($sql);
	}
}
?>