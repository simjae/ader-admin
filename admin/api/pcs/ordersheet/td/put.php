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

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$session_id			= sessionCheck();
$ordersheet_idx     = $_POST['ordersheet_idx'];

$product_code       = $_POST['product_code'];
$product_name       = $_POST['product_name'];
$update_date 		= $_POST['update_date'];
$overwrite_flg		= $_POST['overwrite_flg'];

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

$material_td_kr = "NULL";
if (isset($_POST['material_td_kr'])) {
	$material_td_kr = str_replace("<p>&nbsp;</p>","",$_POST['material_td_kr']);
	$material_td_kr = "'".xssEncode($material_td_kr)."'";
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

$care_td_kr = "NULL";
if (isset($_POST['care_td_kr'])) {
	$care_td_kr = str_replace("<p>&nbsp;</p>","",$_POST['care_td_kr']);
	$care_td_kr = "'".xssEncode($care_td_kr)."'";
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

$manufacturer = "NULL";
if (isset($_POST['manufacturer']) && $_POST['manufacturer'] != "") {
	$manufacturer = "'".$_POST['manufacturer']."'";
}

$supplier = "NULL";
if (isset($_POST['supplier']) && $_POST['supplier'] != "") {
	$supplier = "'".$_POST['supplier']."'";
}

$origin_country = "NULL";
if (isset($_POST['origin_country']) && $_POST['origin_country'] != "") {
	$origin_country = "'".$_POST['origin_country']."'";
}

$load_box_idx = 0;
if (isset($_POST['load_box_idx']) && $_POST['load_box_idx'] != "") {
	$load_box_idx = $_POST['load_box_idx'];
}

$load_weight = 0;
if (isset($_POST['load_weight']) && $_POST['load_weight'] != "") {
	$load_weight = $_POST['load_weight'];
}

$load_qty = 0;
if (isset($_POST['load_qty']) && $_POST['load_qty'] != "") {
	$load_qty = $_POST['load_qty'];
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
	$td_sub_material_idx        = $_POST['td_sub_material_idx'];
	if(!isset($td_sub_material_idx) || !is_array($td_sub_material_idx)){
		$td_sub_material_idx = NULL;
	}
	
	$delivery_sub_material_idx  = $_POST['delivery_sub_material_idx'];
	if(!isset($delivery_sub_material_idx) || !is_array($delivery_sub_material_idx)){
		$delivery_sub_material_idx = NULL;
	}

	$db->begin_transaction();

    try{
		if($td_sub_material_idx != NULL && $delivery_sub_material_idx != NULL){
			$delete_sub_material_sql = "
				DELETE FROM
					SUB_MATERIAL_MAPPING
				WHERE
					ORDERSHEET_IDX = ".$ordersheet_idx."
			";
			
			$db->query($delete_sub_material_sql);

			$sub_material_cnt = count($td_sub_material_idx) + count($delivery_sub_material_idx);
			
			$insert_cnt = 0;
			
			foreach ($td_sub_material_idx as $td_sub_idx) {
				$insert_sub_material_mapping_sql = "
					INSERT INTO
						SUB_MATERIAL_MAPPING
					( 
						SUB_MATERIAL_TYPE,
						SUB_MATERIAL_IDX,
						ORDERSHEET_IDX
					)
					SELECT
						SUB_MATERIAL_TYPE,
						IDX,
						" . $ordersheet_idx . "
					FROM
						SUB_MATERIAL_INFO
					WHERE
						IDX = ".$td_sub_idx. "
				";

				$db->query($insert_sub_material_mapping_sql);

				$mapping_idx = $db->last_id();

				if (!empty($mapping_idx)) {
					$insert_cnt++;
				}
			}
			
			foreach ($delivery_sub_material_idx as $delivery_sub_idx) {
				$insert_delivery_mapping_sql = "
					INSERT INTO
						SUB_MATERIAL_MAPPING
					( 
						SUB_MATERIAL_TYPE,
						SUB_MATERIAL_IDX,
						ORDERSHEET_IDX
					)
					SELECT
						SUB_MATERIAL_TYPE,
						IDX,
						" . $ordersheet_idx . "
					FROM
						SUB_MATERIAL_INFO
					WHERE
						IDX = " . $delivery_sub_idx . "
				";

				$db->query($insert_delivery_mapping_sql);

				$mapping_idx = $db->last_id();

				if (!empty($mapping_idx)) {
					$insert_cnt++;
				}
			}
		}
		
		if($sub_material_cnt == $insert_cnt){
			//검색 유형 - 디폴트
			$update_ordersheet_mst_sql = "
				UPDATE
					ORDERSHEET_MST
				SET
					MATERIAL_DSN_EN			= ".$material_dsn_en.",
					MATERIAL_DSN_CN			= ".$material_dsn_cn.",
					DETAIL_EN				= ".$detail_en.",
					DETAIL_CN				= ".$detail_cn.",
					CARE_DSN_EN				= ".$care_dsn_en.",
					CARE_DSN_CN				= ".$care_dsn_cn.",
					
					MATERIAL_TD_KR			= ".$material_td_kr.",
					MATERIAL_TD_EN			= ".$material_td_en.",
					MATERIAL_TD_CN			= ".$material_td_cn.",
					CARE_TD_KR				= ".$care_td_kr.",
					CARE_TD_EN				= ".$care_td_en.",
					CARE_TD_CN				= ".$care_td_cn.",
				
					MANUFACTURER			= ".$manufacturer.",
					SUPPLIER				= ".$supplier.",
					ORIGIN_COUNTRY			= ".$origin_country.",
					LOAD_BOX_IDX			= ".$load_box_idx.",
					LOAD_WEIGHT				= ".$load_weight.",
					LOAD_QTY				= ".$load_qty.",
					
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					IDX = ".$ordersheet_idx."
			";
			
			$db->query($update_ordersheet_mst_sql);
			
			$db_result = $db->affectedRows();
			
			if($db_result > 0){
				//ORDERSHEET_HISTORY 등록처리
				$action_type = "";
				$action_name = "";
				
				$history_cnt = $db->count("ORDERSHEET_HISTORY","ORDERSHEET_IDX = ".$ordersheet_idx." AND ORDERSHEET_AUTH = 'TD'");
				if($history_cnt > 0){
					$action_type = 'U';
					$action_name = "수정";
				} else{
					$action_type = 'W';
					$action_name = "등록";
				}
				
				$insert_ordersheet_history_sql = "
					INSERT INTO
						ORDERSHEET_HISTORY
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
						'TD',
						'".$action_type."',
						'".$product_code."',
						'".$product_name."',
						'[".$product_code."] ".$product_name."의 오더시트 생산 ".$action_name."이 완료되었습니다.',
						NOW(),
						'".$session_id."'
					)
				";
				
				$db->query($insert_ordersheet_history_sql);
			} else {
				$db->rollback();
				
				$json_result['code'] = 300;
				$json_result['msg'] = "상품정보 -> 오더시트 수정 작업이 실패했습니다.";
				return $json_result;
			}
		} else {
			$db->rollback();
			
			$json_result['code'] = 300;
			$json_result['msg'] = "상품정보 -> 부자재 추가 작업이 실패했습니다.";
			
			return $json_result;
		}
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		print_r($exception);
		$json_result['code'] = 301;
		$json_result['msg'] = "오더시트 생산정보 작성처리중 오류가 발생했습니다.";
	}
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