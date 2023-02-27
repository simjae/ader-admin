<?php
/*
 +=============================================================================
 | 
 | 1:1문의 추가
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$inquiry_type = $_POST['inquiry_type'];
$inquiry_title = $_POST['inquiry_title'];
$inquiryTextBox = $_POST['inquiryTextBox'];
$country = $_POST['country'];

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if ($member_idx == 0 || $country == NULL) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	
	return $json_result;
}

if($inquiry_type != null && $inquiry_title != null && $inquiryTextBox != null){
    $insert_sql = "
        INSERT INTO dev.PAGE_BOARD
        (
            COUNTRY,
            BOARD_TYPE,
            CATEGORY,
            MEMBER_IDX,
            MEMBER_ID,
            MEMBER_NAME,
            TITLE,
            CONTENTS,
            ANSWER_STATE,
            CREATER,
            UPDATER
        )
        SELECT
            '".$country."',
            'ONE',
            '".$inquiry_type."',
            IDX,
            MEMBER_ID,
            MEMBER_NAME,
            '".$inquiry_title."',
            '".$inquiryTextBox."',
            'NAS',
            MEMBER_ID,
            MEMBER_ID
        FROM
            dev.MEMBER_".$country."
        WHERE
            IDX = '".$member_idx."'
    ";

    $db->query($insert_sql);

    $board_idx = $db->last_id();

    if(empty($board_idx)){
        $json_result['code'] = 301;
        $json_result['msg'] = '문의하기가 실패했습니다. 다시 시도해주세요';
        return $json_result;
    }
}

?>