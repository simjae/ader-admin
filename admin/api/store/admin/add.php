<?php
/*
 +=============================================================================
 | 
 | 관리자 : 관리자계정 리스트
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$admin_id			= $_POST['admin_id'];
$admin_name			= $_POST['admin_name'];
$admin_pw			= $_POST['admin_pw'];
$admin_nick			= $_POST['admin_nick'];
$admin_email		= $_POST['admin_email'];
$tel_mobile			= $_POST['tel_mobile'];
$admin_fax			= $_POST['admin_fax'];

$insert_admin_sql = "
	INSERT INTO
		ADMIN
	(
		ADMIN_ID,
		ADMIN_NAME,
		ADMIN_NICK,
		ADMIN_PW,
		ADMIN_EMAIL,
		TEL_MOBILE,
		ADMIN_FAX,
		JOIN_DATE
	) VALUES (
		'".$admin_id."',
		'".$admin_name."',
		'".$admin_nick."',
		MD5('".$admin_pw."'),
		'".$admin_email."',
		'".$tel_mobile."',
		'".$admin_fax."',
		NOW()
	)
";

$db->query($insert_admin_sql);

?>