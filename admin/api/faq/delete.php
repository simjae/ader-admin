<?php
/*
 +=============================================================================
 | 
 | 게시글 삭제 API
 | -------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015. 9. 7
 | 최종 수정일	: 2016. 8. 3
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../static/init.php';

// 권한 검사
if(!permit('customer|faq|article|delete')) {
	$code = 601;
}
else {
	// 예외 처리
	if(!$no) {
		$code = 301;
		$result = false;
	}
	else {
		$result = db_delete($_TABLE['FAQ'],'IDX IN ('.$no.')');

		if(!$result) {
			$code = 500;
		}
	}
}

// json 출력 시작
if($callback) echo $callback.'(';
echo '{"code":'.$code.',"msg":"'.$_CODE[$code][LANGUAGE].'"}';
if($callback) echo ')';
?>