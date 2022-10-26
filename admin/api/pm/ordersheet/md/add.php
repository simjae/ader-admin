<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$verify_ordersheet_cnt = $db->count('dev.ORDERSHEET_MST', 'PRODUCT_CODE = "'.$product_code.'" ');


if($verify_ordersheet_cnt > 0){
	$json_result['code'] = 300;
	$json_result['msg'] = "이미 동일한 상품코드의 제품이 존재합니다.";
	return $json_result;
}

$style_code = $_POST['style_code'];
$style_code_arr = array();
if ($style_code != null) {
	$style_code_arr[0] = ' STYLE_CODE, ';
	$style_code_arr[1] = "'".$style_code."',";
}

$color_code = $_POST['color_code'];
$color_code_arr = array();
if ($color_code != null) {
	$color_code_arr[0] = ' COLOR_CODE, ';
	$color_code_arr[1] = "'".$color_code."',";
}

// " ' , . 치환 처리 (이름같이 문자열 긴것들)
$product_code = $_POST['product_code'];
$product_code_arr = array();
if ($product_code != null) {
	$product_code_arr[0] = ' PRODUCT_CODE, ';
	$product_code_arr[1] = "'".$product_code."',";
}

$preorder_flg = $_POST['preorder_flg'];
$preorder_flg_arr = array();
if ($preorder_flg != null) {
	$preorder_flg_arr[0] = ' PREORDER_FLG, ';
	$preorder_flg_arr[1] = $preorder_flg.",";
}
$category_lrg = $_POST['category_lrg'];
$category_lrg_arr = array();
if ($category_lrg != null) {
	$category_lrg_arr[0] = ' CATEGORY_LRG, ';
	$category_lrg_arr[1] = "'".$category_lrg."',";
}

$category_mdl = $_POST['category_mdl'];
$category_mdl_arr = array();
if ($category_mdl != null) {
	$category_mdl_arr[0] = ' CATEGORY_MDL, ';
	$category_mdl_arr[1] = "'".$category_mdl."',";
}

$category_sml = $_POST['category_sml'];
$category_sml_arr = array();
if ($category_sml != null) {
	$category_sml_arr[0] = ' CATEGORY_SML, ';
	$category_sml_arr[1] = "'".$category_sml."',";
}

$category_dtl = $_POST['category_dtl'];
$category_dtl_arr = array();
if ($category_dtl != null) {
	$category_dtl_arr[0] = ' CATEGORY_DTL, ';
	$category_dtl_arr[1] = "'".$category_dtl."',";
}

$graphic = $_POST['graphic'];
$graphic_arr = array();
if ($graphic != null) {
	$graphic_arr[0] = ' GRAPHIC, ';
	$graphic_arr[1] = "'".$graphic."',";
}

$fit = $_POST['fit'];
$fit_arr = array();
if ($fit != null) {
	$fit_arr[0] = ' FIT, ';
	$fit_arr[1] = "'".$fit."',";
}

$material = $_POST['material'];
$material_arr = array();
if ($material != null) {
	$material_arr[0] = ' MATERIAL, ';
	$material_arr[1] = "'".$material."',";
}

$navigation = $_POST['navigation'];
$navigation_arr = array();
if ($navigation != null) {
	$navigation_arr[0] = ' NAVIGATION, ';
	$navigation_arr[1] = "'".$navigation."',";
}

$product_name = $_POST['product_name'];
$product_name_arr = array();
if ($product_name != null) {
	$product_name_arr[0] = ' PRODUCT_NAME, ';
	$product_name_arr[1] = "'".$product_name."',";
}

$product_size = $_POST['product_size'];
$product_size_arr = array();
if ($product_size != null) {
	$product_size_arr[0] = ' PRODUCT_SIZE, ';
	$product_size_arr[1] = "'".$product_size."',";
}

$color = $_POST['color'];
$color_arr = array();
if ($color != null) {
	$color_arr[0] = ' COLOR, ';
	$color_arr[1] = "'".$color."',";
}

$color_rgb = $_POST['color_rgb'];
$color_rgb_arr = array();
if ($color_rgb != null) {
	$color_rgb_arr[0] = ' COLOR_RGB, ';
	$color_rgb_arr[1] = "'".$color_rgb."',";
}

$limit_qty = $_POST['limit_qty'];
$limit_qty_arr = array();
if ($limit_qty != null) {
	$limit_qty_arr[0] = ' LIMIT_QTY, ';
	$limit_qty_arr[1] = "'".$limit_qty."',";
}

$limit_member = $_POST['limit_member'];
$limit_memberpl_qty_arr = array();
if ($limit_member != null) {
	$limit_member_arr[0] = ' LIMIT_MEMBER, ';
	$limit_member_arr[1] = "'".$limit_member."',";
}

//오더시트 - price
$price_kr = $_POST['price_kr'];
$price_kr_arr = array();
if ($price_kr != null) {
	$price_kr_arr[0] = ' PRICE_KR, ';
	$price_kr_arr[1] = $price_kr.",";
}

$price_kr_gb = $_POST['price_kr_gb'];
$price_kr_gb_arr = array();
if ($price_kr_gb != null) {
	$price_kr_gb_arr[0] = ' PRICE_KR_GB, ';
	$price_kr_gb_arr[1] = $price_kr_gb.",";
}

