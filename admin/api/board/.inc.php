<?php
/*
 +=============================================================================
 | 
 | 게시판 생성/정보 수정
 | -----------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2014.12.20
 | 최종 수정일	: 
 | 버전		: 0.1
 | 설명		: 
 | 
 +=============================================================================
*/

include $_CONFIG['PATH_BOARD'].'_func.php';

$_BOARD = get_board_config(strtoupper($bbscode));
$_BOARD['DB'] = str_replace('[BBSCODE]',strtoupper($bbscode),$_TABLE['BOARD']);
$_BOARD['DB-COMMENT'] = str_replace('[BBSCODE]',strtoupper($bbscode),$_TABLE['BOARD_COMMENT']);
$name = $_SESSION[SS_HEAD.'ADMIN_NAME'];

if($no && $mode != 'modify_ok') {
	$data = db_get($_BOARD['DB'],'IDX="'.$no.'"');

	$title			= str_replace('\"','"',$data['TITLE']);	// 제목
	$category		= $data['CATEGORY'];	// 분류
	$reg_datetime	= $data['FINPUT_DATE'];	// 등록날짜
	$reg_date		= substr($reg_datetime,0,10);	// 등록날짜
	$hit			= $data['VIEW'];						// 조회수
	$notice			= $data['NOTICE'];
	$depth			= $data['DEPTH'];
	$writer			= $data['NAME'].(($data['ID']!='')?'('.$data['ID'].')':'');
	$writerid		= $data['ID'];
	$writername		= $data['NAME'];
	$contents		= $data['CONTENTS'];	// 내용
	$status			= $data['STATUS'];
	$image			= "";
	$thumb			= "";
	if($data['IMG']) { // 커버 이미지가 있을 경우
		$img_path = $_CONFIG['URL_UPLOAD_BOARD'].$bbscode.$_CONFIG['SEPARATOR'];
		$image = $img_path.$data['IMG'];
		$thumb = $img_path.'thumblist'.$_CONFIG['SEPARATOR'].$data['IMG'];
	}
	$file			= explode('||',$data['FILE']);
	$filelist		= $data['FILE'];

	// 다음글 구하기
	$nextdata = db_get($_BOARD['DB'],'IDX > "'.$no.'" ORDER BY NOTICE,IDX ASC LIMIT 1');
	if(is_numeric($nextdata['IDX'])) {
		$nextno = $nextdata['IDX'];
	}

	// 이전글 구하기
	$prevdata = db_get($_BOARD['DB'],'IDX < "'.$no.'" ORDER BY IDX DESC LIMIT 1');
	if(is_numeric($prevdata['IDX'])) {
		$prevno = $prevdata['IDX'];
	}
}
?>