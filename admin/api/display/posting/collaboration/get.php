<?php
/*
 +=============================================================================
 | 
 | 콜라보레이션 관리 페이지 - 콜라보레이션 정보 개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$admin_idx = 0;
if (isset($_SESSION['ADMIN_IDX'])) {
	$admin_idx = $_SESSION['ADMIN_IDX'];
}

$collaboration_idx		= $_POST['collaboration_idx'];

if ($collaboration_idx != null) {
	$select_collaboration_sql = "
		SELECT
			PC.IDX					AS COLLABORATION_IDX,
			PP.COUNTRY				AS COUNTRY,
			PC.POSTING_STATUS		AS POSTING_STATUS,
			PP.PAGE_TITLE			AS PAGE_TITLE,
			DATE_FORMAT(
				PP.DISPLAY_START_DATE,
				'%Y-%m-%d'
			)						AS DISPLAY_START_DATE,
			DATE_FORMAT(
				PP.DISPLAY_END_DATE,
				'%Y-%m-%d'
			)						AS DISPLAY_END_DATE,
			PC.DISPLAY_NUM			AS DISPLAY_NUM,
			
			PC.PRODUCT_LIST_FLG		AS PRODUCT_LIST_FLG,
			PC.PRODUCT_LINK_FLG		AS PRODUCT_LINK_FLG
		FROM
			POSTING_COLLABORATION PC
			LEFT JOIN PAGE_POSTING PP ON
			PC.PAGE_IDX = PP.IDX
		WHERE
			PC.IDX = ".$collaboration_idx." AND
			PC.DEL_FLG = FALSE
	";
	
	$db->query($select_collaboration_sql);
	
	$column_info = array();
	$product_info = array();
	foreach($db->fetch() as $collaboration_data) {
		$country = $collaboration_data['COUNTRY'];
		$collaboration_idx = $collaboration_data['COLLABORATION_IDX'];
		
		$select_column_sql = "
			SELECT
				CC.IDX				AS COLUMN_IDX,
				CC.PHS_COLUMN_NAME	AS PHS_COLUMN_NAME,
				CC.LGC_COLUMN_NAME	AS LGC_COLUMN_NAME,
				CC.COLUMN_VALUE		AS COLUMN_VALUE
			FROM
				COLLABORATION_COLUMN CC
			WHERE
				CC.COLLABORATION_IDX = ".$collaboration_idx."
		";
		
		$db->query($select_column_sql);
		
		foreach($db->fetch() as $column_data) {
			$column_info[] = array(
				'column_idx'		=>$column_data['COLUMN_IDX'],
				'phs_column_name'	=>$column_data['PHS_COLUMN_NAME'],
				'lgc_column_name'	=>$column_data['LGC_COLUMN_NAME'],
				'column_value'		=>$column_data['COLUMN_VALUE']
			);
		}
		
		$select_product_sql = "
			SELECT
				CP.IDX						AS COLLABO_PRODUCT_IDX,
				CP.DISPLAY_NUM				AS DISPLAY_NUM,
				PR.PRODUCT_CODE				AS PRODUCT_CODE,
				PR.PRODUCT_NAME				AS PRODUCT_NAME,
				PR.SALES_PRICE_".$country."	AS SALES_PRICE,
				OM.COLOR					AS COLOR,
				OM.COLOR_RGB				AS COLOR_RGB,
				IFNULL(
					PR.MATERIAL_".$country.",
					'-'
				)							AS MATERIAL,
				(
					SELECT
						REPLACE(
							S_PI.IMG_LOCATION,
							'/var/www/admin/www',
							''
						)
					FROM
						PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = PR.IDX AND
						IMG_TYPE = 'P' AND
						IMG_SIZE = 'S'
					ORDER BY
						IDX ASC
					LIMIT
						0,1
				)							AS IMG_LOCATION,
				CP.DISPLAY_FLG				AS DISPLAY_FLG
			FROM
				COLLABORATION_PRODUCT CP
				LEFT JOIN SHOP_PRODUCT PR ON
				CP.PRODUCT_IDX = PR.IDX
				LEFT JOIN ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
			WHERE
				CP.COLLABORATION_IDX = ".$collaboration_idx."
			ORDER BY
				CP.DISPLAY_NUM ASC
		";
		
		$db->query($select_product_sql);
		
		foreach($db->fetch() as $product_data) {
			$product_info[] = array(
				'collabo_product_idx'	=>$product_data['COLLABO_PRODUCT_IDX'],
				'display_num'			=>$product_data['DISPLAY_NUM'],
				'product_code'			=>$product_data['PRODUCT_CODE'],
				'product_name'			=>$product_data['PRODUCT_NAME'],
				'sales_price'			=>number_format($product_data['SALES_PRICE']),
				'color'					=>$product_data['COLOR'],
				'color_rgb'				=>$product_data['COLOR_RGB'],
				'material'				=>$product_data['MATERIAL'],
				'img_location'			=>$product_data['IMG_LOCATION'],
				'display_flg'			=>$product_data['DISPLAY_FLG']
			);
		}
		
		$bookmark_flg = false;
		
		$bookmark_cnt = $db->count("COLLABORATION_BOOKMARK","COLLABORATION_IDX = ".$collaboration_idx);
		if ($bookmark_cnt > 0) {
			$bookmark_flg = true;
		}
		
		$json_result['data'][] = array(
			'collaboration_idx'		=>$collaboration_idx,
			'country'				=>$collaboration_data['COUNTRY'],
			'posting_status'		=>$collaboration_data['POSTING_STATUS'],
			'page_title'			=>$collaboration_data['PAGE_TITLE'],
			'display_start_date'	=>$collaboration_data['DISPLAY_START_DATE'],
			'display_end_date'		=>$collaboration_data['DISPLAY_END_DATE'],
			'display_num'			=>$collaboration_data['DISPLAY_NUM'],
			
			'product_list_flg'		=>$collaboration_data['PRODUC_LIST_FLG'],
			'product_link_flg'		=>$collaboration_data['PRODUC_LINK_FLG'],
			
			'bookmark_flg'			=>$bookmark_flg,
			
			'column_info'			=>$column_info,
			'product_info'			=>$product_info
		);
	}
}

?>