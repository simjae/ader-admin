<?php
/*
 +=============================================================================
 | 
 | 상품목록 - 선택상품 상태수정
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.09.6
 | 최종 수정일	: 2022.12.13
 | 버전		:   1.2
 | 설명		:   1.1v 변경점 - TABLE COLUMN 최신화
 |              1.2v 변경점 - 트랜젝션 적용 및 불필요 쿼리 제거 
 | 
 +=============================================================================
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$no             = $_POST['no'];
$action_type    = $_POST['action_type'];

$where_values = array();
$where_ist = '';
$where_ist_values = array();

if($action_type != null){
    $db->begin_transaction();
    try {
        if(count($no) != 0){
            foreach($no as $val){
                $idx_list .= $val.',';
            }
        }
        $where = 'IDX IN ('.substr($idx_list, 0, -1).')';
        
        array_push($where_values, $idx_list);

        $prod_del_cnt = 0;
        $ordersheet_del_cnt = 0;
        //$set_delete_cnt = 0;

        $del_sql = "
            UPDATE
                dev.SHOP_PRODUCT
            SET
                DEL_FLG = TRUE
            WHERE
                IDX IN (".substr($idx_list, 0, -1).")";
        $db->query($del_sql);
        $prod_del_cnt = $db->mysqli_affected_rows();

        if($prod_del_cnt > 0){
            $ordersheet_del_sql = "
                UPDATE 
                    dev.ORDERSHEET_MST
                SET
                    DEL_FLG = TRUE
                WHERE 
                    IDX IN (SELECT 
                                ORDERSHEET_IDX
                            FROM
                                dev.SHOP_PRODUCT
                            WHERE
                                IDX IN (".substr($idx_list, 0, -1).")
                            )";
            $db->query($ordersheet_del_sql);
            $ordersheet_del_cnt = $db->mysqli_affected_rows();

            if($ordersheet_del_cnt > 0){
                $set_del_sql = "
                    DELETE FROM
                        dev.SET_PRODUCT
                    WHERE
                        SET_PRODUCT_IDX IN (".substr($idx_list, 0, -1).")";
                $db->query($set_del_sql);
                $db->commit();
            }
            else{
                exceptionAction();
            }
        }
        else{
            exceptionAction();
        }
        /*
        if($ordersheet_delete_cnt > 0){
            $set_del_sql = "
                DELETE FROM
                    dev.SET_PRODUCT
                WHERE
                    SET_PRODUCT_IDX IN (".substr($idx_list, 0, -1).")";
            $db->query($set_del_sql);
        }
        */
    } catch(mysqli_sql_exception $exception){
		exceptionAction();
	} 
}

