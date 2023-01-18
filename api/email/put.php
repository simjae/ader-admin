<?php
/*
 +=============================================================================
 | 
 | 가입메일 체크
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/
$email		= $_POST['email'];

if($email == null || $email == ''){
	$result = false;
	$code	= 401;
}

if($result) {
	$data = @$db->get($_TABLE['MEMBER'],'EMAIL=?',array($email))[0];
	if(is_array($data)) {
		$ran_num = mt_rand(100000, 999999);

		$sql = "
			UPDATE
				dev.MEMBER
			SET
				PW = '".md5($ran_num)."'
			WHERE
				EMAIL = '".$email."'
		";
		$db->query($sql);
		$result = true;
		$json_result['data'] = array('temp_password' => $ran_num);
		$code	= 200;

	} else {
		$result = false;
		$code	= 300;
	}
}
?>