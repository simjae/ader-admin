<?php
/*
 +=============================================================================
 | 
 | 블루마크 엑셀 업로드 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

//블루마크시트 json string 디코딩
$bluemark_sheet = $_POST['bluemark_sheet'];
$sheet_data = json_decode($bluemark_sheet, true);

$msg = "";

$bluemark_regist_fail_cnt = array();

if($sheet_data != null){
	$success_cnt = 0;
	
	$row = 1;
	foreach($sheet_data as $val){
		/*
			$val[0]:상품코드,
			$val[1]:옵션코드,
			$val[2]:시리얼넘버,
			$val[3]:시즌
		*/
		$row++;
		if ($db->count('dev.BLUEMARK_INFO'," SERIAL_CODE = '".$val[2]."' ") == 0) {
			if(strlen($val[0]) != null ){
				$sql = "INSERT INTO dev.BLUEMARK_INFO(	
							PRODUCT_IDX,
							PRODUCT_CODE,
							PRODUCT_NAME,
							OPTION_IDX,
							OPTION_CODE,
							OPTION_NAME,
							SERIAL_CODE,
							SEASON,
							CREATER,
							UPDATER
						)
						SELECT
							PR.IDX			AS PRODUCT_IDX,
							PR.PRODUCT_CODE	AS PRODUCT_CODE,
							PR.PRODUCT_NAME	AS PRODUCT_NAME,
							OO.IDX			AS OPTION_IDX,
							OO.BARCODE		AS BARCODE,
							OO.OPTION_NAME	AS OPTION_NAME,
							'".$val[2]."'	AS SERIAL_CODE,
							'".$val[3]."'	AS SEASON,
							'Admin'			AS CREATER,
							'Admin'			AS UPDATER
						FROM
							dev.SHOP_PRODUCT PR
							LEFT JOIN dev.ORDERSHEET_OPTION OO ON
							PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
						WHERE
							PR.PRODUCT_CODE = '".$val[0]."' AND
							OO.BARCODE = '".$val[1]."'";
				
				$db->query($sql);
				$success_cnt++;
			}
		} else {
			array_push($bluemark_regist_fail_cnt,$row.'행');
		}
	}
	if(count($sheet_data) != $success_cnt){
		$code = 500;
		$msg = "중복된 인증키로는 등록할 수 없습니다.";
		$json_result['bluemark_fail'] = $bluemark_regist_fail_cnt;
	} else {
		$json_result['success_cnt'] = $success_cnt;
	}
}
?>