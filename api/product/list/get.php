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

error_reporting(E_ALL^ E_WARNING); 

$member_idx = 1;
//$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$menu_sort		= null;
if (isset($_POST['menu_sort'])) {
	$menu_sort = $_POST['menu_sort'];
}

$menu_idx		= null;
if (isset($_POST['menu_idx'])) {
	$menu_idx = $_POST['menu_idx'];
}

$img_param = "P";
if (isset($_POST['img_param'])) {
	$img_param = $_POST['img_param'];
}

$last_idx = 0;
if (isset($_POST['last_idx'])) {
	$last_idx = intval($_POST['last_idx']);
}

$page_idx		= $_POST['page_idx'];
if (isset($_POST['country'])) {
	$country		= $_POST['country'];
}
$country = "KR";

$menu_info = array();
if ($menu_sort != null && $menu_idx != null) {
	$upper_filter = getMenuFilter($db,$country,$menu_sort,$menu_idx,"UP");
	$lower_filter = getMenuFilter($db,$country,$menu_sort,$menu_idx,"LW");
	
	$menu_info = array(
		'upper_filter'	=>$upper_filter,
		'lower_filter'	=>$lower_filter,
	);
}

if ($page_idx != null && $country != null) {
	$page_count = $db->count("dev.PAGE_PRODUCT","IDX = ".$page_idx." AND DISPLAY_FLG = TRUE");
	if ($page_count > 0) {
		$select_grid_sql = "
			SELECT
				PG.DISPLAY_NUM				AS DISPLAY_NUM,
				PG.TYPE						AS GRID_TYPE,
				PG.LINK_URL					AS LINK_URL,
				PG.SIZE						AS GRID_SIZE,
				PG.BACKGROUND_COLOR			AS BACKGROUND_COLOR,
				PG.BANNER_IDX				AS BANNER_IDX,
				PG.PRODUCT_IDX				AS PRODUCT_IDX
			FROM
				dev.PRODUCT_GRID PG
			WHERE
				PG.PAGE_IDX = ".$page_idx." AND
				PG.DEL_FLG = FALSE
			ORDER BY
				PG.DISPLAY_NUM
		";
		
		/*if ($last_idx > 0) {
			$select_grid_sql .= " LIMIT ".($last_idx*12+1).",12 ";
		} else {
			$select_grid_sql .= " LIMIT 0,12 ";
		}*/
		
		$db->query($select_grid_sql);
		
		$grid_info = array();
		foreach($db->fetch() as $grid_data) {
			$grid_type = $grid_data['GRID_TYPE'];
			
			$banner_idx = $grid_data['BANNER_IDX'];
			$product_idx = $grid_data['PRODUCT_IDX'];
			
			$banner_info = array();
			$product_info = array();
			
			if ($grid_type == "PRD" && $product_idx > 0) {
				$select_product_sql = "
					SELECT
						PR.PRODUCT_NAME				AS PRODUCT_NAME,
						PR.PRICE_".$country."		AS PRICE,
						PR.DISCOUNT_".$country."	AS DISCOUNT,
						PR.SALES_PRICE_".$country."	AS SALES_PRICE,
						OM.COLOR					AS COLOR
					FROM
						dev.SHOP_PRODUCT PR
						LEFT JOIN dev.ORDERSHEET_MST OM ON
						PR.ORDERSHEET_IDX = OM.IDX
					WHERE
						PR.IDX = ".$product_idx." AND
						PR.SALE_FLG = TRUE AND
						PR.DEL_FLG = FALSE
				";
				
				$db->query($select_product_sql);
				
				foreach($db->fetch() as $product_data) {
					$product_img = array();
					
					$select_img_p_sql = "
						SELECT
							PI.IMG_TYPE		AS IMG_TYPE,
							REPLACE(
								PI.IMG_LOCATION,'/var/www/admin/www',''
							)				AS IMG_LOCATION
						FROM
							dev.PRODUCT_IMG PI
						WHERE
							PI.PRODUCT_IDX = ".$product_idx." AND
							PI.IMG_TYPE = 'P' AND
							PI.IMG_SIZE = 'M'
						ORDER BY
							PI.IDX ASC
					";
					
					$db->query($select_img_p_sql);
					
					$product_p_img = array();
					foreach($db->fetch() as $img_data) {
						$product_p_img[] = array(
							'img_type'		=>$img_data['IMG_TYPE'],
							'img_location'	=>$img_data['IMG_LOCATION']
						);
					}
					
					$select_img_o_sql = "
						SELECT
							PI.IMG_TYPE		AS IMG_TYPE,
							REPLACE(
								PI.IMG_LOCATION,'/var/www/admin/www',''
							)				AS IMG_LOCATION
						FROM
							dev.PRODUCT_IMG PI
						WHERE
							PI.PRODUCT_IDX = ".$product_idx." AND
							PI.IMG_TYPE = 'O' AND
							PI.IMG_SIZE = 'M'
						ORDER BY
							PI.IDX ASC
					";
									
					$db->query($select_img_o_sql);
					
					$product_o_img = array();
					foreach($db->fetch() as $img_data) {
						$product_o_img[] = array(
							'img_type'		=>$img_data['IMG_TYPE'],
							'img_location'	=>$img_data['IMG_LOCATION']
						);
					}
					
					$product_img = array(
						'product_p_img'		=>$product_p_img,
						'product_o_img'		=>$product_o_img
					);
					
					$whish_flg = false;
					if ($member_idx > 0) {
						$whish_count = $db->count("dev.WHISH_LIST","MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND DEL_FLG = FALSE");
						if ($whish_count > 0) {
							$whish_flg = true;
						}
					}
					
					$product_color = getProductColor($db,$product_idx);
					
					$product_size = getProductSize($db,$product_idx);
					
					$stock_status = null;
					$soldout_cnt = 0;
					for ($i=0; $i<count($product_size); $i++) {
						if ($product_size[$i]['stock_status'] == "STSO") {
							$soldout_cnt++;
						}
					}
					
					if (count($product_size) == $soldout_cnt) {
						$stock_status = "STSO";
					}
					
					$product_info = array(
						'product_name'		=>$product_data['PRODUCT_NAME'],
						'price'				=>$product_data['PRICE'],
						'discount'			=>$product_data['DISCOUNT'],
						'sales_price'		=>$product_data['SALES_PRICE'],
						'color'				=>$product_data['COLOR'],
						'product_img'		=>$product_img,
						'product_color'		=>$product_color,
						'product_size'		=>$product_size,
						'stock_status'		=>$stock_status,
						'whish_flg'			=>$whish_flg
					);
				}
			} else if ($grid_type != "BNR" && $banner_idx > 0) {
				$banner_table = "";
				$clip_table = "";
				
				switch($grid_type) {
					case "IMG" :
						$banner_table = "dev.BANNER_IMG BI";
						$clip_table = "dev.BANNER_IMG_CLIP BC";
						break;
					
					case "VID" :
						$banner_table = "dev.BANNER_VID BI";
						$clip_table = "dev.BANNER_VID_CLIP BC";
						break;
				}
				
				$select_banner_sql = "
					SELECT
						REPLACE(
							BI.BANNER_LOCATION,
							'/var/www/admin/www',
							''
						)		AS BANNER_LOCATION
					FROM
						".$banner_table."
					WHERE
						BI.IDX = ".$banner_idx."
				";
				
				$db->query($select_banner_sql);
				
				foreach($db->fetch() as $banner_data) {
					$select_clip_sql = "
						SELECT
							BC.CLIP_TYPE		AS CLIP_TYPE,
							BC.LOCATION_START	AS LOCATION_START,
							BC.LOCATION_END	AS LOCATION_END
						FROM
							".$clip_table."
						WHERE
							BC.BANNER_IDX = ".$banner_idx."
					";
					
					$db->query($select_clip_sql);
					
					$clip_info = array();
					foreach($db->fetch() as $clip_data) {
						$clip_info[] = array(
							'clip_type'			=>$clip_data['CLIP_TYPE'],
							'location_start'	=>$clip_data['LOCATION_START'],
							'location_end'		=>$clip_data['LOCATION_END']
						);
					}
					
					$banner_info = array(
						'banner_location'	=>$banner_data['BANNER_LOCATION'],
						'clip_info'			=>$clip_info
					);
				}
			}
			
			$grid_info[] = array(
				'display_num'		=>$grid_data['DISPLAY_NUM'],
				'grid_type'			=>$grid_data['GRID_TYPE'],
				'link_url'			=>$grid_data['LINK_URL'],
				'grid_size'			=>$grid_data['GRID_SIZE'],
				'background_color'	=>$grid_data['BACKGROUND_COLOR'],
				'product_idx'		=>$grid_data['PRODUCT_IDX'],
				
				'banner_location'	=>$banner_info['banner_location'],
				'clip_info'			=>$banner_info['clip_info'],
				
				'product_name'		=>$product_info['product_name'],
				'price'				=>$product_info['price'],
				'discount'			=>$product_info['discount'],
				'sales_price'		=>$product_info['sales_price'],
				'color'				=>$product_info['color'],
				'product_img'		=>$product_info['product_img'],
				'product_color'		=>$product_info['product_color'],
				'product_size'		=>$product_info['product_size'],
				'stock_status'		=>$product_info['stock_status'],
				'whish_flg'			=>$product_info['whish_flg']
			);
		}
		
		$json_result['data'] = array(
			'menu_info'		=>$menu_info,
			'grid_info'		=>$grid_info
		);
	} else {
		$code = 402;
		$msg = "해당 페이지의 정보가 존재하지 않습니다. 올바른 페이지로 이동해주세요.";
		exit;
	}
}

