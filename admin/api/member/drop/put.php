<?php
/*
 +=============================================================================
 | 
 | 회원 탈퇴 API
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.9.7
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../static/init.php';

$code = 200;
$msg = 'success';

// 예외 처리
if(!$no) {
	$msg = 'must input index number(s)';
	$code = 400;
	$result = false;
}

if(DBMS == 'MYSQL') {
	$query = 'SELECT * FROM '.$Table['Member'].' WHERE IDX IN ('.$no.')';
}
$sql = db_query($query);
while($data = db_array($sql)) {
	$fields  = 'ID, NAME, NICK, PW, PW_PREV, EMAIL, TEL, FAX, MOBILE, ';
	$fields .= 'GENDER, BIRTHDAY, ZIPCODE, ADDRESS1, ADDRESS2, ';
	$fields .= 'ZIPCODE_DORO,ADDRESS1_DORO,ADDRESS2_DORO,RECEIVE_TEL,RECEIVE_SMS,RECEIVE_EMAIL,';
	$fields .= 'RECEIVE_TEL_DATE,RECEIVE_SMS_DATE,RECEIVE_EMAIL_DATE, ';
	$fields .= 'JOIN_DATE, EXIT_DATE';

	$values  = '"'.$data['ID'].'","'.$data['NAME'].'","'.$data['NICK'].'","'.$data['PW'].'","'.$data['PW_PREV'].'",';
	$values .= '"'.$data['EMAIL'].'","'.$data['TEL'].'","'.$data['FAX'].'","'.$data['MOBILE'].'",';
	$values .= '"'.$data['GENDER'].'","'.$data['BIRTHDAY'].'","'.$data['ZIPCODE'].'","'.$data['ADDRESS1'].'","'.$data['ADDRESS2'].'",';
	$values .= '"'.$data['ZIPCODE_DORO'].'","'.$data['ADDRESS1_DORO'].'","'.$data['ADDRESS2_DORO'].'",';
	$values .= '"'.$data['RECEIVE_TEL'].'","'.$data['RECEIVE_SMS'].'","'.$data['RECEIVE_EMAIL'].'",';
	$values .= '"'.$data['RECEIVE_TEL_DATE'].'","'.$data['RECEIVE_SMS_DATE'].'","'.$data['RECEIVE_EMAIL_DATE'].'",';
	$values .= '"'.$data['JOIN_DATE'].'", Now()';

	$result = db_insert($Table['Member_Exit'],$fields,$values);

	if(!$result) {
		$code = 300;
		$msg = 'failed';
		exit;
	}
	else {
		@db_delete($Table['Member'],'IDX='.$data['IDX']);
	}
}

// json 출력 시작
if($callback) echo $callback.'(';
echo '{"code":'.$code.',"msg":"'.$msg.'"}';
if($callback) echo ')';
?>