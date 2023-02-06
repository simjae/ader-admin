<?php
/*
 +=============================================================================
 | 
 | 콜라보레이션 관리 페이지 - 콜라보레이션 상품 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id					= sessionCheck();
$collaboration_idx			= $_POST['collaboration_idx'];
$collabo_product_idx		= $_POST['collabo_product_idx'];

if ($collaboration_idx != null && $collabo_product_idx != null) {
	try {
		$delete_product_sql = "
			DELETE FROM
				dev.COLLABORATION_PRODUCT
			WHERE
				IDX = ".$collabo_product_idx."
		";
		
		$db->query($delete_product_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_product_sql = "
				SELECT
					CP.IDX		AS COLLABO_PRODUCT_IDX
				FROM
					dev.COLLABORATION_PRODUCT CP
				WHERE
					CP.COLLABORATION_IDX = ".$collaboration_idx."
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_product_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $product_data) {
				$tmp_idx = $product_data['COLLABO_PRODUCT_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_product_sql = "
						UPDATE
							dev.COLLABORATION_PRODUCT
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
		
		$db->commit();
		
		$json_result['code'] = 200;
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "콜라보레이션 상품 삭제에 실패했습니다. 삭제하려는 상품을 확인해주세요.";
	}
}

?>