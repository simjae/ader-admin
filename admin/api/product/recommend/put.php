<?php

/*
 +=============================================================================
 | 
 | 추천상품 등롯/수정 모달 - 추천상품 페이지 수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$update_flg			= $_POST['update_flg'];
$active_toggle_flg	= $_POST['active_toggle_flg'];

$page_idx			= $_POST['page_idx'];

$page_title			= $_POST['page_title'];
$page_memo			= $_POST['page_memo'];
$active_flg			= $_POST['active_flg'];
$recommend_idx		= $_POST['recommend_idx'];
$product_idx		= $_POST['product_idx'];

if ($update_flg != null && $page_idx != null) {
	$db->begin_transaction();
	
	try {
		$update_page_recommend_sql = "
			UPDATE
				PAGE_RECOMMEND
			SET
				PAGE_TITLE = '".$page_title."',
				PAGE_MEMO = '".$page_memo."',
				ACTIVE_FLG = ".$active_flg.",
				RECOMMEND_IDX = '".implode(",",$recommend_idx)."'
			WHERE
				IDX = ".$page_idx."
		";
		
		$db->query($update_page_recommend_sql);
		
		if ($product_idx != null) {
			$db->query("DELETE FROM RECOMMEND_PRODUCT WHERE PAGE_IDX = ".$page_idx);
			
			for ($i=0; $i<count($product_idx); $i++) {
				$insert_recommend_product_sql = "
					INSERT INTO
						RECOMMEND_PRODUCT
					(
						PAGE_IDX,
						DISPLAY_NUM,
						PRODUCT_IDX
					) VALUES (
						".$page_idx.",
						".intval($i + 1).",
						".$product_idx[$i]."
					)
				";
				
				$db->query($insert_recommend_product_sql);
			}
		}
		
		$db->commit();
		
		$json_result['code'] = 200;
	} catch (mysqli_sql_exception $exception){
		$db->rollback();
		print_r($exception);
		
		$json_result['code'] = 301;
		$json_result['msg'] = '추천상품 페이지 수정처리중 오류가 발생했습니다.';
	}
}
?>