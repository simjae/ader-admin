<?php
/*
 +=============================================================================
 | 
 | 바우처 발급처리 API
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		:
 | 
 +=============================================================================
*/

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/** 변수 정리 **/


/*
$db->begin_transaction();
try {
	*/
	if(isset($_POST['on_off_type'])){

		//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$db->begin_transaction();
		try {

			$country                = $_POST['country'];
			$on_off_type           	= $_POST['on_off_type'];
			$voucher_type           = $_POST['voucher_type'];
			$voucher_idx            = $_POST['voucher_idx'];
			$offline_issue_cnt      = $_POST['offline_issue_cnt'];

			$member_level			= $_POST['member_level'];
			$member_idx				= $_POST['member_idx'];

			if($on_off_type == 'OFF'){
				if($offline_issue_cnt != null && is_numeric($offline_issue_cnt)){
					for($i = 0; $i < $offline_issue_cnt; $i++){
						$insert_issue_sql = '
							INSERT INTO dev.VOUCHER_ISSUE(	
								COUNTRY,
								VOUCHER_IDX,
								VOUCHER_ISSUE_CODE,
								CREATER,
								UPDATER
							)
							VALUES(
								"'.$country.'",
								'.$voucher_idx.',
								"'.makeVoucherCode().'",
								"Admin",
								"Admin"
							)
						';
						$db->query($insert_issue_sql);
					}
				}
			}
			else if($on_off_type == 'ON'){
				$voucher_mst_sql = "
					SELECT
						VM.IDX					AS VOUCHER_IDX,
						VM.VOUCHER_START_DATE	AS USABLE_START_DATE,
						VM.VOUCHER_END_DATE		AS USABLE_START_DATE
					FROM 
						dev.VOUCHER_MST VM
					WHERE 
						VM.IDX = ".$voucher_idx."
				";
		
				$db->query($voucher_mst_sql);
				foreach($db->fetch() as $data){
					$usable_start_date = "NULL";
					$usable_end_date = "NULL";
					
					if ($data['USABLE_START_DATE'] != null && $data['USABLE_END_DATE']) {
						$usable_start_date	= "'".$data['USABLE_START_DATE']."'";
						$usable_end_date	= "'".$data['USABLE_START_DATE']."'";
					}
		
					$where = "1=1";
					$where .= " AND (MB.MEMBER_STATUS = 'NML') ";
					$where .= " AND (
									MB.IDX NOT IN (
										SELECT
											MEMBER_IDX
										FROM
											dev.VOUCHER_ISSUE
										WHERE
											VOUCHER_IDX = ".$voucher_idx."
									) 
								)";
					$where .= " AND (TEL_MOBILE IS NOT NULL OR TEL_MOBILE != '')";
		
					if($voucher_type == 'MB' && $member_level != null){
						$where .= ' AND MB.IDX IN ('.implode(",",$member_idx).') ';
					}
		
					//여러번 시행시, 중복 전화번호로 등록된 아이디들 중 하나씩 발급되는 버그 있음
					//수정 필요
					else if($voucher_type == 'LV' && $member_level != null){
						$where .= ' AND MB.LEVEL_IDX IN ('.implode(",",$member_level).') ';
						$where .= " GROUP BY MB.TEL_MOBILE ";
					}
		
					$select_member_sql = "
						SELECT
							MB.IDX			AS MEMBER_IDX,
							MB.MEMBER_ID	AS MEMBER_ID
						FROM
							dev.MEMBER_".$country." MB
						WHERE
							".$where."
					";
		
					$db->query($select_member_sql);
		
					$db_result = 0;
					foreach($db->fetch() as $member_data) {
						$insert_issue_sql = '
							INSERT INTO
								dev.VOUCHER_ISSUE
							(
								COUNTRY,
								VOUCHER_IDX,
								VOUCHER_ISSUE_CODE,
								USABLE_START_DATE,
								USABLE_END_DATE,
								MEMBER_IDX,
								MEMBER_ID,
								CREATER,
								UPDATER
							) VALUES (
								"'.$country.'",
								'.$voucher_idx.',
								"'.makeVoucherCode().'",
								'.$usable_start_date.',
								'.$usable_end_date.',
								'.$member_data['MEMBER_IDX'].',
								"'.$member_data['MEMBER_ID'].'",
								"Admin",
								"Admin"
							)
						';
		
						$db->query($insert_issue_sql);
		
						$db_result++;
					}
		
					if ($db_result > 0) {
						;
					}
					else{
						$json_result['code'] = 301;
						$msg = "발급가능한 회원이 없습니다.";
					}
				}
			}
			$voucher_update_sql = "
				UPDATE 
					dev.VOUCHER_MST
				SET 
					TOT_ISSUE_NUM = (SELECT 
										COUNT(0)
									FROM
										dev.VOUCHER_ISSUE
									WHERE
										VOUCHER_IDX = ".$voucher_idx.")
				WHERE
					IDX = ".$voucher_idx."
			";
			$db->query($voucher_update_sql);
			$db->commit();
		}
		catch(mysqli_sql_exception $exception){
			echo $exception->getMessage();
			$json_result['code'] = 301;
			$db->rollback();
			$msg = "바우처 발급 처리에 실패했습니다.";
		}
	}
	
