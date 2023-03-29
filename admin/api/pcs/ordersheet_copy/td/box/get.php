<?php
/*
 +=============================================================================
 | 
 | 박스 정보 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sel_box_idx		= $_POST['sel_box_idx'];

if($sel_box_idx != null){
	$where = '';
	if($sel_box_idx != null){
		$where = ' WHERE IDX = '.$sel_box_idx;
	}
	
	$select_box_info_sql = "
		SELECT
			IDX				AS BOX_IDX,
			BOX_NAME		AS BOX_NAME,
			BOX_WIDTH		AS BOX_WIDTH,
			BOX_LENGTH		AS BOX_LENGTH,
			BOX_HEIGHT		AS BOX_HEIGHT,
			BOX_VOLUME		AS BOX_VOLUME
		FROM
			BOX_INFO
		WHERE
			IDX = ".$sel_box_idx."
	";
	
	$db->query($select_box_info_sql);
	
	foreach($db->fetch() as $box_data) {
		$json_result['data'][] = array(
			'box_idx'		=>intval($box_data['BOX_IDX']),
			'box_name'		=>$box_data['BOX_NAME'],
			'box_width'		=>$box_data['BOX_WIDTH'],
			'box_length'	=>$box_data['BOX_LENGTH'],
			'box_height'	=>$box_data['BOX_HEIGHT'],
			'box_volume'	=>$box_data['BOX_VOLUME']
		);
	}
}

?>