
<?php
/*
 +=============================================================================
 | 
 | 오더시트 수정 - 디자인
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

$session_id			= sessionCheck();
$ordersheet_idx		= $_POST['ordersheet_idx'];

$product_code		= $_POST['product_code'];
$product_name		= $_POST['product_name'];
$update_date		= $_POST['update_date'];
$overwrite_flg		= $_POST['overwrite_flg'];

$tp_completion_date = "NULL";
if (isset($_POST['tp_completion_date']) && $_POST['tp_completion_date'] != "") {
	$tp_completion_date = "'".$_POST['tp_completion_date']."'";
}

$size_guide_idx = 0;
if (isset($_POST['size_guide_idx']) && $_POST['size_guide_idx'] != "") {
	$size_guide_idx = $_POST['size_guide_idx'];
}

$care_dsn_kr = "NULL";
if (isset($_POST['care_dsn_kr']) && $_POST['care_dsn_kr'] != "") {
	$care_dsn_kr = "'".$_POST['care_dsn_kr']."'";
	$care_dsn_kr = str_replace("<p>&nbsp;</p>","",$care_dsn_kr);
}

$care_dsn_en = "NULL";
if (isset($_POST['care_dsn_en']) && $_POST['care_dsn_en'] != "") {
	$care_dsn_en = "'".$_POST['care_dsn_en']."'";
	$care_dsn_en = str_replace("<p>&nbsp;</p>","",$care_dsn_en);
}

$care_dsn_cn = "NULL";
if (isset($_POST['care_dsn_cn']) && $_POST['care_dsn_cn'] != "") {
	$care_dsn_cn = "'".$_POST['care_dsn_cn']."'";
	$care_dsn_cn = str_replace("<p>&nbsp;</p>","",$care_dsn_cn);
}

$detail_kr = "NULL";
if (isset($_POST['detail_kr']) && $_POST['detail_kr'] != "") {
	$detail_kr = "'".$_POST['detail_kr']."'";
	$detail_kr = str_replace("<p>&nbsp;</p>","",$detail_kr);
}

$detail_en = "NULL";
if (isset($_POST['detail_en']) && $_POST['detail_en'] != "") {
	$detail_en = "'".$_POST['detail_en']."'";
	$detail_en = str_replace("<p>&nbsp;</p>","",$detail_en);
}

$detail_cn = "NULL";
if (isset($_POST['detail_cn']) && $_POST['detail_cn'] != "") {
	$detail_cn = "'".$_POST['detail_cn']."'";
	$detail_cn = str_replace("<p>&nbsp;</p>","",$detail_cn);
}

$material_dsn_kr = "NULL";
if (isset($_POST['material_dsn_kr']) && $_POST['material_dsn_kr'] != "") {
	$material_dsn_kr = "'".$_POST['material_dsn_kr']."'";
	$material_dsn_kr = str_replace("<p>&nbsp;</p>","",$material_dsn_kr);
}

$material_dsn_en = "NULL";
if (isset($_POST['material_dsn_en']) && $_POST['material_dsn_en'] != "") {
	$material_dsn_en = "'".$_POST['material_dsn_en']."'";
	$material_dsn_en = str_replace("<p>&nbsp;</p>","",$material_dsn_en);
}

$material_dsn_cn = "NULL";
if (isset($_POST['material_dsn_cn']) && $_POST['material_dsn_cn'] != "") {
	$material_dsn_cn = "'".$_POST['material_dsn_cn']."'";
	$material_dsn_cn = str_replace("<p>&nbsp;</p>","",$material_dsn_cn);
}

$option_type		= $_POST['option_type'];
$option_name		= $_POST['option_name'];
$option_size_1		= $_POST['option_size_1'];
$option_size_2		= $_POST['option_size_2'];
$option_size_3		= $_POST['option_size_3'];
$option_size_4		= $_POST['option_size_4'];
$option_size_5		= $_POST['option_size_5'];
$option_size_6		= $_POST['option_size_6'];
$option_weight		= $_POST['option_weight'];
$limit_option_qty	= $_POST['limit_option_qty'];

$update_date_sql = "
	SELECT
		UPDATE_DATE
	FROM 
		ORDERSHEET_MST
	WHERE 
		IDX = ".$ordersheet_idx."
";

$db->query($update_date_sql);

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
	$db->begin_transaction();

	try {
		//검색 유형 - 디폴트
		$update_ordersheet_mst_sql = "
			UPDATE
				ORDERSHEET_MST
			SET
				TP_COMPLETION_DATE	= ".$tp_completion_date.",
				SIZE_GUIDE_IDX		= ".$size_guide_idx.",
				CARE_DSN_KR			= ".$care_dsn_kr.",
				CARE_DSN_EN			= ".$care_dsn_en.",
				CARE_DSN_CN			= ".$care_dsn_cn.",
				DETAIL_KR			= ".$detail_kr.",
				DETAIL_EN			= ".$detail_en.",
				DETAIL_CN			= ".$detail_cn.",
				MATERIAL_DSN_KR		= ".$material_dsn_kr.",
				MATERIAL_DSN_EN		= ".$material_dsn_en.",
				MATERIAL_DSN_CN		= ".$material_dsn_cn.",
				
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$ordersheet_idx."
		";
	   
		$db->query($update_ordersheet_mst_sql);
		
		$db_result = $db->mysqli_affected_rows();

		if ($db_result > 0 && $option_name != null) {
			if (count($option_name) > 0 && count($option_type) > 0) {
				//ORDERSHEET_OPTION 수정 처리
				$product_cnt = $db->count("SHOP_PRODUCT","ORDERSHEET_IDX = ".$ordersheet_idx);
				
				if ($product_cnt > 0) {
					$db->query("DELETE FROM PRODUCT_OPTION WHERE OPTION_IDX IN (SELECT IDX FROM ORDERSHEET_OPTION WHERE ORDERSHEET_IDX = ".$ordersheet_idx.")");
				}
				
				$db->query("DELETE FROM ORDERSHEET_OPTION WHERE ORDERSHEET_IDX = ".$ordersheet_idx);
				
				for ($i=0; $i<count($option_name); $i++) {
					if ($option_size_1[$i] == "" || $option_size_1[$i] == null) {
						$option_size_1[$i] = "NULL";
					}
					
					if ($option_size_2[$i] == "" || $option_size_2[$i] == null) {
						$option_size_2[$i] = "NULL";
					}
					
					if ($option_size_3[$i] == "" || $option_size_3[$i] == null) {
						$option_size_3[$i] = "NULL";
					}
					
					if ($option_size_4[$i] == "" || $option_size_4[$i] == null) {
						$option_size_4[$i] = "NULL";
					}
					
					if ($option_size_5[$i] == "" || $option_size_5[$i] == null) {
						$option_size_5[$i] = "NULL";
					}
					
					if ($option_size_6[$i] == "" || $option_size_6[$i] == null) {
						$option_size_6[$i] = "NULL";
					}
					
					$insert_ordersheet_option_sql = "
						INSERT INTO
							ORDERSHEET_OPTION
						(
							ORDERSHEET_IDX,
							PRODUCT_CODE,
							OPTION_TYPE,
							BARCODE,
							OPTION_NAME,
							OPTION_SIZE_1,
							OPTION_SIZE_2,
							OPTION_SIZE_3,
							OPTION_SIZE_4,
							OPTION_SIZE_5,
							OPTION_SIZE_6,
							OPTION_WEIGHT,
							LIMIT_OPTION_QTY,
							CREATER,
							UPDATER
						) VALUES (
							".$ordersheet_idx.",
							'".$product_code."',
							'".$option_type[$i]."',
							'".$product_code.$option_type[$i]."',
							'".$option_name[$i]."',
							".$option_size_1[$i].",
							".$option_size_2[$i].",
							".$option_size_3[$i].",
							".$option_size_4[$i].",
							".$option_size_5[$i].",
							".$option_size_6[$i].",
							".$option_weight[$i].",
							".$limit_option_qty[$i].",
							'".$session_id."',
							'".$session_id."'
						)
					";
					
					$db->query($insert_ordersheet_option_sql);
					
					if ($product_cnt > 0) {
						$option_idx = $db->last_id();
						
						$insert_product_option_sql = "
							INSERT INTO
								PRODUCT_OPTION
							(
								PRODUCT_IDX,
								OPTION_IDX
							)
							SELECT
								PR.IDX				AS PRODUCT_IDX,
								".$option_idx."		AS OPTION_IDX
							FROM
								SHOP_PRODUCT PR
							WHERE
								PR.ORDERSHEET_IDX = ".$ordersheet_idx."
						";
						
						$db->query($insert_product_option_sql);
					}
				}
			}
		}
			
		//ORDERSHEET_HISTORY 등록처리
		$action_type = "";
		$action_name = "";
		
		$history_cnt = $db->count("ORDERSHEET_HISTORY","ORDERSHEET_IDX = ".$ordersheet_idx." AND ORDERSHEET_AUTH = 'DSN'");
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
				'DSN',
				'".$action_type."',
				'".$product_code."',
				'".$product_name."',
				'[".$product_code."] ".$product_name."의 오더시트 디자인 ".$action_name."이 완료되었습니다.',
				NOW(),
				'".$session_id."'
			)
		";
		
		$db->query($insert_ordersheet_history_sql);
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		print_r($exception);
		$json_result['code'] = 301;
		$json_result['msg'] = "수정작업에 실패했습니다.";
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