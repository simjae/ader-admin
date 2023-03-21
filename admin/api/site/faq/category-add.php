<?php
/*
 +=============================================================================
 | 
 | FAQ 분류 입력
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2016. 8. 3
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$title		= $_POST['title'];
$language	= $_POST['language'];
$title = addslashes(trim($title));

// 분류 추가시 중복 검사

$db->query('SELECT COUNT(0) AS CNT FROM FAQ_CATEGORY WHERE TITLE = "'.$title.'" ');
foreach($db->fetch() as $data){
	$cnt = $data['CNT'];
}
if($cnt > 0) {
	$code = 501;
}
else {
	$sql = "
		INSERT INTO FAQ_CATEGORY (
				 SEQ,
				 FATHER_NO,
				 LANG,
				 TITLE,
				 STATUS,
				 REG_DATE
			)
		SELECT
			MAX(SEQ)+1,
			0,
			LANG,
			'".$title."',
			'Y',
			NOW()
		FROM
			FAQ_CATEGORY
		WHERE
			LANG = '".$language."'
		AND
			FATHER_NO = 0
		GROUP BY 
			LANG
	";

	$result = $db->query($sql);
	//$seq = db_get($_TABLE['SITE_FAQ_CATE'],'MAX(SEQ)');
	//$fields = 'SEQ,TITLE,REG_DATE';
	//$values = ($seq+1).',"'.$title.'",Now()';
	//$result = db_insert($_TABLE['SITE_FAQ_CATE'],$fields,$values);

	if(!$result) {
		$code = 500;
	}
}
?>