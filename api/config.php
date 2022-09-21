<?php
/*******************************************************************************
 * 사이트 운영 환경
 ******************************************************************************/
define('BASE_DOMAIN',	'//api.adererror.com');		// 기본환경
define('BASE_URL',		'/');			// 기본환경
define('BASE_PATH',		__DIR__.BASE_URL);		// 기본환경
define('DATA_URL',		'https://data.artbyus.co.kr/');
define('DATA_PATH',		'/data/web/');
define('SESSION',array(
	'HEAD'=>''
));

define('ACCESS_ALLOW',true); // 도메인 보안 규칙 해제
define('TOKEN_EXPIRE_TIME',120); // 토큰 만료기간 120분
define('REFRESH_TOKEN_EXPIRE_TIME',720); // 재발행토큰 만료기간 12시간
define('AES_PASSWORD_KEY','dkejdpfj1!'); // 암호화 키
define('AES_PASSWORD',substr(hash('sha256', AES_PASSWORD_KEY, true), 0, 32)); // SHA256 키 암호화
define('AES_IV_128',chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0)); // Initial Vector(IV) = 128 bit(16 byte)
define('GRANT_TYPE',array( // 허용 인증 과정
	//'implicit','password','client_credentials',
	'refresh_token', // 토큰 갱신
	'authorization_code' // 토큰 발급
));
?>