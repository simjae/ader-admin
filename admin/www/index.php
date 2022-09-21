<?php
require_once '../../_static/autoload.php';
//@error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
//@ini_set("display_errors", 0);

/*==============================================================
	.htaccess 생성
  ==============================================================*/
if(!file_exists('.htaccess')) {
$htaccess = 'RewriteEngine On  
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?_url=$1 [L]';
	$fp = fopen('.htaccess','w');
	fputs($fp,$htaccess);
	fclose($fp);
}
/*==============================================================	

  ==============================================================*/
if(is_array($_CONFIG['M']) && sizeof($_CONFIG['M']) > 1) {
	$_CONFIG['REAL_URL'] = implode('/',array_slice($_CONFIG['M'],1));
	switch($_CONFIG['M'][0]) {
		case '_xls': // 엑셀 Export
			$inc_path = $_CONFIG['PATH']['STATIC'].'controller/xls.php';
		break;
		case '_preview': // 이벤트 페이지 생성 후 미리보기
			$inc_path = $_CONFIG['PATH']['STATIC'].'controller/preview.php';
		break;

		case '_api': // API 요청일 경우
			@error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
			@ini_set("display_errors", 1);
			define('ACCESS_ALLOW',false);
			if(file_exists('../api/'.$_CONFIG['M'][1].'/.inc.php')) {
				//include '../api/'.$_CONFIG['M'][1].'/.inc.php';
			}
			if(file_exists('../api/'.$_CONFIG['REAL_URL'].'.php')) {
				$inc_path = '../api/'.$_CONFIG['REAL_URL'].'.php';
			}
			elseif(file_exists('../api/'.$_CONFIG['M'][1].'.php')) {
				$inc_path = '../api/'.$_CONFIG['M'][1].'.php';
			}
			elseif(file_exists('../api/'.$_CONFIG['M'][1].'/get.php')) {
				$inc_path = '../api/'.$_CONFIG['M'][1].'/get.php';
			}
			else {
				$inc_path = $_CONFIG['PATH']['STATIC'].'api/'.$_CONFIG['M'][1].'.php';
			}
		break;
		case '_mailform': // 메일 템플릿 요청일 경우
			$inc_path = '../view/mailform/'.$_CONFIG['M'][1].'.html';
		break;
		case '_modal': // 모달 창
			/** 게시판 **/
			if($_CONFIG['M'][1] == 'board' && $_CONFIG['M'][2] != 'config' && $_CONFIG['M'][2] != PAGE['board'][0]) {
				define('BBSCODE',$_CONFIG['M'][2]);
				$_CONFIG['M'][2] = 'list';
				$_CONFIG['REAL_URL'] = str_replace('_modal-','',implode('-',$_CONFIG['M']));
			}
			$_CONFIG['REAL_URL'] = str_replace('/','-',$_CONFIG['REAL_URL']);
			if(file_exists('../view/modal/'.$_CONFIG['REAL_URL'].'.php')) {
				$inc_path = '../view/modal/'.$_CONFIG['REAL_URL'].'.php';
			}
			elseif(file_exists('../view/modal/'.$_CONFIG['M'][1].'.php')) {
				$inc_path = '../view/modal/'.$_CONFIG['M'][1].'.php';
			}


		break;
		case 'pagebody':
			$pagebody = 'y';
			unset($_CONFIG['M'][0]);
			$_CONFIG['M'] = array_values($_CONFIG['M']);
		break;
	}
	if(isset($inc_path) && file_exists($inc_path)) {
		$result = true;
		$code = 200;
		if(sizeof($_CONFIG['M']) > 2) $m = trim(strtolower($_CONFIG['M'][2]));
		if(!isset($m)) $m = $api_module[0];
		if(!isset($pagenum)) $pagenum = 20;
		if(!isset($page) || is_numeric($page) == FALSE) $page = 1;
		$page = intval($page);
		$json_request = json_decode(file_get_contents('php://input'),true); // json 방식으로 들어왔을 경우
		if(is_array($json_request)) {
			$json_request = $xss->clean($json_request);
			$json_request = sql_injection_addslashes($json_request);
			foreach($json_request as $key => $val) {
				$$key = str_replace('>','&gt;',str_replace('<','&lt;',$val ));
			}
			$json_request = null;
			unset($json_request);
		}
		include $_CONFIG['PATH']['LIBRARY'].'image.php';
		include $_CONFIG['PATH']['LIBRARY'].'serialgenerator.php';
		include $inc_path;
		if($_CONFIG['M'][0] == '_api') {
			header('P3P: CP="CAO PSA OUR"');
			header('Access-Control-Allow-Headers: *');
			header('Content-Type: application/json');
			if(isset($callback) && is_string($callback)) echo $callback.'(';
			echo json_encode(array_merge(array(
				'code'=>$code,
				'msg'=>(!isset($msg) || is_string($msg) === FALSE)?$_CODE[$code]:$msg
			),(is_array($json_result))?$json_result:array()));
			if(isset($callback) && is_string($callback)) echo ')';
		}
		$db->close();
		exit(0);
	}
	else {

	}
}


