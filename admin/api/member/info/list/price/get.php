<?php
/*
 +=============================================================================
 | 
 | 회원 조회 페이지 - 회원조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.05.01
 | 최종 수정일	: 
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

$search_type		= $_POST['search_type'];		//검색유형 - 이름, 아이디, 이메일, 전화번호, 휴대폰번호, 휴면일자
$search_keyword		= $_POST['search_keyword'];		//검색 키워드

$member_level		= $_POST['member_level'];		//멤버 그룹 - 일반회원, ADER family
$member_gender		= $_POST['member_gender'];		//성별

$min_order_cnt		= $_POST['min_order_cnt'];
$max_order_cnt		= $_POST['max_order_cnt'];

$price_type			= $_POST['price_type'];
$min_price			= $_POST['min_price'];
$max_price			= $_POST['max_price'];

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_type = $_POST['sort_type'];				//정렬타입
$sort_value = $_POST['sort_value'];				//정렬 기준값

/** 검색 조건 **/
$where = '1=1';
$where .= " AND OI.IDX IS NOT NULL ";
$where_cnt = $where;

//검색 유형 - 이름, 아이디, 이메일, 전화번호, 휴대폰번호
if ($search_keyword != null) {
	switch ($search_type) {
		case 'member_id':
			$where .= ' AND (MB.MEMBER_ID LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'member_name':
			$where .= ' AND (MB.MEMBER_NAME LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'tel_mobile':
			$where .= ' AND (MB.TEL_MOBILE LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'member_addr':
			$where .= "
				AND (
					MB.ROAD_ADDR LIKE '%".$search_keyword."%' OR
					MB.LOT_ADDR LIKE '%".$search_keyword."%'
				)
			";
		break;
	}
}

//멤버 레벨
if ($member_level != null && $member_level != 'ALL') {
	$where .= " AND (MB.LEVEL_IDX = ".$member_level.") ";
}

//나이
if ($min_age != null || $max_age != null) {
	if ($min_age != null && $max_age == null) {
		$where .= ' AND (ROUND((TO_DAYS(NOW()) - (TO_DAYS(MB.MEMBER_BIRTH))) / 365) >= '.$min_age.') ';
	} else if ($min_age == null && $max_age != null) {
		$where .= ' AND (ROUND((TO_DAYS(NOW()) - (TO_DAYS(MB.MEMBER_BIRTH))) / 365) <= '.$max_age.') ';
	} else if ($min_age != null && $max_age != null) {
		$where .= ' AND (ROUND((TO_DAYS(NOW()) - (TO_DAYS(MB.MEMBER_BIRTH))) / 365) BETWEEN '.$min_age.' AND '.$max_age.') ';
	}
}

if ($price_type != null && ($min_price != null || $max_price != null)) {
	$price_type_sql = "";
	switch ($price_type) {
		case "max_price_product" :
			$price_type_sql = " MAX(S_OI.PRICE_PRODUCT) ";
			break;
		
		case "sum_price_product" :
			$price_type_sql = " SUM(S_OI.PRICE_PRODUCT) ";
			break;
		
		case "max_price_total" :
			$price_type_sql = " MAX(S_OI.PRICE_TOTAL) ";
			break;
		
		case "sum_price_total" :
			$price_type_sql = " SUM(S_OI.PRICE_TOTAL) ";
			break;
	}
	
	$order_price_sql = "
		AND (
			(
				SELECT
					".$price_type_sql."
				FROM
					ORDER_INFO S_OI
				WHERE
					S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OI.MEMBER_IDX = MB.IDX
			)
	";
	
	if ($min_price != null && $max_price == null) {
		$order_price_sql .= " >= ".$min_price." IS TRUE ";
	} else if ($min_price == null && $max_price != null) {
		$order_price_sql .= " <= ".$min_price." IS TRUE ";
	} else if ($min_price != null && $max_price != null) {
		$order_price_sql .= " BETWEEN ".$min_price." AND ".$max_price." IS TRUE ";
	}
	
	$order_price_sql .= "
		)
	";
	
	$where .= $order_price_sql;
}

