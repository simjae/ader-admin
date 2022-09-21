<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 조회 API
 | -------
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
$board_idx			= $_POST['board_idx'];				//IDX
$tab_num			= $_POST['tab_num'];				//Tab Num : board type11
$subtab_num			= $_POST['subtab_num'];				//Sub Tab Num

$board_country      = $_POST['board_country'];        	//쇼핑몰 국가
$board_category     = $_POST['board_category'];        	//게시판 카테고리
$sel_exposure_view  = $_POST['sel_exposure_view']; 		//스팸 관리
$answer_state       = $_POST['answer_state'];        	//답변 상태
$reply_flg      	= $_POST['reply_flg'];        		//댓글 사용 여부
$reply_count     	= $_POST['reply_count'];        	//댓글 유무
$file_flg         	= $_POST['file_flg'];        		//첨부파일 여부
$admin_flg    		= $_POST['admin_flg'];        		//관리자글 보기 유무
$report_status       = $_POST['report_status'];        	//신고 상태

$eSearchComment 	= $_POST['eSearchComment'];			//
$search_type        = $_POST['search_type'];        	//검색 타입
$search_keyword     = $_POST['search_keyword']; 		//검색 키워드

$search_date        = $_POST['search_date'];
$create_from        = $_POST['create_from'];     		//등록일 검색 시작일자
$create_to          = $_POST['create_to'];      		//등록일 검색 종료일자

$code_mst					= array();
$member_level				= array();
$administrator_permision	= array();
$origin_report 				= array();

$rows = $_POST['rows'];
$page = $_POST['page'];
$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

$where = ' 1=1 ';

