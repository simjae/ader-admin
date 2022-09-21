<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$page_idx               = $_POST['page_idx'];
$tmp_flg				= $_POST['tmp_flg'];

$tbl_grid = array();
if ($tmp_flg == "true") {
	$tbl_grid[0] = "dev.TMP_PRODUCT_GRID";
	$tbl_grid[1] = "dev.TMP_PRODUCT_GRID_COLUMN";
} else {
	$tbl_grid[0] = "dev.PRODUCT_GRID";
	$tbl_grid[1] = "dev.PRODUCT_GRID_COLUMN";
}

if($page_idx != null){
	$grid_sql= "SELECT
					IDX						AS GRID_IDX,
					DISPLAY_NUM				AS DISPLAY_NUM,
					GRID_TYPE				AS GRID_TYPE,
					GRID_SIZE				AS GRID_SIZE,
					PRODUCT_IDX				AS PRODUCT_IDX,
					PRODUCT_CODE			AS PRODUCT_CODE,
					GRID_CONTENT_URL		AS GRID_CONTENT_URL,
					GRID_BACKGROUND_COLOR	AS GRID_BACKGROUND_COLOR
				FROM
					".$tbl_grid[0]."
				WHERE
					PAGE_IDX = ".$page_idx." AND
					DEL_FLG = FALSE
				ORDER BY
					DISPLAY_NUM";
	
	$db->query($grid_sql);
	foreach($db->fetch() as $grid_data) {
		$grid_idx = $grid_data['GRID_IDX'];
		
		$json_data = "";
		
		$json_data .= '{';
		$json_data .= '    "grid_type":"'		.$grid_data['GRID_TYPE'].'",';
		$json_data .= '    "grid_size":"'		.$grid_data['GRID_SIZE']. '",';
		$json_data .= '    "product_idx":"'		.$grid_data['PRODUCT_IDX']. '",';
		$json_data .= '    "product_code":"'	.$grid_data['PRODUCT_CODE']. '",';
		$json_data .= '    "content_url":"'		.$grid_data['GRID_CONTENT_URL']. '",';
		$json_data .= '    "bg_color":"'		.$grid_data['GRID_BACKGROUND_COLOR'].'",';
		$json_data .= '    "data":[';
				
		if ($grid_idx > 0) {
			$column_sql  = "SELECT
								IDX,
								DISPLAY_NUM,
								GRID_COLUMN_TYPE,
								GRID_COLUMN_VALUE,
								GRID_COLUMN_STYLE
							FROM
								".$tbl_grid[1]."
							WHERE
								PAGE_IDX = ".$page_idx."
								AND GRID_IDX = ".$grid_idx."
								AND DEL_FLG = FALSE";
			$db->query($column_sql);
			
			$json_column_data = "";
			foreach($db->fetch() as $column_data) {
				$json_column_data .= '	{"idx":"'.$column_data['DISPLAY_NUM'].'","category_id":"'.$column_data['GRID_COLUMN_TYPE'].'","category":"'.$column_data['GRID_COLUMN_VALUE'].'","position":"'.$column_data['GRID_COLUMN_STYLE'].'"},';
			}
			
			$json_column_data = substr($json_column_data,0,-1);
			$json_data .= $json_column_data;
		}
		
		$json_data .= "        ]";
		$json_data .= '}';
		
		$json_result['data'][] = array(
			'display_num'			=>intval($grid_data['DISPLAY_NUM']),
			'grid_type'				=>$grid_data['GRID_TYPE'],
			'product_idx'			=>$grid_data['PRODUCT_IDX'],
			'product_code'			=>$grid_data['PRODUCT_CODE'],
			'content_url'			=>$grid_data['GRID_CONTENT_URL'],
			'bg_color'				=>$grid_data['GRID_BACKGROUND_COLOR'],
			'grid_background_color'	=>$grid_data['GRID_BACKGROUND_COLOR'],
			'json_data'				=>$json_data
		);
	}
}
?>