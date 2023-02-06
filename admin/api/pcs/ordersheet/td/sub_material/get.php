<?php
/*
 +=============================================================================
 | 
 | 부자재 정보 목록
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

$sel_sub_material_idx               = $_POST['sel_sub_material_idx'];			    //wkla idx
$all_flg                            = $_POST['all_flg']; 

if($sel_sub_material_idx != null){
    $where = ' WHERE IDX = '.$sel_sub_material_idx;
}
if($all_flg != null && $all_flg == 'true'){
    $where = '';
}
$sql = 	'SELECT
            IDX                                         AS SUB_MATERIAL_IDX,
            SUB_MATERIAL_NAME                           AS SUB_MATERIAL_NAME,
            SUB_MATERIAL_CODE                           AS SUB_MATERIAL_CODE,
            SUB_MATERIAL_TYPE                           AS SUB_MATERIAL_TYPE,
            MEMO                                        AS SUB_MATERIAL_MEMO
        FROM 
            dev.SUB_MATERIAL_INFO
            '.$where;

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'sub_material_idx'		                =>intval($data['SUB_MATERIAL_IDX']),
        'sub_material_name'				        =>$data['SUB_MATERIAL_NAME'],
        'sub_material_code'				        =>$data['SUB_MATERIAL_CODE'],
        'sub_material_type'				        =>$data['SUB_MATERIAL_TYPE'],
        'sub_material_memo'			            =>$data['SUB_MATERIAL_MEMO']
    );
}
?>