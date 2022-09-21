<?php
/*
 +=============================================================================
 | 
 | 1:1문의 삭제
 | ----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.12.8
 | 최종 수정일	: 2015.12.8 21:28
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../static/init.php';
// 예외 처리
if(!$no) {
	$msg	= 'must input index number(s)';
	$code	= 400;
	$result = false;
}

$result = db_delete($Table['Qna'],'IDX IN ('.$no.')');

if(!$result) {
	$msg = 'fail';
	$code = 400;
}

// json 출력 시작
if($callback) echo $callback.'(';
echo '{"code":'.$code.',"msg":"'.$msg.'"}';
if($callback) echo ')';
?>