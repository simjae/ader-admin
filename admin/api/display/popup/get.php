<?php
/*
 +=============================================================================
 | 
 | 팝업 목록 조회 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$popup_idx			= $_POST['popup_idx'];				//IDX

$country            = $_POST['country'];        	    //쇼핑몰 국가

$search_type        = $_POST['search_type'];        	//검색 타입
$search_keyword     = $_POST['search_keyword']; 		//검색 키워드

$popup_type         = $_POST['popup_type'];        	    //팝업 타입
$device             = $_POST['device']; 		        //디바이스
$display_status     = $_POST['display_status'];         //팝업 진행상태

$display_flg        = $_POST['display_flg'];     		//진행 일자 사용유무(상시 오픈 체크)
$display_from       = $_POST['display_from'];     		//진행일 검색 시작일자
$display_to         = $_POST['display_to'];             //진행일 검색 시작일자

$search_date_type   = $_POST['search_date_type'];     	//등록일 타입(생성일, 변경일)
$search_date        = $_POST['search_date'];            
$search_from      	= $_POST['search_from'];        	//등록일 검색 시작일자
$search_to     	    = $_POST['search_to'];        	    //등록일 검색 종료일자

$code_mst					= array();
$member_level				= array();
$administrator_permision	= array();
$origin_report 				= array();

$rows = $_POST['rows'];
$page = $_POST['page'];
$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

$where = ' DEL_FLG = FALSE';
$tables = "  dev.DISPLAY_POPUP ";  

$order = "";
$limit = "";
if ($popup_idx != null) {
    $where .= " AND (IDX = ".$popup_idx.") ";
} else {
    /** 검색 조건 **/
    $cnt_where = "";
    $cnt_where .= $where;

    /* 검색조건 : 쇼핑몰 */
    if($country != null){
        $where .= " AND COUNTRY = '".$country."' ";
    }
    /* 검색조건 : 검색타입 - 검색키워드 */
    if ($search_type != null && $search_keyword != null) {
        switch ($search_type) {
            case "title" :
                $where .=  " AND TITLE LIKE '%".$search_keyword."%' ";
                break;
            case "url" :
                $where .=  " AND IDX IN 
                                (SELECT 
                                    DISTINCT POPUP_IDX 
                                FROM 
                                    dev.POPUP_URL 
                                WHERE 
                                    URL LIKE '%product%' 
                                AND 
                                    URL LIKE '%".$search_keyword."%') ";
                break;
        }
    }

    /* 검색조건 : 팝업 타입 'LAYER', 'WINDOW' */
    if ($popup_type != null && $popup_type != 'ALL') {
        $where .=  " AND  POPUP_TYPE = '".$popup_type."' ";
    }
    /* 검색조건 : 디바이스 'WEB', 'mobile' */
    if ($device != null && $device != 'TOTAL') {
        $where .=  " AND DEVICE = '".$device."' ";
    }
    /* 검색조건 : 상태 */
    /* 검색조건 진열예약, 진열상태 */ 
    if($display_status != null && $display_status != "all"){
        switch ($display_status) {
            case "true" :
                $where .= " AND (DISPLAY_FLG = TRUE AND NOW() >= DISPLAY_START_DATE AND NOW() <= DISPLAY_END_DATE) ";
                break;
            case "false" :
                $where .= " AND (DISPLAY_FLG = FALSE) ";
                break;
            case "wait" :
                $where .= " AND (DISPLAY_FLG = TRUE AND NOW() < DISPLAY_START_DATE) ";
                break;
            case "end" :
                $where .= " AND (DISPLAY_FLG = TRUE AND NOW() >= DISPLAY_START_DATE AND NOW() >= DISPLAY_END_DATE) ";
                break;
        }
    }

    if($display_date != null && $display_date != 'all'){
        switch ($display_date) {
            case "true" :
                $where .= " AND DISPLAY_END_DATE = '9999-12-31 23:59' ";
                break;
            case "false" :
                if($display_from != null && $display_to == null){
                    $where .= " AND DISPLAY_START_DATE >= '".$display_from."' ";
                }
                if($display_from == null && $display_to != null){
                    $where .= " AND DISPLAY_END_DATE <= '".$display_to."'  ";
                }
                if($display_from != null && $display_to != null){
                    $where .= " AND DISPLAY_START_DATE >= '".$display_from."' 
                                AND DISPLAY_END_DATE <= '".$display_to."' ";
                }
                break;
        }
    }

    /* 검색조건 : 등록일 */
    if ($search_date != null) {
        switch ($search_date) {
            case "today" :
                $where .= " AND (".$search_date_type." >= CURDATE()) ";
                break;
            
            case "01d" :
                $where .= " AND (".$search_date_type." >= (CURDATE() - INTERVAL 1 DAY)) ";
                break;
            
            case "03d" :
                $where .= " AND (".$search_date_type." >= (CURDATE() - INTERVAL 3 DAY)) ";
                break;
            
            case "07d" :
                $where .= " AND (".$search_date_type." >= (CURDATE() - INTERVAL 7 DAY)) ";
                break;
            
            case "15d" :
                $where .= " AND (".$search_date_type." >= (CURDATE() - INTERVAL 15 DAY)) ";
                break;
            
            case "01m" :
                $where .= " AND (".$search_date_type." >= (CURDATE() - INTERVAL 1 MONTH)) ";
                break;
            
            case "03m" :
                $where .= " AND (".$search_date_type." >= (CURDATE() - INTERVAL 3 MONTH)) ";
                break;
        }
    }
    if ($create_from != null && $create_to != null) {
        $where .= " AND (".$search_date_type." BETWEEN '".$search_from."' AND '".$search_to."') ";
    }

    /** DB 처리 **/
    $json_result = array(
        'total' => $db->count($tables,$where),
        'total_cnt' => $db->count($tables,$cnt_where),
        'page' => intval($page)
    );

    $limit_start = (intval($page)-1)*$rows;

    /** 정렬 조건 **/
    if ($sort_value != null && $sort_type != null) {
        $order = " ORDER BY ".$sort_value." ".$sort_type.", ";
        $order .= "IDX DESC ";
    }
    
    $limit = " LIMIT ".$limit_start.",".$rows;
}

