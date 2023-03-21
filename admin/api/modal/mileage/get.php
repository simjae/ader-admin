<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 멤버 정보 조회
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

$country				= $_POST['country'];
$member_idx				= $_POST['member_idx'];

$order_code				= $_POST['order_code'];
$order_product_code		= $_POST['order_product_code'];
$mileage_code			= $_POST['mileage_code'];
$mileage_type			= $_POST['mileage_type'];

$min_mileage			= $_POST['min_mileage'];
$max_mielage			= $_POST['max_mileage'];

$date_param				= $_POST['date_param'];
$date_from				= $_POST['date_from'];
$date_to				= $_POST['date_to'];

$sort_value				= $_POST['sort_value'];
$sort_type				= $_POST['sort_type'];

$page					= $_POST['page'];
$rows					= $_POST['rows'];

if ($country != null && $member_idx != null) {
	$where  = " MI.COUNTRY = '".$country."' AND MI.MEMBER_IDX = ".$member_idx." ";
	
	$where_cnt = $where;
	
	if ($mileage_type != "ALL" && $mileage_type != null) {
		switch ($mileage_type) {
			case "UNU" :
				$where .= " AND (MI.MILEAGE_UNUSABLE > 0) ";
				break;
				
			case "INC" :
				$where .= " AND (MI.MILEAGE_CODE LIKE '%IN' AND MI.MILEAGE_USABLE_INC > 0) ";
				break;
			
			case "DEC" :
				$where .= " AND (MI.MILEAGE_CODE LIKE '%DC' AND MI.MILEAGE_USABLE_DEC > 0) ";
				break;
		}
	}
	
	if ($mileage_code = "ALL" && $mileage_code != null) {
		$where .= " AND (MI.MILEAGE_CODE = '".$mileage_code."') ";
	}
	
	if ($order_code != null) {
		$where .= " AND (MI.ORDER_CODE = '".$order_code."') ";
	}
	
	if ($order_product_code != null) {
		$where .= " AND (MI.ORDER_PRODUCT_CODE = '".$order_product_code."') ";
	}
	
	if (($min_mileage > 0 && $min_mileage != null) || ($max_mileage > 0 && $max_mileage != null)) {
		if ($min_mileage != null && $max_mileage == null) {
			$where .= "
				AND (
					MI.MILEAGE_UNUSABLE >= ".$min_mileage." OR
					MI.MILEAGE_USABLE_INC >= ".$min_mileage." OR
					MI.MILEAGE_USABLE_DEC >= ".$min_mileage."
				)
			";
		} else if ($min_mileage == null && $max_mileage != null) {
			$where .= "
				AND (
					MI.MILEAGE_UNUSABLE <= ".$max_mileage." OR
					MI.MILEAGE_USABLE_INC <= ".$max_mileage." OR
					MI.MILEAGE_USABLE_DEC <= ".$max_mileage."
				)
			";
		} else if ($min_mileage != null && $max_mileage != null) {
			$where .= "
				AND (
					MI.MILEAGE_UNUSABLE BETWEEN ".$min_mileage." AND ".$max_mileage." OR
					MI.MILEAGE_USABLE_INC BETWEEN ".$min_mileage." AND ".$max_mileage." OR
					MI.MILEAGE_USABLE_DEC BETWEEN ".$min_mileage." AND ".$max_mileage."
				)
			";
		}
	}
	
	if ($date_param != null || $date_from != null || $date_to != null) {
		if ($date_param != null) {
			switch ($date_param) {
				case "today" :
					$where .= ' AND (MI.CREATE_DATE = CURDATE()) ';
					break;
				case "01d" :
					$where .= ' AND (MI.CREATE_DATE >= (CURDATE() - INTERVAL 1 DAY)) ';
					break;
				case "03d" :
					$where .= ' AND (MI.CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
					break;
				case "07d" :
					$where .= ' AND (MI.CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
					break;
				case "15d" :
					$where .= ' AND (MI.CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
					break;
				case "01m" :
					$where .= ' AND (MI.CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
					break;
				case "03m" :
					$where .= ' AND (MI.CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
					break;
				case "01y" :
					$where .= ' AND (MI.CREATE_DATE >= (CURDATE() - INTERVAL 1 YEAR)) ';
					break;
			}
		} else if ($date_from != null || $date_to != null) {
			if ($date_start != null && $date_to == null) {
				$where .= " AND (MI.".$date_type." >= '".$date_from."') ";
			} else if ($date_from == null && $date_to != null) {
				$where .= " AND (OI.".$date_type." <= '".$date_to."') ";
			} else if ($date_from != null && $date_to != null) {
				$where .= " AND (OI.".$date_type." BETWEEN '".$date_from."' AND '".$date_to."') ";
			}
		}
	}
	
	$json_result = array(
		'total' => $db->count("MILEAGE_INFO MI",$where),
		'total_cnt' => $db->count("MILEAGE_INFO MI",$where_cnt),
		'page' => $page
	);
	
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " MI.".$sort_value." ".$sort_type." ";
	} else {
		$order = " MI.IDX DESC ";
	}
	
	$select_mileage_info_sql = "
		SELECT
			MI.MILEAGE_UNUSABLE				AS MILEAGE_UNUSABLE,
			MI.MILEAGE_USABLE_INC			AS MILEAGE_USABLE_INC,
			MI.MILEAGE_USABLE_DEC			AS MILEAGE_USABLE_DEC,
			MI.MILEAGE_BALANCE				AS MILEAGE_BALANCE,
			
			IFNULL(
				MI.ORDER_CODE,'-'
			)								AS ORDER_CODE,
			IFNULL(
				MI.ORDER_PRODUCT_CODE,'-'
			)								AS ORDER_PRODUCT_CODE,
			IFNULL(
				DATE_FORMAT(
					MI.MILEAGE_USABLE_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)								AS MILEAGE_USABLE_DATE,
			
			DATE_FORMAT(
				MI.CREATE_DATE,
				'%Y-%m-%d %H:%i'
			)								AS CREATE_DATE,
			
			MC.MILEAGE_TYPE					AS MILEAGE_TYPE
		FROM
			MILEAGE_INFO MI
			LEFT JOIN MILEAGE_CODE MC ON
			MI.MILEAGE_CODE = MC.MILEAGE_CODE
		WHERE
			".$where."
		ORDER BY
			".$order."
	";
	
	$limit_start = (intval($page)-1)*$rows;	
	if ($rows != null) {
		$select_mileage_info_sql .= " LIMIT ".$limit_start.",".$rows;
	}
	
	$db->query($select_mileage_info_sql);
	
	foreach($db->fetch() as $mileage_data) {
		$json_result['data'][] = array(
			'create_date'				=>$mileage_data['CREATE_DATE'],
			
			'mileage_unusable'			=>number_format($mileage_data['MILEAGE_UNUSABLE']),
			'mileage_usable_inc'		=>number_format($mileage_data['MILEAGE_USABLE_INC']),
			'mileage_usable_dec'		=>number_format($mileage_data['MILEAGE_USABLE_DEC']),
			'mileage_balance'			=>number_format($mileage_data['MILEAGE_BALANCE']),
			
			'mileage_usable_date'		=>$mileage_data['MILEAGE_USABLE_DATE'],
			
			'order_code'				=>$mileage_data['ORDER_CODE'],
			'order_product_code'		=>$mileage_data['ORDER_PRODUCT_CODE'],
			
			'mileage_type'				=>$mileage_data['MILEAGE_TYPE']
		);
	}
}

?>