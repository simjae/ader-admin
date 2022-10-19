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
$product_idx	= $_POST['product_idx'];
$country		= $_POST['country'];

if ($product_idx != null) {
	$sql = "SELECT
				PR.IDX						AS PRODUCT_IDX,
				PR.PRODUCT_NAME				AS PRODUCT_NAME,
				OM.COLOR					AS COLOR,
				PR.PRICE_".$country."		AS PRICE,
				PR.DISCOUNT_".$country."	AS DISCOUNT,
				PR.SALES_PRICE_".$country."	AS SALES_PRICE,
				OM.MATERIAL_".$country."	AS MATERIAL,
				OM.DETAIL_".$country."		AS DETAIL,
				OM.CARE_".$country."		AS CARE,
				PR.REFUND_FLG				AS REFUND_FLG,
				PR.REFUND_".$country."		AS REFUND_MSG
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
			$img_product = array();
			
			$img_sql = "SELECT
							PI.IDX			AS IMG_IDX,
							PI.IMG_TYPE		AS IMG_TYPE,
							PI.IMG_LOCATION	AS IMG_LOCATION
						FROM
							dev.PRODUCT_IMG PI
						WHERE
							PI.PRODUCT_IDX = ".$product_idx."
						ORDER BY
							PI.IDX ASC"
			
			$db->query($img_sql);
			
			$img_main = array();
			$img_detail = array();
			foreach($db->fetch() as $img_data) {
				$img_type = $img_data['IMG_TYPE'];
				
				if ($img_type == "MAIN") {
					$img_main['data'][] = array(
						'img_location'		=>$img_data['IMG_LOCATION']
					);
				} else if ($img_type == "DETAIL") {
					$img_detail['data'][] = array(
						'img_location'		=>$img_data['IMG_LOCATION']
					);
				}
			}
			
			$img_product[] = array(
				'img_main'		=>$img_main,
				'img_detail'	=>$img_detail
			);
			
			$whish_flg = false;
			if ($member_idx != null) {
				$whish_cnt => $db->count("dev.WHISH_LIST"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx);
				if ($whish_cnt > 0) {
					$whish_flg = true;
				}
			}
			
			$json_result['data'][] = array(
				'product_idx'		=>$data['PRODUCT_IDX'],
				'img_product'		=>$img_product,
				'product_name'		=>$data['PRODUCT_NAME'],
				'color'				=>$data['COLOR'],
				'price'				=>$data['PRICE'],
				'discount'			=>$data['DISCOUNT'],
				'sales_price'		=>$data['SALES_PRICE'],
				'material'			=>$data['MATERIAL'],
				'detail'			=>$data['DETAIL'],
				'care'				=>$data['CARE'],
				'refund_flg'		=>$data['REFUND_FLG'],
				'refund_msg'		=>$data['REFUND_MSG'],
				'whish_flg'			=>$whish_flg
			);
		}
	}
}
?>