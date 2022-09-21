<?php
/*
 +=============================================================================
 | 
 | 알림메세지 목록 획득 api
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.09.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$tables = '
	dev.ALARM_INFO
';

//검색 유형 - 디폴트
$where = 'DEL_FLG = FALSE ';


$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where)
);

$sql = 	'
		SELECT 
			IDX,
            COUNTRY,
            ALARM_CONDITION,
            ALARM_MESSAGE,
            CREATE_DATE,
            CREATER,
            UPDATE_DATE,
            UPDATER	
		FROM 
			'.$tables.'
		WHERE 
			'.$where;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
        'rn'                =>$total_cnt--,
		'idx'			    =>intval($data['IDX']),
		'country'			=>$data['COUNTRY'],
		'alarm_condition'	=>$data['ALARM_CONDITION'],
		'alarm_message'		=>stripslashes($data['ALARM_MESSAGE']),
		'create_date'		=>$data['CREATE_DATE'],
		'creater'		    =>$data['CREATER'],
        'update_date'		=>$data['UPDATE_DATE'],
        'updater'           =>$data['UPDATER']
	);
}
?>