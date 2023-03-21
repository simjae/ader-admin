<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 상품 이미지 수정
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

$display_num_flg	= $_POST['display_num_flg'];
$update_flg			= $_POST['update_flg'];

$action_type		= $_POST['action_type'];
$project_idx		= $_POST['project_idx'];
$c_product_idx		= $_POST['c_product_idx'];
$relevant_flg		= $_POST['relevant_flg'];

$recent_num			= $_POST['recent_num'];

if ($display_num_flg != null && $action_type != null && $c_product_idx != null && $recent_num != null) {
	$db->begin_transaction();
	
	try {
		$head_num = $recent_num[0];
		$tail_num = $recent_num[count($recent_num) - 1];

		switch ($action_type) {
			case "up":
				$calc_num = (intval($head_num) - 1);

				$display_num = (intval($head_num) - 1);

				$prev_sql = "
					UPDATE
						COLLECTION_PRODUCT
					SET
						DISPLAY_NUM = DISPLAY_NUM + " . count($recent_num) . "
					WHERE
						DISPLAY_NUM = ".$calc_num."
					AND
						PROJECT_IDX = ".$project_idx."
				";

				$db->query($prev_sql);

				for ($i = 0; $i < count($c_product_idx); $i++) {
					$update_collection_product_sql = "
						UPDATE
							COLLECTION_PRODUCT
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$c_product_idx[$i]."
					";

					$db->query($update_collection_product_sql);

					$display_num++;
				}

				break;

			case "down":
				$calc_num = (intval($tail_num) + 1);

				$display_num = (intval($head_num) + 1);

				$prev_sql = "
					UPDATE
						COLLECTION_PRODUCT
					SET
						DISPLAY_NUM = DISPLAY_NUM - ".count($recent_num)."
					WHERE
						DISPLAY_NUM = ".$calc_num."
					AND
						PROJECT_IDX = ".$project_idx."
				";
				
				$db->query($prev_sql);

				for ($i = 0; $i < count($c_product_idx); $i++) {
					$update_collection_product_sql = "
						UPDATE
							COLLECTION_PRODUCT
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$c_product_idx[$i]."
					";
					
					$db->query($update_collection_product_sql);

					$display_num++;
				}

				break;
		}
		
		$db->commit();
	
		$json_result['code'] = 200;
		$json_result['msg'] = "컬렉션 이미지 진열정보가 변경되었습니다.";
	} catch(mysqli_sql_exception $exception) {
		$db->rollback();
		print_r($exception);
		
		$json_result['code'] = 301;
		$json_result['msg'] = "컬렉션 이미지 진열정보 변경처리중 오류가 발생했습니다.";
	}	
}

if ($update_flg != null && $c_product_idx != null && $relevant_flg != null) {
	for ($i=0; $i<count($c_product_idx); $i++) {
		$update_collection_product_sql = "
			UPDATE
				COLLECTION_PRODUCT
			SET 
				RELEVANT_FLG = ".$relevant_flg[$i]."
			WHERE
				IDX = ".$c_product_idx[$i]."
		";
		
		$db->query($update_collection_product_sql);
	}
}

?>