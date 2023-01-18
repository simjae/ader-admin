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
$country		= $_POST['country'];
$member_id		= $_POST['member_id'];
// 값 검사
$verify_member_cnt = $db->count('dev.MEMBER_'.$country, 'MEMBER_ID = "'.$member_id.'" ');


if($verify_member_cnt > 0){
	$json_result['code'] = 303;
	$json_result['msg'] = "이미 동일한 이메일의 계정이 있습니다.";
	return $json_result;
}
else{
	$member_id		        = $_POST['member_id'];
	$member_id_arr = array();
	if ($member_id != null) {
		$member_id_arr[0] = ' MEMBER_ID, ';
		$member_id_arr[1] = "'".$member_id."',";
	}

	$member_pw		    = $_POST['member_pw'];
	$member_pw_arr = array();
	if ($member_pw != null) {
		$member_pw_arr[0] = ' MEMBER_PW, ';
		$member_pw_arr[1] = "'".md5($member_pw)."',";
	}
	$member_name		        = $_POST['member_name'];
	$member_name_arr = array();
	if ($member_name != null) {
		$member_name_arr[0] = ' MEMBER_NAME, ';
		$member_name_arr[1] = "'".$member_name."',";
	}

	$zipcode        = $_POST['zipcode'];
	$zipcode_arr = array();
	if ($zipcode != null) {
		$zipcode_arr[0] = ' ZIPCODE, ';
		$zipcode_arr[1] = "'".$zipcode."',";
	}

	$lot_addr        = $_POST['lot_addr'];
	$lot_addr_arr = array();
	if ($lot_addr != null) {
		$lot_addr_arr[0] = ' LOT_ADDR, ';
		$lot_addr_arr[1] = "'".$lot_addr."',";
	}

	$road_addr        = $_POST['road_addr'];
	$road_addr_arr = array();
	if ($road_addr != null) {
		$road_addr_arr[0] = ' ROAD_ADDR, ';
		$road_addr_arr[1] = "'".$road_addr."',";
	}

	$detail_addr        = $_POST['detail_addr'];
	$detail_addr_arr = array();
	if ($detail_addr != null) {
		$detail_addr_arr[0] = ' LOT_ADDR, ';
		$detail_addr_arr[1] = "'".$detail_addr."',";
	}

	$tel_mobile		        = $_POST['tel_mobile'];
	$tel_mobile_arr = array();
	if ($tel_mobile != null) {
		$tel_mobile_arr[0] = ' TEL_MOBILE, ';
		$tel_mobile_arr[1] = "'".$tel_mobile."',";
	}

	$birth_year		    = $_POST['birth_year'];
	$birth_month	    = $_POST['birth_month'];
	$birth_day		    = $_POST['birth_day'];
	$birth_arr = array();
	if($birth_year != null && $birth_month != null && $birth_day != null){
		$birth_arr[0] = ' MEMBER_BIRTH ';
		$birth_arr[1] = "DATE('".$birth_year."-".$birth_month."-".$birth_day."')";
	}

	$sql = 	"INSERT INTO
						dev.MEMBER_".$country."
					(   
						".$member_id_arr[0]."
						".$member_pw_arr[0]."
						".$member_name_arr[0]."
						".$zipcode_arr[0]."
						".$lot_addr_arr[0]."
						".$road_addr_arr[0]."
						".$detail_addr_arr[0]."
						".$tel_mobile_arr[0]."
						".$birth_arr[0].",
						JOIN_DATE
					)
					VALUES
					(
						".$member_id_arr[1]."
						".$member_pw_arr[1]."
						".$member_name_arr[1]."
						".$zipcode_arr[1]."
						".$lot_addr_arr[1]."
						".$road_addr_arr[1]."
						".$detail_addr_arr[1]."
						".$tel_mobile_arr[1]."
						".$birth_arr[1].",
						NOW()
					)
			";
	$db->query($sql);
}
?>