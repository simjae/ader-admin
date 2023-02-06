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
			AD.PERMITION_IDX	AS PERMITION_IDX,
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
					dev.ADMIN_PROFILE_IMG S_AI
				WHERE
					S_AI.ADMIN_IDX = AD.IDX AND
					S_AI.IMG_SIZE = 'S' AND
					S_AI.DEL_FLG = FALSE
			)					AS IMG_LOCATION
		FROM
			dev.ADMIN AD
			LEFT JOIN dev.ADMIN_PERMITION AP ON
			AD.IDX = AP.ADMIN_IDX
		WHERE
		   AD.IDX = ".$admin_idx."
	";
    
	$db->query($select_admin_sql);
    
	foreach($db->fetch() as $data) {
        $json_result['data'][] = array(
            'admin_idx'			=>$data['ADMIN_IDX'],
            'permition_idx'		=>$data['PERMITION_IDX'],
            'admin_id'			=>$data['ADMIN_ID'],
            'admin_name'		=>$data['ADMIN_NAME'],
            'admin_nick'		=>$data['ADMIN_NICK'],
            'admin_email'		=>$data['ADMIN_EMAIL'],
            'tel_mobile'		=>$data['TEL_MOBILE'],
            'admin_fax'			=>$data['ADMIN_FAX'],
			'img_location'		=>$data['IMG_LOCATION']
        );
    }
}
?>