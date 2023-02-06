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

$page_title		= $_POST['page_title'];
$page_memo		= $_POST['page_memo'];
$active_flg		= $_POST['active_flg'];

$product_idx	= $_POST['product_idx'];
$recommend_idx	= $_POST['recommend_idx'];

if ($page_title != null && $page_memo != null && $recommend_idx != null) {
	$db->begin_transaction();
	try {
		$page_sql ="
			INSERT INTO
				dev.PAGE_RECOMMEND
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
				'".$active_flg."',
				'Admin',
				'Admin'
			)
		";
		
		$db->query($page_sql);
		
		$page_idx = $db->last_id();
		
		if (!empty($page_idx) && $product_idx != null) {
			for ($i=0; $i<count($product_idx); $i++) {
				$product_sql = "
					INSERT INTO
						dev.RECOMMEND_PRODUCT
					(
						PAGE_IDX,
						PRODUCT_IDX
					) VALUES (
						".$page_idx.",
						".$product_idx[$i]."
					);
				";
				
				$db->query($product_sql);
			}
		}
		
		$db->commit();
		$json_result['code'] = 200;
		return $json_result;
	} catch (mysqli_sql_exception $exception){
		$db->rollback();
		print_r($exception);
		$json_result['code'] = 301;
		$json_result['msg'] = '추천상품 페이지 등록에 실패했습니다.';
		return $json_result;
	}
}
?>