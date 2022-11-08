<?php
/*
 +=============================================================================
 | 
 | 회원 로그인
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/

// 값 검사
//$id = strtolower(trim($id));
$id = "adertest4";
//$pw = strtolower(trim($pw));
$pw = "password";

if($id == '') {
	$result = false;
	$code	= 401;
}
elseif($pw == '') {
	$result = false;
	$code	= 402;
}

if($result) {
	$data = $db->get($_TABLE['MEMBER'],'ID=? AND PW=?',array($id,$pw))[0];
	if(is_array($data)) {
		// 세션 등록
		$_SESSION['MEMBER_IDX']	= $data['IDX'];
		$_SESSION['MEMBER_ID'] = $data['ID'];

	} else {
		$result = false;
		$code	= 300;
	}
}
?>