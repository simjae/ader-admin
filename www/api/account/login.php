<?php
/*
 +=============================================================================
 | 
 | 회원 로그인
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
include_once("/var/www/admin/api/voucher/issue/add.php");

$country		= $_POST['country'];
$member_id		= $_POST['member_id'];
$member_pw		= $_POST['member_pw'];
// 값 검사
//$id = strtolower(trim($id));

//$pw = strtolower(trim($pw));

if($member_id == null || $member_id == ''){
	$result = false;
	$code	= 401;
}
if($member_pw == null || $member_pw == ''){
	$result = false;
	$code	= 402;
}

if($result) {
	$sql = "
		SELECT 
			COUNT(0) 	MEMBER_CNT,
			IDX,
			MEMBER_ID,
			COUNTRY,
			MONTH(MEMBER_BIRTH) 	AS BIRTH_MONTH,
			MONTH(NOW()) 			AS NOW_MONTH
		FROM 
			dev.MEMBER_".$country."
		WHERE
			MEMBER_ID = '".$member_id."'
		AND
			MEMBER_PW = '".md5($member_pw)."'
	";

	$db->query($sql);
	
	foreach($db->fetch() as $data){
		$member_cnt = $data['MEMBER_CNT'];
		$birth_month = $data['BIRTH_MONTH'];
		$now_month = $data['NOW_MONTH'];

		if($member_cnt == 1){
			//회원 있음
			$_SESSION['COUNTRY'] = $country;
			$_SESSION['MEMBER_IDX']	= $data['IDX'];
			$_SESSION['MEMBER_ID'] = $data['MEMBER_ID'];	
			
			$sql = "
				UPDATE
					dev.MEMBER_".$country."
				SET
					LOGIN_CNT = LOGIN_CNT + 1,
					LOGIN_DATE = NOW()
				WHERE
					IDX = ".$data['IDX']." ";
			$db->query($sql);	

			if($birth_month == $now_month){
				if(brithVoucherIssue($db,$country, $data['IDX'])){
					$json_result['data'] = 'issue_birth_voucher';
				}
			}
		}
		else{
			$result = false;
			$code	= 300;
			$msg 	= "가입된 회원이 아닙니다.";
		}
	}
}
?>