/** 검색 조건 **/
$cnt_where = "";
/* 탭에 따라 참조 테이블이 상이함 */
if($tab_num != null){
	
	if($tab_num != '02'){
		$main_table_alias = 'BOARD';
		switch($tab_num){
			case '01':
				$board_type = 'ONE';
				$tables = "	dev.DISPLAY_BOARD AS BOARD 	LEFT JOIN
								dev.MEMBER 		  AS MEMBER
							ON	BOARD.MEMBER_NAME = MEMBER.NAME
							AND	BOARD.CREATER = MEMBER.ID";
				break;
			case '03':
				$board_type = 'NOT';
				$tables = "	dev.DISPLAY_BOARD AS BOARD 	LEFT JOIN
								dev.ADMINISTRATOR AS ADMIN
							ON	BOARD.MEMBER_NAME = ADMIN.NAME
							AND	BOARD.CREATER = ADMIN.ID";
				break;
			case '04':
				$board_type = 'FAQ';
				$tables = "	dev.DISPLAY_BOARD AS BOARD 	LEFT JOIN
								dev.ADMINISTRATOR AS ADMIN
							ON	BOARD.MEMBER_NAME = ADMIN.NAME
							AND	BOARD.CREATER = ADMIN.ID";
				break;
		}
		$where .= " AND BOARD.BOARD_TYPE='".$board_type."' 
					AND BOARD.DEL_FLG = FALSE ";
		
		$cnt_where .= $where;
	}
	else{
		switch($subtab_num){
			case '01':
				$main_table_alias = 'REVIEW';
				$tables = '	dev.DISPLAY_BOARD_REVIEW AS REVIEW LEFT JOIN
							dev.MEMBER AS MEMBER
						ON	REVIEW.MEMBER_NAME = MEMBER.NAME
						AND	REVIEW.CREATER = MEMBER.ID';
				break;
			case '02':
				$main_table_alias = 'REPLY';
				$tables = ' dev.DISPLAY_BOARD_REVIEW_REPLY AS REPLY LEFT JOIN
							dev.ADMINISTRATOR AS ADMIN
						ON	REPLY.MEMBER_NAME = ADMIN.NAME
						AND	REPLY.CREATER = ADMIN.ID				LEFT JOIN
							dev.DISPLAY_BOARD_REVIEW AS REVIEW
						ON	REPLY.REVIEW_IDX = REVIEW.IDX';
				break;
			case '03':
				$main_table_alias = 'REPORT';
				$tables = " 	((SELECT 
										REPORT.IDX,
										REPORT.REPORT_DIVISION,
										REPORT.REPORT_TYPE,
										REPORT.REASON,
										REPORT.REPORT_IDX,
										REPORT.PROCESSING_FLG,
										REVIEW.STATUS		AS ORIGIN_STATUS,
										REVIEW.TITLE		AS ORIGIN_TITLE,
										REVIEW.MEMBER_NAME 	AS ORIGIN_NAME,
										REVIEW.CREATE_DATE	AS ORIGIN_DATE,
										REVIEW.CREATER		AS ORIGIN_ID,
										REVIEW.IP			AS ORIGIN_IP,
										REPORT.CREATE_DATE,
										REPORT.CREATER,
										REPORT.UPDATE_DATE,
										REPORT.UPDATER
									FROM 
										dev.DISPLAY_BOARD_REPORT 		AS REPORT LEFT JOIN
										dev.DISPLAY_BOARD_REVIEW 		AS REVIEW
									ON 	
										REPORT.REPORT_IDX = REVIEW.IDX
									WHERE
										REPORT.REPORT_DIVISION = 'BOARD')
									UNION
									(SELECT 
										REPORT.IDX,
										REPORT.REPORT_DIVISION,
										REPORT.REPORT_TYPE,
										REPORT.REASON,
										REPORT.REPORT_IDX,
										REPORT.PROCESSING_FLG,
										NULL				AS ORIGIN_STATUS,
										REPLY.CONTENTS		AS ORIGIN_TITLE,
										REPLY.MEMBER_NAME 	AS ORIGIN_NAME,
										REPLY.CREATE_DATE	AS ORIGIN_DATE,
										REPLY.CREATER		AS ORIGIN_ID,
										NULL				AS ORIGIN_IP,
										REPORT.CREATE_DATE,
										REPORT.CREATER,
										REPORT.UPDATE_DATE,
										REPORT.UPDATER
									FROM 
										dev.DISPLAY_BOARD_REPORT 		AS REPORT LEFT JOIN
										dev.DISPLAY_BOARD_REVIEW_REPLY 	AS REPLY
									ON	
										REPORT.REPORT_IDX = REPLY.IDX
									WHERE
										REPORT.REPORT_DIVISION = 'REPLY'))		AS REPORT LEFT JOIN
									dev.MEMBER									AS MEMBER
								ON	REPORT.ORIGIN_ID = MEMBER.ID
							";
					break;
			}
			$cnt_where .= $where;
		}
	}

	/* 검색조건 : 쇼핑몰 */
	if($board_country != null){
		if($tab_num == '02' && $subtab_num == '02'){
			$where .= 	" AND REPLY.REVIEW_IDX IN ( SELECT 
														IDX 
													FROM 
														dev.DISPLAY_BOARD_REVIEW 
													WHERE 
														COUNTRY = '".$board_country."') 
							";
		}
		else if($tab_num == '02' && $subtab_num == '03'){
			$where .= 	" AND REPORT.REPORT_IDX IN ( SELECT 
														IDX 
													FROM 
														dev.DISPLAY_BOARD_REVIEW 
													WHERE 
														COUNTRY = '".$board_country."') 
							";
		}
		else{
			$where .= " AND ".$main_table_alias.".COUNTRY = '".$board_country."' ";
		}
	}
	/* 검색조건 : 게시판 카테고리 */
	if ($board_category != null) {
		$where .=  " AND BOARD.CATEGORY = '".$board_category."' ";
	}
	/* 검색조건 : 신고 상태 */
	if($report_status != null){
		if($tab_num == '02' && $subtab_num == '03'){
			$where .= 	" AND REPORT.REPORT_IDX IN ( SELECT 
														IDX 
													FROM 
														dev.DISPLAY_BOARD_REVIEW 
													WHERE 
														STATUS = '".$report_status."') 
						";
		}
		else{
			if ($report_status != null) {
				$where .=  " AND REVIEW.STATUS = '".$report_status."' ";
			} 
		}
	}
	if ($answer_state != null) {
		$where .=  " AND BOARD.ANSWER_STATE = '".$answer_state."' ";
	}
	/* 검색조건 : 숨김여부 */
	if ($sel_exposure_view != null) {
		switch ($sel_exposure_view) {
			case "not" :
				if($subtab_num == 2){
					$where .=  " AND REPLY.DISPLAY_FLG = TRUE ";
				}
				else{
					$where .=  " AND REVIEW.EXPOSURE_FLG = TRUE ";
				}
				break;
			case "only" :
				if($subtab_num == 2){
					$where .=  " AND REPLY.DISPLAY_FLG = FALSE ";
				}
				else{
					$where .=  " AND REVIEW.EXPOSURE_FLG = FALSE ";
				}
				break;
		}
	}
	/* 검색조건 : 댓글 유무 */
	if ($reply_count != null) {
		if($tab_num == '02'){
			$comment_sql = "
							SELECT 
								REVIEW_IDX
							FROM 	
								dev.DISPLAY_BOARD_REVIEW_REPLY
							GROUP BY 
								REVIEW_IDX
							HAVING
								COUNT(0) > 0	
					";
		}
		else{
			$comment_sql = "
							SELECT 
								BOARD_IDX
							FROM 	
								dev.DISPLAY_BOARD_REPLY
							GROUP BY 
								BOARD_IDX
							HAVING
								COUNT(0) > 0	
					";
		}
		switch ($reply_count) {
			case "false" :
				$where .=  " AND ".$main_table_alias.".IDX NOT IN (".$comment_sql.") ";
				break;
			case "true" :
				$where .=  " AND ".$main_table_alias.".IDX IN (".$comment_sql.")";
				break;
		}
	}
	/* 대댓글보기 유무 */
	if($eSearchComment != null){
		if($eSearchComment == "commentReply"){
			$where .=  " AND REPLY.DEPTH = 1 ";
		}
	}
	/* 검색조건 : 댓글 여부 */
	if ($reply_flg != null) {
		switch ($reply_flg) {
			case "false" :
				$where .=  " AND BOARD.REPLY_FLG = FALSE ";
				break;
			case "true" :
				$where .=  " AND BOARD.REPLY_FLG = TRUE ";
				break;
		}
	}
	/* 검색조건 : 첨부파일 여부 */
	if ($file_flg != null) {
		switch ($file_flg) {
			case "false" :
				$where .=  " AND BOARD.FILE_FLG = FALSE ";
				break;
			case "true" :
				$where .=  " AND BOARD.FILE_FLG = TRUE ";
				break;
		}
	}
	if ($admin_flg != null && $admin_flg == "true") {
		$where .=  " AND (	SELECT 
								COUNT(*) AS CNT
							FROM 	
								dev.ADMINISTRATOR
							WHERE
								ID = ".$main_table_alias.".CREATER AND NAME = ".$main_table_alias.".MEMBER_NAME ) > 0 ";
	}
	/* 검색조건 : 검색타입 - 검색키워드 */
	if ($search_type != null && $search_keyword != null) {
		switch ($search_type) {
			case "report_name" :
				$where .=  " AND ".$main_table_alias.".CREATER LIKE '%".$search_keyword."%' ";
				break;
			case "origin_name" :
				$where .=  " AND ".$main_table_alias.".ORIGIN_NAME LIKE '%".$search_keyword."%' ";
				break;
			case "origin_subject" :
				$where .=  " AND ".$main_table_alias.".ORIGIN_TITLE LIKE '%".$search_keyword."%' ";
				break;
			case "origin_id" :
				$where .=  " AND ".$main_table_alias.".ORIGIN_ID LIKE '%".$search_keyword."%' ";
				break;
			case "origin_ip" :
				$where .=  " AND ".$main_table_alias.".ORIGIN_IP LIKE '%".$search_keyword."%' ";
				break;
			case "subject" :
				$where .=  " AND ".$main_table_alias.".TITLE LIKE '%".$search_keyword."%' ";
				break;
			case "writer_name" :
				$where .=  " AND ".$main_table_alias.".MEMBER_NAME LIKE '%".$search_keyword."%' ";
				break;
			case "board_id" :
				$where .=  " AND ".$main_table_alias.".CREATER LIKE '%".$search_keyword."%' ";
				break;
			case "client_ip" :
				$where .=  " AND ".$main_table_alias.".IP LIKE '%".$search_keyword."%' ";
				break;
			case "content" :
				$where .=  " AND ".$main_table_alias.".CONTENTS LIKE '%".$search_keyword."%' ";
				break;
			case "product" :
				$where .=  " AND (	SELECT 	
										PRODUCT_NAME 
									FROM 	
										dev.SHOP_PRODUCT 
									WHERE 	
										PRODUCT_CODE = ".$main_table_alias.".PRODUCT_CODE) 
							LIKE '%".$search_keyword."%' ";
				break;
		}
	}

	/* 검색조건 : 등록일 */
	if ($search_date != null) {
		switch ($search_date) {
			case "today" :
				$where .= " AND (".$main_table_alias.".CREATE_DATE >= CURDATE()) ";
				break;
			
			case "01d" :
				$where .= " AND (".$main_table_alias.".CREATE_DATE >= (CURDATE() - INTERVAL 1 DAY)) ";
				break;
			
			case "03d" :
				$where .= " AND (".$main_table_alias.".CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ";
				break;
			
			case "07d" :
				$where .= " AND (".$main_table_alias.".CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ";
				break;
			
			case "15d" :
				$where .= " AND (".$main_table_alias.".CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ";
				break;
			
			case "01m" :
				$where .= " AND (".$main_table_alias.".CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ";
				break;
			
			case "03m" :
				$where .= " AND (".$main_table_alias.".CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ";
				break;
		}
	}
	if ($create_from != null && $create_to != null) {
		$where .= " AND (".$main_table_alias.".CREATE_DATE BETWEEN '".$create_from."' AND '".$create_to."') ";
	}

	/** DB 처리 **/
	$json_result = array(
		'total' => $db->count($tables,$where),
		'total_cnt' => $db->count($tables,$cnt_where),
		'page' => intval($page)
	);
	$limit_start = (intval($page)-1)*$rows;

	/** 정렬 조건 **/
	if($tab_num == '02' && $subtab_num == '02'){
		$order = " ORDER BY REPLY.REVIEW_IDX, REPLY.DEPTH, REPLY.SEQ ";
	}
	else{
		$order = " ORDER BY ";
		if ($sort_value != null && $sort_type != null) {
			$order = " ORDER BY ".$sort_value." ".$sort_type.", ";
		}
		$order .= " ".$main_table_alias.".IDX DESC ";
	}
	
	$limit = " LIMIT ".$limit_start.",".$rows;

	$code_table = " dev.CODE_MST ";
	$code_sql = "
			SELECT 
				CODE_TYPE,
				CODE_VALUE,
				CODE_NAME
			FROM
				".$code_table."
	";
	if(!isset($code_db)){
		$code_db = new db();
	} 
	$code_db->query($code_sql);
	foreach($code_db->fetch() as $code_data){
		$code_mst[$code_data['CODE_TYPE']][$code_data['CODE_VALUE']] = $code_data['CODE_NAME'];
	}
	/* 검색조건 : IDX (단일 페이지 업데이트 창에서 사용) */
	if($board_idx != null){
		$where .= " AND ".$main_table_alias.".IDX = ".$board_idx." ";
		$order = "";
		$limit = "";
		if($tab_num == '01'){
			$reply_info = array();
			$reply_sql = "
				SELECT 
					REPLY.BOARD_IDX,
					REPLY.MEMBER_NAME,
					REPLY.CONTENTS,
					REPLY.CREATE_DATE,
					IF(ADMIN.ID IS NULL, FALSE, TRUE) AS ADMIN_FLG 
				FROM 
					dev.DISPLAY_BOARD_REPLY		REPLY LEFT JOIN
					dev.ADMINISTRATOR			ADMIN
				ON
					REPLY.CREATER = ADMIN.ID
				WHERE
					BOARD_IDX = ".$board_idx."
				ORDER BY 
					REPLY.IDX ASC
			";
			if(!isset($reply_db)){
				$reply_db = new db();
			} 
			$reply_db->query($reply_sql);
			foreach($reply_db->fetch() as $reply_data){
				$reply_info[] = array(
					'board_idx' 		=> $reply_data['BOARD_IDX'],
					'member_name' 		=> $reply_data['MEMBER_NAME'],
					'contents' 			=> $reply_data['CONTENTS'],
					'create_date' 		=> $reply_data['CREATE_DATE'],
					'admin_flg' 		=> $reply_data['ADMIN_FLG'],
				);
			}
		}
	}
	if($tab_num != '02'){
		$sql = "SELECT
					BOARD.IDX,
					BOARD.COUNTRY,
					BOARD.BOARD_TYPE,
					BOARD.CATEGORY,
					BOARD.MEMBER_NAME,
					BOARD.IP,
					BOARD.TITLE,
					BOARD.CONTENTS,
					IFNULL((SELECT PRODUCT_NAME FROM dev.SHOP_PRODUCT WHERE PRODUCT_CODE = BOARD.PRODUCT_CODE),'-') AS PRODUCT_NAME,
					BOARD.ANSWER_STATE,
					BOARD.REPLY_FLG,
					BOARD.FILE_FLG,
					BOARD.FILE_LINK,
					BOARD.AUTH_LV,
					IF(BOARD.EXPOSURE_FLG = TRUE,'숨김 해제','숨김') AS EXPOSURE_FLG,
					DATE_FORMAT(BOARD.EXPOSURE_START_DATE, '%Y-%m-%d %H:%i') AS EXPOSURE_START_DATE,
					DATE_FORMAT(BOARD.EXPOSURE_END_DATE, '%Y-%m-%d %H:%i') AS EXPOSURE_END_DATE,
					IF(BOARD.FIX_FLG = TRUE,'글고정 됨','글고정 안됨') AS FIX_FLG,
					";
		switch($tab_num){
			
			case '01':
				$sql .= "
					MEMBER.NAME AS CREATER_NAME,
					MEMBER.LEVEL AS CREATER_LEVEL,
				";
				break;
			case '03':
			case '04':
				$sql .= "
					ADMIN.NAME AS CREATER_NAME,
					(SELECT TITLE FROM dev.ADMINISTRATOR_PERMITION WHERE IDX = ADMIN.PERMITION_NO) AS CREATER_LEVEL,
				";
				break;
		}
		$sql .= "			
					BOARD.CREATE_DATE,
					BOARD.CREATER,
					BOARD.UPDATE_DATE,
					BOARD.UPDATER
				FROM
					".$tables."
				WHERE
					".$where."
				".$order."
				".$limit." 
			";
	}
	else{
		switch($subtab_num){
			case '01':
				$sql = "SELECT
							REVIEW.IDX,
							REVIEW.COUNTRY,
							REVIEW.ORDERNUM,
							IFNULL((SELECT PRODUCT_NAME FROM dev.SHOP_PRODUCT WHERE PRODUCT_CODE = REVIEW.PRODUCT_CODE),'-') AS PRODUCT_NAME,
							REVIEW.MEMBER_NAME,
							REVIEW.IP,
							REVIEW.TITLE,
							REVIEW.CONTENTS,
							REVIEW.STATUS,
							REVIEW.AUTH_LV,
							REVIEW.IMG_IDX,
							IF(REVIEW.EXPOSURE_FLG = TRUE,'숨김 해제','숨김') AS EXPOSURE_FLG,
							IF(REVIEW.FIX_FLG = TRUE,'글고정 됨','글고정 안됨') AS FIX_FLG,
							REVIEW.MILEAGE_FLG,
							MEMBER.NAME AS CREATER_NAME,
							MEMBER.LEVEL AS CREATER_LEVEL,
							IF(REVIEW.DEL_FLG = TRUE,'삭제됨','-') AS DEL_FLG,
							REVIEW.CREATE_DATE,
							REVIEW.CREATER,
							REVIEW.UPDATE_DATE,
							REVIEW.UPDATER
						";
				break;
			case '02':
				$sql = "SELECT
							REPLY.IDX,
							REPLY.REVIEW_IDX,
							REPLY.SEQ,
							REPLY.DEPTH,
							REPLY.FATHER_NO,
							REPLY.MEMBER_NAME,
							REPLY.CONTENTS,
							REVIEW.TITLE,
							IF(REPLY.FIX_FLG = TRUE,'글고정 됨','글고정 안됨') AS FIX_FLG,
							IF(REPLY.DISPLAY_FLG = TRUE,'숨김 해제','숨김') AS DISPLAY_FLG,
							if(ADMIN.NAME IS NULL, REPLY.MEMBER_NAME, ADMIN.NAME)	AS CREATER_NAME,
							if(ADMIN.ID IS NULL, 
									(SELECT LEVEL FROM dev.MEMBER WHERE ID = REPLY.CREATER), 
									(SELECT TITLE FROM dev.ADMINISTRATOR_PERMITION WHERE IDX = ADMIN.PERMITION_NO)
							)	AS CREATER_LEVEL,
							IF(REPLY.DEL_FLG = TRUE,'삭제됨','-') AS DEL_FLG,
							REPLY.CREATE_DATE,
							REPLY.CREATER,
							REPLY.UPDATE_DATE,
							REPLY.UPDATER
						";
				break;
			case '03':
				$sql = "SELECT
							REPORT.IDX,
							REPORT.REPORT_DIVISION,
							REPORT.REPORT_TYPE,
							REPORT.REASON,
							REPORT.REPORT_IDX,
							REPORT.PROCESSING_FLG,
							REPORT.ORIGIN_STATUS  	AS STATUS,
							REPORT.ORIGIN_TITLE,
							REPORT.ORIGIN_NAME,
							REPORT.ORIGIN_DATE,
							REPORT.ORIGIN_ID,
							MEMBER.LEVEL 			AS ORIGIN_LEVEL,
							REPORT.CREATE_DATE,
							REPORT.CREATER,
							REPORT.UPDATE_DATE,
							REPORT.UPDATER,
							(SELECT NAME FROM dev.MEMBER WHERE ID = REPORT.CREATER) AS CREATER_NAME,
							(SELECT LEVEL FROM dev.MEMBER WHERE ID = REPORT.CREATER) AS CREATER_LEVEL
					";
		break;
	}
	$sql .= "			
			FROM
				".$tables."
			WHERE
				".$where."
			".$order."
			".$limit." 
		";
}
$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'					=> $total_cnt--,
		'idx' 					=> $data['IDX'],
		'country' 				=> $data['COUNTRY'],
		'board_type' 			=> $data['BOARD_TYPE'],
		'category' 				=> $code_mst['BOARD_CATEGORY'][$data['CATEGORY']],
		'member_name' 			=> $data['MEMBER_NAME'],
		'ip' 					=> $data['IP'],
		'title' 				=> $data['TITLE'],
		'contents' 				=> $data['CONTENTS'],
		'product_name' 			=> $data['PRODUCT_NAME'],
		'answer_state' 			=> $code_mst['BOARD_ANSWER'][$data['ANSWER_STATE']],
		'reply_flg'				=> $data['REPLY_FLG'],
		'file_flg'				=> $data['FILE_FLG'],
		'file_link'				=> $data['FILE_LINK'],
		'auth_lv'				=> $data['AUTH_LV'],
		'exposure_flg'			=> $data['EXPOSURE_FLG'],
		'exposure_start_date'	=> $data['EXPOSURE_START_DATE'],
		'exposure_end_date'		=> $data['EXPOSURE_END_DATE'],
		'spam_flg' 				=> $data['SPAM_FLG'],
		'fix_flg'				=> $data['FIX_FLG'],
		'creater_name'			=> $data['CREATER_NAME'],
		'creater_level'			=> $data['CREATER_LEVEL'],

		'ordernum' 				=> $data['ORDERNUM'],
		'status' 				=> $code_mst['BOARD_REPORT_STATUS'][$data['STATUS']],
		'img_idx' 				=> $data['IMG_IDX'],
		'mileage_flg'			=> $data['MILEAGE_FLG'],
		'mileage'				=> $data['MILEAGE'],

		'review_idx' 			=> $data['REVIEW_IDX'],
		'seq' 					=> $data['SEQ'],
		'depth' 				=> $data['DEPTH'],
		'father_no' 			=> $data['FATHER_NO'],
		'display_flg' 			=> $data['DISPLAY_FLG'],

		'member_id' 			=> $data['MEMBER_ID'],
		'report_division' 		=> $data['REPORT_DIVISION'],
		'report_type' 			=> $data['REPORT_TYPE'],
		'reason' 				=> $data['REASON'],
		'report_idx' 			=> $data['REPORT_IDX'],
		'processing_flg' 		=> $data['PROCESSING_FLG'],

		'origin_status' 		=> $code_mst['BOARD_REPORT_STATUS'][$data['ORIGIN_STATUS']],
		'origin_title' 			=> $data['ORIGIN_TITLE'],
		'origin_creater_name' 	=> $data['ORIGIN_NAME'],
		'origin_creater_level' 	=> $data['ORIGIN_LEVEL'],
		'origin_create_date' 	=> $data['ORIGIN_DATE'],
		'origin_create_id' 		=> $data['ORIGIN_ID'],
		
		'del_flg'				=> $data['DEL_FLG'],
		'create_date'			=> $data['CREATE_DATE'],
		'creater'				=> $data['CREATER'],
		'update_date'			=> $data['UPDATE_DATE'],
		'updater'				=> $data['UPDATER'],
	);
}
if(isset($reply_info)){
	$json_result['data'][0]['reply'] = $reply_info;
}
?>