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

$admin_id = null;
if (isset($_POST['id'])) {
	$admin_id	= $_POST['id'];
}

$admin_pw = null;
if (isset($_POST['pw'])) {
	$admin_pw	= $_POST['pw'];
}

if($admin_id == "" || $admin_id == null) {
	$json_result['result'] = false;
	$json_result['code'] = 401;
}

if ($admin_pw == '' || $admin_pw == null) {
	$json_result['result'] = false;
	$json_result['code'] = 402;
}

if($admin_id != null && $admin_pw != null) {
	$admin_cnt = $db->count("ADMIN","ADMIN_ID = '".$admin_id."' AND ADMIN_PW = '".md5($admin_pw)."'");
	
	if ($admin_cnt > 0) {
		$select_admin_sql = "
			SELECT
				AD.IDX				AS ADMIN_IDX,
				AD.ADMIN_ID			AS ADMIN_ID,
				AD.ADMIN_NAME		AS ADMIN_NAME,
				AD.IP				AS ADMIN_IP,
				CASE
					WHEN
						PT.TITLE LIKE 'PCS%'
						THEN
							'PCS'
					ELSE
							'WCC'
				END					AS PERMITION_TYPE
			FROM
				ADMIN AD
				LEFT JOIN PERMITION_TYPE PT ON
				AD.TYPE_IDX = PT.IDX
			WHERE
				AD.ADMIN_ID = '".$admin_id."' AND
				AD.ADMIN_PW = '".md5($admin_pw)."'
		";
		
		$db->query($select_admin_sql);
		
		$avatar = 'files/ico-avatar.png';
		foreach($db->fetch() as $admin_data) {
			$admin_idx = $admin_data['ADMIN_IDX'];
			$permition_type = $admin_data['PERMITION_TYPE'];
			
			if (!empty($admin_idx)) {
				$db->query("UPDATE ADMIN SET LOGIN_DATE = NOW() WHERE IDX = ".$admin_idx);
				
				$_SESSION['ADMIN_IDX']			= $admin_data['ADMIN_IDX'];
				$_SESSION['ADMIN_ID']			= $admin_data['ADMIN_ID'];
				$_SESSION['ADMIN_NAME']			= $admin_data['ADMIN_NAME'];
				$_SESSION['ADMIN_IP']			= $admin_data['ADMIN_IP'];
				$_SESSION['ADMIN_AVATAR']		= $avatar;
				
				// 비밀번호 기억 설정시 쿠키 기억
				if($remember == '1') {
					setcookie('USER_ID',$id, time() + (86400 * 30), '/');
					setcookie('USER_PASSWORD',$pw, time() + (86400 * 30), '/');
				} else {
					setcookie('USER_ID','', 0, '/');
					setcookie('USER_PASSWORD','', 0, '/');
				}
				
				$json_result['data'] = $permition_type;
			}
		}
	} else {
		$json_result['result'] = false;
		$json_result['code'] = 300;
		$json_result['msg'] = "관리자 계정정보가 존재하지 않습니다.";
	}
}
?>