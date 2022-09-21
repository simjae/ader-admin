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
$tmp_flg				= $_POST['tmp_flg'];
$page_idx               = $_POST['page_idx'];

$json_param				= $_POST['json_param'];

//tmp_flg 확인 후 상품 전시정보 저장 테이블 설정		tmp_flg : TRUE[진열 그리드/진열 그리드 칼럼 테이블] / FALSE[tmp_진열 그리드/tmp_진열 그리드 칼럼 테이블]
$tbl_grid = array();
if ($tmp_flg == "true") {
	$tbl_grid[0] = "dev.TMP_PRODUCT_GRID";
	$tbl_grid[1] = "dev.TMP_PRODUCT_GRID_COLUMN";
} else if ($tmp_flg == "false") {
	$tbl_grid[0] = "dev.PRODUCT_GRID";
	$tbl_grid[1] = "dev.PRODUCT_GRID_COLUMN";
	
	//임시저장이 아닌 경우 상품 전시정보 저장 전 기존 진열 진열 그리드/진열 그리드 칼럼 테이블 논리 삭제
	$update_grid_sql = "UPDATE dev.PRODUCT_GRID SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
	$db->query($update_grid_sql);

	$update_grid_column_sql = "UPDATE dev.PRODUCT_GRID_COLUMN SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
	$db->query($update_grid_column_sql);
}

//상품 전시정보 저장 전 진열 tmp_진열 그리드/tmp_진열 그리드 칼럼 테이블 물리 삭제
$delete_tmp_grid_sql = "DELETE FROM dev.TMP_PRODUCT_GRID WHERE PAGE_IDX = ".$page_idx;
$db->query($delete_tmp_grid_sql);

$delete_tmp_grid_column_sql = "DELETE FROM dev.TMP_PRODUCT_GRID_COLUMN WHERE PAGE_IDX = ".$page_idx;
$db->query($delete_tmp_grid_column_sql);

if($page_idx != null && $json_param != null){
	$json_arr = json_decode($json_param,true);
	
	$display_num = 1;
	foreach($json_arr AS $row) {
		$grid_row = json_decode($row);
		
		$link_url = "";
		if ($grid_row->grid_type == "PRD") {
			$link_url = "test/link/product?idx=".$grid_row->product_idx;
		}
		
		$grid_sql = "INSERT INTO
						".$tbl_grid[0]."
					(
						PAGE_IDX,
						DISPLAY_NUM,
						GRID_TYPE,
						GRID_CONTENT_URL,
						GRID_LINK_URL,
						GRID_SIZE,
						GRID_BACKGROUND_COLOR,
						PRODUCT_IDX,
						PRODUCT_CODE,
						CREATE_DATE,
						CREATER,
						UPDATE_DATE,
						UPDATER
					) VALUES (
						".$page_idx.",
						".$display_num.",
						'".$grid_row->grid_type."',
						'".$grid_row->content_url."',
						'".$link_url."',
						".$grid_row->grid_size.",
						'".$grid_row->bg_color."',
						'".$grid_row->product_idx."',
						'".$grid_row->product_code."',
						NOW(),
						'Admin',
						NOW(),
						'Admin'
					)";
		$db->query($grid_sql);
		
		$grid_idx = $db->last_id();
		if ($grid_idx != null) {
			$display_num++;
		}
		
		$column_data = $grid_row->data;
		if ($column_data != null) {
			
			foreach($column_data AS $column_row) {
				$column_sql = "INSERT INTO
									".$tbl_grid[1]."
								(
									PAGE_IDX,
									GRID_IDX,
									DISPLAY_NUM,
									GRID_COLUMN_TYPE,
									GRID_COLUMN_VALUE,
									GRID_COLUMN_STYLE,
									CREATE_DATE,
									CREATER,
									UPDATE_DATE,
									UPDATER
								) VALUES (
									".$page_idx.",
									".$grid_idx.",
									".$column_row->idx.",
									'".$column_row->category_id."',
									'".$column_row->category."',
									'".$column_row->position."',
									NOW(),
									'Admin',
									NOW(),
									'Admin'
								)";
				
				$db->query($column_sql);
			}
		}
	}
}
?>