if ($min_order_cnt != null || $max_order_cnt != null) {
	$order_cnt_sql .= "
		AND (
			(
				SELECT
					COUNT(S_OI.IDX)
				FROM
					ORDER_INFO S_OI
				WHERE
					S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OI.MEMBER_IDX = MB.IDX
			)
	";
	
	if ($min_order_cnt != null && $max_order_cnt == null) {
		$order_cnt_sql .= " >= ".$min_order_cnt." IS TRUE ";
	} else if ($min_order_cnt == null && $max_order_cnt != null) {
		$order_cnt_sql .= " <= ".$min_order_cnt." IS TRUE ";
	} else if ($min_order_cnt != null && $max_order_cnt != null) {
		$order_cnt_sql .= " BETWEEN ".$min_order_cnt." AND ".$max_order_cnt." IS TRUE ";
	}
	
	$order_cnt_sql .= "
		)
	";
	
	$where .= $order_cnt_sql;
}
/* 검색조건 : 등록일 */
if ($search_date != null && $search_date != 'all') {
	$order_date_sql = "
		AND (
			(
				SELECT
					DATE_FORMAT(
						MAX(S_OI.ORDER_DATE),
						'%Y-%m-%d %H:%i'
					)
				FROM
					ORDER_INFO S_OI
				WHERE
					S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OI.MEMBER_IDX = MB.IDX
			)
	";

	switch ($search_date) {
		case "today" :
			$order_date_sql .= " = CURDATE() IS TRUE ";
			break;
		
		case "01d" :
			$order_date_sql .= " >= (CURDATE() - INTERVAL 1 DAY) IS TRUE ";
			break;
		
		case "03d" :
			$order_date_sql .= " >= (CURDATE() - INTERVAL 7 DAY) IS TRUE ";
			break;
		
		case "07d" :
			$order_date_sql .= " >= (CURDATE() - INTERVAL 7 DAY) IS TRUE ";
			break;
		
		case "15d" :
			$order_date_sql .= " >= (CURDATE() - INTERVAL 15 DAY) IS TRUE ";
			break;
		
		case "01m" :
			$order_date_sql .= " >= (CURDATE() - INTERVAL 1 MONTH) IS TRUE ";
			break;
		
		case "03m" :
			$order_date_sql .= " >= (CURDATE() - INTERVAL 3 MONTH) IS TRUE ";
			break;
		
		case "01y" :
			$order_date_sql .= " >= (CURDATE() - INTERVAL 1 YEAR) IS TRUE ";
			break;
	}
}
else if ($order_date_from != null || $order_date_to != null) {
	$order_date_sql = "
		AND (
			(
				SELECT
					MAX(S_OI.ORDER_DATE)
				FROM
					ORDER_INFO S_OI
				WHERE
					S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OI.MEMBER_IDX = MB.IDX
			)
	";
	
	if (strlen($order_date_from) > 0 && strlen($order_date_to) == 0) {
		$order_date_sql .= " >= '".$order_date_from."' IS TRUE ";
	} else if (strlen($order_date_from) == 0 && strlen($order_date_to) > 0) {
		$order_date_sql .= " <= '".$order_date_from."' IS TRUE ";
	} else if (strlen($order_date_from) > 0 && strlen($order_date_to) > 0) {
		$order_date_sql .= " BETWEEN '".$order_date_from."' AND '".$order_date_to."' IS TRUE ";
	}
	
	$order_date_sql .= "
		)
	";
	
	$where .= $order_date_sql;
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' SUM_PRICE_TOTAL DESC';
}

$table = "
	MEMBER_".$country." MB
	LEFT JOIN MEMBER_LEVEL LV ON
	MB.LEVEL_IDX = LV.IDX
	LEFT JOIN ORDER_INFO OI ON
	MB.IDX = OI.MEMBER_IDX AND
	MB.COUNTRY = OI.COUNTRY
";

//검색항목
$select_member_sql = "
	SELECT
		*
	FROM
		(
			SELECT
				MB.IDX					AS MEMBER_IDX,
				MB.COUNTRY				AS COUNTRY,
				MB.MEMBER_STATUS		AS MEMBER_STATUS,
				MB.MEMBER_ID			AS MEMBER_ID,
				LV.TITLE				AS MEMBER_LEVEL,
				MB.MEMBER_NAME			AS MEMBER_NAME,
				IFNULL(
					DATE_FORMAT(
						MB.MEMBER_BIRTH,
						'%Y-%m-%d %H:%i'
					),'-'
				)						AS MEMBER_BIRTH,
				ROUND(
					(
						TO_DAYS(NOW()) - (
							TO_DAYS(MB.MEMBER_BIRTH)
						)
					) / 365
				)						AS AGE,
				CASE
					WHEN
						MB.MEMBER_GENDER = 'F'
						THEN
							'여자'
					WHEN
						MB.MEMBER_GENDER = 'M'
						THEN
							'남자'
					ELSE
						'-'
				END						AS MEMBER_GENDER,
				MB.ZIPCODE				AS ZIPCODE,
				MB.ROAD_ADDR			AS ROAD_ADDR,
				MB.LOT_ADDR				AS LOT_ADDR,
				MB.DETAIL_ADDR			AS DETAIL_ADDR,
				MB.TEL_MOBILE			AS TEL_MOBILE,
				
				MB.RECEIVE_SMS_FLG		AS RECEIVE_SMS_FLG,
				MB.RECEIVE_PUSH_FLG		AS RECEIVE_PUSH_FLG,
				MB.RECEIVE_EMAIL_FLG	AS RECEIVE_EMAIL_FLG,
				IFNULL(
					DATE_FORMAT(
						MB.JOIN_DATE,
						'%Y-%m-%d %H:%i'
					),'-'
				)						AS JOIN_DATE,		
				IFNULL(
					DATE_FORMAT(
						MB.LOGIN_DATE,
						'%Y-%m-%d'
					),'-'
				)						AS LOGIN_DATE,
				
				MB.SUSPICION_FLG		AS SUSPICION_FLG,
				COUNT(OI.IDX)			AS ORDER_CNT,
				DATE_FORMAT(
					MAX(OI.ORDER_DATE),
					'%Y-%m-%d'
				)						AS ORDER_DATE,
				MAX(OI.PRICE_PRODUCT)	AS MAX_PRICE_PRODUCT,
				SUM(OI.PRICE_PRODUCT)	AS SUM_PRICE_PRODUCT,
				MAX(OI.PRICE_TOTAL)		AS MAX_PRICE_TOTAL,
				SUM(OI.PRICE_TOTAL)		AS SUM_PRICE_TOTAL
			FROM
				".$table."
			WHERE
				".$where."
			GROUP BY
				MB.IDX
		) AS TMP
	ORDER BY
		".$order."
";

$select_cnt_sql = "
	SELECT
		COUNT(OI.IDX)
	FROM
		MEMBER_".$country." MB
		LEFT JOIN ORDER_INFO OI ON
		MB.IDX = OI.MEMBER_IDX
	WHERE
		OI.IDX IS NOT NULL
	GROUP BY
		MB.IDX
";

$total_cnt = $db->count("(".$select_cnt_sql.") AS TMP");
$json_result = array(
	'total' => $db->count("(".$select_member_sql.") AS TMP"),
	'total_cnt' => $total_cnt,
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

if ($rows != null && $select_idx_flg == null) {
	$select_member_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_member_sql);

foreach($db->fetch() as $member_data) {
	$member_idx = $member_data['MEMBER_IDX'];
	
	$txt_country = "";
	switch ($member_data['COUNTRY']) {
		case "KR" :
			$txt_country = "한국몰";
			break;
		
		case "EN" :
			$txt_country = "영문몰";
			break;
		
		case "CN" :
			$txt_country = "중문몰";
			break;
	}
	
	$member_status = "";
	switch ($member_data['MEMBER_STATUS']) {
		case "NML" :
			if ($member_data['SUSPICION_FLG'] == true) {
				$member_status = "의심";
			} else {
				$member_status = "정상";
			}
			break;
		
		case "SLP" :
			$member_status = "휴면";
			break;
		
		case 'BMB':
			$member_status = "불량";
			break;
		
		case "SPC" :
			$member_status = "의심";
			break;
		
		case "DRP" :
			$member_status = "탈퇴";
			break;
		
		case "FDP" :
			$member_status = "강제탈퇴";
			break;
	}
	
	$region = null;
	$road_addr = $member_data['ROAD_ADDR'];
	$lot_addr = $lot_addr['LOT_ADDR'];
	
	$tmp_addr = array();
	if (!empty($road_addr) && $road_addr != null) {
		$tmp_addr = explode(" ",$road_addr);
	} else if (!empty($lot_addr) && $lot_addr != null) {
		$tmp_addr = explode(" ",$lot_addr);
	} else {
		$region = "주소 미입력";
	}
	
	$region = $tmp_addr[0];
	
	$drop_type = "";
	if ($member_data['DROP_TYPE'] != null) {
		switch ($member_data['DROP_TYPE']) {
			case "NDP" :
				$drop_type = "일반탈퇴";
				break;
			
			case "FDP" :
				$drop_type = "강제탈퇴";
				break;
		}
	}
	
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
		'member_idx'			=>$member_data['MEMBER_IDX'],
		'country'				=>$member_data['COUNTRY'],
		'txt_country'			=>$txt_country,
		'member_status'			=>$member_status,
		'member_id'				=>$member_data['MEMBER_ID'],
		'member_level'			=>$member_data['MEMBER_LEVEL'],
		'member_name'			=>$member_data['MEMBER_NAME'],
		'member_birth'			=>$member_data['MEMBER_BIRTH'],
		'age'					=>$member_data['AGE'],
		'member_gender'			=>$member_data['MEMBER_GENDER'],
		
		'region'				=>$region,
		'zipcode'				=>$member_data['ZIPCODE'],
		'road_addr'				=>$member_data['ROAD_ADDR'],
		'lot_addr'				=>$member_data['LOT_ADDR'],
		'detail_addr'			=>$member_data['DETAIL_ADDR'],
		
		'tel_mobile'			=>$member_data['TEL_MOBILE'],
		
		'receive_sms_flg'		=>$member_data['RECEIVE_SMS_FLG'],
		'receive_push_flg'		=>$member_data['RECEIVE_PUSH_FLG'],
		'receive_email_flg'		=>$member_data['RECEIVE_EMAIL_FLG'],
		
		'join_date'				=>$member_data['JOIN_DATE'],
		'order_date'			=>$member_data['ORDER_DATE'],
		
		'suspicioun_flg'		=>$member_data['SUSPICION_FLG'],
		
		'order_cnt'				=>$member_data['ORDER_CNT'],
		'max_price_product'		=>number_format($member_data['MAX_PRICE_PRODUCT']),
		'sum_price_product'		=>number_format($member_data['SUM_PRICE_PRODUCT']),
		'max_price_total'		=>number_format($member_data['MAX_PRICE_TOTAL']),
		'sum_price_total'		=>number_format($member_data['SUM_PRICE_TOTAL'])
	);
}
?>