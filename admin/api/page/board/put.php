<?php
/*
 +=============================================================================
 | 
 | 게시판 글목록 일괄변경 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

/** 변수 정리 **/
$session_id			= sessionCheck();
$board_idx          = $_POST['board_idx'];
$page_idx           = $_POST['page_idx'];
$put_type           = $_POST['put_type'];

$exposure_flg       = $_POST['exposure_flg'];
$exposure_from      = $_POST['exposure_from'];
$exposure_from_h    = $_POST['exposure_from_h'];
$exposure_from_m    = $_POST['exposure_from_m'];
$exposure_to        = $_POST['exposure_to'];
$exposure_to_h      = $_POST['exposure_to_h'];
$exposure_to_m      = $_POST['exposure_to_m'];

$answer_contents    = $_POST['answer_contents'];
$answer_contents	= str_replace("<p>&nbsp;</p>","",$answer_contents);

$exposure_start_date = "";
$exposure_end_date = "";

$idx_list="";
$where = '1=1';
if ($board_idx != null) {
	$idx_list = implode(',',$board_idx);
	$where .= " AND IDX IN (".$idx_list.")";
}
if($page_idx != null){
    $where .= " AND IDX  = ".$page_idx." ";
}
switch($put_type){
    case 'exposure_date':
        if($exposure_flg == 'true'){
            $exposure_start_date = "NOW()";
            $exposure_end_date = "'9999-12-31 23:59'";
        }
        else if($exposure_flg == 'false'){
            $exposure_start_date = "'".$exposure_from." ".$exposure_from_h.":".$exposure_from_m."'";
            $exposure_end_date = "'".$exposure_to." ".$exposure_to_h.":".$exposure_to_m."'";
        }
        $sql = "
                UPDATE 
                    PAGE_BOARD
                SET
                    EXPOSURE_FLG = true,
                    EXPOSURE_START_DATE = ".$exposure_start_date.",
                    EXPOSURE_END_DATE   = ".$exposure_end_date.",
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$session_id."'
                WHERE
                    ".$where."
        ";
        $db->query($sql);
        break;
    case 'answer':
        $reply_info_sql = "
                SELECT 
                    MAX(SEQ) AS MAX_SEQ 
                FROM 
                    BOARD_REPLY
                WHERE 
                    BOARD_IDX = ".$page_idx." 
                AND 
                    DEPTH = 1
                GROUP BY 
                    BOARD_IDX    
        ";
        $db->query($reply_info_sql);
        foreach($db->fetch() as $data){
            $max_seq = $data['MAX_SEQ'];
        }
        if($max_seq != null){
            $max_seq++;
        }
        else{
            $max_seq = 0;
        }
        $insert_reply_sql = "
                INSERT  BOARD_REPLY(
                    BOARD_IDX,
                    SEQ,
                    DEPTH,
                    MEMBER_IDX,
                    MEMBER_ID,
                    MEMBER_NAME,
                    CONTENTS,
                    CREATE_DATE,
                    CREATER,
                    UPDATE_DATE,
                    UPDATER
                )
                SELECT
                    ".$page_idx.",
                    ".$max_seq.",
                    1,
                    IDX,
                    ADMIN_ID,
                    ADMIN_NAME,
                    '".$answer_contents."',
                    NOW(),
                    ADMIN_NAME,
                    NOW(),
                    ADMIN_NAME
                FROM
                    ADMIN
                WHERE
                    ADMIN_ID = '".$session_id."'
                
        ";
        $db->query($insert_reply_sql);
        $sql = "
                UPDATE 
                    PAGE_BOARD
                SET
                    ANSWER_STATE = 'RCP',
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$session_id."'
                WHERE
                    ".$where."
        ";
        $db->query($sql);
        break;
}
?>