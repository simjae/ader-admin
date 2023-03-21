<?php
/*
 +=============================================================================
 | 
 | 진열상품 엑셀 대량등록 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.16
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();
//블루마크시트 json string 디코딩
$display_product_sheet = $_POST['display_product_sheet'];
$sel_idx    = NULL;
$sel_idx    = $_POST['sel_idx'];
$sheet_data = json_decode($display_product_sheet, true);

$msg = "";

$display_product_fail_cnt = array();

if($sheet_data != null && $sel_idx != NULL){
    
    $db->begin_transaction();
    try {
        $success_cnt = 0;
        $row = 2;
        $display_num = 1;
        $delete_old_display_product_sql = "
            UPDATE PRODUCT_GRID
            SET
                DEL_FLG = TRUE
            WHERE
                PAGE_IDX = ".$sel_idx."
        ";
        $db->query($delete_old_display_product_sql);
        foreach($sheet_data as $val){
            /*
                $val[0]:상품코드
            */
            $row++;
    
            $product_code = NULL;
            $product_code = $val[0];
    
            if($product_code != NULL){
                $display_product_cnt = $db->count('SHOP_PRODUCT', 'PRODUCT_CODE = "'.$product_code.'" AND SALE_FLG = TRUE ');
    
                if($display_product_cnt > 0){
    
                    $insert_display_product_sql = "
                        INSERT INTO PRODUCT_GRID
                        (
                            PAGE_IDX,
                            DISPLAY_NUM,
                            TYPE,
                            PRODUCT_IDX,
                            PRODUCT_CODE,
                            LINK_URL,
                            CREATER,
                            UPDATER
                        )
                        SELECT
                            ".$sel_idx.",
                            ".$display_num.",
                            'PRD',
                            IDX,
                            PRODUCT_CODE,
                            'product/detail?product_idx=',
                            '".$session_id."',
                            '".$session_id."'
                        FROM
                            SHOP_PRODUCT
                        WHERE
                            PRODUCT_CODE = '".$product_code."'
                    ";
    
                    $db->query($insert_display_product_sql);
                    $product_grid_idx = $db->last_id();
    
                    $display_num++;
                }
                else{
                    $json_result['code'] = 301;
                    $json_result['msg'] = "진열상품 중에 판매상태가 아닌 상품이 있습니다. 상품정보를 다시 확인해주세요."; 
                    $db->rollback();
                    return $json_result;         
                }
            }
        }
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $json_result['msg'] = '진열상품 등록작업이 실패했습니다.';
        $db->rollback();
        return $json_result;
    }
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = "빈 엑셀시트입니다. 엑셀 파일을 다시 확인해주세요";
    
    return $json_result;
}
?>