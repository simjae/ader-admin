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
    $member_id = $_SESSION['MEMBER_ID'];
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
    if(!empty($board_idx) && count($_FILES) > 0){
        $path = "/var/www/admin/www/images/inquiry/";
        for($i = 1; $i <=5 ; $i++){
            $file_obj = $_FILES['board_img'.$i];
            if($file_obj['size'] > 0) {
                move_uploaded_file($file_obj['tmp_name'], $path.'img_'.time().'_'.$file_obj['name']);
                
                $img_sql = "INSERT INTO
                            dev.BOARD_IMAGE
                            (
                                BOARD_IDX,
                                IMG_LOCATION,
                                CREATER,
                                UPDATER
                            ) VALUES (
                                ".$board_idx.",
                                '".$path.'img_'.time().'_'.$file_obj['name']."',
                                '".$member_id."',
                                '".$member_id."'
                        )";
                $db->query($img_sql);
            }
        }
    }
    
    if(empty($board_idx)){
        $json_result['code'] = 301;
        $json_result['msg'] = '문의하기가 실패했습니다. 다시 시도해주세요';
        return $json_result;
    }
}

?>