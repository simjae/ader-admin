<?php
/*
 +=============================================================================
 | 
 | FAQ DB 입력
 | ----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015. 9. 7
 | 최종 수정일	: 2016. 8. 3
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$question = addslashes($question);
$answer = addslashes($answer);
$status = strtoupper($status);
if($status != 'Y') $status = 'N';


if($no) {
	$query = '
		CATEGORY="'.$category.'",
		QUESTION="'.$question.'",
		ANSWER="'.$answer.'",
		STATUS="'.$status.'"
	';
	$result = db_update($_TABLE['SITE_FAQ'],$query,'IDX='.$no);
}
else {
	@db_update($_TABLE['SITE_FAQ'],'SEQ=SEQ+1','CATEGORY="'.$category.'"');

	$fields = 'SEQ,CATEGORY,QUESTION,ANSWER,STATUS,REG_DATE';
	$values = '1,"'.$category.'","'.$question.'","'.$answer.'","Y",Now()';
	$result = db_insert($_TABLE['SITE_FAQ'],$fields,$values);
}

if(!$result) {
	$code = 500;
}
?>