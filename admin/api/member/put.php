<?php

$receive_tel = (isset($receive_tel) && $receive_tel == 'y')?'Y':'N';
$receive_sms = (isset($receive_sms) && $receive_sms == 'y')?'Y':'N';
$receive_email = (isset($receive_email) && $receive_email == 'y')?'Y':'N';
$receive_push = (isset($receive_push) && $receive_push == 'y')?'Y':'N';

if(isset($pw) && $pw != '' && $pw != $pw_confirm) {
	$result = false;
	$code = 358;
	$msg = '비밀번호 확인이 일치하지 않습니다.';
}
elseif(isset($pw) && $pw != '' && (strlen($pw) < 4 || strlen($pw) > 20)) {
	$result = false;
	$code = 355;
	$msg = '비밀번호는 4자 이상 20자 이하가 되어야 합니다.';
}
elseif($_FILES['profile_image']['size'] > 0 && $_FILES['profile_image']['error'] > 0) {
	$result = false;
	$code = 999;
	$msg = '이미지 업로드에 문제가 생겼습니다. ('.$_FILES['profile_image']['error'].')';
}
else {
	$values = array(
		'ID'=>$id,
		'LEVEL'=>$level,
		'NAME'=>$name,
		'NICK'=>$nick,
		'BIRTHDAY'=>($birthday!='')?$birthday:NULL,
		'EMAIL'=>$email,
		'TEL'=>$tel,
		'RECEIVE_TEL'=>$receive_tel,
		'RECEIVE_SMS'=>$receive_sms,
		'RECEIVE_PUSH'=>$receive_push,
		'RECEIVE_EMAIL'=>$receive_email,
		'REMARK'=>$remark,
		'STATUS'=>$status
	);
	if(isset($no) && is_numeric($no)) {
		$where = 'IDX=?';
		$where_values = array($no);
		/*
		$data = $db->get($_TABLE['MEMBER'],$where,$where_values)[0]; // 기존 정보 불러옴
		$values = array(
			'PW'=>$data['PW'],
			'PW_DATE'=>$data['PW_DATE'],
			'TEL'=>$data['TEL'],
			'PROFILE_IMAGE'=>$data['PROFILE_IMAGE']
		);
		*/
	}
	else {
		if($receive_tel == 'Y') {
			$values['RECEIVE_TEL_DATE'] = date('Y-m-d H:i:s');
		}
		if($receive_sms == 'Y') {
			$values['RECEIVE_SMS_DATE'] = date('Y-m-d H:i:s');
		}
		if($receive_push == 'Y') {
			$values['RECEIVE_PUSH_DATE'] = date('Y-m-d H:i:s');
		}
		if($receive_email == 'Y') {
			$values['RECEIVE_EMAIL_DATE'] = date('Y-m-d H:i:s');
		}
	}

	/** 프로필 이미지 업로드 **/
	if($_FILES['profile_image']['size'] > 0) {
		$profile_image = file_up(
			$_FILES['profile_image'],
			$_CONFIG['PATH']['UPLOAD_PROFILE'],
			array(
				'thumbnail'=>true,
				'thumbnail_width'=>120,
				'thumbnail_height'=>120
			)
		); // 이미지 업로드
		$values['PROFILE_IMAGE'] = $_CONFIG['URL']['UPLOAD_PROFILE'].$profile_image;
	}
	if(isset($pw) && $pw != '' && $pw == $pw_confirm) { // 비밀번호를 변경할 경우
		$values['PW'] = $pw;
		$values['PW_DATE'] = date('Y-m-d H:i:s');
	}

	if(!$db->insert($_TABLE['MEMBER'],$values,$where,$where_values)) {
		$code = 500;
	}
}

?>