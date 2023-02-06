<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 관리 페이지 - FTP 서버 내 룩북이미지 체크
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

$ftp_dir			    = $_POST['ftp_dir'];

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

$ftp_file = ftp_nlist($conn,$ftp_dir);
if($ftp_file != null){
	/* NULL을 sort 함수의 인자로 넣을 시, fatal_error발생하므로 조건문 추가 */
	/* sort 함수의 리턴값은 성공여부에 따른 T/F이다 */
	sort($ftp_file);
}

if (!empty($ftp_file)) {
	ftp_close($conn);
	
	$json_result['code'] = 200;
    $json_result['data']['img_cnt'] = count($ftp_file);
} else {
	ftp_close($conn);
	
	$json_result['code'] = 301;
	$json_result['msg'] = "FTP 서버 내에 파일이 존재하지 않습니다. 업로드 하려는 파일을 확인해주세요.";
}
?>