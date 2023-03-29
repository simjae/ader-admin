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

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$session_id				= sessionCheck();
$ordersheet_idx     	= $_POST['ordersheet_idx'];

$update_date 			= $_POST['update_date'];
$overwrite_flg			= $_POST['overwrite_flg'];

$style_code				= $_POST['style_code'];
$color_code				= $_POST['color_code'];
$product_code			= $_POST['product_code'];

$preorder_flg			= $_POST['preorder_flg'];
$refund_flg				= $_POST['refund_flg'];
$limit_id_flg			= $_POST['limit_id_flg'];
$limit_product_qty_flg	= $_POST['limit_product_qty_flg'];

$line_idx = 0;
if (isset($_POST['line_idx'])) {
	$line_idx = $_POST['line_idx'];
}

$material = "NULL";
if (isset($_POST['material'])) {
	$material = "'".$_POST['material']."', ";
}

$graphic = "NULL";
if (isset($_POST['graphic'])) {
	$graphic = "'".$_POST['graphic']."', ";
}

$fit = "NULL";
if (isset($_POST['fit'])) {
	$fit = "'".$_POST['fit']."', ";
}

$product_name = "NULL";
if (isset($_POST['product_name'])) {
	$product_name = $_POST['product_name'];
}

$product_size = "NULL";
if (isset($_POST['product_size'])) {
	$product_size = "'".$_POST['product_size']."'";
}

$color = "NULL";
if (isset($_POST['color'])) {
	$color = "'".$_POST['color']."'";
}

$md_category_guide = "NULL";
if (isset($_POST['md_category_guide'])) {
	$md_category_guide = "'".$_POST['md_category_guide']."'";
}

$limit_product_qty = 0;
if (isset($_POST['limit_product_qty'])) {
	$limit_product_qty = $_POST['limit_product_qty'];
}

$limit_member = "NULL";
if (isset($_POST['limit_member'])) {
	$limit_member = "'".$_POST['limit_member']."'";
}

//오더시트 - price
$price_cost = 0;
if (isset($_POST['price_cost'])) {
	$price_cost = $_POST['price_cost'];
}

$price_kr = 0;
if (isset($_POST['price_kr'])) {
	$price_kr = $_POST['price_kr'];
}

$price_kr_gb = 0;
if (isset($_POST['price_kr_gb'])) {
	$price_kr_gb = $_POST['price_kr_gb'];
}

$price_en = 0;
if (isset($_POST['price_en'])) {
	$price_en = $_POST['price_en'];
}

$price_cn = 0;
if (isset($_POST['price_cn'])) {
	$price_cn = $_POST['price_cn'];
}

$product_qty = 0;
if (isset($_POST['product_qty'])) {
	$product_qty = $_POST['product_qty'];
}

$safe_qty = 0;
if (isset($_POST['safe_qty'])) {
	$safe_qty = $_POST['safe_qty'];
}

$launching_date = "NULL";
if (isset($_POST['launching_date'])) {
	$launching_date = "'".$_POST['launching_date']."'";
}

$receive_request_date = "NULL";
if (isset($_POST['receive_request_date'])) {
	$receive_request_date = "'".$_POST['receive_request_date']."'";
}

$option_idx				= $_POST['option_idx'];
$limit_option_qty		= $_POST['limit_option_qty'];

$material_dsn_en = "NULL";
if (isset($_POST['material_dsn_en'])) {
	$material_dsn_en = str_replace("<p>&nbsp;</p>","",$_POST['material_dsn_en']);
	$material_dsn_en = "'".xssEncode($material_dsn_en)."'";
}

$material_dsn_cn = "NULL";
if (isset($_POST['material_dsn_cn'])) {
	$material_dsn_cn = str_replace("<p>&nbsp;</p>","",$_POST['material_dsn_cn']);
	$material_dsn_cn = "'".xssEncode($material_dsn_cn)."'";
}

$detail_en = "NULL";
if (isset($_POST['detail_en'])) {
	$detail_en = str_replace("<p>&nbsp;</p>","",$_POST['detail_en']);
	$detail_en = "'".xssEncode($detail_en)."'";
}

$detail_cn = "NULL";
if (isset($_POST['detail_cn'])) {
	$detail_cn = str_replace("<p>&nbsp;</p>","",$_POST['detail_cn']);
	$detail_cn = "'".xssEncode($detail_cn)."'";
}

$care_dsn_en = "NULL";
if (isset($_POST['care_dsn_en'])) {
	$care_dsn_en = str_replace("<p>&nbsp;</p>","",$_POST['care_dsn_en']);
	$care_dsn_en = "'".xssEncode($care_dsn_en)."'";
}

$care_dsn_cn = "NULL";
if (isset($_POST['care_dsn_cn'])) {
	$care_dsn_cn = str_replace("<p>&nbsp;</p>","",$_POST['care_dsn_cn']);
	$care_dsn_cn = "'".xssEncode($care_dsn_cn)."'";
}

$material_td_en = "NULL";
if (isset($_POST['material_td_en'])) {
	$material_td_en = str_replace("<p>&nbsp;</p>","",$_POST['material_td_en']);
	$material_td_en = "'".xssEncode($material_td_en)."'";
}

$material_td_cn = "NULL";
if (isset($_POST['material_td_cn'])) {
	$material_td_cn = str_replace("<p>&nbsp;</p>","",$_POST['material_td_cn']);
	$material_td_cn = "'".xssEncode($material_td_cn)."'";
}

