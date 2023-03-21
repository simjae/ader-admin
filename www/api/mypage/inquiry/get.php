<?php
/*
 +=============================================================================
 | 
 | 마이페이지_문의내역 - 문의내역 리스트 조회
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	
	return $json_result;
}

$inquiry_list_sql = "

        SELECT
            IDX,
            DATE_FORMAT(CREATE_DATE, '%y.%m.%d') AS CREATE_DATE,
            CATEGORY,
            TITLE,
            CONTENTS,
            ANSWER_STATE
        FROM
            PAGE_BOARD
        WHERE
            BOARD_TYPE = 'ONE'
        AND
            MEMBER_IDX = ".$member_idx."
        AND
            DEL_FLG = FALSE
        ORDER BY IDX DESC
";

$db->query($inquiry_list_sql);

foreach($db->fetch() as $data){
    $board_idx = $data['IDX'];

    $reply_info = array();
    if($board_idx != null){
        $reply_sql = "
            SELECT
                CONTENTS
            FROM
                BOARD_REPLY
            WHERE
                BOARD_IDX = ".$board_idx."
        ";
        $db->query($reply_sql);
        
        foreach($db->fetch() as $reply_data){
            $reply_info[] = array(
                'contents' => $reply_data['CONTENTS']
            );
        }
    } 
    
    $image_info = array();
    if($board_idx != null){
        $reply_sql = "
            SELECT
                IDX,
                REPLACE(IMG_LOCATION,'/var/www/admin/www', 'http://116.124.128.246:81') AS IMG_LOCATION
            FROM
                BOARD_IMAGE
            WHERE
                BOARD_IDX = ".$board_idx."
        ";
        $db->query($reply_sql);
        
        foreach($db->fetch() as $reply_data){
            $image_info[] = array(
                'img_location' => $reply_data['IMG_LOCATION']
            );
        }
    } 
    
    $json_result['data'][] = array(
        'board_idx' =>$data['IDX'],
        'create_date' => $data['CREATE_DATE'],
        'category' => $data['CATEGORY'],
        'title' => $data['TITLE'],
        'contents' => $data['CONTENTS'],
        'answer_state' => $data['ANSWER_STATE'],
        'reply_info' => $reply_info,
        'image_info' => $image_info
    );
}