function checkArrayValue($param) {
	$value = null;
	if (isset($param)) {
		$value = $param;
	}
	return $value;
}

function getMenuFilter($db,$country,$menu_sort,$menu_idx,$filter_type) {
	$filter_table = "";
	$img_sql = "";
	$link_sql = "";
	
	switch ($filter_type) {
		case "UP" :
			$filter_table = " dev.MENU_UPPER_FILTER MF ";
			$img_sql = " MF.IMG_LOCATION, ";
			$link_sql = "
				CASE
					WHEN
						MF.LINK_TYPE = 'PR'
						THEN
							(
								SELECT
									CONCAT(
										S_PPR.PAGE_URL,
										'&menu_sort=".$menu_sort."&menu_idx=".$menu_idx."'
									)
								FROM
									dev.PAGE_PRODUCT S_PPR
								WHERE
									S_PPR.IDX = MF.PAGE_IDX
							)
					WHEN
						MF.LINK_TYPE = 'PO'
						THEN
							(
								SELECT
									PAGE_URL
								FROM
									dev.PAGE_POSTING S_PPO
								WHERE
									S_PPO.IDX = MF.PAGE_IDX
							)
				END			AS MENU_LINK
			";
			break;
		
		case "LW" :
			$filter_table = " dev.MENU_LOWER_FILTER MF ";
			$link_sql = "
				(
					SELECT
						PAGE_URL
					FROM
						dev.PAGE_PRODUCT S_PPR
					WHERE
						S_PPR.IDX = MF.PAGE_IDX
				)			AS MENU_LINK
			";
			break;
	}
	
	
	$filter_sql = "
		SELECT
			MF.OBJ_TITLE,
			".$img_sql."
			".$link_sql."
		FROM
			".$filter_table."
		WHERE
			MF.MENU_SORT = '".$menu_sort."' AND
			MF.MENU_IDX = ".$menu_idx." AND
			MF.COUNTRY = '".$country."'
		ORDER BY
			MF.DISPLAY_NUM ASC
			
	";
	
	$db->query($filter_sql);
	
	$filter_info = array();
	foreach($db->fetch() as $data) {
		$img_location = null;
		if (!empty($data['IMG_LOCATION'])) {
			$img_location = $data['IMG_LOCATION'];
		}
		
		$filter_info[] = array(
			'filter_title'	=>$data['OBJ_TITLE'],
			'img_location'	=>$img_location,
			'menu_link'		=>$data['MENU_LINK']
		);
	}
	
	return $filter_info;
}
?>