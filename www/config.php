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
			'main','landing','login','join','search','introduce','pay',
			'guide','privacy-policy','terms-of-use','refund-policy','faq','notice',
			'studio','performance','audition','store','account-search','components',
			'product', 'order'
		),
		'header'=>'header',
		'footer'=>'footer',
		'login'=>true
	),
	'base'=>'base'
));
define('PAGE',array(
	'components'=>array('nav','footer'),
	'main'=>array(''),
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

	'notice'=>array(''),
	'product'=>array('classify','register','list'),
	'order'=>array('list')
));
?>