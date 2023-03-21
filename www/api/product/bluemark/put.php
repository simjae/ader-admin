<?php
/*
 +=============================================================================
 | 
 | 마이페이지 블루마크 - 블루마크 인증
 | -------
 |
 | 최초 작성	: 윤재은
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$session_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$session_id = $_SESSION['MEMBER_ID'];
}

$serial_code = null;
if (isset($_POST['serial_code'])) {
	$serial_code = $_POST['serial_code'];
}

$handover_id = null;
if (isset($_POST['handover_id'])) {
	$handover_id = $_POST['handover_id'];
}

$bluemark_idx = 0;
if (isset($_POST['bluemark_idx'])) {
	$bluemark_idx = $_POST['bluemark_idx'];
}

$ip = null;
if (isset($_POST['ip'])) {
	$ip = $_POST['ip'];
} else {
	$ip = '000.000.000.000';
}

$country = null;
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($country != null && $serial_code != null) {
	if ($member_idx != 0) {
		$db->begin_transaction();
		
		try {
			$bluemark_cnt = $db->count("BLUEMARK_INFO BI", "BI.DEL_FLG = FALSE AND BI.SERIAL_CODE ='".$serial_code."' AND BI.MEMBER_IDX = 0 AND BI.STATUS = FALSE");
			
			if($bluemark_cnt == 1) {
				$update_bluemark_sql = "
					UPDATE
						BLUEMARK_INFO,
						(
							 SELECT
									MB.IDX				AS TMP_MEMBER_IDX,
									MB.MEMBER_ID		AS TMP_MEMBER_ID,
									MB.MEMBER_NAME		AS TMP_MEMBER_NAME,
									MB.TEL_MOBILE		AS TMP_TEL_MOBILE,
									MB.MEMBER_ID		AS TMP_EMAIL,
									TRUE				AS TMP_STATUS,
									NOW()				AS TMP_UPDATE_DATE,
									MB.MEMBER_ID		AS TMP_UPDATER
							 FROM
									MEMBER_".$country." MB
							 WHERE
									MB.IDX = '".$member_idx."'
						) AS TMP
					SET
						MEMBER_IDX		= TMP.TMP_MEMBER_IDX,
						MEMBER_ID		= TMP.TMP_MEMBER_ID,
						MEMBER_NAME		= TMP.TMP_MEMBER_NAME,
						TEL_MOBILE		= TMP.TMP_TEL_MOBILE,
						EMAIL			= TMP.TMP_EMAIL,
						STATUS			= TMP.TMP_STATUS,
						UPDATE_DATE		= NOW(),
						UPDATER			= TMP_UPDATER
					WHERE
						SERIAL_CODE = '".$serial_code."'
				";
				

				$db->query($update_bluemark_sql);
	
				$db_result = $db->affectedRows();
	
				if ($db_result > 0) {
					$insert_log_sql = "
						INSERT
							BLUEMARK_LOG
						(
							BLUEMARK_IDX,
							MEMBER_IDX,
							MEMBER_ID,
							MEMBER_NAME,
							IP,
							STATUS,
							REG_DATE
						)
						SELECT
							IDX				AS BLUEMARK_IDX,
							MEMBER_IDX		AS MEMBER_IDX,
							MEMBER_ID		AS MEMBER_ID,
							MEMBER_NAME		AS MEMBER_NAME,
							'".$ip."'		AS IP,
							'신규인증'			AS STATUS,
							NOW()			AS REG_DATE
						FROM
							BLUEMARK_INFO BI
						WHERE 
							BI.SERIAL_CODE = '".$serial_code."'
					";

					$db->query($insert_log_sql);
				}
			} else {
				$json_result['code'] = 301;
				$json_result['msg'] = '인증하려는 블루마크의 정보가 유효하지 않습니다.';

				return $json_result;
			}
			
			$db->commit();
			$json_result['code'] = 200;
			$json_result['msg'] = '블루마크 인증 성공';
			return $json_result;
		} catch(mysqli_sql_exception $exception){
			$db->rollback();

			$json_result['code'] = 302;
			$json_result['msg'] = '블루마크 신규 인증에 실패했습니다.';
			
			return $json_result;
		}
	} else {
		$json_result['code'] = 401;
		$json_result['msg'] = '블루마크 신규 인증 처리에 실패했습니다.';
		
		return $json_result;
	}
}

if ($country != null && $member_idx != null && $handover_id != null && $bluemark_idx != null) {
	$db->begin_transaction();
	
	try {
		$my_bluemark_cnt = $db->count("BLUEMARK_INFO BI", "BI.IDX = ".$bluemark_idx." AND BI.MEMBER_IDX = '".$member_idx."' AND BI.STATUS = TRUE AND BI.DEL_FLG = FALSE");
		$handover_cnt = $db->count("MEMBER_".$country." MB", "MB.IDX = '".$member_idx."'");
	
		if ($my_bluemark_cnt > 0 && $handover_cnt > 0) {
			$update_handover_sql = "
				UPDATE
					BLUEMARK_INFO,
					(
						SELECT
							MB.IDX				AS TMP_MEMBER_IDX,
							MB.MEMBER_ID		AS TMP_MEMBER_ID,
							MB.MEMBER_NAME		AS TMP_MEMBER_NAME,
							MB.TEL_MOBILE		AS TMP_TEL_MOBILE,
							MB.MEMBER_ID		AS TMP_EMAIL,
							TRUE				AS TMP_STATUS,
							NOW()				AS TMP_UPDATE_DATE,
							(
								SELECT
									S_MB.MEMBER_ID
								FROM
									MEMBER_".$country." S_MB
								WHERE
									S_MB.IDX = ".$member_idx."
							)					AS TMP_UPDATER
						FROM
							MEMBER_".$country." MB
						WHERE
							MB.MEMBER_ID = '".$handover_id."'
					) AS TMP
				SET
					MEMBER_IDX		= TMP.TMP_MEMBER_IDX,
					MEMBER_ID		= TMP.TMP_MEMBER_ID,
					MEMBER_NAME		= TMP.TMP_MEMBER_NAME,
					TEL_MOBILE		= TMP.TMP_TEL_MOBILE,
					EMAIL			= TMP.TMP_EMAIL,
					STATUS			= TMP.TMP_STATUS,
					UPDATE_DATE		= NOW(),
					UPDATER			= TMP.TMP_UPDATER
				WHERE
					IDX = ".$bluemark_idx."
			";
			
			$db->query($update_handover_sql);

			$db_result = $db->affectedRows();
			
			if ($db_result > 0) {
				$insert_handover_sql = "
					INSERT INTO
						BLUEMARK_LOG
					(
						BLUEMARK_IDX,
						MEMBER_IDX,
						MEMBER_ID,
						MEMBER_NAME,
						IP,
						STATUS,
						REG_DATE
					)
					SELECT
						BI.IDX			AS BLUEMARK_IDX,
						BI.MEMBER_IDX	AS MEMBER_IDX,
						BI.MEMBER_ID	AS MEMBER_ID,
						BI.MEMBER_NAME	AS MEMBER_NAME,
						'".$ip."'		AS IP,	
						'양도'			AS STATUS,
						NOW()			AS REG_DATE
					FROM
						BLUEMARK_INFO BI
					WHERE 
						BI.IDX = ".$bluemark_idx."
				";
				
				$db->query($insert_handover_sql);
			}
		} else {
			if ($my_bluemark_cnt == 0) {
				$json_result['code'] = 401;
				$json_result['msg'] = '존재하지 않는 블루마크 인증정보입니다.';
				
				return $json_result;
			} else if ($handover_cnt == 0) {
				$json_result['code'] = 401;
				$json_result['msg'] = '양도하려는 멤버의 정보가 존재하지 않습니다.';
				
				return $json_result;
			}
		}

		$db->commit();
	} catch(mysqli_sql_exception $exception) {
		$db->rollback();
		$json_result['code'] = 401;
		$json_result['msg'] = '블루마크 양도처리에 실패했습니다.';
	}
} else {
	$db->rollback();
	$json_result['code'] = 401;
	$json_result['msg'] = '블루마크 양도처리에 실패했습니다.';
}
?>