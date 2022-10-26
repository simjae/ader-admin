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
	$material_kr = $_POST['material_kr'];
	$material_kr_str = '';
	if ($material_kr != null) {
		$material_kr_str = " MATERIAL_KR = '".$material_kr."',";
	}

	$material_en = $_POST['material_en'];
	$material_en_str = '';
	if ($material_en != null) {
		$material_en_str = " MATERIAL_EN = '".$material_en."',";
	}

	$material_cn = $_POST['material_cn'];
	$material_cn_str = '';
	if ($material_cn != null) {
		$material_cn_str = " MATERIAL_CN = '".$material_cn."',";
	}

	$manufacturer = $_POST['manufacturer'];
	$manufacturer_str = '';
	if ($manufacturer != null) {
		$manufacturer_str = " manufacturer = '".$manufacturer."',";
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

	$brand = $_POST['brand'];
	$brand_str = '';
	if ($brand != null) {
		$brand_str = " BRAND = '".$trenbrand."',";
	}

	$trend = $_POST['trend'];
	$trend_str = '';
	if ($trend != null) {
		$trend_str = " TREND = '".$trend."',";
	}

	$box_idx = $_POST['box_idx'];
	$box_idx_str = '';
	if ($box_idx != null) {
		$box_idx_str = " BOX_IDX = '".$box_idx."',";
	}

	$product_weight = $_POST['product_weight'];
	$product_weight_str = '';
	if ($product_weight != null) {
		$product_weight_str = " PRODUCT_WEIGHT = '".$product_weight."',";
	}

	$db->begin_transaction();

    try{
		//검색 유형 - 디폴트
		$sql = 	"UPDATE
					dev.ORDERSHEET_MST
				SET
					".$material_kr_str."
					".$material_en_str."
					".$material_cn_str."
					".$manufacturer_str."
					".$supplier_str."
					".$supplier_str."
					".$origin_country_str."
					".$brand_str."
					".$trend_str."
					".$box_idx_str."
					".$product_weight_str."
					
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