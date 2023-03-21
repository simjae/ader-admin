<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 멤버 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.08
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country				= $_POST['country'];
$member_idx				= $_POST['member_idx'];

if ($country != null && $member_idx != null) {
	$select_member_sql = "
		SELECT
			MB.IDX						AS MEMBER_IDX,
			MB.COUNTRY					AS COUNTRY,
			MB.MEMBER_STATUS			AS MEMBER_STATUS,
			MB.MEMBER_ID				AS MEMBER_ID,
			ML.TITLE					AS MEMBER_LEVEL,
			MB.MEMBER_NAME				AS MEMBER_NAME,
			DATE_FORMAT(
				MB.PW_DATE,
				'%Y-%m-%d %H:%i'
			)							AS PW_DATE,
			DATE_FORMAT(
				MB.MEMBER_BIRTH,
				'%Y-%m-%d'
			)							AS MEMBER_BIRTH,
			ROUND(
				(
					TO_DAYS(NOW()) - (
						TO_DAYS(MB.MEMBER_BIRTH)
					)
				) / 365
			)							AS AGE,
			MB.MEMBER_GENDER			AS MEMBER_GENDER,
			IFNULL(
				MB.ZIPCODE,'-'
			)							AS ZIPCODE,
			IFNULL(
				MB.LOT_ADDR,'-'
			)							AS LOT_ADDR,
			IFNULL(
				MB.ROAD_ADDR,'-'
			)							AS ROAD_ADDR,
			IFNULL(
				MB.DETAIL_ADDR,'-'
			)							AS DETAIL_ADDR,
			MB.TEL_MOBILE				AS TEL_MOBILE,
			MB.ACCEPT_TERMS_FLG			AS ACCEPT_TERMS_FLG,
			MB.ACCEPT_PRIVACY_FLG		AS ACCEPT_PRIVACY_FLG,
			MB.ACCEPT_MARKETING_FLG		AS ACCEPT_MARKETING_FLG,
			MB.RECEIVE_TEL_FLG			AS RECEIVE_TEL_FLG,
			MB.RECEIVE_SMS_FLG			AS RECEIVE_SMS_FLG,
			MB.RECEIVE_PUSH_FLG			AS RECEIVE_PUSH_FLG,
			MB.RECEIVE_EMAIL_FLG		AS RECEIVE_EMAIL_FLG,
			IFNULL(
				DATE_FORMAT(
					MB.RECEIVE_TEL_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS RECEIVE_TEL_DATE,
			IFNULL(
				DATE_FORMAT(
					MB.RECEIVE_SMS_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS RECEIVE_SMS_DATE,
			IFNULL(
				DATE_FORMAT(
					MB.RECEIVE_PUSH_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS RECEIVE_PUSH_DATE,
			IFNULL(
				DATE_FORMAT(
					MB.RECEIVE_EMAIL_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS RECEIVE_EMAIL_DATE,
			MB.REMARK					AS REMARK,
			MB.IP_BAN_FLG				AS IP_BAN_FLG,
			DATE_FORMAT(
				MB.JOIN_DATE,
				'%Y-%m-%d %H:%i'
			)							AS JOIN_DATE,
			IFNULL(
				DATE_FORMAT(
					MB.LOGIN_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS LOGIN_DATE,
			IFNULL(
				DATE_FORMAT(
					MB.SLEEP_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS SLEEP_DATE,
			IFNULL(
				DATE_FORMAT(
					MB.SLEEP_OFF_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS SLEEP_OFF_DATE,
			IFNULL(MB.DROP_TYPE,'-')	AS DROP_TYPE,
			IFNULL(
				DATE_FORMAT(
					MB.DROP_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)							AS DROP_DATE,
			IFNULL(
				MB.DROP_REASON,'-'
			)							AS DROP_REASON,
			IFNULL(
				MB.LOGIN_CNT,0
			)							AS LOGIN_CNT,
			MB.SUSPICION_FLG			AS SUSPICION_FLG,
			IFNULL(
				(
					SELECT
						S_MI.MILEAGE_BALANCE
					FROM
						MILEAGE_INFO S_MI
					WHERE
						S_MI.MEMBER_IDX = MB.IDX
					ORDER BY
						S_MI.IDX DESC
					LIMIT
						0,1
				),0
			)							AS MEMBER_MILEAGE,
			IFNULL(
				(
					SELECT
						SUM(S_OI.PRICE_TOTAL)
					FROM
						ORDER_INFO S_OI
					WHERE
						S_OI.MEMBER_IDX = MB.IDX
				),0
			)							AS SUM_PRICE_TOTAL
		FROM
			MEMBER_".$country." MB
			LEFT JOIN MEMBER_LEVEL ML ON
			MB.LEVEL_IDX = ML.IDX
		WHERE
			MB.IDX = ".$member_idx."
	";
	
	$db->query($select_member_sql);
	
	foreach($db->fetch() as $member_data) {
		$json_result['data'] = array(
			'member_idx'			=>$member_data['MEMBER_IDX'],
			'country'				=>setTxtParam($member_data['COUNTRY']),
			'member_status'			=>setTxtParam($member_data['MEMBER_STATUS']),
			'member_id'				=>$member_data['MEMBER_ID'],
			'member_level'			=>$member_data['MEMBER_LEVEL'],
			'member_name'			=>$member_data['MEMBER_NAME'],
			'pw_date'				=>$member_data['PW_DATE'],
			'member_birth'			=>$member_data['MEMBER_BIRTH'],
			'age'					=>$member_data['AGE'],
			'member_gender'			=>setTxtParam($member_data['MEMBER_GENDER']),
			'zipcode'				=>$member_data['ZIPCODE'],
			'lot_addr'				=>$member_data['LOT_ADDR'],
			'road_addr'				=>$member_data['ROAD_ADDR'],
			'detail_addr'			=>$member_data['DETAIL_ADDR'],
			'tel_mobile'			=>$member_data['TEL_MOBILE'],
			
			'accept_term_flg'		=>setTxtParam($member_data['ACCEPT_TERMS_FLG']),
			'accept_privacy_flg'	=>setTxtParam($member_data['ACCEPT_PRIVACY_FLG']),
			'accept_marketing_flg'	=>setTxtParam($member_data['ACCEPT_MARKETING_FLG']),
			
			'receive_tel_flg'		=>($member_data['RECEIVE_TEL_FLG'] == true) ? "수신동의" : "수신거부",
			'receive_sms_flg'		=>($member_data['RECEIVE_SMS_FLG'] == true) ? "수신동의" : "수신거부",
			'receive_push_flg'		=>($member_data['RECEIVE_PUSH_FLG'] == true) ? "수신동의" : "수신거부",
			'receive_email_flg'		=>($member_data['RECEIVE_EMAIL_FLG'] == true) ? "수신동의" : "수신거부",
			
			'receive_tel_date'		=>$member_data['RECEIVE_TEL_DATE'],
			'receive_sms_date'		=>$member_data['RECEIVE_SMS_DATE'],
			'receive_push_date'		=>$member_data['RECEIVE_PUSH_DATE'],
			'receive_email_date'	=>$member_data['RECEIVE_EMAIL_DATE'],
			
			'join_date'				=>$member_data['JOIN_DATE'],
			'login_date'			=>$member_data['LOGIN_DATE'],
			'sleep_date'			=>$member_data['SLEEP_DATE'],
			'sleep_off_date'		=>$member_data['SLEEP_OFF_DATE'],
			'drop_type'				=>setTxtParam($member_data['DROP_TYPE']),
			'drop_date'				=>$member_data['DROP_DATE'],
			'drop_reason'			=>$member_data['DROP_REASON'],
			'login_cnt'				=>$member_data['LOGIN_CNT'],
			
			'suspicion_flg'			=>($member_data['SUSPICION_FLG'] == true) ? "의심회원":"없음",
			
			'member_mileage'		=>number_format($member_data['MEMBER_MILEAGE']),
			'sum_price_total'		=>number_format($member_data['SUM_PRICE_TOTAL'])
		);
	}
}

function setTxtParam($param) {
	$txt_param = "";
	switch ($param) {
		case "KR" :
			$txt_param = "한국몰";
			break;
		
		case "EN" :
			$txt_param = "영문몰";
			break;
		
		case "CN" :
			$txt_param = "중문몰";
			break;
		
		case "NML" :
			$txt_param = "일반회원";
			break;
		
		case "SLP" :
			$txt_param = "휴면회원";
			break;
		
		case "DRP" :
			$txt_param = "탈퇴회원";
			break;
		
		case "NDP" :
			$txt_param = "일반탈퇴";
			break;
		
		case "FDP" :
			$txt_param = "강제탈퇴";
			break;
		
		case "M" :
			$txt_param = "남자";
			break;
		
		case "F" :
			$txt_param = "여자";
			break;
		
		case "-" :
			$txt_param = "-";
			break;
	}
	
	return $txt_param;
}

?>