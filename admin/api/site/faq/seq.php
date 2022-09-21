<?php
/*
 +=============================================================================
 | 
 | FAQ 순서 변경
 | -----------
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
// 예외 처리
if(!$seq || !$cat) {
	$code = 301;
	$result = false;
}
else {
	$seq = explode(',',$seq);
	for($i=1;$i<=sizeof($seq);$i++) {
		$result = db_update($_TABLE['FAQ'],'SEQ='.$i,'CATEGORY='.$cat.' AND IDX='.$seq[$i-1]);
		if(!$result) break;
	}
}

if(!$result) {
	$code = 500;
}

// json 출력 시작
if($callback) echo $callback.'(';
echo '{"code":'.$code.',"msg":"'.$_CODE[$code][LANGUAGE].'"}';
if($callback) echo ')';
?>