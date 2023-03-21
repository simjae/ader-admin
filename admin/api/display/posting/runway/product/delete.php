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

$page_idx				= $_POST['page_idx'];
$product_idx			= $_POST['product_idx'];

if ($page_idx != null && $product_idx != null) {
	$db->begin_transaction();
	
	try {
		$delete_runway_product_sql = "
			DELETE FROM
				RUNWAY_PRODUCT
			WHERE
				PAGE_IDX = ".$page_idx." AND
				PRODUCT_IDX = ".$product_idx."
		";
		
		$db->query($delete_runway_product_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_runway_product_sql = "
				SELECT
					EP.IDX		AS E_PRODUCT_IDX
				FROM
					RUNWAY_PRODUCT EP
				WHERE
					EP.PAGE_IDX = ".$page_idx."
				ORDER BY
					EP.DISPLAY_NUM ASC
			";
			
			$db->query($select_runway_product_sql);
			
			$display_num = 1;
			
			foreach($db->fetch() as $product_data) {
				$tmp_idx = $product_data['E_PRODUCT_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_runway_product_sql = "
						UPDATE
							RUNWAY_PRODUCT
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx."
					";
					
					$db->query($update_runway_product_sql);
					
					$display_num++;
				}
			}
		}
		
		$db->commit();
		
		$json_result['code'] = 200;
		$json_result['msg'] = "선택한 상품이 삭제되었씁니다.";
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		print_r($exception);
		
		$json_result['code'] = 301;
		$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
	}
}

?>