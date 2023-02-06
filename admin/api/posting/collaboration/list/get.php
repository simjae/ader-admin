<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 콜라보레이션 전시정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$page_idx	= $_POST['page_idx'];

$sql = "SELECT
			DC.IDX					AS COLLABORATION_IDX,	
			DC.POSTING_STATUS		AS POSTING_STATUS,
			PP.PAGE_TITLE			AS PAGE_TITLE,
			PP.DISPLAY_FLG			AS DISPLAY_FLG,
			PP.DISPLAY_START_DATE	AS DISPLAY_START_DATE,
			PP.DISPLAY_END_DATE		AS DISPLAY_END_DATE,
			DC.DISPLAY_NUM			AS DISPLAY_NUM,
			DC.BOOKMARK_FLG			AS BOOKMARK_FLG,
			DC.PRODUCT_LIST_FLG		AS PRODUCT_LIST_FLG,
			DC.PRODUCT_LINK_FLG		AS PRODUCT_LINK_FLG
		FROM
			dev.PAGE_POSTING PP
			LEFT JOIN dev.DISPLAY_COLLABORATION DC ON
			PP.IDX = DC.PAGE_IDX
		WHERE
			PP.PAGE_IDX = ".$page_idx;

$db->query($sql);
foreach($db->fetch() as $data) {
	$collaboration_idx = $data['COLLABORATION_IDX'];
	
	$column_info = array();
	$product_info = array();
	
	if (!empty($collaboration_idx)) {
		$column_sql = "
						SELECT
							CC.IDX						AS COLUMN_IDX,
							CC.COLUMN_NAME				AS COLUMN_NAME,
							CC.COLUMN_VALUE				AS COLUMN_VALUE
						FROM
							dev.COLLABORATION_COLUMN CC
						WHERE
							CC.COLLABORATION_IDX = ".$collaboration_idx."
						
		";
		foreach($db->fetch() as $column_data) {
			$column_info[] = array(
				'column_idx'		=>$column_data['COLUMN_IDX'],
				'column_name'		=>$column_data['COLUMN_NAME'],
				'column_value'		=>$column_data['COLUMN_VALUE']
			);
		}
		
		$product_sql = "
						SELECT
							CP.PRODUCT_IDX				AS PRODUCT_IDX,
							PR.PRODUCT_NAME				AS PRODUCT_NAME,
							PR.PRICE_".$country."		AS PRICE,
							PR.DISCOUNT_".$country."	AS DISCOUNT,
							PR.SALES_PRICE_".$country."	AS SALES_PRICE,
							OM.COLOR					AS COLOR,
							OM.RGB_CODE					AS RGB_CODE,
							OM.MATERIAL					AS MATERIAL,
							(
								SELECT
									S_PI.IMG_LOCATION
								FROM
									dev.PRODUCT_IMG S_PI
								WHERE
									S_PI.PRODUCT_IDX = CP.PRODUCT_IDX AND
									S_PI.IMG_TYPE = 'P' AND
									S_PI.IMG_SIZE = 'M'
								LIMIT
									0,1
							) AS IMG_LOCATION
							CONCAT(
								'/product/detail?product_idx=',CP.PRODUCT_IDX
							)							AS PRODUCT_LINK,
							(
								SELECT
									COUNT(S_PG.IDX)
								FROM
									dev.PRODUCT_GRID S_PG
								WHERE
									S_PG.PRODUCT_IDX = CP.PRODUCT_IDX
							)							AS DISPLAY_CNT
						FROM
							dev.COLLABORATION_PRODUCT CP
							LEFT JOIN dev.SHOP_PRODUCT PR ON
							CP.PRODUCT_IDX = PR.IDX
							LEFT JOIN dev.ORDERSHEET_MST OM ON
							PR.ORDERSHEET_IDX = OM.IDX
						WHERE
							CP.COLLABORATION_IDX = ".$collaboration_idx."
		";
		foreach($db->fetch() as $product_data) {
			$display_status = FALSE;
			$display_cnt = $product_data['DISPLAY_CNT'];
			if ($display_cnt > 0) {
				$display_status = TRUE;
			}
			
			$product_info[] = array(
				'product_idx'		=>$product_data['PRODUCT_IDX'],
				'product_name'		=>$product_data['PRODUCT_NAME'],
				'price'				=>$product_data['PRICE'],
				'discount'			=>$product_data['DISCOUNT'],
				'sales_price'		=>$product_data['SALES_PRICE'],
				'color'				=>$product_data['COLOR'],
				'rgb_color'			=>$product_data['RGB_COLOR'],
				'material'			=>$product_data['MATERIAL'],
				'img_location'		=>$product_data['IMG_LOCATION'],
				'display_status'	=>$display_status
			);
		}
	}
	
	$json_result['data'][] = array(
		'collaboration_idx'			=>$data['COLLABORATION_IDX'],
		'posting_status'			=>$data['POSTING_STATUS'],
		'page_title'				=>$data['PAGE_TITLE'],
		'display_flg'				=>$data['DISPLAY_FLG'],
		'display_start_date'		=>$data['DISPLAY_START_DATE'],
		'display_end_date'			=>$data['DISPLAY_END_DATE'],
		'display_num'				=>$data['DISPLAY_NUM'],
		'bookmark_flg'				=>$data['BOOKMARK_FLG'],
		'column_info'				=>$column_info,
		'product_list_flg'			=>$data['PRODUCT_LIST_FLG'],
		'product_link_flg'			=>$data['PRODUCT_LINK_FLG'],
		'product_info'				=>$product_info

		
		
	);
}
?>