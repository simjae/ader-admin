<?php
/*
 +=============================================================================
 | 
 | 콜라보레이션 관리 페이지 - 콜라보레이션 상품 추가/삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.20
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$action_type		= $_POST['action_type'];
$collaboration_idx	= $_POST['collaboration_idx'];
$product_idx		= $_POST['product_idx'];

if ($display_num_flg != null && $action_type != null && $recent_idx != null && $recent_num != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					COLLABORATION_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num - 1)." AND
					COLLABORATION_IDX = ".$collaboration_idx."
			";
			
			$sql = "
				UPDATE
					COLLABORATION_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx." AND
					COLLABORATION_IDX = ".$collaboration_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					COLLABORATION_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					COLLABORATION_IDX = ".$collaboration_idx."
			";
			
			$sql = "
				UPDATE
					COLLABORATION_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx." AND
					COLLABORATION_IDX = ".$collaboration_idx."
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

if ($collaboration_idx != null && $action_type != null && $product_idx != null) {
	if ($action_type == "ADD") {
		$insert_product_sql = "
			INSERT INTO
				COLLABORATION_PRODUCT
			(
				DISPLAY_NUM,
				COLLABORATION_IDX,
				PRODUCT_IDX
			) VALUES (
				1,
				'".$collaboration_idx."',
				'".$product_idx."'
			);
		";
		
		$db->query($insert_product_sql);
		
		$collabo_product_idx = $db->last_id();
		
		if (!empty($collabo_product_idx)) {
			$select_product_sql = "
				SELECT
					CP.IDX		AS COLLABO_PRODUCT_IDX
				FROM
					COLLABORATION_PRODUCT CP
				WHERE
					CP.IDX != ".$collabo_product_idx." AND
					CP.COLLABORATION_IDX = ".$collaboration_idx."
				ORDER BY
					CP.DISPLAY_NUM ASC
			";
			
			$db->query($select_product_sql);
			
			$display_num = 2;
			foreach($db->fetch() as $product_data) {
				$tmp_idx = $product_data['COLLABO_PRODUCT_IDX'];
				
				$update_product_sql = "
					UPDATE
						COLLABORATION_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_product_sql);
				
				$display_num++;
			}
		}
	} else if ($action_type == "DEL") {
		$delete_product_sql = "
			DELETE FROM
				COLLABORATION_PRODUCT
			WHERE
				COLLABORATION_IDX = ".$collaboration_idx." AND
				PRODUCT_IDX = ".$product_idx."
		";
		
		$db->query($delete_product_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_product_sql = "
				SELECT
					CP.IDX			AS COLLABO_PRODUCT_IDX
				FROM
					COLLABORATION_PRODUCT CP
				WHERE
					CP.COLLABORATION_IDX = ".$collaboration_idx."
				ORDER BY
					CP.DISPLAY_NUM ASC
			";
			
			$db->query($select_product_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $product_data) {
				$tmp_idx = $product_data['COLLABO_PRODUCT_IDX'];
				
				$update_product_sql = "
					UPDATE
						COLLABORATION_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_product_sql);
				
				$display_num++;
			}
		}
	}
}

?>