<?php
/*
 +=============================================================================
 | 
 | 배송업체 명 조회
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.12
 | 최종 수정일	: 
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

$keyword_param		= $_POST['keyword_param'];		//검색유형 - 이름, 아이디, 이메일, 전화번호, 휴대폰번호, 휴면일자
$search_keyword		= $_POST['search_keyword'];		//검색 키워드


$delivery_country	= $_POST['delivery_country'];	//배송국가
$default_flg		= $_POST['default_flg'];		//기본배송지 유무

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_type = $_POST['sort_type'];				    //정렬타입
$sort_value = $_POST['sort_value'];				    //정렬 기준값

/** 검색 조건 **/
$where = ' COUNTRY = "'.$country.'" AND DEL_FLG = FALSE';
$where_cnt = $where;

//검색 유형 - 이름, 아이디, 이메일, 전화번호, 휴대폰번호
if ($keyword_param != null && $search_keyword != 'ALL') {
	switch ($search_keyword) {
		case 'company_name':
			$where .= ' AND (DC.COMPANY_NAME LIKE "%'.$keyword_param.'%") ';
		break;
		
		case 'company_tel':
			$where .= ' AND (DC.COMPANY_TEL LIKE "%'.$keyword_param.'%") ';
		break;
		
		case 'company_email':
			$where .= ' AND (DC.COMPANY_EMAIL LIKE "%'.$keyword_param.'%") ';
		break;
		
		case 'homepage':
			$where .= ' AND (DC.HOMEPAGE LIKE "%'.$keyword_param.'%") ';
		break;
	}
}

//배송가능 국가
if ($delivery_country != null && $delivery_country != 'ALL') {
	$where .= " AND (DC.delivery_country = '".$delivery_country."') ";
}

//기본배송지 유무
if ($default_flg != null && $default_flg != 'ALL') {
	$where .= " AND (DC.default_flg = ".$default_flg.") ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' DC.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' DC.IDX DESC';
}

$table = "
	DELIVERY_COMPANY DC
";

$total_cnt = $db->count($table,$where_cnt);
$json_result = array(
	'total' => $db->count($table,$where),
	'total_cnt' => $total_cnt,
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

//검색항목
$select_company_sql = "
	SELECT
		IDX,
        COUNTRY,
        DELIVERY_COUNTRY,
        COMPANY_NAME,
        COMPANY_TEL,
        COMPANY_SUB_TEL,
        COMPANY_EMAIL,
        DELIVERY_PRICE,
        HOMEPAGE,
        DEFAULT_FLG
	FROM
		".$table."
	WHERE
		".$where."
	ORDER BY
		".$order."
";
if ($rows != null) {
	$select_company_sql .= " LIMIT ".$limit_start.",".$rows;
}
$db->query($select_company_sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
		'idx'                   => $data['IDX'],
        'country'               => $data['COUNTRY'],
        'delivery_country'      => $data['DELIVERY_COUNTRY'],
        'company_name'          => $data['COMPANY_NAME'],
        'company_tel'           => $data['COMPANY_TEL'],
        'company_sub_tel'       => $data['COMPANY_SUB_TEL'],
        'company_email'         => $data['COMPANY_EMAIL'],
        'delivery_price'        => $data['DELIVERY_PRICE'],
        'homepage'              => $data['HOMEPAGE'],
        'default_flg'           => $data['DEFAULT_FLG']
	);
}
?>