$care_td_en = "NULL";
if (isset($_POST['care_td_en'])) {
	$care_td_en = str_replace("<p>&nbsp;</p>","",$_POST['care_td_en']);
	$care_td_en = "'".xssEncode($care_td_en)."'";
}

$care_td_cn = "NULL";
if (isset($_POST['care_td_cn'])) {
	$care_td_cn = str_replace("<p>&nbsp;</p>","",$_POST['care_td_cn']);
	$care_td_cn = "'".xssEncode($care_td_cn)."'";
}

$verify_ordersheet_query = "
    SELECT
        UPDATE_DATE
    FROM 
        ORDERSHEET_MST
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

	$db->begin_transaction();

	try{
		//검색 유형 - 디폴트
		$update_ordersheet_mst_sql = "
			UPDATE
				ORDERSHEET_MST
			SET
				STYLE_CODE				= '".$style_code."',
				COLOR_CODE				= '".$color_code."',
				PRODUCT_CODE			= '".$product_code."',
				PREORDER_FLG			= ".$preorder_flg.",
				REFUND_FLG				= ".$refund_flg.",
				LINE_IDX				= ".$line_idx.",
				".$category_lrg_str."
				".$category_mdl_str."
				".$category_sml_str."
				".$category_dtl_str."
				".$category_idx_str."
				
				MATERIAL				= ".$material."
				GRAPHIC					= ".$graphic."
				FIT						= ".$fit."
				PRODUCT_NAME			= '".$product_name."',
				PRODUCT_SIZE			= ".$product_size.",
				COLOR					= ".$color.",
				MD_CATEGORY_GUIDE		= ".$md_category_guide.",
				LIMIT_MEMBER			= ".$limit_member.",
				LIMIT_ID_FLG			= ".$limit_id_flg.",
				LIMIT_PRODUCT_QTY_FLG	= ".$limit_product_qty_flg.",
				LIMIT_PRODUCT_QTY		= ".$limit_product_qty.",
				PRICE_COST				= ".$price_cost.",
				
				PRICE_KR				= ".$price_kr.",
				PRICE_KR_GB				= ".$price_kr_gb.",
				PRICE_EN				= ".$price_en.",
				PRICE_CN				= ".$price_cn.",
				
				PRODUCT_QTY				= ".$product_qty.",
				SAFE_QTY				= ".$safe_qty.",
				LAUNCHING_DATE			= ".$launching_date.",
				RECEIVE_REQUEST_DATE	= ".$receive_request_date.",
				
				MATERIAL_DSN_EN			= ".$material_dsn_en.",
				MATERIAL_DSN_CN			= ".$material_dsn_cn.",
				DETAIL_EN				= ".$detail_en.",
				DETAIL_CN				= ".$detail_cn.",
				CARE_DSN_EN				= ".$care_dsn_en.",
				CARE_DSN_CN				= ".$care_dsn_cn.",
				
				MATERIAL_TD_EN			= ".$material_td_en.",
				MATERIAL_TD_CN			= ".$material_td_cn.",
				CARE_TD_EN				= ".$care_td_en.",
				CARE_TD_CN				= ".$care_td_cn.",
				
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$ordersheet_idx."
		";
		
		$db->query($update_ordersheet_mst_sql);
		
		$db_result = $db->affectedRows();

		if ($db_result > 0) {
			if ($option_idx != null && $limit_option_qty != null) {
				for ($i=0; $i<count($option_idx); $i++) {
					$update_ordersheet_option_sql = "
						UPDATE
							ORDERSHEET_OPTION
						SET
							LIMIT_OPTION_QTY = ".$limit_option_qty[$i]."
						WHERE
							IDX = ".$option_idx[$i]." AND
							ORDERSHEET_IDX = ".$ordersheet_idx."
					";
					
					$db->query($update_ordersheet_option_sql);
				}
			}
			
			$insert_ordersheet_history_sql = "
				INSERT INTO ORDERSHEET_HISTORY
				(	
					ORDERSHEET_IDX,
					ORDERSHEET_AUTH,
					ACTION_TYPE,
					PRODUCT_CODE,
					PRODUCT_NAME,
					HISTORY_MSG,
					CREATE_DATE,
					CREATER
				) VALUES (
					".$ordersheet_idx.",
					'MD',
					'U',
					'".$product_code."',
					'".$product_name."',
					'[".$product_code."] ".$product_name."의 오더시트 기획 수정이 완료되었습니다.',
					NOW(),
					'".$session_id."'
				)
			";
			
			$db->query($insert_ordersheet_history_sql);
		}
		
		$db->commit();
	} 
	catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		print_r($exception);
		$json_result['code'] = 301;
		$json_result['msg'] = "오더시트 기획정보 수정처리중 오류가 발생했습니다.";
	}
} else{
	$json_result['code'] = 301;
	$json_result['msg'] = '오더시트 정보를 얻는데 실패했습니다.';
}

function xssEncode($value){
	$value = str_replace("&","&amp;",$value);
	$value = str_replace("\"","&quot;",$value);
	$value = str_replace("'","&apos;",$value);
	$value = str_replace("<","&lt;",$value);
	$value = str_replace(">","&gt;",$value);
	$value = str_replace("\r","<br>",$value);
	$value = str_replace("\n","<p>",$value);

	return $value;
}
?>