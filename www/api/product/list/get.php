<?php
/*
 +=============================================================================
 | 
 | 상품 리스트 - 상품 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/www/api/common/common.php");

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$page_idx		= $_POST['page_idx'];
$country		= $_POST['country'];

if ($page_idx != null && $country != null) {
	$page_count = $db->count("dev.PAGE_PRODUCT","IDX = ".$page_idx." AND DISPLAY_FLG = TRUE");
	if ($page_count > 0) {
		$sql = "SELECT
					PG.DISPLAY_NUM				AS DISPLAY_NUM,
					PG.GRID_TYPE				AS GRID_TYPE,
					PG.GRID_CONTENT_URL			AS CONTENT_URL,
					PG.GRID_LINK_URL			AS LINK_URL,
					PG.GRID_SIZE				AS GRID_SIZE,
					PG.GRID_BACKGROUND_COLOR	AS BACKGROUND_COLOR,
					PG.PRODUCT_IDX				AS PRODUCT_IDX,
					PR.PRODUCT_NAME				AS PRODUCT_NAME,
					(
						SELECT
							REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
						FROM
							dev.PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = PR.IDX AND
							S_PI.IMG_TYPE = 'P' AND
							S_PI.IMG_SIZE = 'M'
						ORDER BY
							S_PI.IDX ASC
						LIMIT
							0,1
					)							AS PRODUCT_IMG,
					PR.PRICE_".$country."		AS PRICE,
					PR.DISCOUNT_".$country."	AS DISCOUNT,
					PR.SALES_PRICE_".$country."	AS SALES_PRICE,
					OM.COLOR					AS COLOR
				FROM
					dev.PRODUCT_GRID PG
					LEFT OUTER JOIN dev.SHOP_PRODUCT PR ON
					PG.PRODUCT_IDX = PR.IDX
					LEFT JOIN dev.ORDERSHEET_MST OM ON
					PR.ORDERSHEET_IDX = OM.IDX
				WHERE
					PG.PAGE_IDX = ".$page_idx."
				ORDER BY
					PG.DISPLAY_NUM";
		
		$db->query($sql);
		
		foreach($db->fetch() as $data) {
			$product_idx = $data['PRODUCT_IDX'];
			
			$whish_flg = false;
			if ($member_idx > 0) {
				$whish_count = $db->count("dev.WHISH_LIST","MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx);
				if ($whish_count > 0) {
					$whish_flg = true;
				}
			}
			
			$product_color = getProductColor($db,$product_idx);
			
			$product_size = getProductSize($db,$product_idx);
			
			$json_result['data'][] = array(
				'display_num'		=>$data['DISPLAY_NUM'],
				'grid_type'			=>$data['GRID_TYPE'],
				'content_url'		=>$data['CONTENT_URL'],
				'link_url'			=>$data['LINK_URL'],
				'grid_size'			=>$data['GRID_SIZE'],
				'background_color'	=>$data['BACKGROUND_COLOR'],
				'product_idx'		=>$data['PRODUCT_IDX'],
				'product_name'		=>$data['PRODUCT_NAME'],
				'price'				=>$data['PRICE'],
				'discount'			=>$data['DISCOUNT'],
				'sales_price'		=>$data['SALES_PRICE'],
				'color'				=>$data['COLOR'],
				'product_color'		=>$product_color,
				'product_size'		=>$product_size,
				'whish_flg'			=>$whish_flg
			);
		}
	} else {
		$code = 402;
		$msg = "해당 페이지의 정보가 존재하지 않습니다. 올바른 페이지로 이동해주세요.";
		exit;
	}
}
?>