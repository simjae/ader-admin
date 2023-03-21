<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 이미지 관련상품 수정
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$display_num_flg	= $_POST['display_num_flg'];

$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$page_idx			= $_POST['page_idx'];
$product_idx		= $_POST['product_idx'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					EDITORIAL_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					PAGE_IDX = ".$page_idx." AND
					DISPLAY_NUM = ".intval($recent_num - 1)."
			";
			
			$sql = "
				UPDATE
					EDITORIAL_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx." AND
					PAGE_IDX = ".$page_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					EDITORIAL_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					PAGE_IDX = ".$page_idx."
			";
			
			$sql = "
				UPDATE
					EDITORIAL_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx." AND
					PAGE_IDX = ".$page_idx."
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

if ($select_flg != null && $action_type != null && $page_idx != null && $product_idx != null) {
	if ($action_type == "ADD") {
		$insert_editorial_product_sql = "
			INSERT INTO
				EDITORIAL_PRODUCT
			(
				PAGE_IDX,
				PRODUCT_IDX,
				DISPLAY_NUM
			) VALUES (
				".$page_idx.",
				".$product_idx.",
				1
			);
		";
		
		$db->query($insert_editorial_product_sql);
		
		$e_product_idx = $db->last_id();
		
		if (!empty($e_product_idx)) {
			$update_editorial_product_sql = "
				UPDATE
					EDITORIAL_PRODUCT
				SET
					DISPLAY_NUM = DISPLAY_NUM + 1
				WHERE
					IDX != ".$e_product_idx."
			";
			
			$db->query($update_editorial_product_sql);
		}
	} else if ($action_type == "DEL") {
		$delete_editorial_product_sql = "
			DELETE FROM
				EDITORIAL_PRODUCT
			WHERE
				PAGE_IDX = ".$page_idx." AND
				PRODUCT_IDX = ".$product_idx."
		";
		
		$db->query($delete_editorial_product_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_editorial_product_sql = "
				SELECT
					EP.IDX		AS E_PRODUCT_IDX
				FROM
					EDITORIAL_PRODUCT EP
				WHERE
					EP.PAGE_IDX = ".$page_idx."
				ORDER BY
					EP.DISPLAY_NUM ASC
			";
			
			$db->query($select_editorial_product_sql);
			
			$display_num = 1;
			
			foreach($db->fetch() as $product_data) {
				$tmp_idx = $product_data['E_PRODUCT_IDX'];
				
				$update_editorial_product_sql = "
					UPDATE
						EDITORIAL_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_editorial_product_sql);
				
				$display_num++;
			}
		}
	}
}
?>