$sql = "SELECT
                IDX,
                COUNTRY,
                TITLE,
                CONTENTS,
                DEVICE,
                DISPLAY_FLG,
                DATE_FORMAT(DISPLAY_START_DATE, '%Y-%m-%d %H:%i') AS DISPLAY_START_DATE,
                DATE_FORMAT(DISPLAY_END_DATE, '%Y-%m-%d %H:%i') AS DISPLAY_END_DATE,
                LOCATION_WIDTH,
                LOCATION_HEIGHT,
                SIZE_WIDTH,
                SIZE_HEIGHT,
                POPUP_TYPE,
                ALIGN,
                CLOSE_FLG,
                CREATER,
                DATE_FORMAT(CREATE_DATE, '%Y-%m-%d %H:%i') AS CREATE_DATE,
                UPDATER,
                DATE_FORMAT(UPDATE_DATE, '%Y-%m-%d %H:%i') AS UPDATE_DATE
            FROM
                ".$tables."
            WHERE
                ".$where."
            ".$order."
            ".$limit." 
    ";

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'num'					=> $total_cnt--,
        'idx' 					=> $data['IDX'],
        'country' 				=> $data['COUNTRY'],
        'title' 			    => $data['TITLE'],
        'contents' 			    => $data['CONTENTS'],
        'device' 			    => $data['DEVICE'],
        'display_flg' 			=> $data['DISPLAY_FLG'],
        'display_start_date' 	=> $data['DISPLAY_START_DATE'],
        'display_end_date' 	    => $data['DISPLAY_END_DATE'],
        'location_width' 		=> $data['LOCATION_WIDTH'],
        'location_height'		=> $data['LOCATION_HEIGHT'],
        'size_width'			=> $data['SIZE_WIDTH'],
        'size_height'			=> $data['SIZE_HEIGHT'],
        'popup_type'			=> $data['POPUP_TYPE'],
        'align'			        => $data['ALIGN'],
        'close_flg'	            => $data['CLOSE_FLG'],
        'create_date'			=> $data['CREATE_DATE'],
        'creater'				=> $data['CREATER'],
        'update_date'			=> $data['UPDATE_DATE'],
        'updater'				=> $data['UPDATER'],
    );
}
?>