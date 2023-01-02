<?php
/*
 +=============================================================================
 | 
 | 비밀번호 변경
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/
$country		= $_POST['country'];
$member_idx		= $_POST['member_idx'];
$member_pw		= $_POST['member_pw'];

if($member_idx == null){
    $result = false;
	$code	= 401;
}
else{
    $member_count = 0;
	$sql = "
		UPDATE 
			dev.MEMBER_".$country." 
		SET 
			MEMBER_PW = '".md5($member_pw)."',
            PW_DATE = NOW()
		WHERE
			MEMBER_IDX = '".$member_idx."'
	";
	$db->query($sql);
}
?>