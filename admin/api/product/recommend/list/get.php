<?php

/*
 +=============================================================================
 | 
 | 추천상품 관리화면 - 추천상품 페이지 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' RE.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' RE.IDX DESC';
}

//검색 유형 - 디폴트
$select_page_recommend_sql = "
	SELECT
			RE.IDX			AS PAGE_IDX,
			RE.PAGE_TITLE	AS PAGE_TITLE,
			RE.PAGE_MEMO	AS PAGE_MEMO,
			RE.ACTIVE_FLG	AS ACTIVE_FLG,
			(
				SELECT
					COUNT(S_RP.IDX)
				FROM
					RECOMMEND_PRODUCT S_RP
				WHERE
					S_RP.PAGE_IDX = RE.IDX
			)				AS PRODUCT_QTY,
			RE.CREATE_DATE	AS CREATE_DATE,
			RE.CREATER		AS CREATER,
			RE.UPDATE_DATE	AS UPDATE_DATE,
			RE.UPDATER		AS UPDATER
		FROM
			PAGE_RECOMMEND RE
		WHERE
			RE.DEL_FLG = FALSE
		ORDER BY
			".$order."
		";

$limit_start = (intval($page)-1)*$rows;

if ($rows != null) {
	$select_page_recommend_sql .= " LIMIT ".$limit_start.",".$rows;
}

$cnt = $db->count("PAGE_RECOMMEND RE","RE.DEL_FLG = FALSE");

$json_result = array(
	'total' => $cnt,
	'total_cnt' => $cnt,
	'page' => $page
);

$db->query($select_page_recommend_sql);

foreach($db->fetch() as $recommend_data) {
	$json_result['data'][] = array(
		'num'			=>$cnt--,
		'page_idx'		=>$recommend_data['PAGE_IDX'],
		'page_title'	=>$recommend_data['PAGE_TITLE'],
		'page_memo'		=>$recommend_data['PAGE_MEMO'],
		'active_flg'	=>$recommend_data['ACTIVE_FLG'],
		'product_qty'	=>$recommend_data['PRODUCT_QTY'],
		'create_date'	=>$recommend_data['CREATE_DATE'],
		'creater'		=>$recommend_data['CREATER'],
		'update_date'	=>$recommend_data['UPDATE_DATE'],
		'updater'		=>$recommend_data['UPDATER']
	);
}
?>