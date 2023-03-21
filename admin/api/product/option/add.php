<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$history_option_code	= $_POST['history_option_code'];
$product_code			= $_POST['product_code'];

$cnt = 0;

$sql = "";
if ($history_option_code != null && $product_code != null) {
	$sql = "INSERT INTO PRODUCT_OPTION (
				PRODUCT_CODE,
				OPTION_CODE,
				OPTION_NAME,
				STOCK_MANAGEMENT,
				STOCK_GRADE,
				QTY_CHECK_TYPE,
				SOLD_OUT_FLG
			) SELECT
				'".$product_code."' AS PRODUCT_CODE,
				CONCAT('".$product_code."_',OPTION_NAME) AS OPTION_CODE,
				OPTION_NAME,
				STOCK_MANAGEMENT,
				STOCK_GRADE,
				QTY_CHECK_TYPE,
				SOLD_OUT_FLG
			FROM
				PRODUCT_OPTION
			WHERE OPTION_CODE = '".$history_option_code."'";
	
	$db->query($sql);
} else {
	$size_detail_a1_kr = $_POST['size_detail_a1_kr'];
	$size_detail_a1_en = $_POST['size_detail_a1_en'];
	$size_detail_a1_cn = $_POST['size_detail_a1_cn'];

	$size_detail_a1_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a1_kr);
	$size_detail_a1_en = str_replace("<p>&nbsp;</p>","",$size_detail_a1_en);
	$size_detail_a1_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a1_cn);

	$option_a1_arr = array();
	if ($size_detail_a1_kr != null || $size_detail_a1_en != null || $size_detail_a1_cn != null) {
		$option_a1_arr[0] = 'A1';
		$option_a1_arr[1] = $product_code.'_A1';
		$cnt++;
	}

	$size_detail_a2_kr = $_POST['size_detail_a2_kr'];
	$size_detail_a2_en = $_POST['size_detail_a2_en'];
	$size_detail_a2_cn = $_POST['size_detail_a2_cn'];

	$size_detail_a2_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a2_kr);
	$size_detail_a2_en = str_replace("<p>&nbsp;</p>","",$size_detail_a2_en);
	$size_detail_a2_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a2_cn);

	$option_a2_arr = array();
	if ($size_detail_a2_kr != null || $size_detail_a2_en != null || $size_detail_a2_cn != null) {
		$option_a2_arr[0] = 'A2';
		$option_a2_arr[1] = $product_code.'_A2';
		$cnt++;
	}

	$size_detail_a3_kr = $_POST['size_detail_a3_kr'];
	$size_detail_a3_en = $_POST['size_detail_a3_en'];
	$size_detail_a3_cn = $_POST['size_detail_a3_cn'];

	$size_detail_a3_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a3_kr);
	$size_detail_a3_en = str_replace("<p>&nbsp;</p>","",$size_detail_a3_en);
	$size_detail_a3_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a3_cn);

	$option_a3_arr = array();
	if ($size_detail_a3_kr != null || $size_detail_a3_en != null || $size_detail_a3_cn != null) {
		$option_a3_arr[0] = 'A3';
		$option_a3_arr[1] = $product_code.'_A3';
		$cnt++;
	}

	$size_detail_a4_kr = $_POST['size_detail_a4_kr'];
	$size_detail_a4_en = $_POST['size_detail_a4_en'];
	$size_detail_a4_cn = $_POST['size_detail_a4_cn'];

	$size_detail_a4_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a4_kr);
	$size_detail_a4_en = str_replace("<p>&nbsp;</p>","",$size_detail_a4_en);
	$size_detail_a4_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a4_cn);

	$option_a4_arr = array();
	if ($size_detail_a4_kr != null || $size_detail_a4_en != null || $size_detail_a4_cn != null) {
		$option_a4_arr[0] = 'A4';
		$option_a4_arr[1] = $product_code.'_A4';
		$cnt++;
	}

	$size_detail_a5_kr = $_POST['size_detail_a5_kr'];
	$size_detail_a5_en = $_POST['size_detail_a5_en'];
	$size_detail_a5_cn = $_POST['size_detail_a5_cn'];

	$size_detail_a5_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a5_kr);
	$size_detail_a5_en = str_replace("<p>&nbsp;</p>","",$size_detail_a5_en);
	$size_detail_a5_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a5_cn);

	$option_a5_arr = array();
	if ($size_detail_a5_kr != null || $size_detail_a5_en != null || $size_detail_a5_cn != null) {
		$option_a5_arr[0] = 'A5';
		$option_a5_arr[1] = $product_code.'_A5';
		$cnt++;
	}

	$size_detail_onesize_kr = $_POST['size_detail_onesize_kr'];
	$size_detail_onesize_en = $_POST['size_detail_onesize_en'];
	$size_detail_onesize_cn = $_POST['size_detail_onesize_cn'];

	$size_detail_onesize_kr = str_replace("<p>&nbsp;</p>","",$size_detail_onesize_kr);
	$size_detail_onesize_en = str_replace("<p>&nbsp;</p>","",$size_detail_onesize_en);
	$size_detail_onesize_cn = str_replace("<p>&nbsp;</p>","",$size_detail_onesize_cn);

	$option_a6_arr = array();
	if ($size_detail_onesize_kr != null || $size_detail_onesize_en != null || $size_detail_onesize_cn != null) {
		$option_a6_arr[0] = 'ONESIZE';
		$option_a6_arr[1] = $product_code.'_ONE';
		$cnt++;
	}
	
	//검색 유형 - 디폴트
	$product_code_validation = $db->count("PRODUCT_OPTION"," PRODUCT_CODE = '".$product_code."' ");
	
	if ($product_code_validation == 0) {
		if ($cnt > 0) {
			for ($i=1; $i<=6; $i++) {
				$sql = "INSERT INTO PRODUCT_OPTION (PRODUCT_CODE,OPTION_NAME,OPTION_CODE) VALUES ";
				
				$tmp_sql = "";
				if (count(${'option_a'.$i.'_arr'}) > 0) {
					$tmp_sql .= "('".$product_code."','".${'option_a'.$i.'_arr'}[0]."','".${'option_a'.$i.'_arr'}[1]."');";
					
					if (strlen($tmp_sql) > 0) {
						$sql .= $tmp_sql;
						$db->query($sql);
					}
				}
			}
		}
	} else {
		$code = 999;
		$msg = '상품코드의 옵션이 이미 존재합니다.';
	}
}
?>