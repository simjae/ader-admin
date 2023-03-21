<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.01
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

//재고시트 json string 디코딩
$stock_sheet = $_POST['stock_sheet'];
$sheet_data = json_decode($stock_sheet, true);

$msg = "";

$stock_regist_fail_cnt = array();
$stock_regist_fail_option = array();

if($sheet_data != null){
	$success_cnt = 0;
	
	$wms_sql= "SELECT
					OPTION_CODE,
					SUM(QTY) AS WMS_STOCK
				FROM
					WMS_DUMMY
				GROUP BY
					OPTION_CODE";
	$db->query($wms_sql);
	
	$wms_stock = array();
	foreach($db->fetch() as $data) {
		$option_code = $data['OPTION_CODE'];
		$wms_stock[$option_code] = $data['WMS_STOCK'];
	}
	
	$row = 1;
	foreach($sheet_data as $val){
		/*
			$val[0]:상품코드,
			$val[1]:상품이름,
			$val[2]:옵션코드,
			$val[3]:옵션이름,
			$val[4]:재고수량,
			$val[5]:안전재고,
			$val[6]:총 누적판매량,
			$val[7]:재고적용일,
		*/
		$row++;
		if ($db->count('PRODUCT_OPTION'," PRODUCT_CODE = '".$val[0]."' AND OPTION_CODE = '".$val[2]."' ") > 0) {
			$stock_sql= "SELECT
							SUM(STOCK_QUANTITY) AS STOCK_QUANTITY
						FROM
							PRODUCT_STOCK
						WHERE
							OPTION_CODE = '".$val[2]."'";
			$db->query($stock_sql);
			
			$stock = 0;
			foreach($db->fetch() as $data) {
				$stock = $data['STOCK_QUANTITY'];
			}
				
			if((intval($wms_stock[$val[2]]) - ($stock + intval($val[4])) > 0)){
				$sql = "INSERT INTO PRODUCT_STOCK(	
							PRODUCT_CODE,
							PRODUCT_NAME,
							OPTION_CODE,
							OPTION_NAME,
							STOCK_QUANTITY,
							STOCK_SAFE_QUANTITY,
							TOTAL_SALES_CNT,
							STOCK_DATE,
							CREATE_DATE,
							CREATER
						) VALUES(
							'".$val[0]."',
							'".$val[1]."',
							'".$val[2]."',
							'".$val[3]."',
							".$val[4].",
							".$val[5].",
							".$val[6].",
							'".$val[7]."',
							NOW(),
							'Admin'
						)";
				
				$db->query($sql);
				$success_cnt++;
			} else {
				array_push($stock_regist_fail_cnt,$row.'행');
			}
		} else {
			array_push($stock_regist_fail_option,$row.'행');
		}
	}
	if(count($sheet_data) != $success_cnt){
		$code = 500;
		if (count($stock_regist_fail_cnt) > 0) {
			$msg = "WMS에 등록되어있는 재고 이상의 값은 등록할 수 없습니다.";
			$json_result['stock_fail'] = $stock_regist_fail_cnt;
		} else if (count($stock_regist_fail_option) > 0) {
			$msg = "옵션이 등록되지 않은 상품의 재고정보가 존재합니다. 옵션정보를 확인해주세요.";
			$json_result['stock_fail'] = $stock_regist_fail_option;
		}
	} else {
		$json_result['success_cnt'] = $success_cnt;
	}
}
?>