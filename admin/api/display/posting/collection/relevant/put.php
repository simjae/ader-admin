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

$country			= $_POST['country'];
$collection_idx		= $_POST['collection_idx'];
$c_product_idx		= $_POST['c_product_idx'];

$relevant_idx		= $_POST['relevant_idx'];
$sold_out_flg		= $_POST['sold_out_flg'];
$display_flg		= $_POST['display_flg'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					dev.COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					COLLECTION_IDX = ".$collection_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx." AND
					DISPLAY_NUM = ".intval($recent_num - 1)."
			";
			
			$sql = "
				UPDATE
					dev.COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx." AND
					COUNTRY = '".$country."' AND
					COLLECTION_IDX = ".$collection_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					dev.COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					COLLECTION_IDX = ".$collection_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx."
			";
			
			$sql = "
				UPDATE
					dev.COLLECTION_RELEVANT_PRODUCT
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx." AND
					COUNTRY = '".$country."' AND
					COLLECTION_IDX = ".$collection_idx." AND
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

if ($country != null && $action_type != null && $product_idx != null) {
	if ($action_type == "ADD") {
		$insert_relevant_sql = "
			INSERT INTO
				dev.COLLECTION_RELEVANT_PRODUCT
			(
				DISPLAY_NUM,
				COUNTRY,
				COLLECTION_IDX,
				C_PRODUCT_IDX,
				PRODUCT_IDX
			) VALUES (
				1,
				'".$country."',
				'".$collection_idx."',
				'".$c_product_idx."',
				'".$product_idx."'
			);
		";
		
		$db->query($insert_relevant_sql);
		
		$relevant_idx = $db->last_id();
		
		if (!empty($relevant_idx)) {
			$select_relevant_sql = "
				SELECT
					IDX			AS RELEVANT_IDX
				FROM
					dev.COLLECTION_RELEVANT_PRODUCT
				WHERE
					IDX != ".$relevant_idx." AND
					COUNTRY = '".$country."' AND
					COLLECTION_IDX = ".$collection_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx."
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_relevant_sql);
			
			$display_num = 2;
			foreach($db->fetch() as $relevant_data) {
				$tmp_idx = $relevant_data['RELEVANT_IDX'];
				
				$update_relevant_sql = "
					UPDATE
						dev.COLLECTION_RELEVANT_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_relevant_sql);
				
				$display_num++;
			}
		}
	} else if ($action_type == "DEL") {
		$delete_relevant_sql = "
			DELETE FROM
				dev.COLLECTION_RELEVANT_PRODUCT
			WHERE
				COLLECTION_IDX = ".$collection_idx." AND
				PRODUCT_IDX = ".$product_idx." AND
				C_PRODUCT_IDX = ".$c_product_idx."
		";
		
		$db->query($delete_relevant_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_relevant_sql = "
				SELECT
					IDX		AS RELEVANT_IDX
				FROM
					dev.COLLECTION_RELEVANT_PRODUCT
				WHERE
					COUNTRY = '".$country."' AND
					COLLECTION_IDX = ".$collection_idx." AND
					C_PRODUCT_IDX = ".$c_product_idx."
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_relevant_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $relevant_data) {
				$tmp_idx = $relevant_data['RELEVANT_IDX'];
				
				$update_relevant_sql = "
					UPDATE
						dev.COLLECTION_RELEVANT_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_relevant_sql);
				
				$display_num++;
			}
		}
	}
}
else{
	if ($relevant_idx != null){
		for ($i=0; $i<count($relevant_idx); $i++) {
			$update_relevant_sql = "
				UPDATE
					dev.COLLECTION_RELEVANT_PRODUCT
				SET
					SOLD_OUT_FLG = ".${"sold_out_flg_".$relevant_idx[$i]}.",
					DISPLAY_FLG = ".${"display_flg_".$relevant_idx[$i]}."
				WHERE
					IDX = ".$relevant_idx[$i]."
			";
			$db->query($update_relevant_sql);
		}
	}
}


?>