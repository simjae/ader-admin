<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지 - 진열 한 상품 조회
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
	$tbl_grid[0] = "dev.TMP_PRODUCT_GRID PG";
	$tbl_grid[1] = "dev.TMP_GRID_COLUMN GC";
} else {
	$tbl_grid[0] = "dev.PRODUCT_GRID PG";
	$tbl_grid[1] = "dev.GRID_COLUMN GC";
}

if($page_idx != null){
	$select_grid_sql = "
		SELECT
			PG.IDX						AS GRID_IDX,
			PG.DISPLAY_NUM				AS DISPLAY_NUM,
			PG.TYPE						AS TYPE,
			PG.SIZE						AS SIZE,
			PG.BACKGROUND_COLOR			AS BACKGROUND_COLOR,
			PG.BANNER_IDX				AS BANNER_IDX,
			PG.PRODUCT_IDX				AS PRODUCT_IDX,
			IFNULL(
				PG.PRODUCT_CODE,'-'
			)							AS PRODUCT_CODE
		FROM
			".$tbl_grid[0]."
		WHERE
			PG.PAGE_IDX = ".$page_idx." AND
			PG.DEL_FLG = FALSE
		ORDER BY
			PG.DISPLAY_NUM
	";
	
	$db->query($select_grid_sql);
	
	foreach($db->fetch() as $grid_data) {
		$grid_idx = $grid_data['GRID_IDX'];
		
		$grid_type = $grid_data['TYPE'];
		
		$banner_idx = $grid_data['BANNER_IDX'];
		$product_idx = $grid_data['PRODUCT_IDX'];
		
		$content_location = null;
		if ($banner_idx > 0 || $product_idx > 0) {
			$banner_table = "";
			
			$select_img_sql = "";
			$select_product_img_sql = "";
			$select_banner_img_sql = "";
			switch ($grid_type) {
				case "PRD" :
					$select_product_img_sql = "
						SELECT
							REPLACE(
								PI.IMG_LOCATION,
								'/var/www/admin/www',
								''
							)		AS CONTENT_LOCATION
						FROM
							dev.PRODUCT_IMG PI
						WHERE
							PI.PRODUCT_IDX = ".$product_idx." AND
							PI.IMG_TYPE = 'P' AND
							PI.IMG_SIZE = 'M'
						ORDER BY
							PI.IDX ASC
						LIMIT
							0,1
					";
					
					break;
				case "HED" :
					$banner_table = "dev.BANNER_HEAD BI";
					break;
				
				case "IMG" :
					$banner_table = "dev.BANNER_IMG BI";
					break;
				
				case "VID" :
					$banner_table = "dev.BANNER_VID BI";
					break;
			}
			
			if ($grid_type != "PRD") {
				if ($grid_type != "VID") {
					$select_banner_img_sql = "
						SELECT
							REPLACE(
								BI.BANNER_LOCATION,
								'/var/www/admin/www',
								''
							)		AS CONTENT_LOCATION
						FROM
							".$banner_table."
						WHERE
							BI.IDX = ".$banner_idx." AND
							BI.DEL_FLG = FALSE
					";
				} else {
					$select_banner_img_sql = "
						SELECT
							REPLACE(
								BI.BANNER_PREVIEW,
								'/var/www/admin/www',
								''
							)		AS CONTENT_LOCATION
						FROM
							".$banner_table."
						WHERE
							BI.IDX = ".$banner_idx." AND
							BI.DEL_FLG = FALSE
					";
				}
			}
			
			if (strlen($select_product_img_sql) > 0) {
				$select_img_sql = $select_product_img_sql;
			} else if (strlen($select_banner_img_sql) > 0) {
				$select_img_sql = $select_banner_img_sql;
			}
			
			$db->query($select_img_sql);
			
			foreach($db->fetch() as $img_data) {
				$content_location = $img_data['CONTENT_LOCATION'];
			}
		}
		
		if ($grid_idx != null && $grid_type == "PRD") {
			$column_cnt = $db->count($tbl_grid[1],"GC.PAGE_IDX = ".$page_idx." AND GC.GRID_IDX = ".$grid_idx." AND GC.DEL_FLG = FALSE");
			
			$column_info = array();
			if ($column_cnt > 0) {
				$select_column_sql = "
					SELECT
						GC.IDX					AS COLUMN_IDX,
						
						GC.COLUMN_TYPE_01		AS COLUMN_TYPE_01,
						GC.COLUMN_TYPE_02		AS COLUMN_TYPE_02,
						GC.COLUMN_TYPE_03		AS COLUMN_TYPE_03,
						GC.COLUMN_TYPE_04		AS COLUMN_TYPE_04,
						GC.COLUMN_TYPE_05		AS COLUMN_TYPE_05,
						GC.COLUMN_TYPE_06		AS COLUMN_TYPE_06,
						GC.COLUMN_TYPE_07		AS COLUMN_TYPE_07,
						GC.COLUMN_TYPE_08		AS COLUMN_TYPE_08,
						GC.COLUMN_TYPE_09		AS COLUMN_TYPE_09,
						GC.COLUMN_TYPE_10		AS COLUMN_TYPE_10,
						GC.COLUMN_TYPE_11		AS COLUMN_TYPE_11,
						GC.COLUMN_TYPE_12		AS COLUMN_TYPE_12,
						GC.COLUMN_TYPE_13		AS COLUMN_TYPE_13,
						GC.COLUMN_TYPE_14		AS COLUMN_TYPE_14,
						
						GC.COLUMN_ALIGN_01		AS COLUMN_ALIGN_01,
						GC.COLUMN_ALIGN_02		AS COLUMN_ALIGN_02,
						GC.COLUMN_ALIGN_03		AS COLUMN_ALIGN_03,
						GC.COLUMN_ALIGN_04		AS COLUMN_ALIGN_04,
						GC.COLUMN_ALIGN_05		AS COLUMN_ALIGN_05,
						GC.COLUMN_ALIGN_06		AS COLUMN_ALIGN_06,
						GC.COLUMN_ALIGN_07		AS COLUMN_ALIGN_07,
						GC.COLUMN_ALIGN_08		AS COLUMN_ALIGN_08,
						GC.COLUMN_ALIGN_09		AS COLUMN_ALIGN_09,
						GC.COLUMN_ALIGN_10		AS COLUMN_ALIGN_10,
						GC.COLUMN_ALIGN_11		AS COLUMN_ALIGN_11,
						GC.COLUMN_ALIGN_12		AS COLUMN_ALIGN_12,
						GC.COLUMN_ALIGN_13		AS COLUMN_ALIGN_13,
						GC.COLUMN_ALIGN_14		AS COLUMN_ALIGN_14
					FROM
						".$tbl_grid[1]."
					WHERE
						GC.PAGE_IDX = ".$page_idx." AND
						GC.GRID_IDX = ".$grid_idx." AND
						GC.DEL_FLG = FALSE
				";
				
				$db->query($select_column_sql);
				
				foreach($db->fetch() as $column_data) {
					$column_info[] = array(
						'column_type_01'			=>$column_data['COLUMN_TYPE_01'],
						'column_type_02'			=>$column_data['COLUMN_TYPE_02'],
						'column_type_03'			=>$column_data['COLUMN_TYPE_03'],
						'column_type_04'			=>$column_data['COLUMN_TYPE_04'],
						'column_type_05'			=>$column_data['COLUMN_TYPE_05'],
						'column_type_06'			=>$column_data['COLUMN_TYPE_06'],
						'column_type_07'			=>$column_data['COLUMN_TYPE_07'],
						'column_type_08'			=>$column_data['COLUMN_TYPE_08'],
						'column_type_09'			=>$column_data['COLUMN_TYPE_09'],
						'column_type_10'			=>$column_data['COLUMN_TYPE_10'],
						'column_type_11'			=>$column_data['COLUMN_TYPE_11'],
						'column_type_12'			=>$column_data['COLUMN_TYPE_12'],
						'column_type_13'			=>$column_data['COLUMN_TYPE_13'],
						'column_type_14'			=>$column_data['COLUMN_TYPE_14'],

						'column_align_01'		=>$column_data['COLUMN_ALIGN_01'],
						'column_align_02'		=>$column_data['COLUMN_ALIGN_02'],
						'column_align_03'		=>$column_data['COLUMN_ALIGN_03'],
						'column_align_04'		=>$column_data['COLUMN_ALIGN_04'],
						'column_align_05'		=>$column_data['COLUMN_ALIGN_05'],
						'column_align_06'		=>$column_data['COLUMN_ALIGN_06'],
						'column_align_07'		=>$column_data['COLUMN_ALIGN_07'],
						'column_align_08'		=>$column_data['COLUMN_ALIGN_08'],
						'column_align_09'		=>$column_data['COLUMN_ALIGN_09'],
						'column_align_10'		=>$column_data['COLUMN_ALIGN_10'],
						'column_align_11'		=>$column_data['COLUMN_ALIGN_11'],
						'column_align_12'		=>$column_data['COLUMN_ALIGN_12'],
						'column_align_13'		=>$column_data['COLUMN_ALIGN_13'],
						'column_align_14'		=>$column_data['COLUMN_ALIGN_14']
					);
				}
			}
		}
		
		$json_result['data'][] = array(
			'grid_idx'			=>$grid_data['GRID_IDX'],
			'display_num'		=>$grid_data['DISPLAY_NUM'],
			'type'				=>$grid_type,
			'content_location'	=>$content_location,
			'size'				=>$grid_data['SIZE'],
			'background_color'	=>$grid_data['BACKGROUND_COLOR'],
			'banner_idx'		=>$grid_data['BANNER_IDX'],
			'product_idx'		=>$product_idx,
			'product_code'		=>$grid_data['PRODUCT_CODE'],
			'column_info'		=>$column_info
		);
	}
}
?>