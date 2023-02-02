<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 배송지 추가
 | -------
 |
 | 최초 작성	: 윤재은
 | 최초 작성일	: 2023.01.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$to_place = null;
if (isset($_POST['to_place'])) {
	$to_place = $_POST['to_place'];
}

$to_name = null;
if (isset($_POST['to_name'])) {
	$to_name = $_POST['to_name'];
}

$to_mobile = null;
if (isset($_POST['to_mobile'])) {
	$to_mobile = $_POST['to_mobile'];
}

$to_zipcode = null;
if (isset($_POST['to_zipcode'])) {
	$to_zipcode = $_POST['to_zipcode'];
}

$to_lot_addr = null;
if (isset($_POST['to_lot_addr'])) {
	$to_lot_addr = $_POST['to_lot_addr'];
}

$to_road_addr = null;
if (isset($_POST['to_road_addr'])) {
	$to_road_addr = $_POST['to_road_addr'];
}

$to_detail_addr = null;
if (isset($_POST['to_detail_addr'])) {
	$to_detail_addr = $_POST['to_detail_addr'];
}

$default_flg = null;
if (isset($_POST['default_flg'])) {
	$default_flg = $_POST['default_flg'];
}

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	exit;
}

if ($member_idx > 0 && $to_zipcode != null) {
	$db->begin_transaction();
	
	try {
		$insert_order_to_sql = "
			INSERT INTO
				dev.ORDER_TO
				(
					COUNTRY,
					MEMBER_IDX,
					TO_PLACE,
					TO_NAME,
					TO_MOBILE,
					TO_ZIPCODE,
					TO_LOT_ADDR,
					TO_ROAD_ADDR,
					TO_DETAIL_ADDR,
					DEFAULT_FLG
				)
			VALUES
				(
					'".$country."',
					".$member_idx.",
					'".$to_place."',
					'".$to_name."',
					'".$to_mobile."',
					'".$to_zipcode."',
					'".$to_lot_addr."',
					'".$to_road_addr."',
					'".$to_detail_addr."',
					".$default_flg."
				)
		";

		$db->query($insert_order_to_sql);

		if($default_flg == true) {
			$order_to_idx = $db->last_id();
			
			if(!empty($order_to_idx)) {
				$update_default_flg_sql = "
					UPDATE
						dev.ORDER_TO
					SET
						DEFAULT_FLG = FALSE
					WHERE
						COUNTRY = '".$country."' AND
						MEMBER_IDX = ".$member_idx." AND
						IDX != ".$order_to_idx."
				";

				$db->query($update_default_flg_sql);
			}
		}
		
		$db->commit();
	} catch(mysqli_sql_exception $exception) {
		$db->rollback();

		$json_result['code'] = 302;
		$json_result['msg'] = '배송지 추가에 실패했습니다.';
		
		return $json_result;
	}
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = '배송지 정보를 다시 입력해주세요';
	exit;
}

?>