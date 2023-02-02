<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 배송지 수정
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

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	exit;
}

$order_to_idx = 0;
if (isset($_POST['order_to_idx'])) {
	$order_to_idx = $_POST['order_to_idx'];
}

$to_place_sql = null;
if (isset($_POST['to_place'])) {
	$to_place_sql = " TO_PLACE = '".$_POST['to_place']."', ";
}

$to_name_sql = null;
if (isset($_POST['to_name'])) {
	$to_name_sql = " TO_NAME = '".$_POST['to_name']."', ";
}

$to_mobile_sql = null;
if (isset($_POST['to_mobile'])) {
  $to_mobile_sql = " TO_MOBILE = '".$_POST['to_mobile']."', ";
}

$to_zipcode_sql = null;
if (isset($_POST['to_zipcode'])) {
  $to_zipcode_sql = " TO_ZIPCODE = '".$_POST['to_zipcode']."', ";
}

$to_lot_addr_sql = null;
if (isset($_POST['to_lot_addr'])) {
  $to_lot_addr_sql = " TO_LOT_ADDR = '".$_POST['to_lot_addr']."', ";
}

$to_road_addr_sql = null;
if (isset($_POST['to_road_addr'])) {
  $to_road_addr_sql = " TO_ROAD_ADDR = '".$_POST['to_road_addr']."', ";
}

$to_detail_addr_sql = null;
if (isset($_POST['to_detail_addr'])) {
  $to_detail_addr_sql = " TO_DETAIL_ADDR = '".$_POST['to_detail_addr']."' ";
}

$default_flg = null;
$default_flg_sql = null;
if (isset($_POST['default_flg'])) {
	$default_flg = $_POST['default_flg'];
	$default_flg_sql = " DEFAULT_FLG = ".$_POST['default_flg']." ";
	
	if (strlen($to_detail_addr_sql) > 0) {
		$default_flg_sql = " , ".$default_flg_sql;
	}
}

if ($country != null && $member_idx > 0 && $order_to_idx > 0) {
	$db->begin_transaction();
    
	try {
		$update_order_to_sql = "
			UPDATE
				dev.ORDER_TO
			SET
				".$to_place_sql."
				".$to_name_sql."
				".$to_mobile_sql."
				".$to_zipcode_sql."
				".$to_lot_addr_sql."
				".$to_road_addr_sql."
				".$to_detail_addr_sql."
				".$default_flg_sql."
			WHERE
				IDX = ".$order_to_idx." AND
				COUNTRY = '".$country."' AND
				MEMBER_IDX = ".$member_idx."
		";

		$db->query($update_order_to_sql);
		  
		if ($default_flg == true) {
			$db_result = $db->affectedRows();
			  
			if ($db_result > 0) {
				$update_default_flg_sql = "
					UPDATE
						dev.ORDER_TO
					SET
						DEFAULT_FLG = FALSE
					WHERE
						IDX != ".$order_to_idx." AND
						COUNTRY = '".$country."' AND
						MEMBER_IDX = ".$member_idx."
				";
		  
				$db->query($update_default_flg_sql);
			}
		}
		  
		$db->commit();
  } catch (mysqli_sql_exception $exception) {
	$db->rollback();
	
	$json_result['code'] = 302;
	$json_result['msg'] = '배송지 변경에 실패했습니다.';
	return $json_result;
  }
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = "배송지정보를 불러오지 못했습니다";
	exit;
}
?>