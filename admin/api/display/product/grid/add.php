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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();

$tmp_flg				= $_POST['tmp_flg'];

$page_idx               = $_POST['page_idx'];
$json_param				= $_POST['json_param'];

$db->begin_transaction();

try {
	//tmp_flg 확인 후 상품 전시정보 저장 테이블 설정		tmp_flg : TRUE[진열 그리드/진열 그리드 칼럼 테이블] / FALSE[tmp_진열 그리드/tmp_진열 그리드 칼럼 테이블]
	$tbl_grid = array();
	if ($tmp_flg == "true") {
		$tbl_grid[0] = "TMP_PRODUCT_GRID";
		$tbl_grid[1] = "TMP_GRID_COLUMN";
	} else if ($tmp_flg == "false") {
		$tbl_grid[0] = "PRODUCT_GRID";
		$tbl_grid[1] = "GRID_COLUMN";
		
		//임시저장이 아닌 경우 상품 전시정보 저장 전 기존 진열 진열 그리드/진열 그리드 칼럼 테이블 논리 삭제
		$update_grid_sql = "UPDATE PRODUCT_GRID SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
		$db->query($update_grid_sql);

		$update_grid_column_sql = "UPDATE GRID_COLUMN SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
		$db->query($update_grid_column_sql);
	}

	//상품 전시정보 저장 전 진열 tmp_진열 그리드/tmp_진열 그리드 칼럼 테이블 물리 삭제
	$delete_tmp_grid_sql = "DELETE FROM TMP_PRODUCT_GRID WHERE PAGE_IDX = ".$page_idx;
	$db->query($delete_tmp_grid_sql);
	
	$delete_tmp_grid_column_sql = "DELETE FROM TMP_GRID_COLUMN WHERE PAGE_IDX = ".$page_idx;
	$db->query($delete_tmp_grid_column_sql);
	
	if($page_idx != null && $json_param != null){
		$json_arr = json_decode($json_param,true);
		
		$display_num = 1;
		foreach($json_arr AS $row) {
			$grid_row = json_decode($row);
			
			$grid_type = $grid_row->grid_type;
			$background_color = $grid_row->bg_color;
			if ($background_color != "null") {
				$background_color = "'".$background_color."'";
			}
			
			$link_url = "";
			if ($grid_type == "PRD") {
				$link_url = "product/detail?product_idx=".$grid_row->product_idx;
			} else {
				$grid_type = $grid_row->banner_type;
			}
			
			$insert_grid_sql = "
				INSERT INTO
					".$tbl_grid[0]."
				(
					PAGE_IDX,
					DISPLAY_NUM,
					TYPE,
					BACKGROUND_COLOR,
					SIZE,
					BANNER_IDX,
					PRODUCT_IDX,
					PRODUCT_CODE,
					LINK_URL,
					CREATER,
					UPDATER
				) VALUES (
					".$page_idx.",
					".$display_num.",
					'".$grid_type."',
					".$background_color.",
					".$grid_row->grid_size.",
					".$grid_row->banner_idx.",
					".$grid_row->product_idx.",
					'".$grid_row->product_code."',
					'".$link_url."',
					'".$session_id."',
					'".$session_id."'
				)
			";
			
			$db->query($insert_grid_sql);
			
			$grid_idx = $db->last_id();
			if (!empty($grid_idx)) {
				$display_num++;
			}
			
			$column_data = $grid_row->data;
			if ($column_data != null) {
				foreach($column_data AS $column_row) {
					$insert_column_sql = "
						INSERT INTO
							".$tbl_grid[1]."
						(
							PAGE_IDX,
							GRID_IDX,
							
							COLUMN_TYPE_01,
							COLUMN_TYPE_02,
							COLUMN_TYPE_03,
							COLUMN_TYPE_04,
							COLUMN_TYPE_05,
							COLUMN_TYPE_06,
							COLUMN_TYPE_07,
							COLUMN_TYPE_08,
							COLUMN_TYPE_09,
							COLUMN_TYPE_10,
							COLUMN_TYPE_11,
							COLUMN_TYPE_12,
							COLUMN_TYPE_13,
							COLUMN_TYPE_14,
							
							COLUMN_ALIGN_01,
							COLUMN_ALIGN_02,
							COLUMN_ALIGN_03,
							COLUMN_ALIGN_04,
							COLUMN_ALIGN_05,
							COLUMN_ALIGN_06,
							COLUMN_ALIGN_07,
							COLUMN_ALIGN_08,
							COLUMN_ALIGN_09,
							COLUMN_ALIGN_10,
							COLUMN_ALIGN_11,
							COLUMN_ALIGN_12,
							COLUMN_ALIGN_13,
							COLUMN_ALIGN_14,
							
							CREATER,
							UPDATER
						) VALUES (
							".$page_idx.",
							".$grid_idx.",
							
							".$column_row->column_type_01.",
							".$column_row->column_type_02.",
							".$column_row->column_type_03.",
							".$column_row->column_type_04.",
							".$column_row->column_type_05.",
							".$column_row->column_type_06.",
							".$column_row->column_type_07.",
							".$column_row->column_type_08.",
							".$column_row->column_type_09.",
							".$column_row->column_type_10.",
							".$column_row->column_type_11.",
							".$column_row->column_type_12.",
							".$column_row->column_type_13.",
							".$column_row->column_type_14.",
							
							".$column_row->column_align_01.",
							".$column_row->column_align_02.",
							".$column_row->column_align_03.",
							".$column_row->column_align_04.",
							".$column_row->column_align_05.",
							".$column_row->column_align_06.",
							".$column_row->column_align_07.",
							".$column_row->column_align_08.",
							".$column_row->column_align_09.",
							".$column_row->column_align_10.",
							".$column_row->column_align_11.",
							".$column_row->column_align_12.",
							".$column_row->column_align_13.",
							".$column_row->column_align_14.",
							
							'".$session_id."',
							'".$session_id."'
						)
					";
					
					$db->query($inser_column_sql);
				}
			}
		}
	}
	
	$db->commit();
} catch(mysqli_sql_exception $exception){
	$db->rollback();
	$json_result['code'] = 301;
	$json_result['msg'] = "상품 진열정보 저장처리중 에러가 발생했습니다. 진열 하려는 상품의 진열정보를 확인해주세요.";
}
?>