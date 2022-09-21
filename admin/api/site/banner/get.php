<?php
/*
 +=============================================================================
 | 
 | 게시판 목록 
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.08.30
 | 최종 수정일	: 2022.04.01
 | 버전		: 2.0
 | 설명		: 
 | 
 +=============================================================================
*/



$tables = '
	'.$_TABLE['BOARD'].' AS A 
	LEFT JOIN '.$_TABLE['BOARD_CAT'].' AS B 
		ON A.CATEGORY_NO = B.IDX 
';
$where = 'A.BBSCODE = ?';
$where_values = array($bbscode);
if(isset($no) && is_numeric($no)) {
	$where .= ' AND A.IDX = ? ';
	$where_values[] = $no;
}

$fnum_start = 0;
$fnum = $db->count($tables,$where.' AND FATHER_NO=0',$where_values);
$fnum_notice = $db->count($tables,$where.' AND NOTICE="Y"',$where_values);
$json_result = array(
	'total'=>$db->count($tables,$where,$where_values),
	'page'=>intval($page),
	'pagenum'=>$pagenum
);
$db->query('
	SELECT 
			A.*
		FROM '.$tables.' 
	WHERE 
		'.$where.'
	ORDER BY 
		A.NOTICE DESC,A.IDX DESC
',$where_values);
foreach($db->fetch() as $data) {
	$no = intval($data['IDX']);
	$title = $data['TITLE'];	// 제목
	$category = $data['CATEGORY'];	// 분류
	$regdate = substr($data['FINPUT_DATE'],0,10);	// 등록날짜
	$regdatetime = $data['FINPUT_DATE'];	// 등록날짜
	$writer = $data['NAME'];
	$comment_num = intval($data['COMMENT']);
	$contents = $data['CONTENTS'];
	$image = '';
	$thumb = '';
	$file = ($data['FILE']!='')?true:false;
	if($data['IMG'] != '') { // 커버 이미지가 있을 경우
		$image = json_decode($data['IMG'],true)[0]['url'];
	}

	// 게시판 가상 번호 계산
	$data['FATHER_NO'] = intval($data['FATHER_NO']);
	if($fnum_start==0 && $data['FATHER_NO']==0 && $notice==false) {
		$fnum_start = $no;
		if(($fnum_notice-(($page*$rownum)-$rownum)) < 0) $fnum -= $fnum_notice;
	}
	$num = '';
	if($data['FATHER']==0) $num = $fnum--;

	$json_result['data'][] = array(
		'no'=>$no,
		'vno'=>$num,
		'title'=>$title,
		'category'=>$category,
		'hit'=>intval($data['HIT']),
		'status'=>($data['STATUS']=='Y')?true:false,
		'notice'=>($data['NOTICE']=='Y')?true:false,
		'type'=>$data['TYPE'],
		'email'=>$data['EMAIL'],
		'writer'=>$writer,
		'comment_num'=>$comment_num,
		'image'=>$image,
		'contents'=>(isset($no))?$contents:null,
		'image_thumbnail'=>$thumb,
		'has_file'=>$file,
		'reg_date'=>$regdate,
		'reg_datetime'=>$regdatetime
	);
}
?>