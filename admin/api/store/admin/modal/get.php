<?php
/*
 +=============================================================================
 | 
 | 관리자 : 관리자계정 리스트
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$idx = $_REQUEST['idx'];

if($idx != null) {
    $sql = "SELECT 
                ADMIN.IDX,
				ADMIN.PERMITION_NO,
				ADMIN.ID,
				ADMIN.NAME,
				ADMIN.NICK,
				ADMIN.EMAIL,
				ADMIN.TEL,
				ADMIN.FAX,
				ADMIN.MOBILE,
				ADMIN.ZIPCODE,
				ADMIN.ADDRESS,
				ADMIN.ADDRESS_EXT,
				
				(
					SELECT 
						IMG_LOCATION
					FROM
						dev.ADMIN_PROFILE_IMG
					WHERE
						DEL_FLG = FALSE AND
						IMG_SIZE = 'org' AND
						ADMIN_IDX = ".$idx."
				) AS IMG_LOCATION,
				
				PERMITION.STORE_INFO_KR,
				PERMITION.STORE_INFO_EN,
				PERMITION.STORE_INFO_CN,
				PERMITION.STORE_ADMIN,
				PERMITION.STORE_NOTICE,
				PERMITION.STORE_ADD_ON,
				PERMITION.STORE_SEO,
				PERMITION.STORE_CHANNEL,

				PERMITION.MEMBER_INFO_MEMBER_LIST,
				PERMITION.MEMBER_INFO_MEMBER_SLEEP,
				PERMITION.MEMBER_INFO_MEMBER_DROP,
				PERMITION.MEMBER_INFO_MEMBER_ORDER,
				PERMITION.MEMBER_INFO_MEMBER_PRICE,
				PERMITION.MEMBER_INFO_MEMBER_LEVEL,
				PERMITION.MEMBER_VISIT_MEMBER_LOGIN,
				PERMITION.MEMBER_VISIT_MEMBER_SUSPICIOUS,
				PERMITION.MEMBER_VISIT_MEMBER_OFFLINE,
				PERMITION.MEMBER_RESERVE,
				PERMITION.MEMBER_COUPON,
				PERMITION.MEMBER_SMS,
				PERMITION.MEMBER_MAIL,
				PERMITION.MEMBER_KAKAO,

				PERMITION.PRODUCT_CLASSIFY,
				PERMITION.PRODUCT_REGISTER,
				PERMITION.PRODUCT_SET,
				PERMITION.PRODUCT_EXCEL_REGIST,
				PERMITION.PRODUCT_EXCEL_UPDATE,
				PERMITION.PRODUCT_LIST,
				PERMITION.PRODUCT_UPDATE,
				PERMITION.PRODUCT_DELETE_DELETE_PRODUCT,
				PERMITION.PRODUCT_DELETE_PERSONAL_ORDER,
				PERMITION.PRODUCT_STOCK_REGISTER,
				PERMITION.PRODUCT_STOCK_LIST,
				PERMITION.PRODUCT_STOCK_SOLD_OUT,
				PERMITION.PRODUCT_BLUEMARK,
				PERMITION.PRODUCT_RECOMMEND,

				PERMITION.DISPLAY_PRODUCT,
				PERMITION.DISPLAY_BOARD_INQUIRY,
				PERMITION.DISPLAY_BOARD_REVIEW,
				PERMITION.DISPLAY_BOARD_NOTICE,
				PERMITION.DISPLAY_BOARD_FAQ,
				PERMITION.DISPLAY_POSTING_COLLECTION,
				PERMITION.DISPLAY_POSTING_EDITORIAL,
				PERMITION.DISPLAY_POSTING_COLLABORATION,
				PERMITION.DISPLAY_POSTING_EXHIBITION,
				PERMITION.DISPLAY_WHATS,
				PERMITION.DISPLAY_POPUP,
				PERMITION.DISPLAY_EVENT,
				PERMITION.DISPLAY_DRAW,
				PERMITION.DISPLAY_MENU,
				PERMITION.DISPLAY_STORE,
				PERMITION.DISPLAY_LANDING,

				PERMITION.ORDER_LIST,
				PERMITION.ORDER_MANAGEMENT,
				PERMITION.ORDER_DEPOSIT,
				PERMITION.ORDER_DELIVER,
				PERMITION.ORDER_RECEIPT,
				PERMITION.ORDER_ADMIN,

				PERMITION.ANALYSIS_EXCEL,
				PERMITION.ANALYSIS_DASHBOARD
            FROM
				dev.ADMINISTRATOR ADMIN
				LEFT JOIN dev.ADMIN_PERMITION PERMITION ON
				ADMIN.IDX = PERMITION.ADMIN_IDX
            WHERE
               ADMIN.IDX = ".$idx;
    
	$db->query($sql);
    foreach($db->fetch() as $data) {
        $json_result['data'][] = array(
            'idx'								=> $data['IDX'],
            'permit'							=> $data['PERMITION_NO'],
            'id'								=> $data['ID'],
            'name'								=> $data['NAME'],
            'nick'								=> $data['NICK'],
            'email'								=> $data['EMAIL'],
            'tel'								=> $data['TEL'],
            'fax'								=> $data['FAX'],
            'mobile'							=> $data['MOBILE'],
            'zipcode'							=> $data['ZIPCODE'],
            'address'							=> $data['ADDRESS'],
            'address_ext'						=> $data['ADDRESS_EXT'],
			'img_location'						=> $data['IMG_LOCATION'],
						
			'store_info_kr'						=>$data['STORE_INFO_KR'],
			'store_info_en'						=>$data['STORE_INFO_EN'],
			'store_info_cn'						=>$data['STORE_INFO_CN'],
			'store_admin'						=>$data['STORE_ADMIN'],
			'store_notice'						=>$data['STORE_NOTICE'],
			'store_add_on'						=>$data['STORE_ADD_ON'],
			'store_seo'							=>$data['STORE_SEO'],
			'store_channel'						=>$data['STORE_CHANNEL'],

			'member_info_member_list'			=>$data['MEMBER_INFO_MEMBER_LIST'],
			'member_info_member_sleep'			=>$data['MEMBER_INFO_MEMBER_SLEEP'],
			'member_info_member_drop'			=>$data['MEMBER_INFO_MEMBER_DROP'],
			'member_info_member_order'			=>$data['MEMBER_INFO_MEMBER_ORDER'],
			'member_info_member_price'			=>$data['MEMBER_INFO_MEMBER_PRICE'],
			'member_info_member_level'			=>$data['MEMBER_INFO_MEMBER_LEVEL'],
			'member_visit_member_login'			=>$data['MEMBER_VISIT_MEMBER_LOGIN'],
			'member_visit_member_suspicious'	=>$data['MEMBER_VISIT_MEMBER_SUSPICIOUS'],
			'member_visit_member_offline'		=>$data['MEMBER_VISIT_MEMBER_OFFLINE'],
			'member_reserve'					=>$data['MEMBER_RESERVE'],
			'member_coupon'						=>$data['MEMBER_COUPON'],
			'member_sms'						=>$data['MEMBER_SMS'],
			'member_mail'						=>$data['MEMBER_MAIL'],
			'member_kakao'						=>$data['MEMBER_KAKAO'],

			'product_classify'					=>$data['PRODUCT_CLASSIFY'],
			'product_register'					=>$data['PRODUCT_REGISTER'],
			'product_set'						=>$data['PRODUCT_SET'],
			'product_excel_regist'				=>$data['PRODUCT_EXCEL_REGIST'],
			'product_excel_update'				=>$data['PRODUCT_EXCEL_UPDATE'],
			'product_list'						=>$data['PRODUCT_LIST'],
			'product_update'					=>$data['PRODUCT_UPDATE'],
			'product_delete_delete_product'		=>$data['PRODUCT_DELETE_DELETE_PRODUCT'],
			'product_delete_personal_order'		=>$data['PRODUCT_DELETE_PERSONAL_ORDER'],
			'product_stock_register'			=>$data['PRODUCT_STOCK_REGISTER'],
			'product_stock_list'				=>$data['PRODUCT_STOCK_LIST'],
			'product_stock_sold_out'			=>$data['PRODUCT_STOCK_SOLD_OUT'],
			'product_bluemark'					=>$data['PRODUCT_BLUEMARK'],
			'product_recommend'					=>$data['PRODUCT_RECOMMEND'],
						
			'display_product'					=>$data['DISPLAY_PRODUCT'],
			'display_board_inquiry'				=>$data['DISPLAY_BOARD_INQUIRY'],
			'display_board_review'				=>$data['DISPLAY_BOARD_REVIEW'],
			'display_board_notice'				=>$data['DISPLAY_BOARD_NOTICE'],
			'display_board_faq'					=>$data['DISPLAY_BOARD_FAQ'],
			'display_posting_collection'		=>$data['DISPLAY_POSTING_COLLECTION'],
			'display_posting_editorial'			=>$data['DISPLAY_POSTING_EDITORIAL'],
			'display_posting_collaboration'		=>$data['DISPLAY_POSTING_COLLABORATION'],
			'display_posting_exhibition'		=>$data['DISPLAY_POSTING_EXHIBITION'],
			'display_whats'						=>$data['DISPLAY_WHATS'],
			'display_popup'						=>$data['DISPLAY_POPUP'],
			'display_event'						=>$data['DISPLAY_EVENT'],
			'display_draw'						=>$data['DISPLAY_DRAW'],
			'display_menu'						=>$data['DISPLAY_MENU'],
			'display_store'						=>$data['DISPLAY_STORE'],
			'display_landing'					=>$data['DISPLAY_LANDING'],
						
			'order_list'						=>$data['ORDER_LIST'],
			'order_management'					=>$data['ORDER_MANAGEMENT'],
			'order_deposit'						=>$data['ORDER_DEPOSIT'],
			'order_deliver'						=>$data['ORDER_DELIVER'],
			'order_receipt'						=>$data['ORDER_RECEIPT'],
			'order_admin'						=>$data['ORDER_ADMIN'],
			
			'analysis_excel'					=>$data['ANALYSIS_EXCEL'],
			'analysis_dashboard'				=>$data['ANALYSIS_DASHBOARD']

        );
    }
}
?>