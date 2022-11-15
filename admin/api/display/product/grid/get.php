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
	$tbl_grid[0] = "dev.TMP_PRODUCT_GRID PG";
	$tbl_grid[1] = "dev.TMP_GRID_COLUMN GC";
} else {
	$tbl_grid[0] = "dev.PRODUCT_GRID PG";
	$tbl_grid[1] = "dev.GRID_COLUMN GC";
}

if($page_idx != null){
	$grid_sql= "SELECT
					PG.IDX						AS GRID_IDX,
					PG.DISPLAY_NUM				AS DISPLAY_NUM,
					PG.TYPE						AS TYPE,
					CASE
						WHEN
							PG.TYPE = 'IMG'
							THEN
								(
									SELECT
										REPLACE(S_CI.IMG_LOCATION,'/var/www/admin/www','')
									FROM
										dev.CONTENTS_IMG S_CI
									WHERE
										S_CI.IDX = PG.CONTENT_IDX AND
										S_CI.IMG_SIZE = 'M'
								)
						
						WHEN
							PG.TYPE = 'VID'
							THEN
								(
									SELECT
										REPLACE(S_CV.BANNER_LOCATION,'/var/www/admin/www','')
									FROM
										dev.CONTENTS_VID S_CV
									WHERE
										S_CV.IDX = PG.CONTENT_IDX
								)
						
						WHEN
							PG.TYPE = 'PRD'
							THEN
								(
									SELECT
										REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
									FROM
										dev.PRODUCT_IMG S_PI
									WHERE
										S_PI.PRODUCT_IDX = PG.PRODUCT_IDX AND
										S_PI.IMG_TYPE = 'P' AND
										S_PI.IMG_SIZE = 'M'
									ORDER BY
										S_PI.IDX ASC
									LIMIT
										0,1
								)
					END							AS CONTENT_LOCATION,
					PG.SIZE						AS SIZE,
					PG.BACKGROUND_COLOR			AS BACKGROUND_COLOR,
					PG.PRODUCT_IDX				AS PRODUCT_IDX,
					PG.PRODUCT_CODE				AS PRODUCT_CODE
				FROM
					".$tbl_grid[0]."
				WHERE
					PG.PAGE_IDX = ".$page_idx." AND
					PG.DEL_FLG = FALSE
				ORDER BY
					PG.DISPLAY_NUM";
	
	$db->query($grid_sql);
	foreach($db->fetch() as $grid_data) {
		$grid_idx = $grid_data['GRID_IDX'];
				
		if ($grid_idx != null) {
			$column_cnt = $db->count($tbl_grid[1],"GC.PAGE_IDX = ".$page_idx." AND GC.GRID_IDX = ".$grid_idx." AND GC.DEL_FLG = FALSE");
			
			$column_info = array();
			if ($column_cnt > 0) {
				$column_sql  = "SELECT
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
									GC.DEL_FLG = FALSE";
				$db->query($column_sql);
				
				foreach($db->fetch() as $column_data) {
					$json_result[] = array(
						'column_idx'			=>$column_data['DISPLAY_NUM'],
						
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

						'column_alignidx_01'		=>$column_data['COLUMN_ALIGN_01'],
						'column_alignidx_02'		=>$column_data['COLUMN_ALIGN_02'],
						'column_alignidx_03'		=>$column_data['COLUMN_ALIGN_03'],
						'column_alignidx_04'		=>$column_data['COLUMN_ALIGN_04'],
						'column_alignidx_05'		=>$column_data['COLUMN_ALIGN_05'],
						'column_alignidx_06'		=>$column_data['COLUMN_ALIGN_06'],
						'column_alignidx_07'		=>$column_data['COLUMN_ALIGN_07'],
						'column_alignidx_08'		=>$column_data['COLUMN_ALIGN_08'],
						'column_alignidx_09'		=>$column_data['COLUMN_ALIGN_09'],
						'column_alignidx_10'		=>$column_data['COLUMN_ALIGN_10'],
						'column_alignidx_11'		=>$column_data['COLUMN_ALIGN_11'],
						'column_alignidx_12'		=>$column_data['COLUMN_ALIGN_12'],
						'column_alignidx_13'		=>$column_data['COLUMN_ALIGN_13'],
						'column_alignidx_14'		=>$column_data['COLUMN_ALIGN_14']
					);
				}
			}
			
			$json_result['data'][] = array(
				'grid_idx'			=>$grid_data['GRID_IDX'],
				'display_num'		=>$grid_data['DISPLAY_NUM'],
				'type'				=>$grid_data['TYPE'],
				'content_location'	=>$grid_data['CONTENT_LOCATION'],
				'size'				=>$grid_data['SIZE'],
				'background_color'	=>$grid_data['BACKGROUND_COLOR'],
				'product_idx'		=>$grid_data['PRODUCT_IDX'],
				'product_code'		=>$grid_data['PRODUCT_CODE'],
				'column_info'		=>$column_info
			);
		}
	}
}
?>