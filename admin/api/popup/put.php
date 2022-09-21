<?php
/*
 +=============================================================================
 | 
 | 팝업 입력
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.09.21
 | 최종 수정일	: 2017.07.10
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$no = intval($no);
$values = array(
	'SEQ'=>1,
	'TITLE'=>$title,
	'URL'=>trim($url),
	'CONTENTS'=>$contents,
	'START_DATE'=>$start_date.' 00:00:00',
	'END_DATE'=>$end_date.' 23:59:59',
	'STATUS'=>(strtolower(trim($status))=='y')?'Y':'N'
);

// 커버 이미지 업로드
if($_FILES['image']['size']>0) {
	$img = file_up(
		$_FILES['image'],
		$_CONFIG['PATH']['UPLOAD_POPUP'],
		array('thumbnail'=>true)
	);
	$values['IMG'] = $_CONFIG['PATH']['UPLOAD_POPUP'].$img;
	$values['IMG_URL'] = $_CONFIG['URL']['UPLOAD_POPUP'].$img;
	$values['IMG_THUMB'] = $_CONFIG['URL']['UPLOAD_POPUP_THUMB'].$img;
}

// 인덱스 번호가 없을 경우 신규 작성
if($no == 0) {
	// 순서 변경
	// $db->update($_TABLE['POPUP'],array('SEQ'=>'SEQ+1'));
}
if(!$db->insert($_TABLE['POPUP'],$values,'IDX=?',array($no))) {
	$code = 500;
}
?>