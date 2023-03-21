<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_이미지 추가
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();
$country		= $_POST['country'];

if ($country != null) {
	try {
		$insert_img_sql = "
			INSERT INTO
				TMP_MAIN_IMG
			(
				COUNTRY,
				DISPLAY_NUM,
				TITLE,
				BTN_NAME,
				BTN_URL,
				CREATER,
				UPDATER
			) VALUES (
				'".$country."',
				1,
				'신규 이미지 타이틀',
				'버튼 이름',
				'버튼 URL',
				'".$session_id."',
				'".$session_id."'
			)
		";

		$db->query($insert_img_sql);

		$img_idx = $db->last_id();

		if (!empty($img_idx)) {
			$update_img_sql = "
				UPDATE
					TMP_MAIN_IMG MI
				SET
					DISPLAY_NUM = DISPLAY_NUM + 1
				WHERE
					MI.IDX != ".$img_idx." AND
					MI.COUNTRY = '".$country."' AND
					MI.DEL_FLG = FALSE
			";
			
			$db->query($update_img_sql);
			
		} else {
			$json_result['code'] = 301;
			$json_result['msg'] = "메인 배너  등록에 실패했습니다.";
		}
		
		$json_result['code'] = 200;
		$json_result['img_idx'] = $img_idx;
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		unlink($img_location);
		
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
	}
}

?>