/*==============================================================
	페이지 정의에 따른 설정
  ==============================================================*/
/*if(!isset($_SESSION[SESSION['HEAD'].'ADMIN_ID']) && is_array(PAGE_OPTION['login-false']) && in_array($_CONFIG['M'][0],PAGE_OPTION['login-false']['page']) === FALSE) {
	$_CONFIG['M'][0] = PAGE_OPTION['login-false']['page'][0];

	$pagebody = 'y';
}*/

if(in_array($_CONFIG['M'][0],array_keys(PAGE)) === FALSE) {
	foreach(PAGE as $k => $v) {
		if(in_array($k,PAGE_OPTION['login-false']['page']) === FALSE && $_SESSION[SESSION['HEAD'].'ADMIN_ID']) {
			$_CONFIG['M'][0] = $k;
			break;
		}
	}
}
if($_CONFIG['M'][0] == 'board' && $_CONFIG['M'][1] != PAGE['board'][0]) {
	define('BBSCODE',$_CONFIG['M'][1]);
	$_CONFIG['M'][1] = 'list';
	if(sizeof($_CONFIG['M']) > 2 && is_numeric($_CONFIG['M'][2])) {
		$no = intval($_CONFIG['M'][2]);
		$_CONFIG['M'][1] = 'detail';
	}
}
$_inc_page = implode('-',$_CONFIG['M']);

// 전체 화면 여부
//$is_fullscreen = (is_bool($_page[$m][0]))?$_page[$m][0]:false;
$is_fullscreen = false;
if(!isset($pagebody)) $pagebody = 'n';
if(!defined('PAGE_OPTION')) {
}
//if(!$is_fullscreen && $pagebody != 'y') $is_fullscreen = false;
if($_CONFIG['M'][0] == 'login') $is_fullscreen = true;

/*==============================================================
	페이지별 정보 정의
  ==============================================================*/
if(!file_exists($_CONFIG['PATH']['PAGE'].$_inc_page.'.php') && !file_exists($_CONFIG['PATH']['PAGE_ORG'].$_inc_page.'.php')) {
	$_CONFIG['PATH']['PAGE'] = $_CONFIG['PATH']['PAGE_ERROR'];
	$code = 404;
	//$_inc_page = $code;
}
/*==============================================================
	레이아웃
  ==============================================================*/
if(!$is_fullscreen && file_exists($_CONFIG['PATH']['LAYOUT'].'base.php')) {
	include $_CONFIG['PATH']['LAYOUT'].'base.php';
}
if(!$is_fullscreen && file_exists($_CONFIG['PATH']['LAYOUT'].'header.php')) {
	include $_CONFIG['PATH']['LAYOUT'].'header.php';
}
// if(!$is_fullscreen && file_exists($_CONFIG['PATH']['LAYOUT'].'main.php')) {
// 	include $_CONFIG['PATH']['LAYOUT'].'main.php';
// }
include $_CONFIG['PATH']['PAGE'].$_inc_page.'.php';
if(!$is_fullscreen && file_exists($_CONFIG['PATH']['LAYOUT'].'footer.php')) {
	include $_CONFIG['PATH']['LAYOUT'].'footer.php';
}
$db->close();
?>