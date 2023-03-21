<?php
/*
 +=============================================================================
 | 
 | WKLA 정보 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sel_wkla_idx    	                        = $_POST['sel_wkla_idx'];			    //wkla idx

if($sel_wkla_idx != null){
    $where = ' WHERE IDX = '.$sel_wkla_idx;
}
$sql = 	'SELECT
            WI.IDX			AS WKLA_IDX,
            WI.WKLA_NAME	AS WKLA_NAME,
            WI.MEMO			AS WKLA_MEMO
        FROM 
            WKLA_INFO WI
            '.$where;

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'wkla_idx'		                =>intval($data['WKLA_IDX']),
        'wkla_name'				        =>$data['WKLA_NAME'],
        'wkla_memo'			            =>$data['WKLA_MEMO']
    );
}
?>