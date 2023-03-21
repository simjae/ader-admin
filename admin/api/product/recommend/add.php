<?php

/*
 +=============================================================================
 | 
 | 추천상품 등록/수정 모달 - 추천상품 페이지 등록
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

$page_title			= $_POST['page_title'];
$page_memo			= $_POST['page_memo'];
$recommend_idx		= $_POST['recommend_idx'];
$active_flg			= $_POST['active_flg'];

$product_idx		= $_POST['product_idx'];

if ($page_title != null && $product_idx != null) {
	$db->begin_transaction();
	
	try {
		$insert_page_recommend_sql ="
			INSERT INTO
				PAGE_RECOMMEND
			(
				PAGE_TITLE,
				PAGE_MEMO,
				RECOMMEND_IDX,
				ACTIVE_FLG,
				CREATER,
				UPDATER
			) VALUES (
				'".$page_title."',
				'".$page_memo."',
				'".implode(",",$recommend_idx)."',
				".$active_flg.",
				'Admin',
				'Admin'
			)
		";
		
		$db->query($insert_page_recommend_sql);
		
		$page_idx = $db->last_id();
		
		if (!empty($page_idx) && $product_idx != null) {
			for ($i=0; $i<count($product_idx); $i++) {
				$insert_recommend_product_sql = "
					INSERT INTO
						RECOMMEND_PRODUCT
					(
						PAGE_IDX,
						PRODUCT_IDX
					) VALUES (
						".$page_idx.",
						".$product_idx[$i]."
					);
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
		$json_result['msg'] = '추천상품 페이지 등록처리중 오류가 발생했습니다.';
	}
}
?>