<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$action_type		= $_POST['action_type'];

$option_idx			= $_POST['option_idx'];
$stock_grade		= $_POST['stock_grade'];
$qty_check_type		= $_POST['qty_check_type'];

if ($action_type != null) {
	if ($action_type == 'update') {
		for ($i=0; $i<count($option_idx); $i++) {
			$stock_management = $_POST['stock_management_'.$option_idx[$i]];
			$sold_out_flg = $_POST['sold_out_flg_'.$option_idx[$i]];
			$sql = "UPDATE
						dev.PRODUCT_OPTION
					SET
						STOCK_MANAGEMENT = ".$stock_management.",
						STOCK_GRADE = '".$stock_grade[$i]."',
						QTY_CHECK_TYPE = '".$qty_check_type[$i]."',
						SOLD_OUT_FLG = ".$sold_out_flg."
					WHERE
						IDX = ".$option_idx[$i];
			$db->query($sql);
		}
	} else if ($action_type == 'delete') {
		$sql = "DELETE FROM dev.PRODUCT_OPTION WHERE IDX IN (".implode(',',$option_idx).")";
		$db->query($sql);
	}
}
?>