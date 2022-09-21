<?php
/*******************************************************************************
 * 사이트 운영 환경
 ******************************************************************************/
define('BASE_DOMAIN',	'//dev.adererror.com');		// 기본환경
define('BASE_URL',		'/');			// 기본환경
define('BASE_PATH',		__DIR__.BASE_URL);		// 기본환경
define('DATA_URL',		'https://data.artbyus.co.kr/');
define('DATA_PATH',		'/data/web/');
define('SESSION',array(
	'HEAD'=>''
));

/*******************************************************************************
 * 페이지 정의
 ******************************************************************************/
define('PAGE_OPTION',array(
	'login-false'=>array(
		'page'=>array(
			'intro','login','join','search','introduce','pay',
			'guide','privacy-policy','terms-of-use','refund-policy','faq','notice',
			'studio','performance','audition','store','account-search'
		),
		'header'=>'header',
		'footer'=>'footer',
		'login'=>true
	),
	'base'=>'base'
));
define('PAGE',array(
	'intro'=>array(''),
	'login'=>array(''),
	'join'=>array('','google','naver','kakao'),
	'faq'=>array(''),
	'calendar'=>array(''),
	'search'=>array(''),
	'account-search'=>array(''),
	'introduce'=>array('company','service'),
	'guide'=>array(''),
	'privacy-policy'=>array(''),
	'refund-policy'=>array(''),
	'terms-of-use'=>array(''),
	'booking'=>array('','ok'),
	'pay'=>array('ok','close'),

	'studio'=>array('','detail'),
	'performance'=>array('','detail'),
	'audition'=>array('','detail'),
	'store'=>array('','detail'),
	'partner'=>array('','booking','close','studio','studio-detail','studio-add','contents','ad','ad-submit-ok','notice','guide','customer','calendar'),
	'mypage'=>array('info','booking','board','contents','leave'),
	'notice'=>array('')
));
?>