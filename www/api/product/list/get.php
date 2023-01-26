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

//$member_idx = 1;
$member_idx = 0;
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

$last_idx = 0;
if (isset($_POST['last_idx'])) {
	$last_idx = intval($_POST['last_idx']);
}

$page_idx		= $_POST['page_idx'];

if (isset($_POST['country'])) {
	$country		= $_POST['country'];
}

$menu_info = array();
if ($menu_sort != null && $menu_idx != null) {
	$upper_filter = getMenuFilter($db,$country,$menu_sort,$menu_idx,"UP");
	$lower_filter = getMenuFilter($db,$country,$menu_sort,$menu_idx,"LW");
	
	$menu_info = array(
		'upper_filter'	=>$upper_filter,
		'lower_filter'	=>$lower_filter,
	);
}

$filter_info = array();
$filter_info = getProductFilter($db,$country,$page_idx);

$filter_param = null;
if (isset($_POST['filter_param'])) {
	$filter_param = $_POST['filter_param'];
}

$grid_filter_sql = "";
if ($filter_param != null) {
	$filter_cl = $filter_param['filter_cl'];
	if ($filter_cl != null) {
		$grid_filter_sql = "
			AND (
				PR.FILTER_CL REGEXP '".implode("|",$filter_cl)."'
			)
		";
	}
	
	$filter_ft = $filter_param['filter_ft'];
	if ($filter_ft != null) {
		$grid_filter_sql = "
			AND (
				OM.FIT REGEXP '".implode("|",$filter_ft)."'
			)
		";
	}
	
	$filter_gp = $filter_param['filter_gp'];
	if ($filter_gp != null) {
		$grid_filter_sql = "
			AND (
				OM.GRAPHIC REGEXP '".implode("|",$filter_gp)."'
			)
		";
	}
	
	$filter_sz = $filter_param['filter_sz'];
	if ($filter_sz != null) {
		$grid_filter_sql = "
			AND (
				PR.FILTER_SZ REGEXP '".implode("|",$filter_sz)."'
			)
		";
	}
}

$order_param = null;
if (isset($_POST['order_param'])) {
	$order_param = $_POST['order_param'];
}

