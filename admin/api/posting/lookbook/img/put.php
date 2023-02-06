<?php
/*
 +=============================================================================
 | 
 | 전시정보 수정 - 룩북_이미지 수정
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

$img_idx		= $_POST['img_idx'];
$relevant_flg	= $_POST['relevant_flg'];

if ($img_idx != null && $relevant_flg != null) {
	for ($i=0; $i<count($img_idx); $i++) {
		$sql = "UPDATE
					dev.LOOKBOOK_IMG
				SET
					RELEVANT_FLG = ".$relevant_idx[$i]."
				WHERE
					IDX = ".$img_idx;
		
		$db->query($sql);
	}
}
?>