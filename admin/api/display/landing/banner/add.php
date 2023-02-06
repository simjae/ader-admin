<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_배너 추가
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
		$insert_banner_sql = "
			INSERT INTO
				dev.MAIN_BANNER
			(
				COUNTRY,
				DISPLAY_NUM,
				TITLE,
				SUB_TITLE,
				BACKGROUND_COLOR,
				BTN1_NAME,
				BTN1_URL,
				BTN2_NAME,
				BTN2_URL,
				CREATER,
				UPDATER
			) VALUES (
				'".$country."',
				1,
				'신규 배너',
				'신규 배너 서브 타이틀',
				'BL',
				'버튼 이름',
				'버튼 URL',
				'버튼 이름',
				'버튼 URL',
				'".$session_id."',
				'".$session_id."'
			)
		";

		$db->query($insert_banner_sql);

		$banner_idx = $db->last_id();
		
		if (!empty($banner_idx)) {
			$select_banner_sql = "
				SELECT
					MB.IDX		AS BANNER_IDX
				FROM
					dev.MAIN_BANNER MB
				WHERE
					MB.IDX != ".$banner_idx." AND
					MB.DEL_FLG = FALSE
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_banner_sql);
			
			$display_num = 2;
			
			foreach($db->fetch() as $banner_data) {
				$tmp_idx = $banner_data['BANNER_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_banner_sql = "
						UPDATE
							dev.MAIN_BANNER
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx." AND
							DEL_FLG = FALSE
					";
					
					$db->query($update_banner_sql);
					
					$display_num++;
				}
			}
		} else {
			$json_result['code'] = 301;
			$json_result['msg'] = "메인 배너  등록에 실패했습니다.";
		}
		
		$json_result['code'] = 200;
		$json_result['banner_idx'] = $banner_idx;
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		unlink($img_location);
		
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
	}
}

?>