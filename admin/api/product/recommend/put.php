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

$page_idx		= $_POST['page_idx'];

$page_title		= $_POST['page_title'];
$page_memo		= $_POST['page_memo'];
$active_flg		= $_POST['active_flg'];
$recommend_idx	= $_POST['recommend_idx'];
$product_idx	= $_POST['product_idx'];
$active_toggle	= $_POST['active_toggle'];

if ($page_idx != null && $active_toggle != null) {
	$active_sql = "UPDATE
				dev.PAGE_RECOMMEND
			SET
				ACTIVE_FLG = !ACTIVE_FLG
			WHERE
				IDX = ".$page_idx;
	
	$db->query($active_sql);
}

if($page_idx != null){
	$db->begin_transaction();
	try {
		$page_sql = "
			UPDATE
				dev.PAGE_RECOMMEND
			SET
				PAGE_TITLE = '".$page_title."',
				PAGE_MEMO = '".$page_memo."',
				ACTIVE_FLG = ".$active_flg.",
				RECOMMEND_IDX = '".implode(",",$recommend_idx)."'
			WHERE
				IDX = ".$page_idx."
		";
		
		$db->query($page_sql);
		
		if ($product_idx != null) {
			$db->query("DELETE FROM dev.RECOMMEND_PRODUCT WHERE PAGE_IDX = ".$page_idx);
			
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
					)
				";
				
				$db->query($product_sql);
			}
		}
		
		$db->commit();
		$json_result['code'] = 200;
		return $json_result;
	} catch (mysqli_sql_exception $exception){
		$db->rollback();
		$json_result['code'] = 301;
		$json_result['msg'] = '추천상품 페이지 수정에 실패했습니다.';
		return $json_result;
	}
}
?>