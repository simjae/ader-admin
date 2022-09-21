<?php
/*
 +=============================================================================
 | 
 | 게시판 DB 입력
 | ------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.01.XX
 | 최종 수정일	: 2022.04.06
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

if(!isset($url)) $url = '';
$notice = (strtoupper($notice)!='Y')?'N':'Y';
$status = (strtoupper($status)!='Y')?'N':'Y';
$type = ($notice=='Y')?'공지':'일반';

$_CONFIG['PATH']['UPLOAD_BOARD'] .= $bbscode.'/';
$_CONFIG['URL']['UPLOAD_BOARD'] .= $bbscode.'/';


$no_idx = false;
if(!isset($no) || !is_numeric($no)) {
	$no_idx = true;
	// 인덱스 번호 생성
	$no = intval($db->get($_TABLE['BOARD'],'DEPTH=?',array(1),'MAX(IDX) AS NUM')[0]['NUM'])+1;
	$no = ($no/1000)*1000;
	if(!$no) $no = 1000;

	$data = array(
		'IDX'=>$no,
		'BBSCODE'=>$bbscode,
		'SEQ'=>1,
		'DEPTH'=>1,
		'FATHER_NO'=>0,
		'CATEGORY_NO'=>$data['CATEGORY_NO'],
		'MEMBER_NO'=>$data['MEMBER_NO'],
		'NAME'=>$name,
		'NOTICE'=>$notice,
		'EMAIL'=>$email,
		'URL'=>$url,
		'LINK'=>'[]',
		'IP'=>$_SERVER['REMOTE_ADDR'],
		'TITLE'=>$title,
		'CONTENTS'=>$contents,
		'TYPE'=>$type,
		'STATUS'=>$status,
		'LINPUT_DATE'=>date('Y-m-d H:i:s')
	);

}
else {
	$data = $db->get($_TABLE['BOARD'],'BBSCODE=? AND IDX=?',array($bbscode,$no))[0];
	// 글 수정의 경우 해당 작성자인지 검사
	if($mode == 'reply_ok') { // 댓글일 경우
		$nextno = (intval($no/1000)*1000);
		if($nextno == $no) $nextno -= 1000;
		$no_idx = true;

		// 상위글의 바로 아래에 위치하도록 인덱스번호 전부 변경
		$db->query('UPDATE '.$_TABLE['BOARD'].' SET IDX=IDX-1 WHERE IDX < ? AND IDX > ?',array($no,$nextno));

		$father = $no; // 원본글을 상위 댓글로 지정
		$no = $no-1; // 번호 새로 설정
	}

	$data = array_merge($data,array(
		'IDX'=>$no,
		'NAME'=>$name,
		'NOTICE'=>$notice,
		'EMAIL'=>$email,
		'URL'=>$url,
		'IP'=>$_SERVER['REMOTE_ADDR'],
		'TITLE'=>$title,
		'CONTENTS'=>$contents,
		'TYPE'=>$type,
		'STATUS'=>$status,
		'LINPUT_DATE'=>date('Y-m-d H:i:s')
	));

}

if(isset($_FILES)) {
	if(array_key_exists('file',$_FILES) && is_array($_FILES['file']['size']) && $_FILES['file']['size'][0] > 0) {
		$file_arr = file_up($_FILES['file'],$_CONFIG['PATH']['UPLOAD_BOARD'],array('original_name_return'=>true)); // 파일 업로드
		if(!is_array($file_arr)) $file_arr = array($file_arr);

		foreach($file_arr as $row) {
			$file[] = array(
				'path'=>$_CONFIG['PATH']['UPLOAD_BOARD'].$row[0],
				'original_name'=>$row[1],
				'download_hit'=>0
			);
		}

		$data['FILE'] = json_encode($file);
	}

	if(array_key_exists('img',$_FILES) && is_array($_FILES['img']['size']) && $_FILES['img']['size'][0] > 0) {
		$img_arr = file_up(
			$_FILES['img'],
			$_CONFIG['PATH']['UPLOAD_BOARD'],
			array(
				'thumbnail'=>true,
				'thumbnail_width'=>720,
				'thumbnail_height'=>480
			)
		); // 이미지 업로드

		if(!is_array($img_arr)) $img_arr = array($img_arr);
		foreach($img_arr as $row) {
			$img[] = array(
				'path'=>$_CONFIG['PATH']['UPLOAD_BOARD'].$row,
				'url'=>$_CONFIG['URL']['UPLOAD_BOARD'].$row
			);
		}

		$data['IMG'] = json_encode($img);
	}
}

if(!$db->insert($_TABLE['BOARD'],$data,'IDX=? AND BBSCODE=?',array($no,$bbscode))) {
	$code = 500;
}

?>