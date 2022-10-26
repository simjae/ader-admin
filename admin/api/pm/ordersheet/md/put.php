<?php
/*
 +=============================================================================
 | 
 | 오더시트 수정 - 기획MD
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

$ordersheet_idx     = $_POST['ordersheet_idx'];
$update_date 		= $_POST['update_date'];
$overwrite_flg		= $_POST['overwrite_flg'];

$verify_ordersheet_query = "
    SELECT
        UPDATE_DATE
    FROM 
        dev.ORDERSHEET_MST
    WHERE 
        IDX = ".$ordersheet_idx."
";

$db->query($verify_ordersheet_query);

$last_update_date = "";
foreach($db->fetch() as $verify_data){
    $last_update_date = $verify_data['UPDATE_DATE'];
}

if ($update_date != $last_update_date) {
    if($overwrite_flg == "false"){
        $json_result['code'] = 300;
	    $json_result['msg'] = "작성 도중에 오더시트가 수정되었습니다.<br>이대로 수정하시겠습니까?";
        return $json_result;
    }
}

if($ordersheet_idx != null){
	$style_code = $_POST['style_code'];
	if ($style_code != null) {
		$style_code_str = " STYLE_CODE = '".$style_code."',";
	}

	$color_code = $_POST['color_code'];
	if ($color_code != null) {
		$color_code_str = " COLOR_CODE = '".$color_code."',";
	}

	$product_code = $_POST['product_code'];
	if ($product_code != null) {
		$product_code_str = " PRODUCT_CODE = '".$product_code."',";
	}

	$preorder_flg = $_POST['preorder_flg'];
	if ($preorder_flg != null) {
		$preorder_flg_str = " PREORDER_FLG = ".$preorder_flg.",";
	}

	$category_lrg = $_POST['category_lrg'];
	$category_lrg_str = " CATEGORY_LRG = '".$category_lrg."',";

	$category_mdl = $_POST['category_mdl'];
	$category_mdl_str = " CATEGORY_MDL = '".$category_mdl."',";

	$category_sml = $_POST['category_sml'];
	$category_sml_str = " CATEGORY_SML = '".$category_sml."',";

	$category_dtl = $_POST['category_dtl'];
	$category_dtl_str = " CATEGORY_DTL = '".$category_dtl."',";

	$graphic = $_POST['graphic'];
	$graphic_str = " GRAPHIC = '".$graphic."',";

	$fit = $_POST['fit'];
	$fit_str = " FIT = '".$fit."',";

	$material = $_POST['material'];
	$material_str = " MATERIAL = '".$material."',";

	$navigation = $_POST['navigation'];
	$navigation_str = " NAVIGATION = '".$navigation."',";

	$product_name = $_POST['product_name'];
	$product_name_str = " PRODUCT_NAME = '".$product_name."',";

	$product_size = $_POST['product_size'];
	$product_size_str = " PRODUCT_SIZE = '".$product_size."',";

	$color = $_POST['color'];
	$color_str = " COLOR = '".$color."',";

	$color_rgb = $_POST['color_rgb'];
	$color_rgb_str = " COLOR_RGB = '".$color_rgb."',";

	$limit_qty = $_POST['limit_qty'];
	$limit_qty_str = " LIMIT_QTY = '".$limit_qty."',";

	$limit_member = $_POST['limit_member'];
	$limit_member_str = " LIMIT_MEMBER = '".$limit_member."',";

	//오더시트 - price
	$price_kr = $_POST['price_kr'] != null?$_POST['price_kr'] : '0';
	$price_kr_str = " PRICE_KR = ".$price_kr.",";

	$price_kr_gb = $_POST['price_kr_gb'] != null?$_POST['price_kr_gb'] : '0';
	$price_kr_gb_str = " PRICE_KR_GB = ".$price_kr_gb.",";

	$price_en = $_POST['price_en'] != null?$_POST['price_en'] : '0';
	$price_en_str = " PRICE_EN = ".$price_en.",";

	$price_cn = $_POST['price_en'] != null?$_POST['price_cn'] : '0';
	$price_cn_str = " PRICE_CN = ".$price_cn.",";

	$product_qty = $_POST['product_qty'];
	$product_qty_str = " PRODUCT_QTY = '".$product_qty."',";

	$product_stock_grade = $_POST['product_stock_grade'];
	$product_stock_grade_str = " PRODUCT_STOCK_GRADE = '".$product_stock_grade."',";

	$mileage_flg = $_POST['mileage_flg'];
	$mileage_flg_str = '';
	if ($mileage_flg != null) {
		$mileage_flg_str = " MILEAGE_FLG = ".$mileage_flg.",";
	}

	$exclusive_flg = $_POST['exclusive_flg'];
	$exclusive_flg_str = '';
	if ($exclusive_flg != null) {
		$exclusive_flg_str = " EXCLUSIVE_FLG = ".$exclusive_flg.",";
	}

	$launching_date = $_POST['launching_date'] != null ? $_POST['launching_date'] : 'NULL';
	$launching_date_str = " LAUNCHING_DATE = '".$launching_date."',";
	
	$verify_ordersheet_query = "
		SELECT
			UPDATE_DATE
		FROM 
			dev.ORDERSHEET_MST
		WHERE 
			IDX = ".$ordersheet_idx."
	";

	$db->query($verify_ordersheet_query);
	foreach($db->fetch() as $verify_data){
		$last_update_date = $verify_data['UPDATE_DATE'];
	}

	$db->begin_transaction();

	try{
		//검색 유형 - 디폴트
		$sql = 	"UPDATE
					dev.ORDERSHEET_MST
				SET
					".$style_code_str."
					".$color_code_str."
					".$product_code_str."
					".$preorder_flg_str."
					".$category_lrg_str."
					".$category_mdl_str."
					".$category_sml_str."
					".$category_dtl_str."
					".$material_str."
					".$graphic_str."
					".$fit_str."
					".$product_name_str."
					".$product_size_str."
					".$color_str."
					".$color_rgb_str."
					".$navigation_str."
					".$limit_member_str."
					".$limit_qty_str."
					".$price_kr_str."
					".$price_kr_gb_str."
					".$price_en_str."
					".$price_cn_str."
					".$product_qty_str."
					".$product_stock_grade_str."
					".$mileage_flg_str."
					".$exclusive_flg_str."
					".$launching_date_str."

					UPDATE_DATE = NOW(),
					UPDATER = 'Admin'
					WHERE
						IDX = ".$ordersheet_idx."
				";
		$db->query($sql);
		$update_row_cnt = $db->mysqli_affected_rows();

		if ($update_row_cnt > 0) {
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
					'U',
					'".$product_code."',
					'".$product_name."',
					'[".$product_code."] ".$product_name."의 오더시트 기획 수정이 완료되었습니다.',
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
		$msg = "수정작업에 실패했습니다.";
	}
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = '오더시트 정보를 얻는데 실패했습니다.';
}

?>