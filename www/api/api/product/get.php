<?php
/*
 +=============================================================================
 | 
 | 상품 상세 - 상품 상세 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.17
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

$product_idx	= $_POST['product_idx'];
$country		= $_POST['country'];

if ($product_idx != null && $country != null) {
	$sql = "SELECT
				PR.IDX						AS PRODUCT_IDX,
				PR.PRODUCT_NAME				AS PRODUCT_NAME,
				OM.COLOR					AS COLOR,
				PR.PRICE_".$country."		AS PRICE,
				PR.DISCOUNT_".$country."	AS DISCOUNT,
				PR.SALES_PRICE_".$country."	AS SALES_PRICE,
				PR.DETAIL_".$country."		AS DETAIL,
				PR.CARE_".$country."		AS CARE,
				PR.MATERIAL_".$country."	AS MATERIAL,
				PR.REFUND_MSG_FLG			AS REFUND_MSG_FLG,
				PR.REFUND_".$country."		AS REFUND_MSG,
				PR.RELEVANT_IDX				AS RELEVANT_IDX
			FROM
				dev.SHOP_PRODUCT PR
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
			WHERE
				PR.IDX = ".$product_idx;
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$product_idx = $data['PRODUCT_IDX'];
		
		if ($product_idx != null) {
			$product_img = array();
			
			$img_sql = "SELECT
							PI.IDX			AS IMG_IDX,
							PI.IMG_TYPE		AS IMG_TYPE,
							PI.IMG_SIZE		AS IMG_SIZE,
							REPLACE(
								PI.IMG_LOCATION,'/var/www/admin/www',''
							)				AS IMG_LOCATION,
							REPLACE(
								PI.IMG_URL,'/var/www/admin/www',''
							)				AS IMG_URL
						FROM
							dev.PRODUCT_IMG PI
						WHERE
							PI.PRODUCT_IDX = ".$product_idx." AND
							PI.IMG_SIZE IN ('L','S')
						ORDER BY
							PI.IDX ASC";
			
			$db->query($img_sql);
			
			$img_product_l = array();
			$img_product_s = array();
			
			$img_outfit_l = array();
			$img_outfit_s = array();
			
			$img_detail_l = array();
			$img_detail_s = array();
			
			foreach($db->fetch() as $img_data) {
				$img_size = $img_data['IMG_SIZE'];
				$img_type = $img_data['IMG_TYPE'];
				
				if ($img_size == "L") {
					switch ($img_type) {
						case "P" :
							array_push($img_product_l,$img_data['IMG_URL']);
							break;
						
						case "O" :
							array_push($img_outfit_l,$img_data['IMG_URL']);
							break;
						
						case "D" :
							array_push($img_detail_l,$img_data['IMG_URL']);
							break;
					}
				} else if ($img_size == "S") {
					switch ($img_type) {
						case "P" :
							array_push($img_product_s,$img_data['IMG_LOCATION']);
							break;
						
						case "O" :
							array_push($img_outfit_s,$img_data['IMG_LOCATION']);
							break;
						
						case "D" :
							array_push($img_detail_s,$img_data['IMG_LOCATION']);
							break;
					}
				}
			}
			
			$product_img_l = array(
				'img_product'	=>$img_product_l,
				'img_outfit'	=>$img_outfit_l,
				'img_detail'	=>$img_detail_l
			);
			
			$product_img_s = array(
				'img_product'	=>$img_product_s,
				'img_outfit'	=>$img_outfit_s,
				'img_detail'	=>$img_detail_s
			);
			
			$product_img = array(
				'product_img_l'	=>$product_img_l,
				'product_img_s'	=>$product_img_s
			);
			
			$whish_flg = false;
			if ($member_idx > 0) {
				$whish_cnt = $db->count("dev.WHISH_LIST"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx);
				if ($whish_cnt > 0) {
					$whish_flg = true;
				}
			}
			
			$product_color = getProductColor($db,$product_idx);
			
			$product_size = getProductSize($db,$product_idx);
			
			$json_result['data'][] = array(
				'product_idx'		=>$data['PRODUCT_IDX'],
				'product_img'		=>$product_img,
				'product_name'		=>$data['PRODUCT_NAME'],
				'color'				=>$data['COLOR'],
				'price'				=>$data['PRICE'],
				'discount'			=>$data['DISCOUNT'],
				'sales_price'		=>$data['SALES_PRICE'],
				'material'			=>$data['MATERIAL'],
				'detail'			=>$data['DETAIL'],
				'care'				=>$data['CARE'],
				'refund_msg_flg'	=>$data['REFUND_MSG_FLG'],
				'refund_msg'		=>$data['REFUND_MSG'],
				'relevant_idx'		=>$data['RELEVANT_IDX'],
				'product_color'		=>$product_color,
				'product_size'		=>$product_size,
				'whish_flg'			=>$whish_flg
			);
		}
	}
}
?>