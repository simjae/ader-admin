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

$tbl_posting = array();
if ($tmp_flg == "true") {
	$tbl_posting[0] = "dev.TMP_DISPLAY_POSTING_EDITORIAL";
	$tbl_posting[1] = "dev.TMP_POSTING_IMG_EDITORIAL";
} else {
	$tbl_posting[0] = "dev.DISPLAY_POSTING_EDITORIAL";
	$tbl_posting[1] = "dev.POSTING_IMG_EDITORIAL";
}

if($page_idx != null){
	$posting_sql= "SELECT
					IDX						AS IDX,
					PAGE_IDX				AS PAGE_IDX,
					
					EDITORIAL_TITLE			AS EDITORIAL_TITLE,
					EDITORIAL_VIDEO_URL		AS EDITORIAL_VIDEO_URL
				FROM
					".$tbl_grid[0]."
				WHERE
					PAGE_IDX = ".$page_idx." AND
					DEL_FLG = FALSE";
	
	$db->query($posting_sql);
	foreach($db->fetch() as $posting_data) {
		$editorial_idx = $posting_data['IDX'];
		
		if ($editorial_idx > 0) {
			$img_sql = "SELECT
							IDX,
							IMG_TYPE,
							IMG_LOCATION,
							IMG_URL
						FROM
							".$tbl_grid[1]."
						WHERE
							PAGE_IDX = ".$page_idx."
							AND EDITORIAL_IDX = ".$editorial_idx."
							AND DEL_FLG = FALSE";
			$db->query($img_sql);
			
			$img_result = array();
			foreach($db->fetch() as $img_data) {
				$img_result['data'][] = array(
					'img_idx'			=>intval($img_data['IDX']),
					'img_type'			=>$img_data['IMG_TYPE'],
					'img_location'		=>$img_data['IMG_LOCATION'],
					'img_url'			=>$img_data['IMG_URL']
				);
			}
		}
		
		$json_result['data'][] = array(
			'idx'					=>intval($posting_data['IDX']),
			'page_idx'				=>$posting_data['PAGE_IDX'],
			'editorial_title'		=>$posting_data['EDITORIAL_TITLE'],
			
			'editorial_video_url'	=>$posting_data['EDITORIAL_VIDEO_URL'],
			
			'img_result'			=>$img_result
		);
	}
}
?>