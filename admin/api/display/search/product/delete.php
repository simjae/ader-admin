<?php
/*
 +=============================================================================
 | 
 | 실시간 인기 제품 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$popular_idx		= $_POST['popular_idx'];
$country			= $_POST['country'];

if ($popular_idx != null) {
	$delete_popular_product_sql = "
		DELETE FROM
			TMP_POPULAR_PRODUCT
		WHERE
			IDX IN (".implode(",",$popular_idx).")
	";
	
	$db->query($delete_popular_product_sql);
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0) {
		$select_popular_product_sql = "
			SELECT
				PP.IDX		AS POPULAR_IDX
			FROM
				TMP_POPULAR_PRODUCT PP
			WHERE
				PP.COUNTRY = '".$country."'
			ORDER BY
				PP.DISPLAY_NUM ASC
		";
		
		$db->query($select_popular_product_sql);
		
		$display_num = 1;
		foreach($db->fetch() as $popular_data) {
			$tmp_idx = $popular_data['POPULAR_IDX'];
			
			if (!empty($tmp_idx)) {
				$update_popular_product_sql = "
					UPDATE
						TMP_POPULAR_PRODUCT
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_popular_product_sql);
				
				$display_num++;
			}
		}
	}
}
?>