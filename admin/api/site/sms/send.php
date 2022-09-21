<?php
/*
 +=============================================================================
 | 
 | SMS 테스트
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.09.07
 | 최종 수정일	: 2017.05.26
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$result = sms($FROMNUM,$TONUM,$SMSBODY); // 발송

if($result) {
	$json_result['count'] = $result;
} else {
	$data = db_get($_TABLE['SMS_SENDLIST'],' 1=1 ORDER BY IDX DESC LIMIT 1');
	$code = 300;
	$json_result['resultcode'] = $data['RESULTCODE'];
	$json_result['resultmsg'] = $data['RESULTMSG'];
}
?>