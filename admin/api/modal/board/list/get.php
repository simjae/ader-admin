<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 1:1 문의 리스트 조회
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

$board_category		= $_POST['board_category'];
$board_title		= $_POST['board_title'];

$date_param			= $_POST['date_param'];
$date_from			= $_POST['date_from'];
$date_to			= $_POST['date_to'];

$answer_status		= $_POST['answer_status'];
$file_flg			= $_POST['file_flg'];

$sort_value			= $_POST['sort_value'];
$sort_type			= $_POST['sort_type'];

$page				= $_POST['page'];
$rows				= $_POST['rows'];

if ($country != null && $member_idx != null) {
	$where = " COUNTRY = '".$country."' AND MEMBER_IDX = ".$member_idx." AND BOARD_TYPE = 'ONE'";
	
	$where_cnt = $where;
	
	if ($board_category != "ALL" && $board_category != null) {
		$where .= " AND (PB.CATEGORY = '".$board_category."') ";
	}
	
	if ($board_title != null) {
		$where .= " AND (PB.TITLE LIKE '%".$board_title."%') ";
	}
	
	if ($date_param != null || $date_from != null || $date_to != null) {
		if ($date_param != null) {
			$tmp_date = "DATE_FORMAT(PB.CREATE_DATE,'%Y-%m-%d')";
			
			switch ($date_param) {
				case "today" :
					$where .= ' AND ('.$tmp_date.' = CURDATE()) ';
					break;
				case "01d" :
					$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 DAY)) ';
					break;
				case "03d" :
					$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 DAY)) ';
					break;
				case "07d" :
					$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 7 DAY)) ';
					break;
				case "15d" :
					$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 15 DAY)) ';
					break;
				case "01m" :
					$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
					break;
				case "03m" :
					$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
					break;
				case "01y" :
					$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
					break;
			}
		} else if ($date_from != null || $date_to != null) {
			if ($date_from != null && $date_to == null) {
				$where .= " AND (PB.CREATE_DATE >= '".$date_from."') ";
			} else if ($date_from == null && $date_to != null) {
				$where .= " AND (PB.CREATE_DATE <= '".$date_to."') ";
			} else if ($date_from != null && $date_to != null) {
				$where .= " AND (PB.CREATE_DATE BETWEEN '".$date_from."' AND '".$date_to."') ";
			}
		}
	}
	
	if ($answer_status != null) {
		$where .= " AND PB.ANSWER_STATE = '".$answer_status."' ";
	}
	
	if ($file_flg != null) {
		$tmp_where = "
			AND (
				(
					SELECT
						COUNT(S_BI.IDX)
					FROM
						BOARD_IMAGE S_BI
					WHERE
						S_BI.BOARD_IDX = PB.IDX
				)
		";
		
		if ($file_flg == "true") {
			$tmp_where .= " > 0 ";
		} else if ($file_flg == "false") {
			$tmp_where .= " = 0 ";
		}
		
		$tmp_where .= " IS TRUE ";
		
		$tmp_where .= "
			)
		";
		
		$where .= $tmp_where;
	}
	
	$json_result = array(
		'total' => $db->count("PAGE_BOARD PB",$where),
		'total_cnt' => $db->count("PAGE_BOARD PB",$where_cnt),
		'page' => $page
	);
	
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " ".$sort_value." ".$sort_type." ";
	} else {
		$order = " PB.IDX DESC ";
	}
	
	$select_page_board_sql = "
		SELECT
			PB.IDX				AS BOARD_IDX,
			PB.CATEGORY			AS BOARD_CATEGORY,
			PB.TITLE			AS BOARD_TITLE,
			PB.ANSWER_STATE		AS ANSWER_STATUS,
			DATE_FORMAT(
				PB.CREATE_DATE,
				'%Y-%m-%d %H:%i'
			)					AS CREATE_DATE
		FROM
			PAGE_BOARD PB
		WHERE
			".$where."
		ORDER BY
			".$order."
	";
	
	$limit_start = (intval($page)-1)*$rows;	
	if ($rows != null) {
		$select_page_board_sql .= " LIMIT ".$limit_start.",".$rows;
	}
	
	$db->query($select_page_board_sql);
	
	foreach($db->fetch() as $page_data) {
		$img_cnt = $db->count("BOARD_IMAGE","BOARD_IDX = ".$page_data['BOARD_IDX']);
		
		$file_flg = "";
		if ($img_cnt > 0) {
			$file_flg = "이미지첨부";
		} else {
			$file_flg = "이미지없음";
		}
		
		$json_result['data'][] = array(
			'board_idx'			=>$page_data['BOARD_IDX'],
			'board_category'	=>setTxtParam($page_data['BOARD_CATEGORY']),
			'board_title'		=>$page_data['BOARD_TITLE'],
			'answer_status'		=>setTxtParam($page_data['ANSWER_STATUS']),
			'file_flg'			=>$file_flg,
			'create_date'		=>$page_data['CREATE_DATE']
		);
	}
}

function setTxtParam($param) {
	$txt_param = "";
	
	switch ($param) {
		case "DAE" :
			$txt_param= "배송/기타문의";
			break;
		
		case "CAR" :
			$txt_param= "취소/환불";
			break;
		
		case "OAP" :
			$txt_param= "주문/결제";
			break;
		
		case "FAD" :
			$txt_param= "출고/배송";
			break;
		
		case "RAE" :
			$txt_param= "반품/교환";
			break;
		
		case "RST" :
			$txt_param= "재입고";
			break;
		
		case "PIQ" :
			$txt_param= "제품문의";
			break;
		
		case "BAR" :
			$txt_param= "블루마크/정가품";
			break;
		
		case "AFS" :
			$txt_param= "A/S";
			break;
		
		case "VUC" :
			$txt_param= "바우처";
			break;
		
		case "ETC" :
			$txt_param= "기타서비스";
			break;
		
		case "NAS" :
			$txt_param= "답변전";
			break;
		
		case "PCS" :
			$txt_param= "처리중";
			break;
		
		case "RCP" :
			$txt_param= "답변완료";
			break;
	}
	
	return $txt_param;
}
?>