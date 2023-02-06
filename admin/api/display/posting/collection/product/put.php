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

$action_type		= $_POST['action_type'];
$collection_idx		= $_POST['collection_idx'];

$c_product_idx		= $_POST['c_product_idx'];
$recent_num			= $_POST['recent_num'];


$db->begin_transaction();
	
try {
	if ($display_num_flg != null && $action_type != null && $c_product_idx != null && $recent_num != null) {
		$head_num = $recent_num[0];
		$tail_num = $recent_num[count($recent_num) - 1];

		switch ($action_type) {
			case "up":
				$calc_num = (intval($head_num) - 1);

				$display_num = (intval($head_num) - 1);

				$prev_sql = "
					UPDATE
						dev.COLLECTION_PRODUCT
					SET
						DISPLAY_NUM = DISPLAY_NUM + " . count($recent_num) . "
					WHERE
						DISPLAY_NUM = " . $calc_num . "
					AND
						COLLECTION_IDX = ".$collection_idx."
				";

				$db->query($prev_sql);

				for ($i = 0; $i < count($c_product_idx); $i++) {
					$update_product_sql = "
						UPDATE
							dev.COLLECTION_PRODUCT
						SET
							DISPLAY_NUM = " . $display_num . "
						WHERE
							IDX = " . $c_product_idx[$i] . "
					";

					$db->query($update_product_sql);

					$display_num++;
				}

				break;

			case "down":
				$calc_num = (intval($tail_num) + 1);

				$display_num = (intval($head_num) + 1);

				$prev_sql = "
					UPDATE
						dev.COLLECTION_PRODUCT
					SET
						DISPLAY_NUM = DISPLAY_NUM - " . count($recent_num) . "
					WHERE
						DISPLAY_NUM = " . $calc_num . "
					AND
						COLLECTION_IDX = ".$collection_idx."
				";
				$db->query($prev_sql);

				for ($i = 0; $i < count($c_product_idx); $i++) {
					$update_product_sql = "
						UPDATE
							dev.COLLECTION_PRODUCT
						SET
							DISPLAY_NUM = " . $display_num . "
						WHERE
							IDX = " . $c_product_idx[$i] . "
					";
					$db->query($update_product_sql);

					$display_num++;
				}

				break;
		}
	}
	else{
		//RELEVANT_FLG = ".${"relevant_flg_".$collabo_product_idx[$i]}." 수정 가능성
		for ($i=0; $i<count($c_product_idx); $i++) {
			$update_product_sql = "
				UPDATE
					dev.COLLECTION_PRODUCT
				SET 
					RELEVANT_FLG = ".${"relevant_flg_".$c_product_idx[$i]}."
				WHERE
					IDX = ".$c_product_idx[$i]."
			";
			$db->query($update_product_sql);
		}
	}
	$db->commit();
	
	$json_result['code'] = 200;

} catch(mysqli_sql_exception $exception){
	print_r($exception);
	$db->rollback();
	
	$json_result['code'] = 301;
	$json_result['msg'] = "컬렉션 상품 진열순서 변경에 실패했습니다.";
}


?>