<?php
/*
 +=============================================================================
 | 
 | 회원 중복 체크
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$product_code     = $_POST['product_code'];

if($product_code != null){
    //검색 유형 - 디폴트
    $where = '1=1';
    $where .= " AND (PRODUCT_CODE = '".$product_code."')
                AND DEL_FLG  = FALSE";
    $table = 'dev.ORDERSHEET_MST';
    $sql = 	'
            SELECT
                COUNT(IDX) AS PRODUCT_CNT
            FROM 
                '.$table.'      
            WHERE 
                '.$where.'
            ';

    $db->query($sql);
    foreach($db->fetch() as $data) {
            $json_result['data'][] = array(
                'product_cnt'	=>$data['PRODUCT_CNT']
            );
        }
    }

?>