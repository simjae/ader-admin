<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$option_idx		= $_POST['option_idx'];

$set = "";
$stock_management	= $_POST['stock_management'];
if ($stock_management != null) {
	$set .= " STOCK_MANAGEMENT = ".$stock_management.", ";
}

$stock_grade		= $_POST['stock_grade'];
if ($stock_grade != null) {
	$set .= " STOCK_GRADE = '".$stock_grade."', ";
}

$qty_check_type		= $_POST['qty_check_type'];
if ($qty_check_type != null) {
	$set .= " QTY_CHECK_TYPE = '".$qty_check_type."', ";
}

$sold_out_flg		= $_POST['sold_out_flg'];
if ($sold_out_flg != null) {
	$set .= " SOLD_OUT_FLG = ".$sold_out_flg." ";
}

//검색 유형 - 디폴트
$where = " 1=1 ";
if ($option_idx != null) {
	$where .= " AND (IDX IN (".$option_idx.")) ";
}
//검색 유형 - 상품 IDX

$sql = "UPDATE
			dev.PRODUCT_OPTION
		SET
			".$set."
		WHERE
			".$where;

$db->query($sql);
?>