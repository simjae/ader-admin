<?php
/*
 +=============================================================================
 | 
 | 매장 찾기 - 매장 정보 개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.02.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/

$country = null;
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

$store_type = null;
if (isset($_POST['store_type'])) {
	$store_type = $_POST['store_type'];
}

$store_idx = 0;
if (isset($_POST['store_idx'])) {
	$store_idx = $_POST['store_idx'];
}

$limit_contents_flg = false;
if (isset($_POST['limit_contents_flg'])) {
	$limit_contents_flg = $_POST['limit_contents_flg'];
}

if ($country == null) {
	$json_result['code'] = 301;
	$json_result['msg'] = "부적절한 경로로 접근하셨습니다. 언어설정 확인 후 다시 시도해주세요.";
}

if ($store_type == null || $store_idx == 0) {
	$json_result['code'] = 301;
	$json_result['msg'] = "조회하려는 매장을 다시 선택해주세요.";
}

if ($store_type != null && $store_idx > 0) {
	$store_table = "";
	$contents_table = "";
	switch ($store_type) {
		case "SPC" :
			$store_table = "dev.STORE_SPACE";
			$contents_table = "dev.CONTENTS_SPACE";
			break;
		
		case "PLG" :
			$store_table = "dev.STORE_PLUGSHOP";
			$contents_table = "dev.CONTENTS_PLUGSHOP";
			break;
		
		case "STC" :
			$store_table = "dev.STORE_STOCKIST";
			break;
	}
	
	$select_store_sql = "
		SELECT
			SI.IDX						AS STORE_IDX,
			SI.COUNTRY_".$country."		AS COUNTRY,
			SI.STORE_NAME				AS STORE_NAME,
			SI.STORE_ADDR				AS STORE_ADDR,
			SI.STORE_TEL				AS STORE_TEL,
			SI.STORE_SALE_DATE			AS STORE_SALE_DATE,
			SI.STORE_LINK				AS STORE_LINK,
			SI.INSTAGRAM_ID				AS INSTAGRAM_ID
		FROM
			".$store_table." SI
		WHERE
			SI.IDX = ".$store_idx." AND
			SI.DEL_FLG = FALSE
	";
	
	$db->query($select_store_sql);
	
	$store_info = array();
	foreach ($db->fetch() as $store_data) {
		$store_idx = $store_data['STORE_IDX'];
		
		$contents_info = array();
		if (!empty($store_idx) && strlen($contents_table) > 0) {
			$select_contents_sql = "
				SELECT
					CI.CONTENTS_LOCATION		AS CONTENTS_LOCATION
				FROM
					".$contents_table." CI
				WHERE
					CI.STORE_IDX = ".$store_idx." AND
					DEL_FLG = FALSE
			";
			
			$limit_contents = "";
			if ($limit_contents_flg != false) {
				$limit_contents = "
					ORDER BY
						CI.IDX ASC
					LIMIT
						0,1
				";
			}
			
			$select_contents_sql .= $limit_contents;
			
			$db->query($select_contents_sql);
			
			foreach($db->fetch() as $contents_data) {
				$contents_info[] = array(
					'contents_location'		=>$contents_data['CONTENTS_LOCATION']
				);
			}
		}
		
		$store_info[] = array(
			'store_idx'			=>$store_data['STORE_IDX'],
			'store_type'		=>$store_type,
			'country'			=>$store_data['COUNTRY'],
			'store_name'		=>$store_data['STORE_NAME'],
			'store_addr'		=>$store_data['STORE_ADDR'],
			'store_tel'			=>$store_data['STORE_TEL'],
			'store_sale_date'	=>$store_data['STORE_SALE_DATE'],
			'store_link'		=>$store_data['STORE_LINK'],
			'instagram_id'		=>$store_data['INSTAGRAM_ID'],
			
			'contents_info'		=>$contents_info
		);
	}
	
	$json_result['data'] = $store_info;
}

?>