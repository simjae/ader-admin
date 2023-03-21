<?php
/*
 +=============================================================================
 | 
 | 블루마크 로그 리스트 추출 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$bluemark_idx 		= $_POST['bluemark_idx'];

if ($bluemark_idx != null) {
	$sql = "SELECT
				CASE
					WHEN
						(
							SELECT
								COUNT(S_PI.IDX)
							FROM
								PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = BI.PRODUCT_IDX AND
								S_PI.IMG_SIZE = 'M' AND
								S_PI.IMG_TYPE = 'P'
						) > 0
						THEN
							(
								SELECT
									REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
								FROM
									PRODUCT_IMG S_PI
								WHERE
									S_PI.PRODUCT_IDX = BI.PRODUCT_IDX AND
									S_PI.DEL_FLG = FALSE AND
									S_PI.IMG_SIZE = 'M' AND
									S_PI.IMG_TYPE = 'P'
								ORDER BY
									S_PI.IDX ASC
								LIMIT
									0,1
							)
					ELSE
						'/images/default_product_img.jpg'
				END						AS IMG_LOCATION,
				BI.PRODUCT_NAME			AS PRODUCT_NAME,
				BI.PRODUCT_CODE			AS PRODUCT_CODE,
				IFNULL(BI.BARCODE,'-')	AS BARCODE,
				BI.SERIAL_CODE			AS SERIAL_CODE,
				IFNULL(BI.SEASON,'-')	AS SEASON
			FROM
				BLUEMARK_INFO BI
			WHERE
				BI.IDX = ".$bluemark_idx;

	$db->query($sql);

	foreach($db->fetch() as $data) {
		$log_cnt = $db->count("BLUEMARK_LOG","BLUEMARK_IDX = ".$bluemark_idx);
		
		$log_info = array();
		if ($log_cnt > 0) {
			$log_sql = "SELECT
							BL.MEMBER_IDX	AS MEMBER_IDX,
							BL.MEMBER_ID	AS MEMBER_ID,
							BL.MEMBER_NAME	AS MEMBER_NAME,
							MB.LEVEL		AS MEMBER_LEVEL,
							BL.IP			AS IP,
							BL.REG_DATE		AS REG_DATE
						FROM
							BLUEMARK_LOG BL
							LEFT JOIN MEMBER MB ON
							BL.MEMBER_IDX = MB.IDX
						WHERE
							BL.BLUEMARK_IDX = ".$bluemark_idx;

			$db->query($log_sql);

			foreach($db->fetch() as $log_data) {
				$log_info[] = array(
					'num'			=>$log_cnt--,
					'member_idx'	=>$log_data['MEMBER_IDX'],
					'member_id'		=>$log_data['MEMBER_ID'],
					'member_name'	=>$log_data['MEMBER_NAME'],
					'member_level'	=>$log_data['MEMBER_LEVEL'],
					'ip'		    =>$log_data['IP'],
					'reg_date'		=>$log_data['REG_DATE']
				);
			}
		}
		
		$json_result['data'][] = array(
			'product_name'	=>$data['PRODUCT_NAME'],
			'product_code'	=>$data['PRODUCT_CODE'],
			'barcode'		=>$data['BARCODE'],
			'serial_code'	=>$data['SERIAL_CODE'],
			'season'		=>$data['SEASON'],
			'img_location'	=>$data['IMG_LOCATION'],
			'log_info'		=>$log_info
		);
	}
}
?>