<?php
/*
 +=============================================================================
 | 
 | 오더시트 수정 - 생산
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$ordersheet_idx     = $_POST['ordersheet_idx'];
$product_code       = $_POST['product_code'];
$product_name       = $_POST['product_name'];
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
	$care_td_kr = $_POST['care_td_kr'];
	$care_td_kr = str_replace("<p>&nbsp;</p>","",$care_td_kr);
	$care_td_kr_str = '';
	if ($care_td_kr != null) {
		$care_td_kr_str = " CARE_TD_KR = '".$care_td_kr."',";
	}
	else{
        $care_td_kr_str = " CARE_TD_KR = NULL,";
    }

	$care_td_en = $_POST['care_td_en'];
	$care_td_en = str_replace("<p>&nbsp;</p>","",$care_td_en);
	$care_td_en_str = '';
	if ($care_td_en != null) {
		$care_td_en_str = " CARE_TD_EN = '".$care_td_en."',";
	}
	else{
        $care_td_en_str = " CARE_TD_EN = NULL,";
    }

	$care_td_cn = $_POST['care_td_cn'];
	$care_td_cn = str_replace("<p>&nbsp;</p>","",$care_td_cn);
	$care_td_cn_str = '';
	if ($care_td_cn != null) {
		$care_td_cn_str = " CARE_TD_CN = '".$care_td_cn."',";
	}
	else{
        $care_td_cn_str = " CARE_TD_CN = NULL,";
    }

	$material_kr = $_POST['material_kr'];
	$material_kr = str_replace("<p>&nbsp;</p>","",$material_kr);
	$material_kr_str = '';
	if ($material_kr != null) {
		$material_kr_str = " MATERIAL_KR = '".$material_kr."',";
	}
	else{
        $material_kr_str = " MATERIAL_KR = NULL,";
    }

	$material_en = $_POST['material_en'];
	$material_en = str_replace("<p>&nbsp;</p>","",$material_en);
	$material_en_str = '';
	if ($material_en != null) {
		$material_en_str = " MATERIAL_EN = '".$material_en."',";
	}
	else{
        $material_en_str = " MATERIAL_EN = NULL,";
    }

	$material_cn = $_POST['material_cn'];
	$material_cn = str_replace("<p>&nbsp;</p>","",$material_cn);
	$material_cn_str = '';
	if ($material_cn != null) {
		$material_cn_str = " MATERIAL_CN = '".$material_cn."',";
	}
	else{
        $material_cn_str = " MATERIAL_CN = NULL,";
    }

	$manufacturer = $_POST['manufacturer'];
	$manufacturer_str = '';
	if ($manufacturer != null) {
		$manufacturer_str = " MANUFACTURER = '".$manufacturer."',";
	}
	$supplier = $_POST['supplier'];
	$supplier_str = '';
	if ($supplier != null) {
		$supplier_str = " SUPPLIER = '".$supplier."',";
	}

	$origin_country = $_POST['origin_country'];
	$origin_country_str = '';
	if ($origin_country != null) {
		$origin_country_str = " ORIGIN_COUNTRY = '".$origin_country."',";
	}

	$load_box_idx = $_POST['load_box_idx'];
	$load_box_idx_str = '';
	if ($load_box_idx != null) {
		$load_box_idx_str = " LOAD_BOX_IDX = ".$load_box_idx.",";
	}

	$deliver_box_idx = $_POST['deliver_box_idx'];
	$deliver_box_idx_str = '';
	if ($deliver_box_idx != null) {
		$deliver_box_idx_str = " DELIVER_BOX_IDX = ".$deliver_box_idx.",";
	}

	$load_weight = $_POST['load_weight'];
	$load_weight_str = '';
	if ($load_weight != null) {
		$load_weight_str = " LOAD_WEIGHT = ".$load_weight.",";
	}

	$load_qty = $_POST['load_qty'];
	$load_qty_str = '';
	if ($load_qty != null) {
		$load_qty_str = " LOAD_QTY = ".$load_qty.",";
	}

	$td_sub_material_idx = $_POST['td_sub_material_idx'];
	$td_sub_material_idx_str = '';
	if ($td_sub_material_idx != null) {
		$td_sub_material_idx_str = " TD_SUB_MATERIAL_IDX = '".implode(",", $td_sub_material_idx)."',";
	}

	$delivery_sub_material_idx = $_POST['delivery_sub_material_idx'];
	$delivery_sub_material_idx_str = '';
	if ($delivery_sub_material_idx != null) {
		$delivery_sub_material_idx_str = " DELIVERY_SUB_MATERIAL_IDX = '".implode(",", $delivery_sub_material_idx)."',";
	}

	$db->begin_transaction();

    try{
		//검색 유형 - 디폴트
		$sql = 	"UPDATE
					dev.ORDERSHEET_MST
				SET
					".$care_td_kr_str."
					".$care_td_en_str."
					".$care_td_cn_str."
					".$material_kr_str."
					".$material_en_str."
					".$material_cn_str."
					".$manufacturer_str."
					".$supplier_str."
					".$supplier_str."
					".$origin_country_str."
					".$load_box_idx_str."
					".$deliver_box_idx_str."
					".$load_weight_str."
					".$load_qty_str."
					".$td_sub_material_idx_str."
					".$delivery_sub_material_idx_str."
					
					UPDATE_DATE = NOW(),
					UPDATER = 'Admin'
				WHERE
					IDX = ".$ordersheet_idx."
				";
		$db->query($sql);    $update_row_cnt = $db->mysqli_affected_rows();

        if($update_row_cnt > 0){
			//ORDERSHEET_HISTORY 등록처리
			$action_type = '';
			$action_name = '';
			if($db->count("dev.ORDERSHEET_HISTORY","ORDERSHEET_IDX = ".$ordersheet_idx." AND ORDERSHEET_AUTH = 'TD'") > 0){
				$action_type = 'U';
				$action_name = "수정";
			}
			else{
				$action_type = 'W';
				$action_name = "등록";
			}
			
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
					'TD',
					'".$action_type."',
					'".$product_code."',
					'".$product_name."',
					'[".$product_code."] ".$product_name."의 오더시트 생산 ".$action_name."이 완료되었습니다.',
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
?>