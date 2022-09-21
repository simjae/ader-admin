<?php
/*
 +=============================================================================
 | 
 | 관리자 추가/수정
 | -------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.09.07
 | 최종 수정일	: 2022.04.09
 | 버전		: 2.0
 | 설명		: (2017.07.15) json 형식으로 수정
 |            (2022.04.09) db class 방식 전환
 | 
 +=============================================================================
*/
$id = strtolower(trim($id));
$name = trim($name);
$nick = trim($nick);
$pw = trim($pw);
$pw_confirm = trim($pw_confirm);
$status = (strtoupper($status) != 'Y')?'N':'Y';

if($pw != $pw_confirm) {
	$code = 999;
	$msg = '비밀번호와 확인이 일치하지 않습니다.';
}
else {
	$values = array(
		'ID'=>$id,
		'NAME'=>$name,
		'NICK'=>$nick,
		'PERMITION_NO'=>intval($permition_no),
		'EMAIL'=>$email,
		'TEL'=>$tel,
		'FAX'=>$fax,
		'MOBILE'=>$mobile,
		'ZIPCODE'=>$zipcode,
		'ADDRESS'=>$address1,
		'ADDRESS_EXT'=>$address2
	);

	// 프로필 이미지 업로드
	if($_FILES['img']['size']>0) {
		$values['IMG'] = $_CONFIG['URL']['UPLOAD_ADMIN']
						.file_up('img',$_CONFIG['PATH']['UPLOAD_ADMIN']); // 이미지 업로드
	}

	if(!$db->insert($_TABLE['ADMIN'],$values,'ID=?',array($id))) {
		$code = 500;
	}
}
?>