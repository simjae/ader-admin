<?php
/*
 +=============================================================================
 | 
 | 로그인 여부
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

if($member_idx > 0 && $country != null){
    $json_result['result'] = true;
} else{
    $json_result['code'] = 302;
    $json_result['msg'] = '로그인 정보가 없습니다.';
}

?>