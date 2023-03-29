<?php
/*
 +=============================================================================
 | 
 | 오더시트 상태변경
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

$session_id				= sessionCheck();
$ordersheet_idx_list	= $_POST['ordersheet_idx_list'];
$action_type 			= $_POST['action_type'];

$db->begin_transaction();

try {
	$update_flg = null;
	if($action_type == 'update_flg_true'){
		$update_flg = 'TRUE';
		$err_msg = null;
	
		for ($i=0; $i<count($ordersheet_idx_list); $i++){
			$ordersheet_idx = $ordersheet_idx_list[$i];
			$option_cnt = $db->count("ORDERSHEET_OPTION","ORDERSHEET_IDX = ".$ordersheet_idx);
			
			if ($option_cnt < 1) {
				$json_result['code'] = 402;
				$json_result['msg'] = "옵션이 등록되지 않은 오더시트는 진행완료 상태로 변경할 수 없습니다.";
				return $json_result;
			}

			$ordersheet_required_sql = "
				SELECT
						IDX,
						IF(LENGTH(STYLE_CODE) > 0,STYLE_CODE,NULL) AS STYLE_CODE,
						IF(LENGTH(COLOR_CODE) > 0,STYLE_CODE,NULL) AS COLOR_CODE,
						IF(LENGTH(PRODUCT_CODE) > 0,STYLE_CODE,NULL) AS PRODUCT_CODE,
						IF(LENGTH(PRODUCT_NAME) > 0,STYLE_CODE,NULL) AS PRODUCT_NAME,
						IF(LENGTH(COLOR) > 0,COLOR,NULL) AS COLOR,
						IF(LENGTH(COLOR_RGB) > 0,COLOR_RGB,NULL) AS COLOR_RGB,

						IF(PRICE_KR IS NULL OR PRICE_KR = 0, NULL, PRICE_KR) AS PRICE_KR,
						IF(PRICE_EN IS NULL OR PRICE_KR = 0, NULL, PRICE_EN) AS PRICE_EN,
						IF(PRICE_CN IS NULL OR PRICE_KR = 0, NULL, PRICE_CN) AS PRICE_CN,

						IF(LENGTH(DETAIL_KR) > 0,DETAIL_KR,NULL) AS DETAIL_KR,
						IF(LENGTH(DETAIL_EN) > 0,DETAIL_KR,NULL) AS DETAIL_EN,
						IF(LENGTH(DETAIL_CN) > 0,DETAIL_KR,NULL) AS DETAIL_CN,

						IF(LENGTH(CARE_TD_KR) > 0,DETAIL_KR,NULL) AS CARE_TD_KR,
						IF(LENGTH(CARE_TD_EN) > 0,DETAIL_KR,NULL) AS CARE_TD_EN,
						IF(LENGTH(CARE_TD_CN) > 0,DETAIL_KR,NULL) AS CARE_TD_CN,

						IF(LENGTH(MATERIAL_KR) > 0,DETAIL_KR,NULL) AS MATERIAL_KR,
						IF(LENGTH(MATERIAL_EN) > 0,DETAIL_KR,NULL) AS MATERIAL_EN,
						IF(LENGTH(MATERIAL_CN) > 0,DETAIL_KR,NULL) AS MATERIAL_CN
				FROM
						ORDERSHEET_MST
				WHERE
						IDX = ".$ordersheet_idx."
			";
			$db->query($ordersheet_required_sql);
			$product_code = null;
			$empty_column = array();
			foreach($db->fetch() as $data){
				$product_code = $data['PRODUCT_CODE'];
				
				if($data['STYLE_CODE'] == null){
					$empty_column[] = '스타일 코드';
				}
				if($data['COLOR_CODE'] == null){
					$empty_column[] = '컬러코드';
				}
				if($data['PRODUCT_CODE'] == null){
					$empty_column[] = '상품 이름';
				}
				if($data['PRODUCT_NAME'] == null){
					$empty_column[] = '상품명';
				}
				if($data['COLOR'] == null){
					$empty_column[] = '색상명';
				}
				if($data['COLOR_RGB'] == null){
					$empty_column[] = '색상 RGB 코드';
				}
				if($data['PRICE_KR'] == null){
					$empty_column[] = '한국몰 가격';
				}
				if($data['PRICE_EN'] == null){
					$empty_column[] = '영문몰 가격';
				}
				if($data['PRICE_CN'] == null){
					$empty_column[] = '중국몰 가격';
				}
				if($data['DETAIL_KR'] == null){
					$empty_column[] = '상세정보(한국몰)';
				}
				if($data['DETAIL_EN'] == null){
					$empty_column[] = '상세정보(영문몰)';
				}
				if($data['DETAIL_CN'] == null){
					$empty_column[] = '상세정보(중국몰)';
				}
				if($data['CARE_TD_KR'] == null){
					$empty_column[] = '취급 유의사항(한국몰)';
				}
				if($data['CARE_TD_EN'] == null){
					$empty_column[] = '취급 유의사항(영문몰)';
				}
				if($data['CARE_TD_CN'] == null){
					$empty_column[] = '취급 유의사항(중국몰)';
				}
				if($data['MATERIAL_KR'] == null){
					$empty_column[] = '소재(한국몰)';
				}
				if($data['MATERIAL_EN'] == null){
					$empty_column[] = '소재(영문몰)';
				}
				if($data['MATERIAL_CN'] == null){
					$empty_column[] = '소재(중국몰)';
				}
			}
			$option_required_sql = "
				SELECT
						IDX,
						IF(LENGTH(OPTION_NAME) > 0,OPTION_NAME,NULL) AS OPTION_NAME,
						BARCODE,
						OPTION_SIZE_1,
						OPTION_SIZE_2,
						OPTION_SIZE_3,
						OPTION_SIZE_4,
						OPTION_SIZE_5,
						OPTION_SIZE_6
				FROM
						ORDERSHEET_OPTION
				WHERE
						ORDERSHEET_IDX = ".$ordersheet_idx."
			";
			$db->query($option_required_sql);
			
			foreach($db->fetch() as $option_data){
				if($option_data['OPTION_NAME'] == null){
					$empty_column[] = '옵션이름';
					break;
				}
				$option_size_sum = null;
				$option_size_sum += $option_data['OPTION_SIZE_1'];
				$option_size_sum += $option_data['OPTION_SIZE_2'];
				$option_size_sum += $option_data['OPTION_SIZE_3'];
				$option_size_sum += $option_data['OPTION_SIZE_4'];
				$option_size_sum += $option_data['OPTION_SIZE_5'];
				$option_size_sum += $option_data['OPTION_SIZE_6'];

				if($option_size_sum == null || $option_size_sum == 0){
					$empty_column[] = '옵션 사이즈';
					break;
				}
			}
			
			if(count($empty_column) > 0){
				$err_msg .= '<br>상품코드 ['.$product_code.']<br>미입력 항목 : ';
				$err_msg .= implode(',',$empty_column).'<br>';
			}
		}
		
		if ($err_msg > 0) {
			$json_result['code'] = 402;
			$json_result['msg'] = $err_msg;
			return $json_result;
		}
	}
	else if($action_type == 'update_flg_false'){
		$update_flg = 'FALSE';
	}

	$update_ordersheet_sql = "
		UPDATE
			ORDERSHEET_MST
		SET
			UPDATE_FLG = ".$update_flg.",
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE 
			IDX IN (".implode(",", $ordersheet_idx_list).")";

	$update_row_cnt = 0;

	$db->query($update_ordersheet_sql);

	$update_row_cnt = $db->mysqli_affected_rows();

	if($update_row_cnt == count($ordersheet_idx_list)){
		$insert_history_sql = "
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
			)
			SELECT
				OM.IDX				AS ORDERSHEET_IDX,
				'MD'				AS ORDERSHEET_AUTH,
				'U'					AS ACTION_TYPE,
				OM.PRODUCT_CODE		AS PRODUCT_CODE,
				OM.PRODUCT_NAME		AS PRODUCT_NAME,
				CASE 
					WHEN
						UPDATE_FLG = TRUE 
						THEN
							CONCAT(
								'[',OM.PRODUCT_CODE,'] ',
								IFNULL(
									OM.PRODUCT_NAME,''
								),
								'의 오더시트 상태가 [작성 완료]로 변경되었습니다.'
							)
					WHEN
						UPDATE_FLG = FALSE
						THEN
							CONCAT(
								'[',OM.PRODUCT_CODE,'] ',
								IFNULL(
									OM.PRODUCT_NAME,''
								),
								'의 오더시트 상태가 [작성 중]으로 변경되었습니다.'
							) 
				END					AS HISTORY_MSG,
				NOW(),
				'".$session_id."'
			FROM
				ORDERSHEET_MST OM
			WHERE
				IDX IN (".implode(',', $ordersheet_idx_list).")
		";
		
		$db->query($insert_history_sql);
	}
	
	$db->commit();
} catch(mysqli_sql_exception $exception){
	$json_result['code'] = 300;
	$json_result['exception_msg'] = $exception;
	$db->rollback();
}

?>