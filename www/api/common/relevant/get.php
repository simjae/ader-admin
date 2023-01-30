<?php
/*
 +=============================================================================
 | 
 | 공통 - 관련 상품 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.25
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

$relevant_idx	= $_POST['relevant_idx'];
$country		= $_POST['country'];

if ($relevant_idx != null && $country != null) {
	$sql = "SELECT
				PR.IDX						AS PRODUCT_IDX,
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
				PR.PRODUCT_NAME				AS PRODUCT_NAME,
				OM.COLOR					AS COLOR,
				PR.PRICE_".$country."		AS PRICE,
				PR.DISCOUNT_".$country."	AS DISCOUNT,
				PR.SALES_PRICE_".$country."	AS SALES_PRICE,
				OM.COLOR					AS COLOR
			FROM
				dev.SHOP_PRODUCT PR
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
			WHERE
				PR.IDX IN (".$relevant_idx.")";
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {		
		$product_idx = $data['PRODUCT_IDX'];
		
		if ($product_idx != null) {
			$whish_flg = false;
			
			if ($member_idx > 0) {
				$whish_cnt = $db->count("dev.WHISH_LIST"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND DEL_FLG = FALSE");
				
				if ($whish_cnt > 0) {
					$whish_flg = true;
				}
			}
			
			$product_color = getProductColor($db,$product_idx);
			
			$product_size = getProductSize($db,$product_idx);
			
			$json_result['data'][] = array(
				'product_idx'		=>$product_idx,
				'product_img'		=>$data['PRODUCT_IMG'],
				'product_name'		=>$data['PRODUCT_NAME'],
				'color'				=>$data['COLOR'],
				'price'				=>$data['PRICE'],
				'discount'			=>$data['DISCOUNT'],
				'sales_price'		=>$data['SALES_PRICE'],
				'product_color'		=>$product_color,
				'product_size'		=>$product_size,
				'whish_flg'			=>$whish_flg
			);
		}
	}
}
?>