function exceptionAction(){
    if(isset($exception)){
        echo $exception->getMessage();
    }
    $json_result['code'] = 301;
    $db->rollback();
    $msg = "등록작업에 실패했습니다.";
}
    /*
    switch ($action_type) {
        case 'prod_copy':
            $sql = 	'
                    SELECT 
                        PRODUCT_TYPE,
                        PRODUCT_CODE,
                        PRODUCT_NAME,
                        COLOR,
                        COLOR_CODE,
                        CATEGORY_IDX,
                        MD_CATEGORY_1,
                        MD_CATEGORY_2,
                        MD_CATEGORY_3,
                        MD_CATEGORY_4,
                        MD_CATEGORY_5,
                        MD_CATEGORY_6,
                        PL_LRG_CATEGORY,
                        PL_MDL_CATEGORY,
                        PL_SML_CATEGORY,
                        PL_DTL_CATEGORY,
                        SIZE,
                        SIZE_DETAIL_A1_KR,
                        SIZE_DETAIL_A2_KR,
                        SIZE_DETAIL_A3_KR,
                        SIZE_DETAIL_A4_KR,
                        SIZE_DETAIL_A5_KR,
                        SIZE_DETAIL_A1_EN,
                        SIZE_DETAIL_A2_EN,
                        SIZE_DETAIL_A3_EN,
                        SIZE_DETAIL_A4_EN,
                        SIZE_DETAIL_A5_EN,
                        SIZE_DETAIL_A1_CN,
                        SIZE_DETAIL_A2_CN,
                        SIZE_DETAIL_A3_CN,
                        SIZE_DETAIL_A4_CN,
                        SIZE_DETAIL_A5_CN,
                        MATERIAL_KR,
                        MATERIAL_EN,
                        MATERIAL_CN,
                        CARE_KR,
                        CARE_EN,
                        CARE_CN,
                        DETAIL_KR,
                        DETAIL_EN,
                        DETAIL_CN,
                        PRICE_KR,
                        PRICE_KR_GB,
                        PRICE_EN,
                        PRICE_CN,
                        SALES_PRICE_KR,
                        SALES_PRICE_EN,
                        SALES_PRICE_CN
                    FROM 
                        '.$_TABLE['SHOP_PRODUCT'].'
                    WHERE 
                        '.$where.'
                    ORDER BY 
                        IDX
                    ';
            $db->query($sql);
            foreach($db->fetch() as $data) {
                if(!isset($db2)){
                    $db2 = new db();
                } 
                $values = array(
                        'PRODUCT_TYPE'          => $data['PRODUCT_TYPE'],
                        'PRODUCT_CODE'          => $data['PRODUCT_CODE'],
                        'PRODUCT_NAME'          => $data['PRODUCT_NAME'],
                        'COLOR'                 => $data['COLOR'],
                        'COLOR_CODE'            => $data['COLOR_CODE'],
                        'CATEGORY_IDX'          => $data['CATEGORY_IDX'],
                        'MD_CATEGORY_1'         => $data['MD_CATEGORY_1'],
                        'MD_CATEGORY_2'         => $data['MD_CATEGORY_2'],
                        'MD_CATEGORY_3'         => $data['MD_CATEGORY_3'],
                        'MD_CATEGORY_4'         => $data['MD_CATEGORY_4'],
                        'MD_CATEGORY_5'         => $data['MD_CATEGORY_5'],
                        'MD_CATEGORY_6'         => $data['MD_CATEGORY_6'],
                        'PL_LRG_CATEGORY'       => $data['PL_LRG_CATEGORY'],
                        'PL_MDL_CATEGORY'       => $data['PL_MDL_CATEGORY'],
                        'PL_SML_CATEGORY'       => $data['PL_SML_CATEGORY'],
                        'PL_DTL_CATEGORY'       => $data['PL_DTL_CATEGORY'],
                        'SIZE'                  => $data['SIZE'],
                        'SIZE_DETAIL_A1_KR'     => $data['SIZE_DETAIL_A1_KR'],
                        'SIZE_DETAIL_A2_KR'     => $data['SIZE_DETAIL_A2_KR'],
                        'SIZE_DETAIL_A3_KR'     => $data['SIZE_DETAIL_A3_KR'],
                        'SIZE_DETAIL_A4_KR'     => $data['SIZE_DETAIL_A4_KR'],
                        'SIZE_DETAIL_A5_KR'     => $data['SIZE_DETAIL_A5_KR'],
                        'SIZE_DETAIL_A1_EN'     => $data['SIZE_DETAIL_A1_EN'],
                        'SIZE_DETAIL_A2_EN'     => $data['SIZE_DETAIL_A2_EN'],
                        'SIZE_DETAIL_A3_EN'     => $data['SIZE_DETAIL_A3_EN'],
                        'SIZE_DETAIL_A4_EN'     => $data['SIZE_DETAIL_A4_EN'],
                        'SIZE_DETAIL_A5_EN'     => $data['SIZE_DETAIL_A5_EN'],
                        'SIZE_DETAIL_A1_CN'     => $data['SIZE_DETAIL_A1_CN'],
                        'SIZE_DETAIL_A2_CN'     => $data['SIZE_DETAIL_A2_CN'],
                        'SIZE_DETAIL_A3_CN'     => $data['SIZE_DETAIL_A3_CN'],
                        'SIZE_DETAIL_A4_CN'     => $data['SIZE_DETAIL_A4_CN'],
                        'SIZE_DETAIL_A5_CN'     => $data['SIZE_DETAIL_A5_CN'],
                        'MATERIAL_KR'           => $data['MATERIAL_KR'],
                        'MATERIAL_EN'           => $data['MATERIAL_EN'],
                        'MATERIAL_CN'           => $data['MATERIAL_CN'],
                        'CARE_KR'               => $data['CARE_KR'],
                        'CARE_EN'               => $data['CARE_EN'],
                        'CARE_CN'               => $data['CARE_CN'],
                        'DETAIL_KR'             => $data['DETAIL_KR'],
                        'DETAIL_EN'             => $data['DETAIL_EN'],
                        'DETAIL_CN'             => $data['DETAIL_CN'],
                        'PRICE_KR'              => $data['PRICE_KR'],
                        'PRICE_KR_GB'           => $data['PRICE_KR_GB'],
                        'PRICE_EN'              => $data['PRICE_EN'],
                        'PRICE_CN'              => $data['PRICE_CN'],
                        'SALES_PRICE_KR'        => $data['SALES_PRICE_KR'],
                        'SALES_PRICE_EN'        => $data['SALES_PRICE_EN'],
                        'SALES_PRICE_CN'        => $data['SALES_PRICE_CN'],
                        'CREATER'               => 'Admin' ,
                        'UPDATER'               => 'Admin'  
                );
                $db2->insert(
                        $_TABLE['SHOP_PRODUCT'],
                        $values,
                        $where_ist,
                        $where_ist_values
                );
            }
            $code = 200;
        break;
        case 'prod_delete':
            $del_sql = "
                        UPDATE
                            dev.SHOP_PRODUCT
                        SET
                            DEL_FLG = TRUE
                        WHERE
                            IDX IN (".substr($idx_list, 0, -1).")";
            $db->query($del_sql);

            $prod_delete_cnt = 0;
            $prod_delete_cnt = $db->mysqli_affected_rows();

            $ordersheet_delete_cnt = 0;
            if($prod_delete_cnt > 0){
                $ordersheet_del_sql = "
                            UPDATE 
                                dev.ORDERSHEET_IDX
                            SET
                                DEL_FLG = TRUE
                            WHERE 
                                IDX IN (SELECT 
                                            ORDERSHEET_IDX
                                        FROM
                                            dev.SHOP_PRODUCT
                                        WHERE
                                            IDX IN (".substr($idx_list, 0, -1).")";
                $db->query($ordersheet_del_sql);
                $ordersheet_delete_cnt = $db->mysqli_affected_rows();
            }
            $set_delete_cnt = 0;
            if($ordersheet_delete_cnt > 0){
                $set_del_sql = "
                    UPDATE
                        dev.SET_PRODUCT
                    SET
                        DEL_FLG = TRUE
                    WHERE
                        SET_PRODUCT_IDX IN (".substr($idx_list, 0, -1).")";
                $db->query($set_del_sql);
                $set_delete_cnt = $db->mysqli_affected_rows();
            }
            
            if($set_delete_cnt > 0){
                //commit
            }
        break;
    }
    */
?>