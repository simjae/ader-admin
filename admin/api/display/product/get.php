<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 조회 API
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$page_idx		= $_POST['page_idx'];

if ($page_idx != null) {
	$select_page_product_sql = "
		SELECT
			PP.IDX						AS PAGE_IDX,
			PP.PAGE_TITLE				AS PAGE_TITLE,
			PP.PAGE_MEMO				AS PAGE_MEMO,
			PP.DISPLAY_MEMBER_LEVEL		AS DISPLAY_MEMBER_LEVEL,
			
			PP.DISPLAY_FLG				AS DISPLAY_FLG,
			DATE_FORMAT(
				PP.DISPLAY_START_DATE,
				'%Y-%m-%d'
			)							AS START_DATE,
			DATE_FORMAT(
				PP.DISPLAY_START_DATE,
				'%H'
			)							AS START_H,
			DATE_FORMAT(
				PP.DISPLAY_START_DATE,
				'%i'
			)							AS START_M,
			DATE_FORMAT(
				PP.DISPLAY_END_DATE,
				'%Y-%m-%d'
			)							AS END_DATE,
			DATE_FORMAT(
				PP.DISPLAY_END_DATE,
				'%H'
			)							AS END_H,
			DATE_FORMAT(
				PP.DISPLAY_END_DATE,
				'%i'
			)							AS END_M,
			
			PP.SEO_EXPOSURE_FLG			AS SEO_EXPOSURE_FLG,
			PP.SEO_TITLE				AS SEO_TITLE,
			PP.SEO_AUTHOR				AS SEO_AUTHOR,
			PP.SEO_DESCRIPTION			AS SEO_DESCRIPTION,
			PP.SEO_KEYWORDS				AS SEO_KEYWORDS,
			PP.SEO_ALT_TEXT				AS SEO_ALT_TEXT
		FROM
			PAGE_PRODUCT PP
		WHERE
			PP.IDX = ".$page_idx."
	";

	$db->query($select_page_product_sql);

	foreach($db->fetch() as $product_data) {
		$display_member_level = "";
		if ($product_data['DISPLAY_MEMBER_LEVEL'] != "ALL") {
			$display_member_level = explode(",",$product_data['DISPLAY_MEMBER_LEVEL']);
		} else {
			$display_member_level = "ALL";
		}
		
		$ip_list = array();
		if(isset($page_idx)){
			$ip_sql = "
				SELECT 	
					IP
				FROM
					IP_BAN
				WHERE
					PAGE_IDX = ".$page_idx;
			
			$db->query($ip_sql);
			
			foreach($db->fetch() as $ip_data) {
				array_push($ip_list, $ip_data['IP']);
			}
			
			$json_result['data']['ip'] = $ip_list;
		}
		
		$json_result['data'][] = array(
			'page_title'                	=>$product_data['PAGE_TITLE'],
			'page_memo'                 	=>$product_data['PAGE_MEMO'],
			'display_member_level'      	=>$display_member_level,
			
			'display_flg'               	=>$product_data['DISPLAY_FLG'],
			'start_date'        			=>$product_data['START_DATE'],
			'start_h'   	     			=>$product_data['START_H'],
			'start_m'       	 			=>$product_data['START_M'],
			'end_date'          			=>$product_data['END_DATE'],
			'end_h'     	     			=>$product_data['END_H'],
			'end_m'   		       			=>$product_data['END_M'],
			
			'seo_exposure_flg'				=>$product_data['SEO_EXPOSURE_FLG'],
			'seo_title'						=>$product_data['SEO_TITLE'],
			'seo_author'					=>$product_data['SEO_AUTHOR'],
			'seo_description'				=>$product_data['SEO_DESCRIPTION'],
			'seo_keywords'					=>$product_data['SEO_KEYWORDS'],
			'seo_alt_text'					=>$product_data['SEO_ALT_TEXT']
		);
	}
}

?>