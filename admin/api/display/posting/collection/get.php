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
	$tbl_posting[0] = "dev.TMP_DISPLAY_POSTING_COLLECTION";
	$tbl_posting[1] = "dev.TMP_POSTING_IMG_COLLECTION";
} else {
	$tbl_posting[0] = "dev.DISPLAY_POSTING_COLLECTION";
	$tbl_posting[1] = "dev.POSTING_IMG_COLLECTION";
}

if($page_idx != null){
	$posting_sql= "SELECT
					IDX						AS IDX,
					PAGE_IDX				AS PAGE_IDX,
					
					COLLECTION_TITLE		AS COLLECTION_TITLE,
					COLLECTION_VIDEO_URL	AS COLLECTION_VIDEO_URL
				FROM
					".$tbl_grid[0]."
				WHERE
					PAGE_IDX = ".$page_idx." AND
					DEL_FLG = FALSE";
	
	$db->query($posting_sql);
	foreach($db->fetch() as $posting_data) {
		$collection_idx = $posting_data['IDX'];
		
		if ($collection_idx > 0) {
			$img_sql = "SELECT
							IDX,
							IMG_TYPE,
							IMG_LOCATION,
							IMG_URL
						FROM
							".$tbl_grid[1]."
						WHERE
							PAGE_IDX = ".$page_idx."
							AND COLLECTION_IDX = ".$collection_idx."
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
			'idx'							=>intval($posting_data['IDX']),
			'page_idx'						=>$posting_data['PAGE_IDX'],
			'collection_title'			=>$posting_data['COLLABORATION_DATE'],
			
			'collaboration_video_url'		=>$posting_data['COLLABORATION_VIDEO_URL'],
			
			'img_result'					=>$img_result
		);
	}
}
?>