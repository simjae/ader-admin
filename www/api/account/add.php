<?php
/*
 +=============================================================================
 | 
 | 회원 가입
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

// 값 검사
$verify_member_cnt = $db->count('dev.MEMBER', 'EMAIL = "'.$email.'" ');


if($verify_member_cnt > 0){
	$json_result['code'] = 303;
	$json_result['msg'] = "이미 동일한 이메일의 계정이 있습니다.";
	return $json_result;
}

$email		        = $_POST['email'];
$email_arr = array();
if ($email != null) {
	$email_arr[0] = ' EMAIL, ';
	$email_arr[1] = "'".$email."',";
}
$password		    = $_POST['password'];
$password_arr = array();
if ($password != null) {
	$password_arr[0] = ' PW, ';
	$password_arr[1] = "'".md5($password)."',";
}
$name		        = $_POST['name'];
$name_arr = array();
if ($name != null) {
	$name_arr[0] = ' NAME, ';
	$name_arr[1] = "'".$name."',";
}
$addr		        = $_POST['addr'];
$addr_detail        = $_POST['addr_detail'];
$addr_arr = array();
if ($addr != null) {
	$addr_arr[0] = ' ADDR, ';
	$addr_arr[1] = "'".$addr." ".$addr_detail."',";
}
$phone		        = $_POST['phone'];
$phone_arr = array();
if ($phone != null) {
	$phone_arr[0] = ' TEL_MOBILE, ';
	$phone_arr[1] = "'".$phone."',";
}

$birth_year		    = $_POST['birth_year'];
$birth_month	    = $_POST['birth_month'];
$birth_day		    = $_POST['birth_day'];
$birth_arr = array();
if($birth_year != null && $birth_month != null && $birth_day != null){
    $birth_arr[0] = ' BIRTHDAY ';
	$birth_arr[1] = "DATE('".$birth_year."-".$birth_month."-".$birth_day."')";
}

$sql = 	"INSERT INTO
					dev.MEMBER
				(   ID,
					".$email_arr[0]."
					".$password_arr[0]."
					".$name_arr[0]."
					".@$addr_arr[0]."
					".@$phone_arr[0]."
					".$birth_arr[0]."
				)
				VALUES
				(
                    '".$email."',
					".$email_arr[1]."
					".$password_arr[1]."
					".$name_arr[1]."
					".@$addr_arr[1]."
					".@$phone_arr[1]."
					".$birth_arr[1]."
				)
		";
$db->query($sql);
?>