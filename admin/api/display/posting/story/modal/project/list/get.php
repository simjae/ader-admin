<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 스토리 모달_게시물 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

$project_name		= $_POST['project_name'];
$project_desc		= $_POST['project_desc'];
$project_title		= $_POST['project_title'];

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$where = "
	CP.IDX NOT IN (
		SELECT
			S_PS.PAGE_IDX
		FROM
			POSTING_STORY S_PS
		WHERE
			S_PS.STORY_TYPE = 'COLC' AND
			S_PS.DEL_FLG = FALSE
	) AND
	CP.COUNTRY = '".$country."' AND
	CP.DEL_FLG = FALSE
";

$where_cnt = $where;

if ($project_name != null) {
	$where .= " AND (CP.PROJECT_NAME LIKE '%".$project_name."%') ";
}

if ($project_desc != null) {
	$where .= " AND (CP.PROJECT_DESC LIKE '%".$project_desc."%') ";
}

if ($project_title != null) {
	$where .= " AND (CP.PROJECT_TITLE LIKE '%".$project_title."%') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' CP.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' CP.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$total_cnt = $db->count("COLLECTION_PROJECT CP",$where_cnt);
$json_result = array(
	'total' => $db->count("COLLECTION_PROJECT CP",$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$select_collection_project_sql = "
	SELECT
		CP.IDX					AS COLLECTION_IDX,
		CP.PROJECT_NAME			AS PROJECT_NAME,
		CP.PROJECT_DESC			AS PROJECT_DESC,
		CP.PROJECT_TITLE		AS PROJECT_TITLE,
		CONCAT(
			'/posting/lookbook?country=',
			CP.COUNTRY,
			'&project_idx=',
			CP.IDX
		)						AS PROJECT_URL,
		CP.CREATE_DATE			AS CREATE_DATE,
		CP.CREATER				AS CREATER,
		CP.UPDATE_DATE			AS UPDATE_DATE,
		CP.UPDATER				AS UPDATER
	FROM
		COLLECTION_PROJECT CP
	WHERE
		".$where."
";

if ($rows != null && $select_idx_flg == null) {
	$select_collection_project_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_collection_project_sql);

foreach($db->fetch() as $collection_data) {
	$json_result['data'][] = array(
		'page_idx'			=>$collection_data['COLLECTION_IDX'],
		'project_name'		=>$collection_data['PROJECT_NAME'],
		'project_desc'		=>$collection_data['PROJECT_DESC'],
		'project_title'		=>$collection_data['PROJECT_TITLE'],
		'project_url'		=>$collection_data['PROJECT_URL'],
		'create_date'		=>$collection_data['CREATE_DATE'],
		'creater'			=>$collection_data['CREATER'],
		'update_date'		=>$collection_data['UPDATE_DATE'],
		'updater'			=>$collection_data['UPDATER']
	);
}
?>