$price_en = $_POST['price_en'];
$price_en_arr = array();
if ($price_en != null) {
	$price_en_arr[0] = ' PRICE_EN, ';
	$price_en_arr[1] = $price_en.",";
}

$price_cn = $_POST['price_cn'];
$price_cn_arr = array();
if ($price_cn != null) {
	$price_cn_arr[0] = ' PRICE_CN, ';
	$price_cn_arr[1] = $price_cn.",";
}

$product_qty = $_POST['product_qty'];
$product_qty_arr = array();
if ($product_qty != null) {
	$product_qty_arr[0] = ' PRODUCT_QTY, ';
	$product_qty_arr[1] = $product_qty.",";
}

$product_stock_grade = $_POST['product_stock_grade'];
$product_stock_grade_arr = array();
if ($product_stock_grade != null) {
	$product_stock_grade_arr[0] = ' PRODUCT_STOCK_GRADE, ';
	$product_stock_grade_arr[1] = "'".$product_stock_grade."',";
}

$mileage_flg = $_POST['mileage_flg'];
$mileage_flg_arr = array();
if ($mileage_flg != null) {
	$mileage_flg_arr[0] = ' MILEAGE_FLG, ';
	$mileage_flg_arr[1] = $mileage_flg.",";
}

$exclusive_flg = $_POST['exclusive_flg'];
$exclusive_flg_arr = array();
if ($exclusive_flg != null) {
	$exclusive_flg_arr[0] = ' EXCLUSIVE_FLG, ';
	$exclusive_flg_arr[1] = $exclusive_flg.",";
}

$launching_date = $_POST['launching_date'];
$launching_date_arr = array();
if ($launching_date != null) {
	$launching_date_arr[0] = ' LAUNCHING_DATE, ';
	$launching_date_arr[1] = "'".$launching_date."',";
}

if($product_code != null){

	$db->begin_transaction();

	try {
		//검색 유형 - 디폴트
		$sql = 	"INSERT INTO
					dev.ORDERSHEET_MST
				(
					".$style_code_arr[0]."
					".$color_code_arr[0]."
					".$product_code_arr[0]."
					".$preorder_flg_arr[0]."
					".$category_lrg_arr[0]."
					".$category_mdl_arr[0]."
					".$category_sml_arr[0]."
					".$category_dtl_arr[0]."
					".$material_arr[0]."
					".$graphic_arr[0]."
					".$fit_arr[0]."
					".$product_name_arr[0]."
					".$product_size_arr[0]."
					".$color_arr[0]."
					".$color_rgb_arr[0]."
					".$navigation_arr[0]."
					".$limit_member_arr[0]."
					".$limit_qty_arr[0]."
					".$price_kr_arr[0]."
					".$price_kr_gb_arr[0]."
					".$price_en_arr[0]."
					".$price_cn_arr[0]."
					".$product_qty_arr[0]."
					".$product_stock_grade_arr[0]."
					".$mileage_flg_arr[0]."
					".$exclusive_flg_arr[0]."
					".$launching_date_arr[0]."

					CREATE_DATE,
					CREATER,
					UPDATE_DATE,
					UPDATER
				)
				VALUES
				(
					".$style_code_arr[1]."
					".$color_code_arr[1]."
					".$product_code_arr[1]."
					".$preorder_flg_arr[1]."
					".$category_lrg_arr[1]."
					".$category_mdl_arr[1]."
					".$category_sml_arr[1]."
					".$category_dtl_arr[1]."
					".$material_arr[1]."
					".$graphic_arr[1]."
					".$fit_arr[1]."
					".$product_name_arr[1]."
					".$product_size_arr[1]."
					".$color_arr[1]."
					".$color_rgb_arr[1]."
					".$navigation_arr[1]."
					".$limit_member_arr[1]."
					".$limit_qty_arr[1]."
					".$price_kr_arr[1]."
					".$price_kr_gb_arr[1]."
					".$price_en_arr[1]."
					".$price_cn_arr[1]."
					".$product_qty_arr[1]."
					".$product_stock_grade_arr[1]."
					".$mileage_flg_arr[1]."
					".$exclusive_flg_arr[1]."
					".$launching_date_arr[1]."

					NOW(),
					'Admin',
					NOW(),
					'Admin'
				)
		";

		$db->query($sql);
		$ordersheet_idx = $db->last_id();

		if (!empty($ordersheet_idx)) {
			$history_sql = "
				INSERT INTO dev.ORDERSHEET_HISTORY
				(	
					ORDERSHEET_IDX,
					ORDERSHEET_AUTH,
					ACTION_TYPE,
					PRODUCT_CODE,
					PRODUCT_NAME,
					HISTORY_MSG,
					CREATE_DATE,
					CREATER
				)
				VALUES
				(
					".$ordersheet_idx.",
					'MD',
					'W',
					'".$product_code."',
					'".$product_name."',
					'[".$product_code."] ".$product_name." 의 오더시트 기획 작성 이 완료되었습니다.',
					NOW(),
					'Admin'
				)
			";
			$db->query($history_sql);
		}
		$db->commit();
	} 
	catch(mysqli_sql_exception $exception){
		$json_result['code'] = 301;
		$db->rollback();
		$msg = "등록작업에 실패했습니다.";
	}
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = '오더시트 등록에 실패했습니다.';
}
?>