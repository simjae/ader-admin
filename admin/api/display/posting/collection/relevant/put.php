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

$project_idx		= $_POST['project_idx'];
$c_product_idx		= $_POST['c_product_idx'];

$relevant_idx		= $_POST['relevant_idx'];
$soldout_flg		= $_POST['soldout_flg'];
$display_flg		= $_POST['display_flg'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					PROJECT_IDX = ".$project_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx." AND
					DISPLAY_NUM = ".intval($recent_num - 1)."
			";
			
			$sql = "
				UPDATE
					COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx." AND
					PROJECT_IDX = ".$project_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					PROJECT_IDX = ".$project_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx."
			";
			
			$sql = "
				UPDATE
					COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx." AND
					PROJECT_IDX = ".$project_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx."
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

if ($select_flg != null && $action_type != null && $product_idx != null) {
	if ($action_type == "ADD") {
		$insert_relevant_product_sql = "
			INSERT INTO
				COLLECTION_RELEVANT_PRODUCT
			(
				PROJECT_IDX,
				C_PRODUCT_IDX,
				PRODUCT_IDX,
				DISPLAY_NUM
			) VALUES (
				".$project_idx.",
				".$c_product_idx.",
				".$product_idx.",
				1
			);
		";
		
		$db->query($insert_relevant_product_sql);
		
		$relevant_idx = $db->last_id();
		
		if (!empty($relevant_idx)) {
			$select_relevant_product_sql = "
				SELECT
					RP.IDX			AS RELEVANT_IDX
				FROM
					COLLECTION_RELEVANT_PRODUCT RP
				WHERE
					RP.IDX != ".$relevant_idx." AND
					RP.PROJECT_IDX = ".$project_idx." AND
					RP.C_PRODUCT_IDX = ".$c_product_idx."
				ORDER BY
					RP.DISPLAY_NUM ASC
			";
			
			$db->query($select_relevant_product_sql);
			
			$display_num = 2;
			
			foreach($db->fetch() as $relevant_data) {
				$tmp_idx = $relevant_data['RELEVANT_IDX'];
				
				$update_relevant_product_sql = "
					UPDATE
						COLLECTION_RELEVANT_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_relevant_product_sql);
				
				$display_num++;
			}
		}
	} else if ($action_type == "DEL") {
		$delete_relevant_product_sql = "
			DELETE FROM
				COLLECTION_RELEVANT_PRODUCT
			WHERE
				IDX = ".$relevant_idx."
		";
		
		$db->query($delete_relevant_product_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_relevant_product_sql = "
				SELECT
					RP.IDX		AS RELEVANT_IDX
				FROM
					COLLECTION_RELEVANT_PRODUCT RP
				WHERE
					RP.PROJECT_IDX = ".$project_idx." AND
					RP.C_PRODUCT_IDX = ".$c_product_idx."
				ORDER BY
					RP.DISPLAY_NUM ASC
			";
			
			$db->query($select_relevant_product_sql);
			
			$display_num = 1;
			
			foreach($db->fetch() as $relevant_data) {
				$tmp_idx = $relevant_data['RELEVANT_IDX'];
				
				$update_relevant_product_sql = "
					UPDATE
						COLLECTION_RELEVANT_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_relevant_product_sql);
				
				$display_num++;
			}
		}
	}
}

if ($update_flg != null && $relevant_idx != null && $soldout_flg != null && $display_flg != null){
	for ($i=0; $i<count($relevant_idx); $i++) {
		$update_relevant_product_sql = "
			UPDATE
				COLLECTION_RELEVANT_PRODUCT
			SET
				SOLD_OUT_FLG = ".$soldout_flg[$i].",
				DISPLAY_FLG = ".$display_flg[$i]."
			WHERE
				IDX = ".$relevant_idx[$i]."
		";
		
		$db->query($update_relevant_product_sql);
	}
}

?>