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
$member_idx		= $_POST['member_idx'];
$password	= $_POST['password'];

if($member_idx == null){
	$result = false;
	$code	= 401;
}
if($password == null || $password == ''){
	$result = false;
	$code	= 402;
}

if($result) {
	$sql = "
        UPDATE
            dev.MEMBER
        SET
            PW = '".md5($password)."',
            PW_DATE = NOW()
        WHERE
            IDX = ".$member_idx;
    $db->query($sql);
}
?>