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
	$preorder_flg = $_POST['preorder_flg'];
	if ($preorder_flg != null) {
		$preorder_flg_str = " PREORDER_FLG = ".$preorder_flg.",";
	}
	$refund_flg = $_POST['refund_flg'];
	if ($refund_flg != null) {
		$refund_flg_str = " REFUND_FLG = ".$refund_flg.",";
	}
	$line_idx = $_POST['line_idx'];
	$line_idx_str = " LINE_IDX = ".$line_idx.",";



	
	$md_category = $_POST['md_category'];
	$category_idx = 0;
	if(is_array($md_category)){
		$category_lrg = $md_category[0];
		if ($category_lrg != null) {
			$category_lrg_str = " CATEGORY_LRG = '".$category_lrg."',";
			if($category_lrg > 0){
				$category_idx = $category_lrg;
			}
		}
		$category_mdl = $md_category[1];
		if ($category_mdl != null) {
			$category_mdl_str = " CATEGORY_MDL = '".$category_mdl."',";
			if($category_mdl > 0){
				$category_idx = $category_mdl;
			}
		}

		$category_sml = $md_category[2];
		if ($category_sml != null) {
			$category_sml_str = " CATEGORY_SML = '".$category_sml."',";
			if($category_sml > 0){
				$category_idx = $category_sml;
			}
		}

		$category_dtl = $md_category[3];
		if ($category_dtl != null) {
			$category_dtl_str = " CATEGORY_DTL = '".$category_dtl."',";
			if($category_dtl > 0){
				$category_idx = $category_dtl;
			}
		}
	}

	if ($category_idx != null && $category_idx > 0) {
		$category_idx_str = " CATEGORY_IDX = '".$category_idx."',";
	}

	$graphic = $_POST['graphic'];
	$graphic_str = " GRAPHIC = '".$graphic."',";

	$fit = $_POST['fit'];
	$fit_str = " FIT = '".$fit."',";

	$material = $_POST['material'];
	$material_str = " MATERIAL = '".$material."',";

	$product_name = $_POST['product_name'];
	$product_name_str = " PRODUCT_NAME = '".$product_name."',";

	$product_size = $_POST['product_size'];
	$product_size_str = " PRODUCT_SIZE = '".$product_size."',";

	$color = $_POST['color'];
	$color_str = " COLOR = '".$color."',";

	$color_rgb = $_POST['color_rgb'];
	$color_rgb_str = " COLOR_RGB = '".$color_rgb."',";

	$pantone_code = $_POST['pantone_code'];
	$pantone_code_str = " PANTONE_CODE = '".$pantone_code."',";

	$md_category_guide = $_POST['md_category_guide'];
	$md_category_guide_str = " MD_CATEGORY_GUIDE = '".$md_category_guide."',";

	$limit_qty = $_POST['limit_qty'];
	$limit_qty_str = " LIMIT_QTY = '".$limit_qty."',";

	$limit_member = $_POST['limit_member'];
	$limit_member_str = " LIMIT_MEMBER = '".$limit_member."',";

	//오더시트 - price
	$price_cost = $_POST['price_cost'] != null?$_POST['price_cost'] : '0';
	$price_cost_str = " PRICE_COST = ".$price_cost.",";

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

	$safe_qty = $_POST['safe_qty'];
	$safe_qty_str = " SAFE_QTY = '".$safe_qty."',";

	$launching_date = $_POST['launching_date'] != null ? $_POST['launching_date'] : 'NULL';
	$launching_date_str = " LAUNCHING_DATE = '".$launching_date."',";

	$receive_request_date = $_POST['receive_request_date'] != null ? $_POST['receive_request_date'] : 'NULL';
	$receive_request_date_str = " RECEIVE_REQUEST_DATE = '".$receive_request_date."',";

	$tp_completion_date = $_POST['tp_completion_date'] != null ? $_POST['tp_completion_date'] : 'NULL';
	$tp_completion_date_str = " TP_COMPLETION_DATE = '".$tp_completion_date."',";
	
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
					".$refund_flg_str."
					".$line_idx_str."
					".$category_lrg_str."
					".$category_mdl_str."
					".$category_sml_str."
					".$category_dtl_str."
					".$category_idx_str."
					".$material_str."
					".$graphic_str."
					".$fit_str."
					".$product_name_str."
					".$product_size_str."
					".$color_str."
					".$color_rgb_str."
					".$pantone_code_str."
					".$md_category_guide_str."
					".$limit_member_str."
					".$limit_qty_str."
					".$price_cost_str."
					".$price_kr_str."
					".$price_kr_gb_str."
					".$price_en_str."
					".$price_cn_str."
					".$product_qty_str."
					".$safe_qty_str."
					".$launching_date_str."
					".$receive_request_date_str."
					".$tp_completion_date_str."

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