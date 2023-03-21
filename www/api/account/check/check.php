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
$country		= $_POST['country'];
$member_id		= $_POST['member_id'];

if($member_id == null || $member_id == ''){
	$result = false;
	$code	= 401;
	$msg = '입력한 이메일이 올바르지 않습니다. 다시 입력해주세요';
}
else{
	$member_count = 0;
	$sql = "
		SELECT 
			COUNT(0) AS MEMBER_CNT,
			IDX 
		FROM 
			MEMBER_".$country."
		WHERE
			MEMBER_ID = '".$member_id."'
	";
	$db->query($sql);

	$result_arr = array();
	foreach($db->fetch() as $data){
		$member_count = $data['MEMBER_CNT'];
		$result_arr = array(
			'member_idx' => $data['IDX']
		);
	}

	if($member_count > 0){

		// php의 메일 발송 함수 mail() 
		// 미구현


		$json_result['data'][] = $result_arr; 
	}
	else{
		$result = false;
		$code	= 300;
		$msg = '존재하지 않는 이메일입니다';
	}
}
?>