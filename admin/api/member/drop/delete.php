<?php
/*
 +=============================================================================
 | 
 | 게시글 삭제 API
 | -------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.9.7
 | 최종 수정일	: 
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

$result = db_delete($Table['Member_Exit'],'IDX IN ('.$no.')');

if(!$result) {
	$msg = 'fail';
	$code = 400;
}

// json 출력 시작
if($callback) echo $callback.'(';
echo '{"code":'.$code.',"msg":"'.$msg.'"}';
if($callback) echo ')';
?>