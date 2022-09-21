<?php
/*******************************************************************************
 * 사이트 운영 환경
 ******************************************************************************/
define('BASE_DOMAIN',	'https://admin.adererror.com');		// 기본환경
define('BASE_URL',		'/');			// 기본환경
define('BASE_PATH',		__DIR__.BASE_URL);		// 기본환경
define('DATA_URL',		'https://data.adererror.com/');
define('DATA_PATH',		'/data/web/');
define('SESSION',array(
	'HEAD'=>''
));

/*******************************************************************************
 * 페이지 정의
 ******************************************************************************/
define('PAGE_OPTION',array(
	'login-false'=>array(
		'page'=>array('login'),
		'header'=>'header',
		'footer'=>'footer'
	),
	'base'=>'base'
));
define('PAGE',array(
	'login'=>array(''),

	'dashboard'=>array(''),
	'site'=>array('config','popup','faq','terms'),
	'event'=>array('list'),
	'contents'=>array('collection','collaboration','stockist'),
	'shop'=>array('config','order','exchage','refund','goods','warehouse','coupon'),
	'enterance'=>array('list'),
	'sales'=>array('goods','payout','stat'),
	'analysis'=>array('goods','area','cart'),
	'bluemark'=>array(''),
	'board'=>array('','list'),
	/* 22-06-20 bvdev.shson */
	'member'=>array('list','sleep','drop','info','grade','reserve'),	//[고객관리]
	'administrators'=>array('list'),
	'log'=>array('summary','yearly','monthly','daily','history'),
	'terms'=>array(''),
	'privacy-policy'=>array('')
	/* 22-06-15 bvdev.shson */
	,'order'=>array('list','refund','management', 'deposit')		//[주문관리] - 주문 조회 페이지, 취소/교환/반품/환불 관리 페이지, 자동입금 내역확인 페이지
	/* 22-06-21 bvdev.shson */
	,'display'=>array('board')						//[전시관리] - 게시판 관리 페이지
	/* 22-06-15 bvdev.jhsim */
	,'store'=>array('admin','notice','info')		//[상점관리] - 운영자관리
	,'product'=>array('classify','register','list')	//[상품관리] - 상품분류,상품등록
));
?>