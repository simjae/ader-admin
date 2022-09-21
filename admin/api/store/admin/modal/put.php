<?php
/*
 +=============================================================================
 | 
 | 관리자 : 관리자정보 수정
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$idx							= $_POST['member_idx'];
$id								= $_POST['id'];
$pw								= $_POST['pw'];
$name							= $_POST['name'];
$pwchg							= $_POST['pwchg'];
$current_pw						= $_POST['current_pw'];
$nick							= $_POST['NICK'];
$email							= $_POST['EMAIL'];
$tel							= $_POST['TEL'];
$fax							= $_POST['FAX'];
$mobile							= $_POST['MOBILE'];

$update = "";
$store_info_kr					= $_POST['store_info_kr'];
if ($store_info_kr != null) {
	$update .= " STORE_INFO_KR = ".$store_info_kr.", ";
}

$store_info_en					= $_POST['store_info_en'];
if ($store_info_en != null) {
	$update .= " STORE_INFO_EN = ".$store_info_en.", ";
}

$store_info_cn					= $_POST['store_info_cn'];
if ($store_info_cn != null) {
	$update .= " STORE_INFO_CN = ".$store_info_cn.", ";
}

$store_admin					= $_POST['store_admin'];
if ($store_admin != null) {
	$update .= " STORE_ADMIN = ".$store_admin.", ";
}

$store_notice					= $_POST['store_notice'];
if ($store_notice != null) {
	$update .= " STORE_NOTICE = ".$store_notice.", ";
}

$store_add_on					= $_POST['store_add_on'];
if ($store_add_on != null) {
	$update .= " STORE_ADD_ON = ".$store_add_on.", ";
}

$store_seo						= $_POST['store_seo'];
if ($store_seo != null) {
	$update .= " STORE_SEO = ".$store_seo.", ";
}

$store_channel					= $_POST['store_channel'];
if ($store_channel != null) {
	$update .= " STORE_CHANNEL = ".$store_channel.", ";
}

$member_info_member_list		= $_POST['member_info_member_list'];
if ($member_info_member_list != null) {
	$update .= " MEMBER_INFO_MEMBER_LIST = ".$member_info_member_list.", ";
}

$member_info_member_sleep		= $_POST['member_info_member_sleep'];
if ($member_info_member_sleep != null) {
	$update .= " MEMBER_INFO_MEMBER_SLEEP = ".$member_info_member_sleep.", ";
}

$member_info_member_drop		= $_POST['member_info_member_drop'];
if ($member_info_member_drop != null) {
	$update .= " MEMBER_INFO_MEMBER_DROP = ".$member_info_member_drop.", ";
}

$member_info_member_order		= $_POST['member_info_member_order'];
if ($member_info_member_order != null) {
	$update .= " MEMBER_INFO_MEMBER_ORDER = ".$member_info_member_order.", ";
}

$member_info_member_price		= $_POST['member_info_member_price'];
if ($member_info_member_price != null) {
	$update .= " MEMBER_INFO_MEMBER_PRICE = ".$member_info_member_price.", ";
}

$member_info_member_level		= $_POST['member_info_member_level'];
if ($member_info_member_level != null) {
	$update .= " MEMBER_INFO_MEMBER_LEVEL = ".$member_info_member_level.", ";
}

$member_visit_member_login		= $_POST['member_visit_member_login'];
if ($member_visit_member_login != null) {
	$update .= " MEMBER_VISIT_MEMBER_LOGIN = ".$member_visit_member_login.", ";
}

$member_visit_member_suspicious	= $_POST['member_visit_member_suspicious'];
if ($member_visit_member_suspicious != null) {
	$update .= " MEMBER_VISIT_MEMBER_SUSPICIOUS = ".$member_visit_member_suspicious.", ";
}

$member_visit_member_offline	= $_POST['member_visit_member_offline'];
if ($member_visit_member_offline != null) {
	$update .= " MEMBER_VISIT_MEMBER_OFFLINE = ".$member_visit_member_offline.", ";
}

$member_reserve					= $_POST['member_reserve'];
if ($member_reserve != null) {
	$update .= " MEMBER_RESERVE = ".$member_reserve.", ";
}

$member_coupon					= $_POST['member_coupon'];
if ($member_coupon != null) {
	$update .= " MEMBER_COUPON = ".$member_coupon.", ";
}

$member_sms						= $_POST['member_sms'];
if ($member_sms != null) {
	$update .= " MEMBER_SMS = ".$member_sms.", ";
}

$member_mail					= $_POST['member_mail'];
if ($member_mail != null) {
	$update .= " MEMBER_MAIL = ".$member_mail.", ";
}

$member_kakao					= $_POST['member_kakao'];
if ($member_kakao != null) {
	$update .= " MEMBER_KAKAO = ".$member_kakao.", ";
}

$product_classify				= $_POST['product_classify'];
if ($product_classify != null) {
	$update .= " PRODUCT_CLASSIFY = ".$product_classify.", ";
}

$product_register				= $_POST['product_register'];
if ($product_register != null) {
	$update .= " PRODUCT_REGISTER = ".$product_register.", ";
}

$product_set					= $_POST['product_set'];
if ($product_set != null) {
	$update .= " PRODUCT_SET = ".$product_set.", ";
}

$product_excel_regist			= $_POST['product_excel_regist'];
if ($product_excel_regist != null) {
	$update .= " PRODUCT_EXCEL_REGIST = ".$product_excel_regist.", ";
}

$product_excel_update			= $_POST['product_excel_update'];
if ($product_excel_update != null) {
	$update .= " PRODUCT_EXCEL_UPDATE = ".$product_excel_update.", ";
}

$product_list					= $_POST['product_list'];
if ($product_list != null) {
	$update .= " PRODUCT_LIST = ".$product_list.", ";
}

$product_update					= $_POST['product_update'];
if ($product_update != null) {
	$update .= " PRODUCT_UPDATE = ".$product_update.", ";
}

$product_delete_delete_product	= $_POST['product_delete_delete_product'];
if ($product_delete_delete_product != null) {
	$update .= " PRODUCT_DELETE_DELETE_PRODUCT = ".$product_delete_delete_product.", ";
}

$product_delete_personal_order	= $_POST['product_delete_personal_order'];
if ($product_delete_personal_order != null) {
	$update .= " PRODUCT_DELETE_PERSONAL_ORDER = ".$product_delete_personal_order.", ";
}

$product_stock_register			= $_POST['product_stock_register'];
if ($product_stock_register != null) {
	$update .= " PRODUCT_STOCK_REGISTER = ".$product_stock_register.", ";
}

$product_stock_list				= $_POST['product_stock_list'];
if ($product_stock_list != null) {
	$update .= " PRODUCT_STOCK_LIST = ".$product_stock_list.", ";
}

$product_stock_sold_out			= $_POST['product_stock_sold_out'];
if ($product_stock_sold_out != null) {
	$update .= " PRODUCT_STOCK_SOLD_OUT = ".$product_stock_sold_out.", ";
}

$product_bluemark				= $_POST['product_bluemark'];
if ($product_bluemark != null) {
	$update .= " PRODUCT_BLUEMARK = ".$product_bluemark.", ";
}

$product_recommend				= $_POST['product_recommend'];
if ($product_recommend != null) {
	$update .= " PRODUCT_RECOMMEND = ".$product_recommend.", ";
}

$display_product				= $_POST['display_product'];
if ($display_product != null) {
	$update .= " DISPLAY_PRODUCT = ".$display_product.", ";
}

$display_board_inquiry			= $_POST['display_board_inquiry'];
if ($display_board_inquiry != null) {
	$update .= " DISPLAY_BOARD_INQUIRY = ".$display_board_inquiry.", ";
}

$display_board_review			= $_POST['display_board_review'];
if ($display_board_review != null) {
	$update .= " DISPLAY_BOARD_REVIEW = ".$display_board_review.", ";
}

$display_board_notice			= $_POST['display_board_notice'];
if ($display_board_notice != null) {
	$update .= " DISPLAY_BOARD_NOTICE = ".$display_board_notice.", ";
}

$display_board_faq				= $_POST['display_board_faq'];
if ($display_board_faq != null) {
	$update .= " DISPLAY_BOARD_FAQ = ".$display_board_faq.", ";
}

$display_posting_collection		= $_POST['display_posting_collection'];
if ($display_posting_collection != null) {
	$update .= " DISPLAY_POSTING_COLLECTION = ".$display_posting_collection.", ";
}

$display_posting_editorial		= $_POST['display_posting_editorial'];
if ($display_posting_editorial != null) {
	$update .= " DISPLAY_POSTING_EDITORIAL = ".$display_posting_editorial.", ";
}

$display_posting_collaboration	= $_POST['display_posting_collaboration'];
if ($display_posting_collaboration != null) {
	$update .= " DISPLAY_POSTING_COLLABORATION = ".$display_posting_collaboration.", ";
}

$display_posting_exhibition	= $_POST['display_posting_exhibition'];
if ($display_posting_exhibition != null) {
	$update .= " DISPLAY_POSTING_EXHIBITION = ".$display_posting_exhibition.", ";
}

$display_whats		= $_POST['display_whats'];
if ($display_whats != null) {
	$update .= " DISPLAY_WHATS = ".$display_whats.", ";
}

$display_popup		= $_POST['display_popup'];
if ($display_popup != null) {
	$update .= " DISPLAY_POPUP = ".$display_popup.", ";
}

$display_event		= $_POST['display_event'];
if ($display_event != null) {
	$update .= " DISPLAY_EVENT = ".$display_event.", ";
}

$display_draw		= $_POST['display_draw'];
if ($display_draw != null) {
	$update .= " DISPLAY_DRAW = ".$display_draw.", ";
}

$display_menu					= $_POST['display_menu'];
if ($display_menu != null) {
	$update .= " DISPLAY_MENU = ".$display_menu.", ";
}

$display_store		= $_POST['display_store'];
if ($display_store != null) {
	$update .= " DISPLAY_STORE = ".$display_store.", ";
}

$display_landing	= $_POST['display_landing'];
if ($display_landing != null) {
	$update .= " DISPLAY_LANDING = ".$display_landing.", ";
}

$order_list			= $_POST['order_list'];
if ($order_list != null) {
	$update .= " ORDER_LIST = ".$order_list.", ";
}

$order_management	= $_POST['order_management'];
if ($order_management != null) {
	$update .= " ORDER_MANAGEMENT = ".$order_management.", ";
}

$order_deposit		= $_POST['order_deposit'];
if ($order_deposit != null) {
	$update .= " ORDER_DEPOSIT = ".$order_deposit.", ";
}

$order_deliver		= $_POST['order_deliver'];
if ($order_deliver != null) {
	$update .= " ORDER_DELIVER = ".$order_deliver.", ";
}

$order_receipt		= $_POST['order_receipt'];
if ($order_receipt != null) {
	$update .= " ORDER_RECEIPT = ".$order_receipt.", ";
}

$order_admin		= $_POST['order_admin'];
if ($order_admin != null) {
	$update .= " ORDER_ADMIN = ".$order_admin.", ";
}

$analysis_excel		= $_POST['analysis_excel'];
if ($analysis_excel != null) {
	$update .= " ANALYSIS_EXCEL = ".$analysis_excel.", ";
}

$analysis_dashboard	= $_POST['analysis_dashboard'];
if ($analysis_dashboard != null) {
	$update .= " ANALYSIS_DASHBOARD = ".$analysis_dashboard.", ";
}

$set = array();
$set['ID'] = $id;
$set['NAME'] = $name;

if($pwchg != null) {
	$set['PW'] = md5($pwchg);
}

if($permit != 0){
	$set['PERMITION_NO'] = $permit;
}

$set['NICK']	= $nick;
$set['EMAIL']	= $email;
$set['TEL']		= $tel;
$set['FAX']		= $fax;
$set['MOBILE']	= $mobile;

// 프로필 이미지 업로드
if($_FILES['profile_img']['size'] > 0) {
	$path = "/var/www/admin/www/images/profile/admin/";
	
	$update_sql = "UPDATE dev.ADMIN_PROFILE_IMG SET DEL_FLG = TRUE WHERE ADMIN_IDX = ".$idx;
	$db->query($update_sql);
	
	$file_name_arr = explode('.',$_FILES['profile_img']['name']);
	$ext = $file_name_arr[1];
	
	$_FILES['profile_img']['name'] = "img_admin_profile_".$idx.".".$ext;
	$upload_file = file_up('profile_img',$path); // 이미지 업로드
	
	for ($i=0; $i<count($upload_file); $i++) {
		$img_sql = "INSERT INTO
					dev.ADMIN_PROFILE_IMG
				(
					ADMIN_IDX,
					ADMIN_ID,
					IMG_SIZE,
					IMG_LOCATION,
					IMG_URL,
					CREATER,
					UPDATER
				) VALUES (
					".$idx.",
					'Admin',
					'".$upload_file[$i]['img_size']."',
					'".$path.$upload_file[$i]['filename']."',
					'".$path.$upload_file[$i]['filename']."',
					'Admin',
					'Admin'
				)";
		$db->query($img_sql);
	}
}

$where = " IDX=? ";
if ($current_pw != null) {
	$where .= " AND PW=MD5('".$current_pw."') ";
}

$overlap_id_cnt = $db->count('dev.ADMINISTRATOR',"ID=? AND IDX != ".$idx." ",array($id));
$pw_check_cnt = $db->count('dev.ADMINISTRATOR',"IDX=? AND PW=MD5('".$current_pw."') ",array($idx));

if($overlap_id_cnt > 0){
	$result = false;
	$code = 777;
	$msg = "이미 동일한 아이디가 있습니다.";
}

if($pw_check_cnt == 0){
	$result = false;
	$code = 778;	
	$msg = "현재 비밀번호와 일치하지 않습니다.";
}

if($overlap_id_cnt == 0 && $pw_check_cnt > 0){
	if(!$db->update('dev.ADMINISTRATOR',$set,$where,array($idx))) {
		$code = 500;
	}
	
	$permition_sql="UPDATE
						dev.ADMIN_PERMITION
					SET
						".$update."
						UPDATE_DATE = NOW(),
						UPDATER = 'Admin'
					WHERE
						ADMIN_IDX = ".$idx;
	
	$db->query($permition_sql);
}
?>