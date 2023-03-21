<?php
/*
 +=============================================================================
 | 
 | 관리자 : 관리자계정 리스트
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$admin_idx = $_POST['admin_idx'];

if($admin_idx != null) {
    $select_admin_sql = "
		SELECT 
			AD.IDX				AS ADMIN_IDX,
			AD.ADMIN_ID			AS ADMIN_ID,
			AD.ADMIN_NAME		AS ADMIN_NAME,
			AD.ADMIN_NICK		AS ADMIN_NICK,
			AD.ADMIN_EMAIL		AS ADMIN_EMAIL,
			AD.TEL_MOBILE		AS TEL_MOBILE,
			AD.ADMIN_FAX		AS ADMIN_FAX,
			(
				SELECT 
					REPLACE(
						S_AI.IMG_LOCATION,
						'/var/www/admin/www',
						''
					)
				FROM
					ADMIN_PROFILE_IMG S_AI
				WHERE
					S_AI.ADMIN_IDX = AD.IDX AND
					S_AI.IMG_SIZE = 'S' AND
					S_AI.DEL_FLG = FALSE
			)					AS IMG_LOCATION
		FROM
			ADMIN AD
		WHERE
		   AD.IDX = ".$admin_idx."
	";
    
	$db->query($select_admin_sql);
    
	foreach($db->fetch() as $admin_data) {
		$admin_idx = $admin_data['ADMIN_IDX'];
		
		$permition_mapping = array();
		if (!empty($admin_idx)) {
			$select_permition_mapping_sql = "
				SELECT
					PM.PERMITION_IDX	AS PERMITION_IDX
				FROM
					PERMITION_MAPPING PM
				WHERE
					PM.ADMIN_IDX = ".$admin_idx."
			";
			
			$db->query($select_permition_mapping_sql);
			
			foreach($db->fetch() as $mapping_data) {
				$checked = false;
				if ($mapping_data['PERMITION_IDX'] != null) {
					$checked = true;
				}
				
				$permition_mapping[$mapping_data['PERMITION_IDX']] = $checked;
			}
		}
		
        $json_result['data'][] = array(
            'admin_idx'				=>$admin_data['ADMIN_IDX'],
			'type_title'			=>$admin_data['TYPE_TITLE'],
            'admin_id'				=>$admin_data['ADMIN_ID'],
            'admin_name'			=>$admin_data['ADMIN_NAME'],
            'admin_nick'			=>$admin_data['ADMIN_NICK'],
            'admin_email'			=>$admin_data['ADMIN_EMAIL'],
            'tel_mobile'			=>$admin_data['TEL_MOBILE'],
            'admin_fax'				=>$admin_data['ADMIN_FAX'],
			'img_location'			=>$admin_data['IMG_LOCATION'],
			
			'permition_mapping'		=>$permition_mapping
        );
    }
}
?>