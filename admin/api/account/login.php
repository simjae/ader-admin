<?php
/*
 +=============================================================================
 | 
 | 회원 로그인
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2014.12.19
 | 최종 수정일	: 2015.8.16
 | 버전		: 1.0
 | 설명		: 2015. 8.16 (양한빈) ajax 로 형식 바꿈
 |            2015. 8.18 (양한빈) 아이디/비번 쿠키 저장 코드 추가
 | 
 +=============================================================================
*/

// 값 검사
/*
$id = strtolower(trim($id));
$pw = strtolower(trim($pw));
*/

if($id == '') {
	$result = false;
	$code	= 401;
}
elseif($pw == '') {
	$result = false;
	$code	= 402;
}

if($result) {
	$data = $db->get($_TABLE['ADMIN'],'ID=? AND PW=?',array($id,md5($pw)))[0];
	if(is_array($data)) {
		//session_start();
		$avatar = 'files/ico-avatar.png';
		/*
		if(file_exists($_CONFIG['PATH_UPLOAD_ADMIN'].$id.'.jpg')) {
			$avatar = $_CONFIG['URL_UPLOAD_ADMIN'].$id.'.jpg';
		}
		*/

		// 세션 등록
		$_SESSION[SESSION['HEAD'].'ADMIN_IDX']			= $data['IDX'];
		$_SESSION[SESSION['HEAD'].'ADMIN_ID']			= $id;
		$_SESSION[SESSION['HEAD'].'ADMIN_NAME']			= $data['NAME'];
		$_SESSION[SESSION['HEAD'].'ADMIN_PERMITION']	= $data['PERMITION_NO'];
		$_SESSION[SESSION['HEAD'].'ADMIN_AVATAR'] 		= $avatar;

		// 비밀번호 기억 설정시 쿠키 기억
		if($remember == '1') {
			setcookie('USER_ID',$id, time() + (86400 * 30), '/');
			setcookie('USER_PASSWORD',$pw, time() + (86400 * 30), '/');
		}
		else {
			setcookie('USER_ID','', 0, '/');
			setcookie('USER_PASSWORD','', 0, '/');
		}
	} else {
		$result = false;
		$code	= 300;
		//$msg = md5($pw);
	}
}
?>