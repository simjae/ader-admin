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

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
} else if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

$product_idx = 0;
if (isset($_POST['product_idx'])) {
	$product_idx = $_POST['product_idx'];
}

if ($product_idx > 0 && $country != null) {
	$select_product_sql = "
		SELECT
			PR.IDX						AS PRODUCT_IDX,
			PR.ORDERSHEET_IDX			AS ORDERSHEET_IDX,
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
	
	$db->query($select_product_sql);
	
	foreach($db->fetch() as $product_data) {
		$product_idx = $product_data['PRODUCT_IDX'];
		$ordersheet_idx = $product_data['ORDERSHEET_IDX'];
		
		$img_thumbnail = array();
		$img_main = array();
		
		$product_color = array();
		$product_size = array();
		
		if ($product_idx != null) {
			$img_thumbnail_sql = "
				(
					SELECT
						REPLACE(
							S_PI.IMG_LOCATION,'/var/www/admin/www',''
						)	AS IMG_LOCATION
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = ".$product_idx." AND
						S_PI.IMG_TYPE = 'O' AND
						S_PI.IMG_SIZE = 'S'
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				) UNION (
					SELECT
						REPLACE(
							S_PI.IMG_LOCATION,'/var/www/admin/www',''
						)	AS IMG_LOCATION
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = ".$product_idx." AND
						S_PI.IMG_TYPE = 'P' AND
						S_PI.IMG_SIZE = 'S'
					ORDER BY
						IDX ASC
					LIMIT
						0,1
				)
			";
			
			$db->query($img_thumbnail_sql);
			
			foreach($db->fetch() as $thumbnail) {
				$img_thumbnail[] = array(
					'display_num'	=>0,
					'img_location'	=>$thumbnail['IMG_LOCATION']
				);
			}
			
			$img_main_sql = "
				SELECT
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
					PI.IMG_SIZE = 'L'
				ORDER BY
					PI.IDX ASC
			";
			
			$db->query($img_main_sql);
			
			$display_num = 1;
			
			foreach($db->fetch() as $main) {
				$img_main[] = array(
					'display_num'	=>$display_num++,
					'img_idx'		=>$main['IMG_IDX'],
					'img_type'		=>$main['IMG_TYPE'],
					'img_size'		=>$main['IMG_SIZE'],
					'img_location'	=>$main['IMG_LOCATION'],
					'img_url'		=>$main['IMG_URL']
				);
				
				$o_cnt = false;
				$p_cnt = false;
				if ($img_main != null) {
					for ($i=0; $i<count($img_main); $i++) {
						$img_type = $img_main[$i]['img_type'];
						
						if ($o_cnt == false && $img_type == "O") {
							$o_cnt = true;
							$img_thumbnail[0]['display_num'] = $img_main[$i]['display_num'];
						}
						
						if ($p_cnt == false && $img_type == "P") {
							$p_cnt = true;
							$img_thumbnail[1]['display_num'] = $img_main[$i]['display_num'];
						}
					}
				}
			}
			
			$whish_flg = false;
			if ($member_idx > 0) {
				$whish_cnt = $db->count("dev.WHISH_LIST"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx);
				if ($whish_cnt > 0) {
					$whish_flg = true;
				}
			}
			
			$product_color = getProductColor($db,$product_idx);
			
			$product_size = getProductSize($db,$product_idx);
		}
		
		$option_info = array();
		if (!empty($ordersheet_idx)) {
			$select_option_sql = "
				SELECT
					OO.OPTION_NAME		AS OPTION_NAME,
					OO.SIZE_CATEGORY	AS SIZE_CATEGORY,
					OO.OPTION_SIZE_1	AS OPTION_SIZE_1,
					OO.OPTION_SIZE_2	AS OPTION_SIZE_2,
					OO.OPTION_SIZE_3	AS OPTION_SIZE_3,
					OO.OPTION_SIZE_4	AS OPTION_SIZE_4,
					OO.OPTION_SIZE_5	AS OPTION_SIZE_5,
					OO.OPTION_SIZE_6	AS OPTION_SIZE_6
				FROM
					dev.ORDERSHEET_OPTION OO
				WHERE
					OO.ORDERSHEET_IDX = ".$ordersheet_idx."
			";
			
			$db->query($select_option_sql);
			
			foreach($db->fetch() as $option_data) {
				$option_name = $option_data['OPTION_NAME'];
				
				$option_info[$option_name][] = array(
					'size_category'		=>$option_data['SIZE_CATEGORY'],
					'option_size_1'		=>$option_data['OPTION_SIZE_1'],
					'option_size_2'		=>$option_data['OPTION_SIZE_2'],
					'option_size_3'		=>$option_data['OPTION_SIZE_3'],
					'option_size_4'		=>$option_data['OPTION_SIZE_4'],
					'option_size_5'		=>$option_data['OPTION_SIZE_5'],
					'option_size_6'		=>$option_data['OPTION_SIZE_6']
				);
			}
		}
		
		$json_result['data'][] = array(
			'product_idx'		=>$product_data['PRODUCT_IDX'],
			'img_thumbnail'		=>$img_thumbnail,
			'img_main'			=>$img_main,
			'product_name'		=>$product_data['PRODUCT_NAME'],
			'color'				=>$product_data['COLOR'],
			'price'				=>$product_data['PRICE'],
			'discount'			=>$product_data['DISCOUNT'],
			'sales_price'		=>$product_data['SALES_PRICE'],
			'material'			=>$product_data['MATERIAL'],
			'detail'			=>$product_data['DETAIL'],
			'care'				=>$product_data['CARE'],
			'refund_msg_flg'	=>$product_data['REFUND_MSG_FLG'],
			'refund_msg'		=>$product_data['REFUND_MSG'],
			'relevant_idx'		=>$product_data['RELEVANT_IDX'],
			'product_color'		=>$product_color,
			'product_size'		=>$product_size,
			'whish_flg'			=>$whish_flg,
			
			'option_info'		=>$option_info
		);
	}
}
?>