<?php
/*
 +=============================================================================
 | 
 | 런웨이 관리 페이지 - FTP 서버 내 렁눼이 썸네일/컨텐츠 체크
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$ftp_dir			= $_POST['ftp_dir'];

$ftp_host 				= '203.245.9.174';
$user 					= 'aderwms';
$password 				= 'bv1229';
$dir 					= '';
$conn 					= ftp_connect($ftp_host);

if(!$conn){
	echo "FTP SERVER CONNECT ERROR";
	exit;
}

$result = ftp_login($conn, $user, $password);
if(!$result){
	echo "FTP SERVER LOGIN ERROR";
}

$ftp_thmb_web_file_path = $ftp_dir."/thumb/web";
$ftp_thmb_web_file = ftp_nlist($conn,$ftp_thmb_web_file_path); 
if($ftp_thmb_web_file != null){
	/* NULL을 sort 함수의 인자로 넣을 시, fatal_error발생하므로 조건문 추가 */
	/* sort 함수의 리턴값은 성공여부에 따른 T/F이다 */
	sort($ftp_thmb_web_file);
}

$ftp_thmb_mobile_file_path = $ftp_dir."/thumb/mobile";
$ftp_thmb_mobile_file = ftp_nlist($conn,$ftp_thmb_mobile_file_path); 
if($ftp_thmb_mobile_file != null){
	sort($ftp_thmb_mobile_file);
}

$ftp_cnts_web_file_path = $ftp_dir."/contents/web";
$ftp_cnts_web_file = ftp_nlist($conn,$ftp_cnts_web_file_path); 
if($ftp_cnts_web_file != null){
	sort($ftp_cnts_web_file);
}

$ftp_cnts_mobile_file_path = $ftp_dir."/contents/mobile";
$ftp_cnts_mobile_file = ftp_nlist($conn,$ftp_cnts_mobile_file_path); 
if($ftp_cnts_mobile_file != null){
	sort($ftp_cnts_mobile_file);
}

if (!empty($ftp_thmb_web_file) && !empty($ftp_thmb_mobile_file) && !empty($ftp_cnts_web_file) && !empty($ftp_cnts_mobile_file)) {
	if ((count($ftp_thmb_web_file) != count($ftp_cnts_web_file)) || (count($ftp_thmb_mobile_file) != count($ftp_cnts_mobile_file))) {
		ftp_close($conn);
		
		$json_result['code'] = 301;
		$json_result['msg'] = "런웨이 썸네일 파일과 컨텐츠 파일의 수가 일치하지 않습니다. FTP 서버 내의 파일을 확인해주세요.";
	}
	
	ftp_close($conn);
	
	$json_result['data'] = array(
		'thumb_web_cnt' => count($ftp_thmb_web_file),
		'thumb_mobile_cnt' => count($ftp_thmb_mobile_file),
		'contents_web_cnt' => count($ftp_cnts_web_file),
		'contents_mobile_cnt' => count($ftp_cnts_mobile_file),
	);
} else {
	ftp_close($conn);
	
	$json_result['code'] = 301;
	$json_result['msg'] = "FTP 서버 내에 파일이 존재하지 않습니다. 업로드 하려는 파일을 확인해주세요.";
}
?>