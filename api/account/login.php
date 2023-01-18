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
			MEMBER.IDX,
			MEMBER.MEMBER_ID,
			MEMBER.COUNTRY,
			MEMBER.MEMBER_NAME,
			MEMBER.TEL_MOBILE,
			DATE_FORMAT(MEMBER.MEMBER_BIRTH, '%Y%m%d') AS MEMBER_BIRTH_NUM,

			DATE_FORMAT(MEMBER.MEMBER_BIRTH  - INTERVAL VM.DATE_AGO_PARAM DAY, '%Y') AS AGO_YEAR_PARAM,
			DATE_FORMAT(MEMBER.MEMBER_BIRTH  - INTERVAL VM.DATE_AGO_PARAM DAY, '-%m-%d') AS AGO_DATE_PARAM,
			DATE_FORMAT(MEMBER.MEMBER_BIRTH  + INTERVAL VM.DATE_LATER_PARAM DAY, '%Y') AS LATER_YEAR_PARAM,
			DATE_FORMAT(MEMBER.MEMBER_BIRTH  + INTERVAL VM.DATE_LATER_PARAM DAY, '-%m-%d') AS LATER_DATE_PARAM,
			DATE_FORMAT(MEMBER.MEMBER_BIRTH, '-%m-%d') AS MEMBER_BIRTH,
			DATE_FORMAT(NOW(), '%Y') AS NOW_YEAR,
			DATE_FORMAT(NOW(), '%m') AS NOW_MONTH,
			DATE_FORMAT(NOW(), '%Y-%m-%d') AS NOW,
			VM.DATE_AGO_PARAM,
			VM.DATE_LATER_PARAM
		FROM 
			dev.MEMBER_".$country." 		MEMBER	LEFT JOIN
			(SELECT
				DATE_AGO_PARAM,
				DATE_LATER_PARAM
			FROM
				dev.VOUCHER_MST
			WHERE
				COUNTRY = 'KR' AND VOUCHER_TYPE = 'BR'
			LIMIT 1)			VM
		ON
			1=1
		WHERE
			MEMBER_ID = '".$member_id."'
		AND
			MEMBER_PW = '".md5($member_pw)."'
	";

	$db->query($sql);
	
	foreach($db->fetch() as $data){
		$member_cnt = $data['MEMBER_CNT'];
		$member_birth = $data['MEMBER_BIRTH'];

		if($member_cnt == 1){
			//회원 있음
			$_SESSION['COUNTRY'] = $country;
			$_SESSION['MEMBER_IDX']	= $data['IDX'];
			$_SESSION['MEMBER_ID'] = $data['MEMBER_ID'];
			$_SESSION['COUNTRY'] = $data['COUNTRY'];
			$_SESSION['MEMBER_NAME'] = $data['MEMBER_NAME'];
			$_SESSION['TEL_MOBILE'] = $data['TEL_MOBILE'];
			$_SESSION['MEMBER_EMAIL'] = $data['MEMBER_ID'];
			$_SESSION['MEMBER_BIRTH'] = $data['MEMBER_BIRTH_NUM'];
			
			$sql = "
				UPDATE
					dev.MEMBER_".$country."
				SET
					LOGIN_CNT = LOGIN_CNT + 1,
					LOGIN_DATE = NOW()
				WHERE
					IDX = ".$data['IDX']." ";
			
			$db->query($sql);
			if ($data['AGO_YEAR_PARAM'] != $data['LATER_YEAR_PARAM']) {
				if ($data['NOW_MONTH'] == '01') {
					$ago_year = (string) ((int) $data['NOW_YEAR'] - 1);
					$later_year = $data['NOW_YEAR'];
				}
				else if ($data['NOW_MONTH'] == '12') {
					$ago_year = $data['NOW_YEAR'];
					$later_year = (string) ((int) $data['NOW_YEAR'] + 1);
				}
			}
			else{
				$ago_year = $data['NOW_YEAR'];
				$later_year = $data['NOW_YEAR'];
			}

			$start_date_param = $ago_year.$data['AGO_DATE_PARAM'];
			$end_date_param = $later_year.$data['LATER_DATE_PARAM'];
			$now_param = strtotime(date("Y-m-d"));

			if(strtotime($start_date_param) < $now_param && strtotime($end_date_param) > $now_param){
				brithVoucherIssue($db, $country, $data['IDX'], $start_date_param, $end_date_param);
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