<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 바우처 정보 개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.08
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$voucher_idx			= $_POST['voucher_idx'];

if ($voucher_idx != null) {
	$select_voucher_issue_sql = "
		SELECT
			VM.IDX						AS VOUCHER_IDX,
			VM.COUNTRY					AS COUNTRY,
			VM.ON_OFF_TYPE				AS ON_OFF_TYPE,
			VM.VOUCHER_TYPE				AS VOUCHER_TYPE,
			VM.VOUCHER_CODE				AS VOUCHER_CODE,
			VM.VOUCHER_NAME				AS VOUCHER_NAME,
			
			IFNULL(
				DATE_FORMAT(
					VM.ISSUE_START_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS ISSUE_START_DATE,
			IFNULL(
				DATE_FORMAT(
					VM.ISSUE_END_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS ISSUE_END_DATE,
			VM.VOUCHER_DATE_TYPE		AS VOUCHER_DATE_TYPE,
			VM.VOUCHER_DATE_PARAM		AS VOUCHER_DATE_PARAM,
			IFNULL(
				DATE_FORMAT(
					VM.VOUCHER_START_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS VOUCHER_START_DATE,
			IFNULL(
				DATE_FORMAT(
					VM.VOUCHER_END_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS VOUCHER_END_DATE,
			
			VM.MIN_PRICE				AS MIN_PRICE,
			VM.SALE_TYPE				AS SALE_TYPE,
			VM.SALE_PRICE				AS SALE_PRICE,
			
			IFNULL(
				VM.DESCRIPTION,'-'
			)							AS DESCRIPTION,
			VM.MILEAGE_FLG				AS MILEAGE_FLG,
			VM.MEMBER_LEVEL				AS MEMBER_LEVEL,
			VM.TOT_ISSUE_NUM			AS TOT_ISSUE_NUM,
			
			VM.DATE_AGO_PARAM			AS DATE_AGO_PARAM,
			VM.DATE_LATER_PARAM			AS DATE_LATER_PARAM,
			
			VM.EXCEPT_PRODUCT_FLG		AS EXCEPT_PRODUCT_FLG,
			
			DATE_FORMAT(
				VM.CREATE_DATE,
				'%Y-%m-%d %H:%i'
			)						AS CREATE_DATE,
			VM.CREATER				AS CREATER,
			DATE_FORMAT(
				VM.UPDATE_DATE,
				'%Y-%m-%d %H:%i'
				
			)						AS UPDATE_DATE,
			VM.UPDATER				AS UPDATER
		FROM
			VOUCHER_MST VM
		WHERE
			VM.IDX = ".$voucher_idx."
	";
	
	$db->query($select_voucher_issue_sql);
	
	foreach($db->fetch() as $voucher_data) {
		$country = "";
		switch($voucher_data['COUNTRY']) {
			case "KR" :
				$country = "한국몰";
				break;
			
			case "EN" :
				$country = "영문몰";
				break;
			
			case "CN" :
				$country = "중문몰";
				break;
		}
		
		$voucher_date_type = "";
		$voucher_date_param = "";
		
		if ($voucher_date_type = "FXD") {
			$voucher_date_type = "고정일";
			$voucher_date_param = "-";
		} else if ($voucher_date_type == "PRD") {
			$voucher_date_type = "등록일";
			$voucher_date_param = $voucher_data['VOUCHER_DATE_PARAM']."간 사용 가능";
		}
		
		$on_off_type = "";
		if ($voucher_data['ON_OFF_TYPE'] == "ON") {
			$on_off_type = "온라인";
		} else if ($voucher_data['ON_OFF_TYPE'] == "OFF") {
			$on_off_type = "오프라인";
		}
		
		$voucher_type = "";
		switch($voucher_data['VOUCHER_TYPE']) {
			case "BR" :
				$voucher_type = "생일바우처";
				break;
			
			case "OFF" :
				$voucher_type = "오프라인 바우처";
				break;
			
			case "LV" :
				$voucher_type = "회원등급 바우처";
				break;
			
			case "MB" :
				$voucher_type = "회원지정 바우처";
				break;
		}
		
		$sale_type = "";
		$sale_price = "";
		if ($voucher_data['SALE_TYPE'] == "PER") {
			$sale_type = "비율";
			$sale_price = $voucher_data['SALE_PRICE']."%";
		} else if ($voucher_data['SALE_TYPE'] == "PRC") {
			$sale_type = "고정";
			$sale_price = number_format($voucher_data['SALE_PRICE']);
		}
		
		$issue_cnt = $db->count("VOUCHER_ISSUE","VOUCHER_IDX = ".$voucher_idx." AND DEL_FLG = FALSE");
		
		$json_result['data'] = array(
			'voucher_idx'			=>$voucher_data['VOUCHER_IDX'],
			'country'				=>$country,
			'on_off_type'			=>$on_off_type,
			'voucher_type'			=>$voucher_type,
			'voucher_code'			=>strtoupper($voucher_data['VOUCHER_CODE']),
			'voucher_name'			=>$voucher_data['VOUCHER_NAME'],
			
			'issue_start_date'		=>$voucher_data['ISSUE_START_DATE'],
			'issue_end_date'		=>$voucher_data['ISSUE_END_DATE'],
			'voucher_date_type'		=>$voucher_date_type,
			'voucher_date_param'	=>$voucher_date_param,
			'voucher_start_date'	=>$voucher_data['VOUCHER_START_DATE'],
			'voucher_end_date'		=>$voucher_data['VOUCHER_END_DATE'],
			
			'min_price'				=>number_format($voucher_data['MIN_PRICE']),
			'sale_type'				=>$sale_type,
			'sale_price'			=>$sale_price,
			
			'description'			=>$voucher_data['DESCRIPTION'],
			'member_level'			=>$voucher_data['MEMBER_LEVEL'],
			'mileage_flg'			=>($voucher_data['MILEAGE_FLG'] == true) ? "사용가능" : "사용불가",
			'except_product_flg'	=>($voucher_data['EXCEPT_PRODUCT_FLG']) ? "제한있음" : "제한없음",
			
			'tot_issue_num'			=>$voucher_data['TOT_ISSUE_NUM'],
			'issue_cnt'				=>$issue_cnt,
			
			'create_date'			=>$voucher_data['CREATE_DATE'],
			'creater'				=>$voucher_data['CREATER'],
			'update_date'			=>$voucher_data['UPDATE_DATE'],
			'updater'				=>$voucher_data['UPDATER']
		);
	}
}

?>