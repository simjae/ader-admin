<?php
/*
 +=============================================================================
 | 
 | 찜한 상품 리스트 - 상품 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];
$whish_idx_list	= $_POST['whish_list_idx'];

if ($member_idx != null && $whish_list_idx != null) {
	$sql = "UPDATE
				dev.WHISH_LIST
			SET
				DEL_FLG = TRUE
			WHERE
				IDX IN (".$whish_idx_list.") AND
				MEMBER_IDX = ".$member_idx;
	
	$db->query($sql);
}
?>