$order_cnt_sql = "";
$grid_order_sql = " PG.DISPLAY_NUM ";
if ($order_param != null) {
	switch ($order_param) {
		case "POP" :
			$order_cnt_sql = "
				,(
					SELECT
						IFNULL(SUM(S_OP.PRODUCT_QTY),0)
					FROM
						dev.ORDER_PRODUCT S_OP
					WHERE
						S_OP.PRODUCT_IDX = PR.IDX AND
						S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
				)	AS ORDER_QTY
			";
			
			$grid_order_sql = " ORDER_QTY DESC ";
			
			break;
		
		case "NEW" :
			$grid_order_sql = " PR.CREATE_DATE DESC ";
			break;
		
		case "MIN" :
			$grid_order_sql = " PR.SALES_PRICE_".$country." ASC ";
			break;
			
		case "MAX" :
			$grid_order_sql = " PR.SALES_PRICE_".$country." DESC ";
			break;
	}
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
				".$order_cnt_sql."
			FROM
				dev.PRODUCT_GRID PG
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				PG.PRODUCT_IDX = PR.IDX
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
			WHERE
				PG.PAGE_IDX = ".$page_idx." AND
				PG.DEL_FLG = FALSE
				".$grid_filter_sql."
			ORDER BY
				".$grid_order_sql."
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
			'filter_info'	=>$filter_info,
			'grid_info'		=>$grid_info
		);
	} else {
		$json_result['code'] = 402;
		$json_result['msg'] = "해당 페이지의 정보가 존재하지 않습니다. 올바른 페이지로 이동해주세요.";
		
		return $json_result;
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

function getProductFilter($db,$country,$page_idx) {
	$select_filter_cl_sql = "
		SELECT
			GROUP_CONCAT(
				PR.FILTER_CL
			)		AS FILTER_CL_IDX,
			GROUP_CONCAT(
				PR.FILTER_SZ
			)		AS FILTER_SZ_IDX
		FROM
			dev.SHOP_PRODUCT PR
		WHERE
			PR.IDX IN (
				SELECT
					S_PG.PRODUCT_IDX
				FROM
					dev.PRODUCT_GRID S_PG
				WHERE
					S_PG.PAGE_IDX = ".$page_idx."
			)
	";
	
	$db->query($select_filter_cl_sql);
	
	$filter_info = array();
	
	$filter_cl = array();
	$filter_ft = array();
	$filter_gp = array();
	$filter_ln = array();
	
	$filter_sz = array();
	$filter_sz_up = array();
	$filter_sz_lw = array();
	$filter_sz_ht = array();
	$filter_sz_sh = array();
	$filter_sz_jw = array();
	$filter_sz_ac = array();
	$filter_sz_ta = array();
	
	foreach($db->fetch() as $filter_data) {
		$filter_cl_idx = $filter_data['FILTER_CL_IDX'];		
		$filter_sz_idx = $filter_data['FILTER_SZ_IDX'];
		
		if (!empty($filter_cl_idx)) {
			$tmp_arr = explode(",",$filter_cl_idx);
			$color_idx = array();
			
			for ($i=0; $i<count($tmp_arr); $i++) {
				if (!in_array($tmp_arr[$i],$color_idx)) {
					array_push($color_idx,$tmp_arr[$i]);
				}
			}
			
			if (count($color_idx) > 0) {
				$select_color_sql = "
					SELECT
						PF.IDX						AS FILTER_IDX,
						PF.FILTER_NAME_".$country."	AS FILTER_NAME,
						PF.RGB_COLOR				AS RGB_COLOR
					FROM
						dev.PRODUCT_FILTER PF
					WHERE
						PF.IDX IN (".implode(",",$color_idx).") AND
						PF.FILTER_TYPE = 'CL' AND
						PF.DEL_FLG = FALSE
				";
				
				$db->query($select_color_sql);
				
				foreach($db->fetch() as $color_data) {
					$filter_cl[] = array(
						'filter_idx'		=>$color_data['FILTER_IDX'],
						'filter_name'		=>$color_data['FILTER_NAME'],
						'rgb_color'			=>$color_data['RGB_COLOR'],
					);
				}
			}
		}
		
		if (!empty($filter_sz_idx)) {
			$tmp_arr = explode(",",$filter_sz_idx);
			$size_idx = array();
			
			for ($i=0; $i<count($tmp_arr); $i++) {
				if (!in_array($tmp_arr[$i],$size_idx)) {
					array_push($size_idx,$tmp_arr[$i]);
				}
			}
			
			if (count($size_idx) > 0) {
				$select_size_sql = "
					SELECT
						PF.IDX						AS FILTER_IDX,
						PF.FILTER_NAME_".$country."	AS FILTER_NAME,
						PF.SIZE_TYPE				AS SIZE_TYPE
					FROM
						dev.PRODUCT_FILTER PF
					WHERE
						PF.IDX IN (".implode(",",$size_idx).") AND
						PF.FILTER_TYPE = 'SZ' AND
						PF.DEL_FLG = FALSE
					ORDER BY
						PF.SIZE_TYPE,FILTER_NAME ASC
				";
				
				$db->query($select_size_sql);
				
				$temp_size = array();
				
				foreach($db->fetch() as $size_data) {
					$filter_name = $size_data['FILTER_NAME'];
					$size_sort = substr($filter_name,0,1);
					if ($size_sort != "O" && $size_sort != "A") {
						$size_sort = "E";
					}
					
					$size_type = $size_data['SIZE_TYPE'];
					
					switch ($size_type) {
						case "UP" :
							$filter_sz_up[] = array(
								'size_sort'			=>$size_sort,
								'filter_idx'		=>$size_data['FILTER_IDX'],
								'filter_name'		=>$size_data['FILTER_NAME']
							);
							break;
						
						case "LW" :
							$filter_sz_lw[] = array(
								'size_sort'			=>$size_sort,
								'filter_idx'		=>$size_data['FILTER_IDX'],
								'filter_name'		=>$size_data['FILTER_NAME']
							);
							break;
						
						case "HT" :
							$filter_sz_ht[] = array(
								'size_sort'			=>$size_sort,
								'filter_idx'		=>$size_data['FILTER_IDX'],
								'filter_name'		=>$size_data['FILTER_NAME']
							);
							break;
						
						case "SH" :
							$filter_sz_sh[] = array(
								'size_sort'			=>$size_sort,
								'filter_idx'		=>$size_data['FILTER_IDX'],
								'filter_name'		=>$size_data['FILTER_NAME']
							);
							break;
						
						case "JW" :
							$filter_sz_jw[] = array(
								'size_sort'			=>$size_sort,
								'filter_idx'		=>$size_data['FILTER_IDX'],
								'filter_name'		=>$size_data['FILTER_NAME']
							);
							break;
						
						case "AC" :
							$filter_sz_ac[] = array(
								'size_sort'			=>$size_sort,
								'filter_idx'		=>$size_data['FILTER_IDX'],
								'filter_name'		=>$size_data['FILTER_NAME']
							);
							break;
						
						case "TA" :
							$filter_sz_ta[] = array(
								'size_sort'			=>$size_sort,
								'filter_idx'		=>$size_data['FILTER_IDX'],
								'filter_name'		=>$size_data['FILTER_NAME']
							);
							break;
					}
				}
			}
			
			$filter_sz[] = array(
				'filter_sz_up'		=>$filter_sz_up,
				'filter_sz_lw'		=>$filter_sz_lw,
				'filter_sz_ht'		=>$filter_sz_ht,
				'filter_sz_sh'		=>$filter_sz_sh,
				'filter_sz_jw'		=>$filter_sz_jw,
				'filter_sz_ac'		=>$filter_sz_ac,
				'filter_sz_ta'		=>$filter_sz_ta
			);
		}
		
		$select_fit_sql = "
			SELECT
				DISTINCT OM.FIT			AS FIT
			FROM
				dev.ORDERSHEET_MST OM
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				OM.IDX = PR.ORDERSHEET_IDX
				LEFT JOIN dev.PRODUCT_GRID PG ON
				PR.IDX = PG.PRODUCT_IDX
			WHERE
				PG.PAGE_IDX = ".$page_idx." AND
				PR.FILTER_FT = TRUE
		";
		
		$db->query($select_fit_sql);
		
		foreach($db->fetch() as $fit_data) {
			$filter_ft[] = array(
				'fit'	=>$fit_data['FIT']
			);
		}
		
		$select_line_sql = "
			SELECT
				LI.IDX					AS LINE_IDX,
				LI.LINE_NAME			AS LINE_NAME
			FROM
				dev.ORDERSHEET_MST OM
				LEFT JOIN dev.LINE_INFO LI ON
				OM.LINE_IDX = LI.IDX
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				OM.IDX = PR.ORDERSHEET_IDX
				LEFT JOIN dev.PRODUCT_GRID PG ON
				PR.IDX = PG.PRODUCT_IDX
			WHERE
				PG.PAGE_IDX = ".$page_idx." AND
				PR.FILTER_LN = TRUE
			GROUP BY
				LI.LINE_NAME
		";
		
		$db->query($select_line_sql);
		
		foreach($db->fetch() as $line_data) {
			$filter_ln[] = array(
				'line_idx'	=>$line_data['LINE_IDX'],
				'line_name'	=>$line_data['LINE_NAME']
			);
		}
		
		$select_graphic_sql = "
			SELECT
				DISTINCT OM.GRAPHIC		AS GRAPHIC
			FROM
				dev.ORDERSHEET_MST OM
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				OM.IDX = PR.ORDERSHEET_IDX
				LEFT JOIN dev.PRODUCT_GRID PG ON
				PR.IDX = PG.PRODUCT_IDX
			WHERE
				PG.PAGE_IDX = ".$page_idx." AND
				PR.FILTER_GP = TRUE
		";
		
		$db->query($select_graphic_sql);
		
		foreach($db->fetch() as $graphic_data) {
			$filter_gp[] = array(
				'graphic'	=>$graphic_data['GRAPHIC']
			);
		}
	}
	
	$filter_info = array(
		'filter_cl'		=>$filter_cl,
		'filter_ft'		=>$filter_ft,
		'filter_ln'		=>$filter_ln,
		'filter_gp'		=>$filter_gp,
		'filter_sz'		=>$filter_sz
	);
	
	return $filter_info;
}
?>