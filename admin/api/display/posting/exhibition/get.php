<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.03
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
	$tbl_posting[0] = "dev.TMP_DISPLAY_POSTING_EXHIBITION";
	$tbl_posting[1] = "dev.TMP_POSTING_IMG_EXHIBITION";
} else {
	$tbl_posting[0] = "dev.DISPLAY_POSTING_EXHIBITION";
	$tbl_posting[1] = "dev.POSTING_IMG_EXHIBITION";
}

if($page_idx != null){
	$posting_sql= "SELECT
					IDX							AS IDX,
					PAGE_IDX					AS PAGE_IDX,
					
					EXHIBITION_DATE				AS EXHIBITION_DATE,
					EXHIBITION_TITLE			AS EXHIBITION_TITLE,
					EXHIBITION_DESCRIPTION		AS EXHIBITION_DESCRIPTION,
					EXHIBITION_SCRIPT			AS EXHIBITION_SCRIPT,
					
					BTN_PRODUCT_TOP_DISPLAY_FLG	AS BTN_PRODUCT_TOP_DISPLAY_FLG,
					BTN_PRODUCT_TOP_TEXT		AS BTN_PRODUCT_TOP_TEXT,
					BTN_PRODUCT_TOP_URL			AS BTN_PRODUCT_TOP_URL,
					
					BTN_PRODUCT_BOT_DISPLAY_FLG	AS BTN_PRODUCT_BOT_DISPLAY_FLG,
					BTN_PRODUCT_BOT_TEXT		AS BTN_PRODUCT_BOT_TEXT,
					BTN_PRODUCT_BOT_URL			AS BTN_PRODUCT_BOT_URL
				FROM
					".$tbl_grid[0]."
				WHERE
					PAGE_IDX = ".$page_idx." AND
					DEL_FLG = FALSE";
	
	$db->query($posting_sql);
	foreach($db->fetch() as $posting_data) {
		$exhibition_idx = $posting_data['IDX'];
		
		if ($exhibition_idx > 0) {
			$img_sql = "SELECT
							IDX,
							IMG_TYPE,
							IMG_LOCATION,
							IMG_URL
						FROM
							".$tbl_grid[1]."
						WHERE
							PAGE_IDX = ".$page_idx."
							AND EXHIBITION_IDX = ".$exhibition_idx."
							AND DEL_FLG = FALSE";
			$db->query($img_sql);
			
			$img_result = array();
			foreach($db->fetch() as $img_data) {
				$img_result['data'][] = array(
					'img_idx'			=>intval($img_data['IDX']),
					'img_type'			=>$img_data['IMG_TYPE'],
					'img_location'		=>$img_data['IMG_LOCATION'],
					'img_url'			=>$img_data['IMG_URL']
				);
			}
		}
		
		$json_result['data'][] = array(
			'idx'							=>intval($posting_data['IDX']),
			'page_idx'						=>$posting_data['PRODUCT_IDX'],
			
			'exhibition_date'				=>$posting_data['EXHIBITION_DATE'],
			'exhibition_title'				=>$posting_data['EXHIBITION_TITLE'],
			'exhibition_description'		=>$posting_data['EXHIBITION_DESCRIPTION'],
			'exhibition_script'				=>$posting_data['EXHIBITION_SCRIPT'],
			
			'btn_product_top_display_flg'	=>$posting_data['BTN_PRODUCT_TOP_DISPLAY_FLG'],
			'btn_product_top_text'			=>$posting_data['BTN_PRODUCT_TOP_'],
			'btn_product_top_url'			=>$posting_data['BTN_PRODUCT_TOP_'],
			
			'btn_product_bot_display_flg'	=>$posting_data['BTN_PRODUCT_BOT_'],
			'btn_product_bot_text'			=>$posting_data['BTN_PRODUCT_BOT_'],
			'btn_product_bot_url'			=>$posting_data['BTN_PRODUCT_BOT_']
			
			'img_result'					=>$img_result
		);
	}
}
?>