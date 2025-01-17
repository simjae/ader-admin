<?php
/*
 +=============================================================================
 | 
 | 메인 랜딩 관리 - 컨텐츠 상품 등록/삭제
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

$country			= $_POST['country'];
$action_type		= $_POST['action_type'];
$product_idx		= $_POST['product_idx'];

if ($country != null && $action_type != null && $product_idx != null) {
	if ($action_type == "ADD") {
		$insert_product_sql = "
			INSERT INTO
				TMP_CONTENTS_PRODUCT
			(
				COUNTRY,
				DISPLAY_NUM,
				PRODUCT_IDX
			) VALUES (
				'".$country."',
				1,
				'".$product_idx."'
			);
		";
		
		$db->query($insert_product_sql);
		
		$contents_idx = $db->last_id();
		
		if (!empty($contents_idx)) {
			$select_product_sql = "
				SELECT
					IDX		AS CONTENTS_IDX
				FROM
					TMP_CONTENTS_PRODUCT
				WHERE
					IDX != ".$contents_idx." AND
					COUNTRY = '".$country."'
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_product_sql);
			
			$display_num = 2;
			foreach($db->fetch() as $contents_data) {
				$tmp_idx = $contents_data['CONTENTS_IDX'];
				
				$update_product_sql = "
					UPDATE
						TMP_CONTENTS_PRODUCT
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
				TMP_CONTENTS_PRODUCT
			WHERE
				COUNTRY = '".$country."' AND
				PRODUCT_IDX = ".$product_idx."
		";
		
		$db->query($delete_product_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_product_sql = "
				SELECT
					IDX		AS CONTENTS_IDX
				FROM
					TMP_CONTENTS_PRODUCT
				WHERE
					COUNTRY = '".$country."'
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_product_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $contents_data) {
				$tmp_idx = $contents_data['CONTENTS_IDX'];
				
				$update_product_sql = "
					UPDATE
						TMP_CONTENTS_PRODUCT
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

if ($display_num_flg != null && $action_type != null && $recent_idx != null && $recent_num != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql ="
				UPDATE
					TMP_CONTENTS_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num - 1)."
			";
			
			$sql = "
				UPDATE
					TMP_CONTENTS_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql ="
				UPDATE
					TMP_CONTENTS_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num + 1)."
			";
			
			$sql = "
				UPDATE
					TMP_CONTENTS_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx."
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

?>