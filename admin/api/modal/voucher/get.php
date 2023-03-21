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

$country			= $_POST['country'];
$member_idx			= $_POST['member_idx'];

$sort_value			= $_POST['sort_value'];
$sort_type			= $_POST['sort_type'];

$page				= $_POST['page'];
$rows				= $_POST['rows'];

if ($country != null && $member_idx != null) {
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " ".$sort_value." ".$sort_type." ";
	} else {
		$order = " VI.IDX DESC ";
	}
	
	$json_result = array(
		'total' => $db->count("VOUCHER_ISSUE VI","VI.COUNTRY = '".$country."' AND VI.MEMBER_IDX = ".$member_idx),
		'total_cnt' => $db->count("VOUCHER_ISSUE VI","VI.COUNTRY = '".$country."' AND VI.MEMBER_IDX = ".$member_idx),
		'page' => $page
	);
	
	$select_voucher_issue_sql = "
		SELECT
			VM.IDX					AS VOUCHER_IDX,
			VM.ON_OFF_TYPE			AS ON_OFF_TYPE,
			VM.VOUCHER_NAME			AS VOUCHER_NAME,
			VM.SALE_TYPE			AS SALE_TYPE,
			VM.SALE_PRICE			AS SALE_PRICE,
			
			IFNULL(
				DATE_FORMAT(
					VI.VOUCHER_ADD_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS VOUCHER_ADD_DATE,
			VI.USED_FLG				AS USED_FLG,
			IFNULL(
				OP.ORDER_CODE,'-'
			)						AS ORDER_CODE,
			
			IFNULL(
				DATE_FORMAT(
					VI.UPDATE_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS UPDATE_DATE
		FROM
			VOUCHER_ISSUE VI
			LEFT JOIN VOUCHER_MST VM ON
			VI.VOUCHER_IDX = VM.IDX
			LEFT JOIN ORDER_PRODUCT OP ON
			VI.IDX = OP.PRODUCT_IDX AND
			OP.PRODUCT_CODE NOT LIKE 'VOUXXX%'
		WHERE
			VI.COUNTRY = '".$country."' AND
			VI.MEMBER_IDX = ".$member_idx."
		ORDER BY
			".$order."
	";
	
	$limit_start = (intval($page)-1)*$rows;	
	if ($rows != null) {
		$select_voucher_issue_sql .= " LIMIT ".$limit_start.",".$rows;
	}
	
	$db->query($select_voucher_issue_sql);
	
	foreach($db->fetch() as $issue_data) {
		$on_off_type = "";
		if ($issue_data['ON_OFF_TYPE'] == "ON") {
			$on_off_type = "온라인";
		} else if ($issue_data['ON_OFF_TYPE'] == "OFF") {
			$on_off_type = "오프라인";
		}
		
		$sale_type = "";
		$sale_price = "";
		if ($issue_data['SALE_TYPE'] == "PER") {
			$sale_type = "비율";
			$sale_price = $issue_data['SALE_PRICE']."%";
		} else if ($issue_data['SALE_TYPE'] == "PRC") {
			$sale_type = "고정";
			$sale_price = number_format($issue_data['SALE_PRICE']);
		}
		
		$used_flg = "";
		$update_date = null;
		
		if ($issue_data['USED_FLG'] == true) {
			$used_flg = "사용";
			$update_date = $issue_data['UPDATE_DATE'];
		} else if ($issue_data['USED_FLG'] == false) {
			$used_flg = "미사용";
			$update_date = "-";
		}
		
		$json_result['data'][] = array(
			'voucher_idx'			=>$issue_data['VOUCHER_IDX'],
			'on_off_type'			=>$on_off_type,
			'voucher_name'			=>$issue_data['VOUCHER_NAME'],
			'sale_type'				=>$sale_type,
			'sale_price'			=>$sale_price,
			
			'voucher_add_date'		=>$issue_data['VOUCHER_ADD_DATE'],
			'used_flg'				=>$used_flg,
			'order_code'			=>$issue_data['ORDER_CODE'],
			
			'update_date'			=>$update_date
		);
	}
}

?>