<?php
/*
 +=============================================================================
 | 
 | 주문정보 확인 - 배송지 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.17
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];

$to_idx			= $_POST['to_idx'];

if ($member_idx != null && $to_idx != null) {
	$sql = "DELETE FROM
				dev.ORDER_TO
			WHERE
				IDX = ".$to_idx;
		
	$db->query($sql);
}
?>