/*
}
catch(mysqli_sql_exception $exception){
	echo $exception->getMessage();
	$json_result['code'] = 301;
	$db->rollback();
	$msg = "바우처 발급 처리에 실패했습니다.";
}
*/


function brithVoucherIssue($login_db, $country, $login_member_idx, $start_date_param, $end_date_param){
	if ($login_member_idx != null && $login_member_idx != 0) {
		$now = date('Y-m-d');
		$select_voucher_sql = "
			SELECT
				VM.IDX					AS VOUCHER_IDX,
				VM.VOUCHER_START_DATE	AS USABLE_START_DATE,
				VM.VOUCHER_END_DATE		AS USABLE_END_DATE
			FROM
				dev.VOUCHER_MST VM
			WHERE
				VOUCHER_TYPE = 'BR'
			AND
				COUNTRY = '".$country."'
		";
		
		$login_db->query($select_voucher_sql);
	
		$usable_start_date = "NULL";
		$usable_end_date = "NULL";
	
		$last_id = 0;
		foreach($login_db->fetch() as $data) {
			$voucher_idx = $data['VOUCHER_IDX'];
			$usable_start_date = "DATE('".$start_date_param."')";
			$usable_end_date = "DATE('".$end_date_param."')";
	
			//echo '$voucher_idx :'.$voucher_idx .' ,$usable_start_date:'.$usable_start_date.' ,$usable_end_date:'.$usable_end_date.",MEMBER_IDX = ".$login_member_idx;

			if (!empty($voucher_idx)) {
				$issue_cnt = $login_db->count("dev.VOUCHER_ISSUE VI","VI.VOUCHER_IDX = ".$voucher_idx." AND VI.MEMBER_IDX = ".$login_member_idx);
				//echo $issue_cnt;
				if ($issue_cnt == 0) {
					$duplicate_where = "
						MB.IDX IN (
							SELECT
								S_VI.MEMBER_IDX
							FROM
								dev.VOUCHER_ISSUE S_VI
							WHERE
								S_VI.VOUCHER_IDX = ".$voucher_idx."
						) AND
						MB.TEL_MOBILE = (
							SELECT
								S_MB.TEL_MOBILE
							FROM
								dev.MEMBER_KR S_MB
							WHERE
								S_MB.IDX = ".$login_member_idx."
						)
					";
					
					$duplicate_cnt = $login_db->count('dev.MEMBER_'.$country." MB",$duplicate_where);
					
					if ($duplicate_cnt == 0) {
						$insert_voucher_sql = '
							INSERT INTO
								dev.VOUCHER_ISSUE
							(
								COUNTRY,
								VOUCHER_IDX,
								VOUCHER_ISSUE_CODE,
								VOUCHER_ADD_DATE,
								USABLE_START_DATE,
								USABLE_END_DATE,
								CREATE_YEAR,
								CREATE_MONTH,
								MEMBER_IDX,
								MEMBER_ID,
								CREATER,
								UPDATER
							)
							SELECT 
								"'.$country.'",
								'.$voucher_idx.',
								"'.makeVoucherCode().'",
								NOW(),
								'.$usable_start_date.',
								'.$usable_end_date.',
								DATE_FORMAT(NOW(), "%Y"),
								DATE_FORMAT(NOW(), "%m"),
								MB.IDX,
								MB.MEMBER_ID,
								"Admin",
								"Admin"
							FROM
								dev.MEMBER_'.$country.' MB
							WHERE
								MB.IDX = '.$login_member_idx.'
						';
	
						$login_db->query($insert_voucher_sql);
						$last_id = $login_db->last_id();

						$voucher_update_sql = "
							UPDATE 
								dev.VOUCHER_MST
							SET 
								TOT_ISSUE_NUM = (SELECT 
													COUNT(0)
												FROM
													dev.VOUCHER_ISSUE
												WHERE
													VOUCHER_IDX = ".$voucher_idx.")
							WHERE
								IDX = ".$voucher_idx."
						";
						$login_db->query($voucher_update_sql);
					}
				}
			}
		}
	}

	if($last_id > 0){
		return true;
	}
	else{
		return false;
	}
}


/*
$sel_idx = $_POST['sel_idx'];

$db->begin_transaction();
try {
	$where = "1=1";
	$sel_list_str = implode(',',$sel_idx);
	if ($sel_idx != null) {
		$where .= " AND IDX IN (".$sel_list_str.")";
	}

    $where .= " AND USED_FLG = FALSE";

	//수정항목
	$db->query("
		UPDATE 
			dev.VOUCHER_ISSUE 
		SET 
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW()
		WHERE 
			".$where."
	");

	$db->commit();
}
catch(mysqli_sql_exception $exception){
	echo $exception->getMessage();
	$json_result['code'] = 301;
	$db->rollback();
	$msg = "발급 바우처 삭제 처리에 실패했습니다.";
}
*/

//발급 코드 생성
function makeVoucherCode(){
	$micro_now      = microtime(true);
	$micro_now_dex  = str_replace('.','',$micro_now);
	$micro_now_hex  = dechex($micro_now_dex);

	return $micro_now_hex;
}
?>