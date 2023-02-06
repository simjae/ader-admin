<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 이미지 관련상품 삭제
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$country			= $_POST['country'];
$collection_idx		= $_POST['collection_idx'];
$c_product_idx		= $_POST['c_product_idx'];
$relevant_idx		= $_POST['relevant_idx'];

if ($country != null && $collection_idx != null && $c_product_idx != null && $relevant_idx != null) {
	$db->begin_transaction();
	
	try {
		$delete_relevant_sql = "
			DELETE FROM
				dev.COLLECTION_RELEVANT_PRODUCT
			WHERE
				IDX = ".$relevant_idx." AND
				COUNTRY = '".$country."' AND
				COLLECTION_IDX = ".$collection_idx." AND
				C_PRODUCT_IDX = ".$c_product_idx."
		";
		$db->query($delete_relevant_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_relevant_sql = "
				SELECT
					CP.IDX		AS C_PRODUCT_IDX
				FROM
					dev.COLLECTION_RELEVANT_PRODUCT CP
				WHERE
					CP.COUNTRY = '".$country."' AND
					CP.COLLECTION_IDX = ".$collection_idx." AND
					CP.C_PRODUCT_IDX = ".$c_product_idx."
				ORDER BY
					CP.DISPLAY_NUM ASC
			";
			
			$db->query($select_relevant_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $product_data) {
				$tmp_idx = $product_data['C_PRODUCT_IDX'];
				
				if (!empty($tmp_idx)) {
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
		
		$db->commit();
		
		$json_result['code'] = 200;
		$json_result['msg'] = "선택한 상품이 삭제되었씁니다.";
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
	}
}

?>