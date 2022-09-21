<?php
require_once '../../_static/autoload.php';
if(DEBUG) {
	@error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
	@ini_set("display_errors", 1);
}

/*==============================================================
	.htaccess 생성
  ==============================================================*/
if(!file_exists('.htaccess')) {
$htaccess = 'RewriteEngine On  
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?_url=$1 [QSA,L]';
	$fp = fopen('.htaccess','w');
	fputs($fp,$htaccess);
	fclose($fp);
}

/*==============================================================
	사이트 환경설정
  ==============================================================*/
/*
$db->query('
	SELECT 
			*
		FROM '.$_TABLE['CONFIG'].'
	WHERE 
		SITE IN (?,?)
',array('general','api','_biztalk'));
foreach($db->fetch() as $data) {
	$_CONFIG['SITE'][strtoupper($data['CODE'])] = json_decode($data['VAL'],true);
}
*/

/*==============================================================
	Token 확인
  ==============================================================*/
$code = 200;
if(isset($_HEADER) && is_array($_HEADER) && array_key_exists('Authorization',$_HEADER)) {
	$data = $db->get($_TABLE['TOKEN'],'TOKEN=?',array(explode(' ',trim($_HEADER['Authorization']))[1]));
	if(is_array($data)) {
		$data = $data[0];
		if(intval($data['EXPIRE_DATE']) < time()) { // 만료일이 지남
			$code = 754;
		}
		else {
			define('AUTH',$data);
		}
	}
}
if(!defined('AUTH')) {
	define('AUTH',NULL);
}

/*==============================================================
	API 처리
  ==============================================================*/
$inc_path = '../api/'.implode('/',$_CONFIG['M']).'.php';
if(!file_exists($inc_path)) {
	$code = 404; // 존재하지 않는 API
}
elseif($_CONFIG['M'][0] != 'oauth' && AUTH == NULL) {
	$code = 753; // 토큰 미생성된 요청
}

if($code == 200) {
	include $_CONFIG['FILE']['API'];
}
else {
	echo json_encode(array(
		'code' => $code,
		'msg' => $_CODE[$code]
	));
}
$db->close();
exit(0);
?>