<?php
/*
 +=============================================================================
 | 
 | 콜라보레이션 관리 페이지 - 콜라보레이션 정보 수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

/*$admin_idx = 0;
if (isset($_SESSION['ADMIN_IDX'])) {
	$admin_idx = $_SESSION['ADMIN_IDX'];
}*/

$display_num_flg		= $_POST['display_num_flg'];
$bookmark_flg			= $_POST['bookmark_flg'];
$copy_flg				= $_POST['copy_flg'];
$update_flg				= $_POST['update_flg'];

$session_id				= sessionCheck();
$collaboration_idx		= $_POST['collaboration_idx'];
$country				= $_POST['country'];
$posting_status			= $_POST['posting_status'];
$product_list_flg		= $_POST['product_list_flg'];
$product_link_flg		= $_POST['product_link_flg'];

$phs_column_name		= $_POST['phs_column_name'];
$lgc_column_name		= $_POST['lgc_column_name'];
$column_value			= $_POST['column_value'];

$collabo_product_idx	= $_POST['collabo_product_idx'];

if ($display_num_flg != null && $action_type != null && $recent_idx != null && $recent_num != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num - 1)."
			";
			
			$sql = "
				UPDATE
					POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num + 1)."
			";
			
			$sql = "
				UPDATE
					POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx."
			";
			
			break;
	}
	
	if (strlen($prev_sql) > 0) {
		$db->query($prev_sql);
	}
	
	if (strlen($sql) > 0) {
		$db->query($sql);
	}
}

if ($copy_flg != null && $copy_idx != null && $collaboration_idx != null) {
	$column_cnt = $db->count("COLLABORATION_COLUMN","COLLABORATION_IDX = ".$copy_idx);
	
	if ($column_cnt > 0) {
		$insert_column_sql = "
			INSERT INTO
				COLLABORATION_COLUMN
			(
				COLLABORATION_IDX,
				PHS_COLUMN_NAME,
				LGC_COLUMN_NAME,
				COLUMN_VALUE
			)
			SELECT
				".$collaboration_idx."	AS COLLABORATION_IDX,
				PHS_COLUMN_NAME			AS PHS_COLUMN_NAME,
				LGC_COLUMN_NAME			AS LGC_COLUMN_NAME,
				COLUMN_VALUE			AS COLUMN_VALUE
			FROM
				COLLABORATION_COLUMN
			WHERE
				COLLABORATION_IDX = ".$copy_idx."
		";
		
		$db->query($insert_column_sql);
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "선택한 콜라보레이션에는 복사 가능한 항목 정보가 없습니다.";
	}
}

