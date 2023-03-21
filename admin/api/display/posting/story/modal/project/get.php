<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 스토리 모달_선택한 게시물 정보 조회
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

$page_idx	= $_POST['page_idx'];

if ($page_idx != null) {
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
			CP.IDX = ".$page_idx."
	";
	
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
}
?>