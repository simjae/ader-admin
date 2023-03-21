<?php
/*
 +=============================================================================
 | 
 | 1:1문의 삭제
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

$board_idx = $_POST['board_idx'];
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

if($board_idx != null){
    $delete_sql = "
        DELETE FROM
            PAGE_BOARD
        WHERE
            IDX = ".$board_idx."
    ";

    $db->query($delete_sql);
}

?>