<?php
/*
 +=============================================================================
 | 
 | 1:1문의 답변
 | ------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.12.8
 | 최종 수정일	: 2015.12.8 20:37
 | 버전		: 0.1
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../static/init.php';

if($no && is_numeric($no)){ //정보변경
	$query  = 'IDX='.$no;
	$query .= ',ANSWER="'.$ANSWER.'"';
	$query .= ',ANSWER_DATE = Now(),STATUS = "Y"';

	$result = db_update($Table['Qna'],$query,'IDX='.$no);

	if(!$result) {
		$code = 300;
		$msg = 'failed';
	}
	else {
		$data = db_get_field($Table['Qna'],'*','IDX='.$no);
		$member = memberinfo($data['ID']); // 자료 불러옴
		if($data['RECEIVE_SMS'] == 'Y') {	// 답변 여부 문자로 전송
			$smstmpl = array();
			$smstmpl['SITENAME'] = $Config['SHOP']['NAME'];
			@sms($Config['SHOP']['TEL'],$member['MOBILE'],'MEMBER-5',$smstmpl);
			$smstmpl = null;
			unset($smstmpl);
		}
		if($data['RECEIVE_EMAIL'] == 'Y') {	// 답변 여부 메일로 전송
			$templete = db_get_field($Table['Mailform'],'*','STATUS="Y" AND IDX=99');
			$subject = '['.$Config['SHOP']['NAME'].'] 1:1문의하신 내용에 답변드립니다';
			$str['CONTENTS'] = '
<strong>문의 내용</strong><br><br>'.$data['CONTENTS'].'<br><br>
<div style="width:100%;border-top:solid 1px #666"><br><br>
<strong>답변 내용</strong><br><br>'.nl2br($ANSWER).'<br><br></div>';
			$body = mailform($templete['CONTENTS'],$str);
			$mailresult = send_mail($Config['ADMIN_EMAIL'], $Config['ADMIN_NAME'], $member['EMAIL'], $member['NAME'], $subject, $body);	
		}
		$data = null;
		$member = null;
		unset($data);
		unset($member);
	}

} else {
	$code = 400;
	$msg = '인덱스 번호는 필수항목입니다.';
}

// json 출력 시작
if($callback) echo $callback.'(';
echo '{"code":'.$code.',"msg":"'.$msg.'","mail":'.(($mailresult==true)?'true':'false').'}';
if($callback) echo ')';

?>