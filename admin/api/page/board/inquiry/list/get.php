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
$country			= $_POST['country'];				//국가
$tab_status         = $_POST['tab_status'];

$date_param         = $_POST['date_param'];
$date_from          = $_POST['date_from'];
$date_to            = $_POST['date_to'];
$board_category     = $_POST['board_category'];
$search_type        = $_POST['search_type'];
$search_keyword     = $_POST['search_keyword'];
$boardFlg           = $_POST['boardFlg'];
$answer_state       = $_POST['answer_state'];
$file_flg           = $_POST['file_flg'];

$rows = $_POST['rows'];
$page = $_POST['page'];
$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

if($country != null){
    $cnt_where = "";
    $where = "  BOARD.BOARD_TYPE= '".$tab_status."' 
                AND BOARD.DEL_FLG = FALSE
                AND BOARD.COUNTRY = '".$country."' ";
    $cnt_where = $where;

    
    //기간 검색
    if (($date_param != null || $date_from != null || $date_to != null)) {
        if ($date_param != null) {
			$tmp_date = "DATE_FORMAT(BOARD.CREATE_DATE,'%Y-%m-%d')";
			
            switch ($date_param) {
                case "today" :
                    $where .= ' AND ('.$tmp_date.' = CURDATE()) ';
                    break;
                
				case "01d" :
                    $where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 DAY)) ';
                    break;
                
				case "03d" :
                    $where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 DAY)) ';
                    break;
                
				case "07d" :
                    $where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 7 DAY)) ';
                    break;
                
				case "15d" :
                    $where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 15 DAY)) ';
                    break;
                
				case "01m" :
                    $where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
                    break;
                
				case "03m" :
                    $where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
                    break;
                
				case "01y" :
                    $where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
                    break;
            }
        } else if ($date_from != null || $date_to != null) {
            if ($date_start != null && $date_to == null) {
                $where .= " AND (BOARD.CREATE_DATE >= '".$date_from."') ";
            } else if ($date_from == null && $date_to != null) {
                $where .= " AND (BOARD.CREATE_DATE <= '".$date_to."') ";
            } else if ($date_from != null && $date_to != null) {
                $where .= " AND (BOARD.CREATE_DATE BETWEEN '".$date_from."' AND '".$date_to."') ";
            }
        }
    }
    /* 검색조건 : 게시판 카테고리 */
    if ($board_category != null) {
        $where .=  " AND BOARD.CATEGORY = '".$board_category."' ";
    }
    if (($search_type != null && $search_type != 'ALL') && $search_keyword != null) {
        $where = "";
        switch ($search_type) {
            //게시판정보 검색 - 작성글 제목
            case "subject" :
                $where .= ' (BOARD.TITLE LIKE "%'.$search_keyword.'%") ';
                break;
            
            //게시판정보 검색 - 작성글 내용
            case "content" :
                $where .= ' (BOARD.CONTENTS LIKE "%'.$search_keyword.'%") ';
                break;
            
            //게시판정보 검색 - 작성자
            case "writer_name" :
                $where .= ' (BOARD.MEMBER_NAME LIKE "%'.$search_keyword.'%") ';
                break;
            
            //게시판정보 검색 - 작성자 ip
            case "client_ip" :
                $where .= ' (BOARD.IP LIKE "%'.$search_keyword.'%") ';
                break;
        }
    }
    /* 검색조건 : 답변 여부 */
    if ($answer_state != null) {
        $where .=  " AND BOARD.ANSWER_STATE = '".$answer_state."' ";
    }

    /* 검색조건 : 첨부파일 여부 */
    if ($file_flg != null) {
        switch ($file_flg) {
            case "false" :
                $where .=  " AND ((SELECT COUNT(0) FROM BOARD_IMAGE WHERE BOARD_IDX = BOARD.IDX) = 0) ";
                break;
            case "true" :
                $where .=  " AND ((SELECT COUNT(0) FROM BOARD_IMAGE WHERE BOARD_IDX = BOARD.IDX) > 0) ";
                break;
        }
    }

    $order = '';
    if ($sort_value != null && $sort_type != null) {
        $order = ' '.$sort_value.' '.$sort_type.' ';
    } else {
        $order = ' BOARD.IDX DESC';
    }

    /** DB 처리 **/
	$json_result = array(
		'total' => $db->count('PAGE_BOARD BOARD',$where),
		'total_cnt' => $db->count('PAGE_BOARD BOARD',$cnt_where),
		'page' => intval($page)
	);

	$limit_start = (intval($page)-1)*$rows;
	$limit = " LIMIT ".$limit_start.",".$rows;

    $code_sql = "
			SELECT 
				CODE_TYPE,
				CODE_VALUE,
				CODE_NAME
			FROM
				CODE_MST
	";

	$db->query($code_sql);
	foreach($db->fetch() as $code_data){
		$code_mst[$code_data['CODE_TYPE']][$code_data['CODE_VALUE']] = $code_data['CODE_NAME'];
	}

    $sql = "
        SELECT
            BOARD.IDX,
            BOARD.COUNTRY,
            BOARD.BOARD_TYPE,
            BOARD.CATEGORY,
            BOARD.MEMBER_NAME,
            BOARD.MEMBER_ID,
            LEVEL.TITLE			            AS CREATER_LEVEL, 
            IFNULL(BOARD.IP,'-')            AS IP,
            BOARD.TITLE,
            BOARD.CONTENTS,
            BOARD.ANSWER_STATE,
            BOARD.REPLY_FLG,
            IF(
                BOARD.EXPOSURE_FLG = TRUE,
                '숨김','-'
            )					            AS EXPOSURE_FLG,
            DATE_FORMAT(
                BOARD.EXPOSURE_START_DATE,
                '%Y-%m-%d %H:%i'
            )					            AS EXPOSURE_START_DATE,
            DATE_FORMAT(
                BOARD.EXPOSURE_END_DATE,
                '%Y-%m-%d %H:%i'
            )					            AS EXPOSURE_END_DATE,
            IF(
                BOARD.FIX_FLG = TRUE,
                '글고정 됨',
                '글고정 안됨'
            )					            AS FIX_FLG,
            BOARD.MEMBER_IDX		        AS MEMBER_IDX,
            BOARD.MEMBER_NAME		        AS CREATER_NAME,			
            BOARD.CREATE_DATE,
            BOARD.CREATER,
            BOARD.UPDATE_DATE,
            BOARD.UPDATER
        FROM
            PAGE_BOARD BOARD LEFT JOIN
            MEMBER_".$country." MEMBER ON
            BOARD.MEMBER_IDX = MEMBER.IDX LEFT JOIN
            MEMBER_LEVEL LEVEL ON
            MEMBER.LEVEL_IDX = LEVEL.IDX
        WHERE
            ".$where."
        ORDER BY 
            ".$order."
            ".$limit." 
    ";
    $db->query($sql);

    foreach($db->fetch() as $data) {
        $json_result['data'][] = array(
            'num'					=> $total_cnt--,
            'idx'                   => $data['IDX'],
            'country'               => $data['COUNTRY'],
            'board_type'            => $data['BOARD_TYPE'],
            'category'              => $code_mst['BOARD_CATEGORY'][$data['CATEGORY']],
            'member_name'           => $data['MEMBER_NAME'],
            'member_id'             => $data['MEMBER_ID'],
            'creater_level'         => $data['CREATER_LEVEL'],
            'ip'                    => $data['IP'],
            'title'                 => $data['TITLE'],
            'contents'              => $data['CONTENTS'],
            'answer_state'          => $code_mst['BOARD_ANSWER'][$data['ANSWER_STATE']],
            'reply_flg'             => $data['REPLY_FLG'],
            'exposure_flg'          => $data['EXPOSURE_FLG'],
            'exposure_start_date'   => $data['EXPOSURE_START_DATE'],
            'exposure_end_date'     => $data['EXPOSURE_END_DATE'],
            'fix_flg'               => $data['FIX_FLG'],
            'member_idx'            => $data['MEMBER_IDX'],
            'creater_name'          => $data['CREATER_NAME'],
            'create_date'           => $data['CREATE_DATE'],
            'creater'               => $data['CREATER'],
            'update_date'           => $data['UPDATE_DATE'],
            'updater'               => $data['UPDATER']
        );
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '잘못된 경로입니다.';
}
?>