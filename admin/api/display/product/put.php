<?php
/*
 +=============================================================================
 | 
 | 상품 페이지 목록 - 일괄선택 후 복사&삭제
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$select_idx				= $_POST['select_idx'];
$action_type			= $_POST['action_type'];

$page_idx				= $_POST['page_idx'];				//idx
$page_title         	= $_POST['page_title'];				//페이지 타이틀
$page_memo     			= $_POST['page_memo'];				//페이지 비고

$display_member_level	= $_POST['display_member_level'];	//접근제한 타입
$member_level           = $_POST['member_level'];          	//접근대상 LEVEL LIST
$prodIp					= $_POST['prodIp'];             	//차단 IP LIST

$display_flg            = $_POST['display_flg'];        	//진열 플래그
$display_from     		= $_POST['display_from'];			//진열 시작일
$display_from_h     	= $_POST['display_from_h'];			//진열 시작시간 (시간)
$display_from_m     	= $_POST['display_from_m'];			//진열 시작시간 (분)
$display_to       		= $_POST['display_to'];				//진열 종료일
$display_to_h     		= $_POST['display_to_h'];			//진열 종료시간 (시간)
$display_to_m     		= $_POST['display_to_m'];			//진열 종료시간 (분)

$seo_exposure_flg		= $_POST['seo_exposure_flg'];		//검색엔진 노출 플래그
$seo_title				= $_POST['seo_title'];				//브라우저 타이틀
$seo_author				= $_POST['seo_author'];				//메타태그1
$seo_description		= $_POST['seo_description'];		//메타태그2
$seo_keywords			= $_POST['seo_keywords'];			//메타태그3
$seo_alt_text			= $_POST['seo_alt_text'];			//메타태그4

$where = " 1=1 ";
$idx_list="";
if ($select_idx != null) {
	$idx_list = implode(',',$select_idx);
	$where .= " AND IDX IN (".$idx_list.")";
} else if ($page_idx != null) {
	$where .= " AND IDX = ".$page_idx;
}

$sql = "";
if ($action_type != null) {
	switch ($action_type) {
		case "page_copy" :
			$db->query("SHOW TABLE STATUS WHERE NAME='PAGE_PRODUCT_DISPLAY'");
			$max_idx = 0;
			foreach($db->fetch() as $data) {
				$max_idx = intval($data['Auto_increment']);
			}
			
			for ($i=0; $i<count($select_idx); $i++) {
				$sql = "INSERT INTO dev.PAGE_PRODUCT_DISPLAY
						(
							PAGE_TITLE,
							PAGE_MEMO,
							PAGE_URL,
							PRODUCT_CNT,
							STOCK_OUT_CNT,
							DISPLAY_FLG,
							DISPLAY_START_DATE,
							DISPLAY_END_DATE,
							DISPLAY_LOCATION,
							SEO_EXPOSURE_FLG,
							SEO_TITLE,
							SEO_DESCRIPTION,
							SEO_KEYWORDS,
							SEO_ALT_TEXT,
							CREATER,
							UPDATER
						)
					SELECT    
						CONCAT(PAGE_TITLE,'_복사'),
						PAGE_MEMO,
						CONCAT(
							'/test/page/product?page_idx=',
							".$max_idx."
						),
						PRODUCT_CNT,
						STOCK_OUT_CNT,
						FALSE,
						DISPLAY_START_DATE,
						DISPLAY_END_DATE,
						DISPLAY_LOCATION,
						SEO_EXPOSURE_FLG,
						SEO_TITLE,
						SEO_DESCRIPTION,
						SEO_KEYWORDS,
						SEO_ALT_TEXT,
						'Admin',
						'Admin'
					FROM 
						dev.PAGE_PRODUCT_DISPLAY
					WHERE
						IDX = ".$select_idx[$i].";";
				$max_idx++;
				$db->query($sql);
			}
			
			break;
		
		case "page_delete" :
			$sql = "UPDATE
                    dev.PAGE_PRODUCT_DISPLAY
                SET
                    DEL_FLG = TRUE
                WHERE
                    ".$where;
			break;
		
		case "display_true" :
			$sql = "UPDATE
                    dev.PAGE_PRODUCT_DISPLAY
                SET
                    DISPLAY_FLG = TRUE
                WHERE
                    ".$where;
			break;
		
		case "display_false" :
			$sql = "UPDATE
                    dev.PAGE_PRODUCT_DISPLAY
                SET
                    DISPLAY_FLG = FALSE
                WHERE
                    ".$where;
			break;
	}
	
	if ($action_type != "page_copy") {
		$db->query($sql);
	}
}

if ($page_idx != null) {
	$display_level = "";
	if($display_member_level != null){
		switch($display_member_level){
			case 'all':
				$display_level = 'all';
				break;
			
			case 'member':
				$display_level = 'member';
				break;
			
			case 'level':
				if ($member_level != null) {
					$display_level = implode(',',$member_level);
				}
				break;
		}
	}

	$display_start_date = "";
	$display_end_date = "";
	if($display_flg != null){
		if ($display_flg == "true") {
			$display_start_date = "NOW()";
			$display_end_date = "9999-12-31 23:59";
		} else {
			$display_start_date = "'".$display_from." ".$display_from_h.":".$display_from_m."'";
			$display_end_date = $display_to." ".$display_to_h.":".$display_to_m;
		}
	}

	//상품 목록 페이지 등록
	$sql = "
		UPDATE 
			dev.PAGE_PRODUCT_DISPLAY
		SET
			PAGE_TITLE					= '".$page_title."',
			PAGE_MEMO					= '".$page_memo."',
			DISPLAY_MEMBER_LEVEL		= '".$display_level."',
			DISPLAY_START_DATE			= ".$display_start_date.",
			DISPLAY_END_DATE			= '".$display_end_date."',
			SEO_EXPOSURE_FLG			= ".$seo_exposure_flg.",
			SEO_TITLE					= '".$seo_title."',
			SEO_AUTHOR					= '".$seo_author."',
			SEO_DESCRIPTION				= '".$seo_description."',
			SEO_KEYWORDS				= '".$seo_keywords."',
			UPDATE_DATE					= NOW(),
			UPDATER						= 'Admin'
		WHERE
			".$where;
	$db->query($sql);

	//차단 IP 업데이트
	$db->query("DELETE FROM dev.IP_BAN WHERE PAGE_IDX = ".$page_idx);
	foreach($prodIp as $ip){
		$sql = "INSERT INTO dev.IP_BAN
				(
					PAGE_IDX,
					IP
				) VALUES (
					".$page_idx.",
					'".$ip."'
				)
		";
		$db->query($sql);
	}
}
?>