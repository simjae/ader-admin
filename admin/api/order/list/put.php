<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
	$no             = $_POST['no'];
    $action_type    = $_POST['action_type'];
    
    $where_values = array();
    $where_ist = '';
    $where_ist_values = array();
    
    if(count($no) != 0){
        foreach($no as $val){
            $idx_list .= $val.',';
        }
    }
    $where = 'IDX IN ('.substr($idx_list, 0, -1).')';
    ;
	array_push($where_values, $idx_list);
    switch ($action_type) {
        case 'prod_copy':
            $sql = 	'
                    SELECT 
                        PRODUCT_TYPE,
                        BARCODE,
                        NAME,
                        IMAGE_IDX,
                        COLOR,
                        COLOR_CHIP,
                        CATEGORY_IDX,
                        INNER_CATEGORY_1,
                        INNER_CATEGORY_2,
                        INNER_CATEGORY_3,
                        INNER_CATEGORY_4,
                        INNER_CATEGORY_5,
                        INNER_CATEGORY_6,
                        WAREHOUSE_CATEGORY_1,
                        WAREHOUSE_CATEGORY_2,
                        WAREHOUSE_CATEGORY_3,
                        WAREHOUSE_CATEGORY_4,
                        SIZE,
                        SIZE_DETAIL_KR_01,
                        SIZE_DETAIL_KR_02,
                        SIZE_DETAIL_KR_03,
                        SIZE_DETAIL_KR_04,
                        SIZE_DETAIL_KR_05,
                        SIZE_DETAIL_EN_01,
                        SIZE_DETAIL_EN_02,
                        SIZE_DETAIL_EN_03,
                        SIZE_DETAIL_EN_04,
                        SIZE_DETAIL_EN_05,
                        SIZE_DETAIL_CN_01,
                        SIZE_DETAIL_CN_02,
                        SIZE_DETAIL_CN_03,
                        SIZE_DETAIL_CN_04,
                        SIZE_DETAIL_CN_05,
                        METERIAL_KR,
                        METERIAL_EN,
                        METERIAL_CN,
                        CARE_KR,
                        CARE_EN,
                        CARE_CN,
                        DETAIL_KR,
                        DETAIL_EN,
                        DETAIL_CN,
                        PRICE_KR_KRW,
                        PRICE_EN_USD,
                        PRICE_CN_USD,
                        PRICE_SELL_KR_KRW,
                        PRICE_SELL_EN_USD,
                        PRICE_SELL_CN_USD,
                        WHOLESALE_PRICE_KR_KRW,
                        WHOLESALE_PRICE_EN_USD,
                        WHOLESALE_PRICE_CN_USD,
                        PRODUCT_TAG
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
                        'BARCODE'               => $data['BARCODE'],
                        'NAME'                  => $data['NAME'],
                        'IMAGE_IDX'             => $data['IMAGE_IDX'],
                        'COLOR'                 => $data['COLOR'],
                        'COLOR_CHIP'            => $data['COLOR_CHIP'],
                        'CATEGORY_IDX'          => $data['CATEGORY_IDX'],
                        'INNER_CATEGORY_1'      => $data['INNER_CATEGORY_1'],
                        'INNER_CATEGORY_2'      => $data['INNER_CATEGORY_2'],
                        'INNER_CATEGORY_3'      => $data['INNER_CATEGORY_3'],
                        'INNER_CATEGORY_4'      => $data['INNER_CATEGORY_4'],
                        'INNER_CATEGORY_5'      => $data['INNER_CATEGORY_5'],
                        'INNER_CATEGORY_6'      => $data['INNER_CATEGORY_6'],
                        'WAREHOUSE_CATEGORY_1'  => $data['WAREHOUSE_CATEGORY_1'],
                        'WAREHOUSE_CATEGORY_2'  => $data['WAREHOUSE_CATEGORY_2'],
                        'WAREHOUSE_CATEGORY_3'  => $data['WAREHOUSE_CATEGORY_3'],
                        'WAREHOUSE_CATEGORY_4'  => $data['WAREHOUSE_CATEGORY_4'],
                        'SIZE'                  => $data['SIZE'],
                        'SIZE_DETAIL_KR_01'     => $data['SIZE_DETAIL_KR_01'],
                        'SIZE_DETAIL_KR_02'     => $data['SIZE_DETAIL_KR_02'],
                        'SIZE_DETAIL_KR_03'     => $data['SIZE_DETAIL_KR_03'],
                        'SIZE_DETAIL_KR_04'     => $data['SIZE_DETAIL_KR_04'],
                        'SIZE_DETAIL_KR_05'     => $data['SIZE_DETAIL_KR_05'],
                        'SIZE_DETAIL_EN_01'     => $data['SIZE_DETAIL_EN_01'],
                        'SIZE_DETAIL_EN_02'     => $data['SIZE_DETAIL_EN_02'],
                        'SIZE_DETAIL_EN_03'     => $data['SIZE_DETAIL_EN_03'],
                        'SIZE_DETAIL_EN_04'     => $data['SIZE_DETAIL_EN_04'],
                        'SIZE_DETAIL_EN_05'     => $data['SIZE_DETAIL_EN_05'],
                        'SIZE_DETAIL_CN_01'     => $data['SIZE_DETAIL_CN_01'],
                        'SIZE_DETAIL_CN_02'     => $data['SIZE_DETAIL_CN_02'],
                        'SIZE_DETAIL_CN_03'     => $data['SIZE_DETAIL_CN_03'],
                        'SIZE_DETAIL_CN_04'     => $data['SIZE_DETAIL_CN_04'],
                        'SIZE_DETAIL_CN_05'     => $data['SIZE_DETAIL_CN_05'],
                        'METERIAL_KR'           => $data['METERIAL_KR'],
                        'METERIAL_EN'           => $data['METERIAL_EN'],
                        'METERIAL_CN'           => $data['METERIAL_CN'],
                        'CARE_KR'               => $data['CARE_KR'],
                        'CARE_EN'               => $data['CARE_EN'],
                        'CARE_CN'               => $data['CARE_CN'],
                        'DETAIL_KR'             => $data['DETAIL_KR'],
                        'DETAIL_EN'             => $data['DETAIL_EN'],
                        'DETAIL_CN'             => $data['DETAIL_CN'],
                        'PRICE_KR_KRW'          => $data['PRICE_KR_KRW'],
                        'PRICE_EN_USD'          => $data['PRICE_EN_USD'],
                        'PRICE_CN_USD'          => $data['PRICE_CN_USD'],
                        'PRICE_SELL_KR_KRW'     => $data['PRICE_SELL_KR_KRW'],
                        'PRICE_SELL_EN_USD'     => $data['PRICE_SELL_EN_USD'],
                        'PRICE_SELL_CN_USD'     => $data['PRICE_SELL_CN_USD'],
                        'WHOLESALE_PRICE_KR_KRW'=> $data['WHOLESALE_PRICE_KR_KRW'],
                        'WHOLESALE_PRICE_EN_USD'=> $data['WHOLESALE_PRICE_EN_USD'],
                        'WHOLESALE_PRICE_CN_USD'=> $data['WHOLESALE_PRICE_CN_USD'],
                        'PRODUCT_TAG'           => $data['PRODUCT_TAG'],
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
            foreach($no as $value){
                if($value > 0) {
                    if(!$db->update($_TABLE['SHOP_PRODUCT'],array('DEL_FLG'=>1),$where)) {
                        $code = 200;
                    }
                }
            }
        break;
    }
?>