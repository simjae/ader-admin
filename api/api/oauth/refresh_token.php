<?php

/** 01. 변수 정리 **/
$client_id = (isset($client_id))?trim($client_id):NULL;
$secret_key = (isset($secret_key))?trim($secret_key):NULL;
$refresh_token = (isset($refresh_token))?trim($refresh_token):NULL;
$where = 'CLIENT_ID=? AND REFRESH_TOKEN=?';
$where_values = array($client_id,$refresh_token);

if($secret_key != NULL) { // secret key가 넘어왔을 경우
	$where .= ' AND SECRET_KEY=?';
	$where_values[] = $secret_key;
}

if($client_id == NULL) {
	$code = 760;
	$result = false;
}
elseif($secret_key != '' && strlen($secret_key) != 12) {
	$code = 763;
	$result = false;
}
elseif($grant_type != 'refresh_token' || !in_array($grant_type,GRANT_TYPE)) {
	$code = 764;
	$result = false;
}
elseif($db->count($_TABLE['OAUTH'],$where,$where_values) == 0) {
	$code = 300;
	$result = false;
}
else {
	$data = $db->get($_TABLE['OAUTH'],$where,$where_values)[0];
	if($data['STATUS'] == 'N') {
		$code = 600;
		$result = false;
	}
	elseif($secret_key == NULL && $data['SECRET_KEY'] != '') {
		$code = 763;
		$result = false;
	}
	elseif($data['IP'] != '0.0.0.0' && $data['IP'] != $_SERVER['REMOTE_ADDR']) {
		$code = 780;
		$result = false;
	}
	else {
		// 토큰 유효기간 2시간
		$timestamp = time()+(TOKEN_EXPIRE_TIME*60)+(9*60*60);
		$expire_datetime = date('Y-m-d H:i:s',$timestamp);

		// 토큰 생성 (AES-256)
		/*
		$phprandom = new PHPRandom();
		$access_token = $phprandom->getString().'==';
		*/
		$access_token = base64_encode(openssl_encrypt(substr(getmicrotime().$client_id.$data['CLIENT_KEY'],0,30), 'aes-256-cbc', AES_PASSWORD, OPENSSL_RAW_DATA, AES_IV_128)); // 암호화

		// 재발행 토큰 유효기간
		$refresh_timestamp = time()+(REFRESH_TOKEN_EXPIRE_TIME*60)+(9*60*60);
		$refresh_datetime = date('Y-m-d H:i:s',$refresh_timestamp);
		$refresh_token = base64_encode(openssl_encrypt(substr($client_id.getmicrotime().$data['CLIENT_KEY'],0,30), 'aes-256-cbc', AES_PASSWORD, OPENSSL_RAW_DATA, AES_IV_128)); // 암호화

		// 인증정보 업데이트
		if($db->update(
			$_TABLE['OAUTH'],
			array(
				//'IP' => $_SERVER['REMOTE_ADDR'],
				'ACCESS_TOKEN' => $access_token,
				'EXPIRE_DATE' => $expire_datetime,
				'AUTH_DATE' => date('Y-m-d H:i:s'),
				'REFRESH_TOKEN' => $refresh_token,
				'REFRESH_DATE' => $refresh_datetime
			),
			'IDX=?',
			array($data['IDX'])
		)) {
			$json_result = array(
				'token_type'=>'bearer',
				'access_token'=>$access_token,
				'expire_timestamp'=>$timestamp,
				'expire_datetime'=>$expire_datetime,
				'refresh_token'=>$refresh_token,
				'refresh_timestamp'=>$refresh_timestamp,
				'refresh_datetime'=>$refresh_datetime
			);
		}
		else {
			$code = 750;
		}
	}
}
?>