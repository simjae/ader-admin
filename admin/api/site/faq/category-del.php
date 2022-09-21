<?php
/*
 +=============================================================================
 | 
 | FAQ분류 삭제 API
 | --------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2016. 8. 3
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include '../../static/init.php';

// 예외 처리
if(!$no || !is_numeric($no)) {
	$code = 301;
	$result = false;
}
else {
	$result = db_delete($_TABLE['FAQ_CATE'],'IDX IN ('.$no.')');
	if(!$result) {
		$code = 500;
	}
}

// json 출력 시작
if($callback) echo $callback.'(';
echo '{"code":'.$code.',"msg":"'.$_CODE[$code][LANGUAGE].'"}';
if($callback) echo ')';
?>