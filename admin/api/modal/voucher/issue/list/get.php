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
$voucher_idx		= $_POST['voucher_idx'];

$voucher_issue_code	= $_POST['voucher_issue_code'];

$add_to				= $_POST['add_to'];
$add_from			= $_POST['add_from'];

$start_from			= $_POST['start_from'];
$start_to			= $_POST['start_to'];

$end_from			= $_POST['end_from'];
$end_to				= $_POST['end_to'];

$create_year		= $_POST['create_year'];
$create_month		= $_POST['create_month'];

$search_type		= $_POST['search_type'];
$search_keyword		= $_POST['search_keyword'];

$order_code			= $_POST['order_code'];

$sort_value			= $_POST['sort_value'];
$sort_type			= $_POST['sort_type'];

$page				= $_POST['page'];
$rows				= $_POST['rows'];

if ($country != null && $voucher_idx != null) {
	$table = "
		VOUCHER_ISSUE VI
		LEFT JOIN VOUCHER_MST VM ON
		VI.VOUCHER_IDX = VM.IDX
		LEFT JOIN ORDER_PRODUCT OP ON
		VI.IDX = OP.PRODUCT_IDX AND
		OP.PRODUCT_CODE NOT LIKE 'VOUXXX%'
		LEFT JOIN MEMBER_".$country." MB ON
		VI.MEMBER_IDX = MB.IDX
		LEFT JOIN MEMBER_LEVEL ML ON
		MB.LEVEL_IDX = ML.IDX
	";
	
	$where = " VOUCHER_IDX = ".$voucher_idx." AND DEL_FLG = FALSE ";
	
	$where_cnt = $where;
	
	if ($voucher_issue_code != null) {
		$where .= " AND (VI.VOUCHER_ISSUE_CODE LIKE '%".$voucher_issue_code."%') ";
	}

	if ($add_from != null || $add_to!= null) {
		if ($add_from == null && $add_to == null) {
			$where .= " AND (VI.VOUCHER_ADD_DATE >= '".$add_from."') ";
		} else if ($add_from == null && $add_to == null) {
			$where .= " AND (VI.VOUCHER_ADD_DATE <= '".$add_to."') ";
		} else if ($add_from == null && $add_to == null) {
			$where .= " AND (VI.VOUCHER_ADD_DATE BETWEEN '".$add_from."' AND '".$add_to."') ";
		}
	}

	if ($start_from != null || $start_to != null) {
		if ($start_from == null && $start_to == null) {
			$where .= " AND (VI.USABLE_START_DATE >= '".$start_from."') ";
		} else if ($start_from == null && $start_to == null) {
			$where .= " AND (VI.USABLE_START_DATE <= '".$start_to."') ";
		} else if ($start_from == null && $start_to == null) {
			$where .= " AND (VI.USABLE_START_DATE BETWEEN '".$start_from."' AND '".$start_to."') ";
		}
	}

	if ($end_from != null || $end_to != null) {
		if ($end_from == null && $end_to == null) {
			$where .= " AND (VI.USABLE_END_DATE >= '".$end_from."') ";
		} else if ($end_from == null && $end_to == null) {
			$where .= " AND (VI.USABLE_END_DATE <= '".$end_to."') ";
		} else if ($end_from == null && $end_to == null) {
			$where .= " AND (VI.USABLE_END_DATE BETWEEN '".$start_from."' AND '".$end_to."') ";
		}
	}

	if ($create_year != null) {
		$where .= " AND (CREATE_YEAR = '".$create_year;."') ";
	}
	
	if ($create_month != null) {
		$where .= " AND (CREATE_MONTH = '".$create_month;."') ";
	}
	
	if ($search_type != null && $search_keyword != null) {
		for ($i=0; $i<count($search_keyword); $i++) {
			if ($search_type[$i] != null && $search_keyword[$i] != null) {
				switch ($search_type) {
					case "member_id" :
						$where .= " AND (MB.MEMBER_ID LIKE '%".$search_keyword."%') ";
						break;
					
					case "member_name" :
						$where .= " AND (MB.MEMBER_NAME LIKE '%".$search_keyword."%') ";
						break;
					
					case "member_level" :
						$where .= " AND (ML.TITLE LIKE '%".$search_keyword."%') ";
						break;
				}
			}
		}
	}

	if ($order_code != null) {
		$where .= " AND (OP.ORDER_CODE LIKE '%".$order_code."%') ";
	}
	
	$json_result = array(
		'total' => $db->count($table,$where),
		'total_cnt' => $db->count($table,$where_cnt),
		'page' => $page
	);
	
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " VI.".$sort_value." ".$sort_type." ";
	} else {
		$order = " VI.IDX DESC ";
	}
	
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
			
			VI.MEMBER_IDX			AS MEMBER_IDX,
			VI.MEMBER_ID			AS MEMBER_ID,
			
			VI.USED_FLG				AS USED_FLG,
			IFNULL(
				OP.ORDER_CODE,'-'
			)						AS ORDER_CODE,
			
			DATE_FORMAT(
				VI.CREATE_DATE,
				'%Y-%m-%d %H:%i'
			)						AS CREATE_DATE,
			VI.CREATER				AS CREATER,
			DATE_FORMAT(
				VI.UPDATE_DATE,
				'%Y-%m-%d %H:%i'
			)						AS UPDATE_DATE,
			VI.UPDATER				AS UPDATER
		FROM
			".$table."
		WHERE
			".$where."
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
			'on_off_type'			=>$issue_data['ON_OFF_TYPE'],
			'voucher_type'			=>$issue_data['VOUCHER_TYPE'],
			'voucher_code'			=>$issue_data['VOUCHER_CODE'],
			'voucher_name'			=>$issue_data['VOUCHER_NAME'],
			
			'voucher_issue_code'	=>$issue_data['VOUCHER_ISSUE_CODE'],
			'voucher_add_date'		=>$issue_data['VOUCHER_ADD_DATE'],
			'member_idx'			=>$issue_data['MEMBER_IDX'],
			'member_id'				=>$issue_data['MEMBER_ID'],
			'used_flg'				=>$issue_data['USED_FLG'],
			'order_code'			=>$issue_data['ORDER_CODE'],
			
			'creat_date'			=>$issue_data['CREATE_DATE'],
			'creat_date'			=>$issue_data['CREATER'],
			'update_date'			=>$issue_data['UPDATE_DATE'],
			'updater'				=>$issue_data['UPDATER']
		);
	}
}

?>