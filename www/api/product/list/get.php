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
$country		= $_POST['country'];

$menu_info = array();
if ($menu_sort != null && $menu_sort != null) {
	$menu_table = "";
	$menu_as = "";
	switch ($menu_sort) {
		case "L" :
			$menu_table = "dev.MENU_MDL";
			$menu_where = "MENU_LRG_IDX = ".$menu_idx;
			break;
		
		case "M" :
			$menu_table = "dev.MENU_SML";
			$menu_where = "MENU_MDL_IDX = ".$menu_idx;
			break;
		
		case "S" :
			$menu_cnt = $db->count("dev.MENU_DTL","MENU_IDX = ".$menu_idx);
			if ($menu_cnt > 0) {
				$menu_table = "dev.MENU_DTL";
				$menu_where = "MENU_IDX = ".$menu_idx;
			} else {
				$menu_table = "dev.MENU_SML";
				$menu_where = "MENU_MDL_IDX = (SELECT S_MS.MENU_MDL_IDX FROM dev.MENU_SML S_MS WHERE IDX = ".$menu_idx.")";
			}
			break;
		
		case "D" :
			$menu_table = "dev.MENU_DTL";
			$menu_where = "MENU_IDX = ".$menu_idx;
			break;
	}
	
	$menu_sql = "SELECT
					MENU_TITLE		AS MENU_TITLE,
					MENU_LINK		AS MENU_LINK,
					(
						SELECT
							REPLACE(S_MI.IMG_LOCATION,'/var/www/www/','')
						FROM
							dev.MENU_IMG S_MI
						WHERE
							S_MI.MENU_SORT = '".$menu_sort."' AND
							S_MI.MENU_IDX = ".$menu_idx."
					)				AS MENU_IMG
				FROM
					".$menu_table."
				WHERE
					".$menu_where;
	
	$db->query($menu_sql);
	foreach($db->fetch() as $menu_data) {
		$menu_info[] = array(
			'menu_title'	=>$menu_data['MENU_TITLE'],
			'menu_link'		=>$menu_data['MENU_LINK'],
			'menu_img'		=>$menu_data['MENU_IMG']
		);
	}
}

if ($page_idx != null && $country != null) {
	$page_count = $db->count("dev.PAGE_PRODUCT","IDX = ".$page_idx." AND DISPLAY_FLG = TRUE");
	if ($page_count > 0) {
		$sql = "SELECT
					PG.DISPLAY_NUM				AS DISPLAY_NUM,
					PG.TYPE						AS GRID_TYPE,
					PG.LINK_URL					AS LINK_URL,
					PG.SIZE						AS GRID_SIZE,
					PG.BACKGROUND_COLOR			AS BACKGROUND_COLOR,
					PG.PRODUCT_IDX				AS PRODUCT_IDX,
					PR.PRODUCT_NAME				AS PRODUCT_NAME,
					(
						SELECT
							REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
						FROM
							dev.PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = PR.IDX AND
							S_PI.IMG_TYPE = '".$img_param."' AND
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
		
		if ($last_idx > 0) {
			$sql .= " LIMIT ".($last_idx*12+1).",12 ";
		} else {
			$sql .= " LIMIT 0,12 ";
		}
		
		
		$db->query($sql);
		
		$product_info = array();
		foreach($db->fetch() as $data) {
			$product_idx = $data['PRODUCT_IDX'];
			
			if ($product_idx != null) {
				$product_img = array();
			
				$img_sql = "SELECT
								PI.IMG_TYPE		AS IMG_TYPE,
								REPLACE(
									PI.IMG_LOCATION,'/var/www/admin/www',''
								)				AS IMG_LOCATION
							FROM
								dev.PRODUCT_IMG PI
							WHERE
								PI.PRODUCT_IDX = ".$product_idx." AND
								PI.IMG_TYPE = '".$img_param."' AND
								PI.IMG_SIZE = 'M'
							ORDER BY
								PI.IDX ASC";
				
				$db->query($img_sql);
				
				foreach($db->fetch() as $img_data) {
					$product_img[] = array(
						'img_type'		=>$img_data['IMG_TYPE'],
						'img_location'	=>$img_data['IMG_LOCATION']
					);
				}
				
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
				
				/*for ($i=0; $i<count($product_color); $i++) {
					if ($product_color[$i]['stock_status'] == "STSO") {
						$soldout_cnt++;
					}
				}*/
				
				
				/*if ((count($product_size) + count($product_color)) == $soldout_cnt) {
					$stock_status = "STSO";
				}*/
				
				if (count($product_size) == $soldout_cnt) {
					$stock_status = "STSO";
				}
				
				$product_info[] = array(
					'display_num'		=>$data['DISPLAY_NUM'],
					'grid_type'			=>$data['GRID_TYPE'],
					'link_url'			=>$data['LINK_URL'],
					'grid_size'			=>$data['GRID_SIZE'],
					'background_color'	=>$data['BACKGROUND_COLOR'],
					'product_idx'		=>$data['PRODUCT_IDX'],
					'product_img'		=>$product_img,
					'product_name'		=>$data['PRODUCT_NAME'],
					'price'				=>$data['PRICE'],
					'discount'			=>$data['DISCOUNT'],
					'sales_price'		=>$data['SALES_PRICE'],
					'color'				=>$data['COLOR'],
					'product_color'		=>$product_color,
					'product_size'		=>$product_size,
					'stock_status'		=>$stock_status,
					'whish_flg'			=>$whish_flg
				);
			}
		}
		
		$json_result['data'] = array(
			'menu_info'			=>$menu_info,
			'product_info'		=>$product_info
		);
	} else {
		$code = 402;
		$msg = "해당 페이지의 정보가 존재하지 않습니다. 올바른 페이지로 이동해주세요.";
		exit;
	}
}
?>