<?php
/*
 +=============================================================================
 | 
 | 공지사항 목록 
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if($member_idx == 0){
    $json_result['code'] = 304;
    $json_result['msg'] = '비로그인 상태입니다.';
	
	return $json_result;
}

if($member_idx > 0 && $country != null){
	$select_notice_sql = "
		SELECT 
			CM.CODE_NAME	AS CODE_NAME,
			PB.IDX			AS NOTICE_IDX,
			PB.COUNTRY		AS COUNTRY,
			PB.TITLE		AS TITLE,
			REPLACE(
				PB.CONTENTS,
				'/scripts/smarteditor2/upload/',
				'http://116.124.128.246:81/scripts/smarteditor2/upload/'
			)				AS CONTENTS,
			PB.FIX_FLG		AS FIX_FLG
		FROM 
			dev.PAGE_BOARD PB
			LEFT JOIN dev.CODE_MST CM ON 	
			PB.CATEGORY = CM.CODE_VALUE
		WHERE 
			PB.DEL_FLG = FALSE AND
			PB.BOARD_TYPE = 'NTC' AND
			PB.COUNTRY = '".$country."'
	";

	$db->query($select_notice_sql);

	foreach($db->fetch() as $data){
		$json_result['data'][] = array(
			'code_name'         => $data['CODE_NAME'],
			'notice_idx'        => $data['NOTICE_IDX'],
			'country'           => $data['COUNTRY'],
			'title'             => $data['TITLE'],
			'contents'          => $data['CONTENTS'],
			'fix_flg'           => $data['FIX_FLG'],
		);
	}
}

?>