<?php

$modulename = array(
	'admin'=>'관리자',
	'board'=>'게시판',
	'contents'=>'웹콘텐츠',
	'dashboard'=>'대시보드',
	'log'=>'로그',
	'member'=>'회원',
	'mobileapp'=>'모바일앱',
	'mypage'=>'마이페이지',
	'search'=>'검색',
	'shop'=>'쇼핑몰',
	'site'=>'환경설정'
);
$total = db_count($_TABLE['ADMIN_LOG']);
$query  = 'SELECT A.*,B.NAME FROM '.$_TABLE['ADMIN_LOG'].' AS A ';
$query .= 'LEFT JOIN '.$_TABLE['ADMIN'].' AS B ON A.ID = B.ID ';
$query .= 'ORDER BY A.IDX DESC LIMIT 10';
$sql = db_query($query);
while($data = db_array($sql)) {
	$id = $data['ID'];
	$name = $data['NAME'];
	$date = $data['ACCESS_DATE'];
	$avatar = 'files/ico-avatar.png';
	if(file_exists($_CONFIG['PATH_UPLOAD_ADMIN'].$id.'.jpg')) {
		$avatar = $_CONFIG['URL_UPLOAD_ADMIN'].$id.'.jpg';
	}
	$msg = $modulename[$data['ACTION']].' 모듈에서 ';
	if($data['MSG'] == 'list') {
		$msg .= '목록보기';
	}
	elseif($data['MSG'] == 'add') {
		$msg .= '추가하기';
	}
	else {
		$msg .= '수정하기';
	}

	$json_result['data'][$num++] = array(
		'profile_image'=>$avatar,
		'id'=>$id,
		'name'=>$name,
		'msg'=>$msg,
		'date'=>$date,
		'module'=>$data['ACTION'],
		'action'=>$data['MSG']
	);
}
?>
