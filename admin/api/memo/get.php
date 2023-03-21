<?php
/*
 +=============================================================================
 | 
 | 메모 개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$param_memo_idx		= $_POST['memo_idx'];
$param_memo_type	= $_POST['memo_type'];

$page				= $_POST['page'];
$rows				= $_POST['rows'];

if ($param_memo_type != null && $param_memo_idx != null) {
	$select_memo_info = "";
	switch ($param_memo_type) {
		case "MB" :
			$memo_table .= "
				LEFT JOIN MEMBER_".$country." MB ON
				ML.TYPE_COUNTRY = MB.COUNTRY AND
				ML.TYPE_IDX = MB.IDX
			";
			
			$select_memo_info = "
				MB.IDX				AS MEMBER_IDX,
				MB.MEMBER_NAME		AS MEMBER_NAME,
				MB.MEMBER_ID		AS MEMBER_ID,
			";
			break;
		
		case "PR" :
			$memo_table .= "
				LEFT JOIN SHOP_PRODUCT PR ON
				ML.TYPE_IDX = PR.IDX
			";
			
			$select_memo_info = "
				PR.PRODUCT_IDX		AS PRODUCT_IDX,
				PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
				PR.PRODUCT_NAME		AS PRODUCT_NAME,
			";
			break;
		
		case "OR" :
			$memo_table .= "
				LEFT JOIN ORDER_INFO OI ON
				ML.TYPE_IDX = OI.IDX
			";
			
			$select_memo_info = "
				OI.IDX				AS ORDER_IDX,
				OI.ORDER_CODE		AS ORDER_CODE,
				OI.ORDER_DATE		AS ORDER_DATE,
			";
			break;
	}
	
	$select_memo_sql = "
		SELECT
			ML.IDX				AS MEMO_IDX,
			ML.MEMO_TYPE		AS MEMO_TYPE,
			ML.TYPE_COUNTRY		AS TYPE_COUNTRY,
			ML.TYPE_IDX			AS TYPE_IDX,
			".$select_memo_info."
			ML.MEMO				AS MEMO,
			
			DATE_FORMAT(
				ML.CREATE_DATE,
				'%Y-%m-%d %H:%i'
			)					AS CREATE_DAT,
			ML.CREATER			AS CREATER
		FROM
			MEMO_LOG ML
			".$memo_table."
		WHERE
			IDX = ".$param_memo_idx."
	";
	
	$db->query($select_memo_sql);
	
	foreach ($db->fetch() $memo_data) {
		$memo_type = $memo_data['MEMO_TYPE'];
		$type_idx = $memo_data['TYPE_IDX'];
		$type_country = "NULL";
		
		if (!empty($memo_data['TYPE_COUNTRY'])) {
			$type_country = "'".$memo_data['TYPE_COUNTRY']."'";
		}
		
		if (!empty($type_idx) && !empty($memo_type)) {
			$total_cnt = $db->count("MEMO_LOG","TYPE_IDX = ".$type_idx);
			
			$json_result = array(
				'total' => $total_cnt,
				'total_cnt' => $total_cnt,
				'page' => $page
			);
			
			$select_memo_log_sql = "
				SELECT
					ML.MEMO			AS MEMO,
					
					DATE_FORMAT(
						ML.CREATE_DATE,
						'%Y-%m-%d %H:%i'
					)		AS CREATE_DATE,
					ML.CREATER			AS CREATER
				FROM
					MEMO_LOG ML
				WHERE
					ML.MEMO_TYPE = '".$memo_type."' AND
					ML.TYPE_IDX = ".$type_idx." AND
					ML.TYPE_COUNTRY = ".$type_country."
				ORDER BY
					IDX DESC
			";
			
			$limit_start = (intval($page)-1)*$rows;	
			if ($rows != null) {
				$select_memo_log_sql .= " LIMIT ".$limit_start.",".$rows;
			}
			
			$db->query($select_memo_log_sql);
			
			$log_info = array();
			foreach($db->fetch() as $log_data) {
				$log_info[] = array(
					'memo'				=>$log_data['MEMO'],
					
					'create_date'		=>$log_data['CREATE_DATE'],
					'creater'			=>$log_data['CREATER'],
				);
			}
		}
		
		$txt_memo_type = "";
		switch ($memo_data['MEMO_TYPE']) {
			case "MB" :
				$txt_memo_type = "회원";
				break;
			
			case "PR" :
				$txt_memo_type = "상품";
				break;
			
			case "OR" :
				$txt_memo_type = "주문";
				break;
		}
		
		$json_result['data'] = array(
			'num'				=>$total_cnt--,
			'txt_memo_type'		=>$txt_memo_type,
			
			'member_idx'		=>$memo_data['MEMBER_IDX'],
			'member_name'		=>$memo_data['MEMBER_NAME'],
			'member_id'			=>$memo_data['MEMBER_ID'],
			
			'product_idx'		=>$memo_data['PRODUCT_IDX'],
			'product_type'		=>$memo_data['PRODUCT_TYPE'],
			'product_name'		=>$memo_data['PRODUCT_NAME'],
			
			'order_idx'			=>$memo_data['ORDER_IDX'],
			'order_code'		=>$memo_data['ORDER_CODE'],
			'order_date'		=>$memo_data['ORDER_DATE'],
			
			'create_date'		=>$memo_data['CREATE_DATE'],
			'creater'			=>$memo_data['CREATER'],
			
			'log_info'			=>$log_info
		);
	}
}

?>