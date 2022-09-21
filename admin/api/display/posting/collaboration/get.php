<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.22
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$page_idx               = $_POST['page_idx'];
$tmp_flg				= $_POST['tmp_flg'];

$tbl_posting = array();
if ($tmp_flg == "true") {
	$tbl_posting[0] = "dev.TMP_DISPLAY_POSTING_COLLABORATION";
	$tbl_posting[1] = "dev.TMP_POSTING_IMG_COLLABORATION";
} else {
	$tbl_posting[0] = "dev.DISPLAY_POSTING_COLLABORATION";
	$tbl_posting[1] = "dev.POSTING_IMG_COLLABORATION";
}

if($page_idx != null){
	$posting_sql= "SELECT
					IDX								AS IDX,
					PAGE_IDX						AS PAGE_IDX,
					
					COLLABORATION_DATE				AS COLLABORATION_DATE,
					COLLABORATION_TITLE				AS COLLABORATION_TITLE,
					COLLABORATION_DESCRIPTION		AS COLLABORATION_DESCRIPTION,
					COLLABORATION_SCRIPT			AS COLLABORATION_SCRIPT,
					COLLABORATION_VIDEO_URL			AS COLLABORATION_VIDEO_URL,
					
					BTN_PRODUCT_TOP_DISPLAY_FLG		AS BTN_PRODUCT_TOP_DISPLAY_FLG,
					IFNULL(
						BTN_PRODUCT_TOP_TEXT,'더 많은 제품 보러가기'
					)								AS BTN_PRODUCT_TOP_TEXT,
					IFNULL(BTN_PRODUCT_TOP_URL,'')	AS BTN_PRODUCT_TOP_URL,
					
					BTN_PRODUCT_BOT_DISPLAY_FLG		AS BTN_PRODUCT_BOT_DISPLAY_FLG,
					IFNULL(
						BTN_PRODUCT_BOT_TEXT,'더 많은 제품 보러가기'
					)								AS BTN_PRODUCT_BOT_TEXT,
					IFNULL(BTN_PRODUCT_BOT_URL,'')	AS BTN_PRODUCT_BOT_URL,
					
					BTN_VIDEO_DISPLAY_FLG			AS BTN_VIDEO_DISPLAY_FLG,
					IFNULL(BTN_VIDEO_TEXT,'캠페인 영상 보기')		AS BTN_VIDEO_TEXT,
					
					BTN_IMG_DISPLAY_FLG				AS BTN_IMG_DISPLAY_FLG,
					IFNULL(
						BTN_IMG_TEXT,'캠페인 이미지 전체 보기'
					)								AS BTN_IMG_TEXT,
					IFNULL(BTN_IMG_URL,'')			AS BTN_IMG_URL,
					
					IFNULL(COLLABORATION_IMG_SCRIPT,'')	AS COLLABORATION_IMG_SCRIPT,
					
					COLLABORATION_PRODUCT			AS COLLABORATION_PRODUCT
				FROM
					".$tbl_posting[0]."
				WHERE
					PAGE_IDX = ".$page_idx." AND
					DEL_FLG = FALSE";
	
	$db->query($posting_sql);
	foreach($db->fetch() as $posting_data) {
		$collaboration_idx = $posting_data['IDX'];
		
		if ($collaboration_idx > 0) {
			$img_sql = "SELECT
							IDX,
							IMG_SIZE,
							IMG_TYPE,
							IMG_LOCATION,
							IMG_URL
						FROM
							".$tbl_posting[1]."
						WHERE
							PAGE_IDX = ".$page_idx."
							AND COLLABORATION_IDX = ".$collaboration_idx."
							AND DEL_FLG = FALSE";
			$db->query($img_sql);
			
			$img_result = array();
			foreach($db->fetch() as $img_data) {
				$img_result['data'][] = array(
					'img_idx'			=>intval($img_data['IDX']),
					'img_size'			=>$img_data['IMG_SIZE'],
					'img_type'			=>$img_data['IMG_TYPE'],
					'img_location'		=>$img_data['IMG_LOCATION'],
					'img_url'			=>$img_data['IMG_URL']
				);
			}
			
			$product_result = array();
			$collaboration_product = $posting_data['COLLABORATION_PRODUCT'];
			if ($collaboration_product != null) {
				$product_sql = "SELECT
									PRODUCT.IDX,
									REPLACE(IMG_LOCATION,'/var/www/admin/www','') AS IMG_LOCATION
								FROM
									dev.SHOP_PRODUCT PRODUCT
									LEFT JOIN dev.PRODUCT_IMG IMG ON
									PRODUCT.IDX = IMG.PRODUCT_IDX
								WHERE
									IMG.DEL_FLG = FALSE AND
									IMG.IMG_TYPE = 'product' AND
									IMG.IMG_SIZE = 'mdl' AND
									PRODUCT.IDX IN (".$collaboration_product.")";
				$db->query($product_sql);
				
				foreach($db->fetch() as $product_data) {
					$product_result['data'][] = array(
						'product_idx'			=>intval($product_data['IDX']),
						'product_img_location'	=>$product_data['IMG_LOCATION'],
					);
				}
			}
		}
		
		$json_result['data'][] = array(
			'idx'							=>intval($posting_data['IDX']),
			'page_idx'						=>$posting_data['PAGE_IDX'],
			'collaboration_date'			=>$posting_data['COLLABORATION_DATE'],
			'collaboration_title'			=>$posting_data['COLLABORATION_TITLE'],
			'collaboration_description'		=>$posting_data['COLLABORATION_DESCRIPTION'],
			
			'collaboration_script'			=>$posting_data['COLLABORATION_SCRIPT'],
			
			'collaboration_video_url'		=>$posting_data['COLLABORATION_VIDEO_URL'],
			
			'btn_product_top_display_flg'	=>$posting_data['BTN_PRODUCT_TOP_DISPLAY_FLG'],
			'btn_product_top_text'			=>$posting_data['BTN_PRODUCT_TOP_TEXT'],
			'btn_product_top_url'			=>$posting_data['BTN_PRODUCT_TOP_URL'],
			
			'btn_product_bot_display_flg'	=>$posting_data['BTN_PRODUCT_BOT_DISPLAY_FLG'],
			'btn_product_bot_text'			=>$posting_data['BTN_PRODUCT_BOT_TEXT'],
			'btn_product_bot_url'			=>$posting_data['BTN_PRODUCT_BOT_URL'],
			
			'btn_video_display_flg'			=>$posting_data['BTN_VIDEO_DISPLAY_FLG'],
			'btn_video_text'				=>$posting_data['BTN_VIDEO_TEXT'],
			
			'btn_img_display_flg'			=>$posting_data['BTN_IMG_DISPLAY_FLG'],
			'btn_img_text'					=>$posting_data['BTN_IMG_TEXT'],
			'btn_img_url'					=>$posting_data['BTN_IMG_URL'],
			
			'collaboration_img_script'		=>$posting_data['COLLABORATION_IMG_SCRIPT'],
			
			'collaboration_product'			=>$posting_data['COLLABORATION_PRODUCT'],
			
			'img_result'					=>$img_result,
			'product_result'				=>$product_result
		);
	}
}
?>