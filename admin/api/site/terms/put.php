<?php
/*
 +=============================================================================
 | 
 | 약관 내용 작성
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.8.21
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: (2015.8.21) 최초작성
 | 
 +=============================================================================
*/
$CONTENTS	= addslashes($CONTENTS);

// 이전 내용과 비교하여 내용이 다를 경우에만 db 처리
$old = db_get($_TABLE['SITE_TERM'],'CATEGORY="'.$CATEGORY.'" AND STATUS="Y"','CONTENTS');
if($old != $CONTENTS) {
	// 이전 내용은 미사용으로 업데이트
	$result = db_update($_TABLE['SITE_TERM'],'STATUS="N"','CATEGORY="'.$CATEGORY.'"');

	// 업데이트 성공시 새로운 내용 넣기
	if($result) {
		$fields = 'CATEGORY,CONTENTS,REG_DATE,STATUS';
		$values = '"'.$CATEGORY.'","'.$CONTENTS.'",Now(),"Y"';
		$result = db_insert($_TABLE['SITE_TERM'],$fields,$values);
	}

	// db 작업 실패시 오류 메시지 설정
	if(!$result) {
		$code = 300;
		$msg = "failed";
	}
}
?>