if ($update_flg == "true" && $collaboration_idx != null && $collaboration_idx > 0) {
	$db->begin_transaction();

	try {
		$update_collaboration_sql = "
			UPDATE
				POSTING_COLLABORATION
			SET
				POSTING_STATUS = ".$posting_status.",
				PRODUCT_LIST_FLG = ".$product_list_flg.",
				PRODUCT_LINK_FLG = ".$product_link_flg.",
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$collaboration_idx."
		";
		
		$db->query($update_collaboration_sql);
		
		$bookmark_cnt = $db->count("COLLABORATION_BOOKMARK","COLLABORATION_IDX = ".$collaboration_idx);
		
		if ($bookmark_flg == "false" && $bookmark_cnt > 0) {
			$delete_bookmark_sql = "
				DELETE FROM
					COLLABORATION_BOOKMARK
				WHERE
					COLLABORATION_IDX = ".$collaboration_idx."
			";
			
			$db->query($delete_bookmark_sql);
			
			setBookmarkDisplayNum($db,$country,$collaboration_idx,"DEL");
		} else if ($bookmark_flg == "true" && $bookmark_cnt == 0) {
			$insert_bookmark_sql = "
				INSERT INTO
					COLLABORATION_BOOKMARK
				(
					COLLABORATION_IDX
				) VALUES (
					".$collaboration_idx."
				)
			";
			
			$db->query($insert_bookmark_sql);
			
			$db->query("UPDATE POSTING_COLLABORATION SET DISPLAY_NUM = 1 WHERE IDX = ".$collaboration_idx);
			
			setBookmarkDisplayNum($db,$country,$collaboration_idx,"ADD");
		}
		
		$db->query("DELETE FROM COLLABORATION_COLUMN WHERE COLLABORATION_IDX = ".$collaboration_idx);
		
		if ($phs_column_name != null) {
			for ($i=0; $i<count($phs_column_name); $i++) {
				$insert_column_sql = "
					INSERT INTO
						COLLABORATION_COLUMN
					(
						COLLABORATION_IDX,
						PHS_COLUMN_NAME,
						LGC_COLUMN_NAME,
						COLUMN_VALUE
					) VALUES (
						".$collaboration_idx.",
						'".$phs_column_name[$i]."',
						'".$lgc_column_name[$i]."',
						'".$column_value[$i]."'
					)
				";
				
				$db->query($insert_column_sql);
			}
		}
		
		if ($collabo_product_idx != null) {
			for ($j=0; $j<count($collabo_product_idx); $j++) {
				$display_flg_name = "display_flg_".$collabo_product_idx[$j];
				
				$update_product_sql = "
					UPDATE
						COLLABORATION_PRODUCT
					SET
						DISPLAY_FLG = ".$_POST[$display_flg_name]."
					WHERE
						IDX = ".$collabo_product_idx[$j]."
				";
				
				$db->query($update_product_sql);
			}
		}
		
		$db->commit();
		
		$json_result['code'] = 200;
	} catch(mysqli_sql_exception $exception){
		print_r($exception);
		
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "콜라보레이션 수정처리중 오류가 발생했습니다.";
	}
}

function setBookmarkDisplayNum($db,$country,$collaboration_idx,$bookmark_type) {
	$select_bookmark_sql = "
		SELECT
			PC.IDX				AS COLLABORATION_IDX
		FROM
			POSTING_COLLABORATION PC
			LEFT JOIN PAGE_POSTING PP ON
			PC.PAGE_IDX = PP.IDX
		WHERE
			PC.IDX != ".$collaboration_idx." AND
			PC.IDX IN (
				SELECT
					S_CB.COLLABORATION_IDX
				FROM
					COLLABORATION_BOOKMARK S_CB
			) AND
			PP.COUNTRY = '".$country."'
		ORDER BY
			PC.DISPLAY_NUM ASC
	";
	
	$db->query($select_bookmark_sql);
	
	$display_num = 0;
	if ($bookmark_type == "ADD") {
		$display_num = 2;
	} else if ($bookmark_type == "DEL") {
		$display_num = 1;
	}
	
	foreach($db->fetch() as $bookmark_data) {
		$tmp_bookmark_idx = $bookmark_data['COLLABORATION_IDX'];
		
		if (!empty($tmp_bookmark_idx)) {
			$update_bookmark_display_num_sql = "
				UPDATE
					POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".$display_num."
				WHERE
					IDX = ".$tmp_bookmark_idx."
			";
			
			$db->query($update_bookmark_display_num_sql);
			
			$display_num++;
		}
	}
	
	$select_collaboration_sql = "
		SELECT
			PC.IDX			AS COLLABORATION_IDX
		FROM
			POSTING_COLLABORATION PC
			LEFT JOIN PAGE_POSTING PP ON
			PC.PAGE_IDX = PP.IDX
		WHERE
			PC.IDX NOT IN (
				SELECT
					S_CB.COLLABORATION_IDX
				FROM
					COLLABORATION_BOOKMARK S_CB
			) AND
			PP.COUNTRY = '".$country."'
		ORDER BY
			PC.DISPLAY_NUM ASC
	";
	
	$db->query($select_collaboration_sql);
	
	foreach($db->fetch() as $collaboration_data) {
		$tmp_collabo_idx = $collaboration_data['COLLABORATION_IDX'];
		
		if (!empty($tmp_collabo_idx)) {
			$update_collaboration_sql = "
				UPDATE
					POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".$display_num."
				WHERE
					IDX = ".$tmp_collabo_idx."
			";
			
			$db->query($update_collaboration_sql);
			
			$display_num++;
		}
	}
}
?>