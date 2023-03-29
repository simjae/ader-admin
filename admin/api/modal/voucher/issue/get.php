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

$sort_value				= $_POST['sort_value'];
$sort_type				= $_POST['sort_type'];

$page					= $_POST['page'];
$rows					= $_POST['rows'];

if ($voucher_idx != null) {
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " ".$sort_value." ".$sort_type." ";
	} else {
		$order = " VI.IDX DESC ";
	}
	
	$json_result = array(
		'total' => $db->count("VOUCHER_ISSUE VI","VI.VOUCHER_IDX = ".$voucher_idx),
		'total_cnt' => $db->count("VOUCHER_ISSUE VI","VI.VOUCHER_IDX = ".$voucher_idx),
		'page' => $page
	);
	
	$select_voucher_issue_sql = "
		SELECT
			VM.COUNTRY				AS COUNTRY,
			VM.ON_OFF_TYPE			AS ON_OFF_TYPE,
			VM.VOUCHER_TYPE			AS VOUCHER_TYPE,
			VM.VOUCHER_CODE			AS VOUCHER_CODE,
			VM.VOUCHER_NAME			AS VOUCHER_NAME,
			
			VI.VOUCHER_ISSUE_CODE	AS VOUCHER_ISSUE_CODE,
			IFNULL(
				DATE_FORMAT(
					VI.VOUCHER_ADD_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS VOUCHER_ADD_DATE,
			IFNULL(
				DATE_FORMAT(
					VI.USABLE_START_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS USABLE_START_DATE,
			IFNULL(
				DATE_FORMAT(
					VI.USABLE_END_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS USABLE_END_DATE,
			
			VI.CREATE_YEAR			AS CREATE_YEAR,
			VI.CREATE_MONTH			AS CREATE_MONTH,
			
			VI.MEMBER_IDX			AS MEMBER_IDX,
			VI.MEMBER_ID			AS MEMBER_ID,
			
			VI.USED_FLG				AS USED_FLG,
			IFNULL(
				OP.ORDER_CODE,'-'
			)						AS ORDER_CODE,
			DATE_FORMAT(
				VI.UPDATE_DATE,
				'%Y-%m-%d %H:%i'
			)						AS UPDATE_DATE
		FROM
			VOUCHER_ISSUE VI
			LEFT JOIN VOUCHER_MST VM ON
			VI.VOUCHER_IDX = VM.IDX
			LEFT JOIN ORDER_PRODUCT OP ON
			VI.IDX = OP.PRODUCT_IDX AND
			OP.PRODUCT_CODE NOT LIKE 'VOUXXX%'
		WHERE
			VI.VOUCHER_IDX = ".$voucher_idx."
		ORDER BY
			".$order."
	";
	
	$limit_start = (intval($page)-1)*$rows;	
	if ($rows != null) {
		$select_voucher_issue_sql .= " LIMIT ".$limit_start.",".$rows;
	}
	
	$db->query($select_voucher_issue_sql);
	
	foreach($db->fetch() as $issue_data) {
		$json_result['data'][] = array(
			'country'				=>$issue_data['COUNTRY'],
			
			'voucher_issue_code'	=>strtoupper($issue_data['VOUCHER_ISSUE_CODE']),
			'voucher_add_date'		=>$issue_data['VOUCHER_ADD_DATE'],
			'usable_start_date'		=>$issue_data['USABLE_START_DATE'],
			'usable_end_date'		=>$issue_data['USABLE_END_DATE'],
			
			'member_idx'			=>$issue_data['MEMBER_IDX'],
			'member_id'				=>$issue_data['MEMBER_ID'],
			'used_flg'				=>($issue_data['USED_FLG'] == true) ? "사용":"미사용"
		);
	}
}

?>