<?php
/*
 +=============================================================================
 | 
 | 오더시트 단일정보 
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sel_idx     = $_POST['sel_idx'];
$tables = "
	
";

if($sel_idx != null){
    $sql = 	"SELECT
                    OM.IDX											AS ORDERSHEET_IDX,
                    OM.STYLE_CODE									AS STYLE_CODE,
                    OM.COLOR_CODE									AS COLOR_CODE,
                    OM.PRODUCT_CODE									AS PRODUCT_CODE,
                    OM.PREORDER_FLG									AS PREORDER_FLG,
                    OM.CATEGORY_LRG									AS CATEGORY_LRG,
                    OM.CATEGORY_MDL									AS CATEGORY_MDL,
                    OM.CATEGORY_SML									AS CATEGORY_SML,
                    OM.CATEGORY_DTL									AS CATEGORY_DTL,
                    IFNULL(OM.MATERIAL, '')							AS MATERIAL,
                    IFNULL(OM.GRAPHIC, '')							AS GRAPHIC,
                    IFNULL(OM.FIT, '')								AS FIT,
                    IFNULL(OM.PRODUCT_NAME, '')						AS PRODUCT_NAME,
                    IFNULL(OM.PRODUCT_SIZE, '')						AS PRODUCT_SIZE,
                    IFNULL(OM.COLOR, '')							AS COLOR,
                    IFNULL(OM.COLOR_RGB, '')						AS COLOR_RGB,
                    IFNULL(OM.NAVIGATION, '')						AS NAVIGATION,
                    IFNULL(OM.LIMIT_MEMBER, '')						AS LIMIT_MEMBER,
                    IFNULL(OM.LIMIT_QTY, '')						AS LIMIT_QTY,
                    IFNULL(OM.PRICE_KR, 0)							AS PRICE_KR,
                    IFNULL(OM.PRICE_KR_GB, 0)					    AS PRICE_KR_GB,
                    IFNULL(OM.PRICE_EN, 0)							AS PRICE_EN,
                    IFNULL(OM.PRICE_CN, 0)							AS PRICE_CN,
                    IFNULL(OM.PRODUCT_QTY, '')						AS PRODUCT_QTY,
                    IFNULL(OM.PRODUCT_STOCK_GRADE, '')				AS PRODUCT_STOCK_GRADE,
                    OM.MILEAGE_FLG									AS MILEAGE_FLG,
                    OM.EXCLUSIVE_FLG								AS EXCLUSIVE_FLG,
                    IFNULL(DATE_FORMAT(OM.LAUNCHING_DATE, '%Y-%m-%d'),'') 		AS LAUNCHING_DATE,
                    IFNULL(OM.WKLA, '')                             AS WKLA,
                    IFNULL(OM.MODEL, '')                            AS MODEL,
                    IFNULL(OM.MODEL_WEAR, '')                       AS MODEL_WEAR,
                    OM.SIZE_A1_KR                                   AS SIZE_A1_KR,
                    OM.SIZE_A2_KR                                   AS SIZE_A2_KR,
                    OM.SIZE_A3_KR                                   AS SIZE_A3_KR,
                    OM.SIZE_A4_KR                                   AS SIZE_A4_KR,
                    OM.SIZE_A5_KR                                   AS SIZE_A5_KR,
                    OM.SIZE_ONESIZE_KR                              AS SIZE_ONESIZE_KR,
                    OM.SIZE_A1_EN                                   AS SIZE_A1_EN,
                    OM.SIZE_A2_EN                                   AS SIZE_A2_EN,
                    OM.SIZE_A3_EN                                   AS SIZE_A3_EN,
                    OM.SIZE_A4_EN                                   AS SIZE_A4_EN,
                    OM.SIZE_A5_EN                                   AS SIZE_A5_EN,
                    OM.SIZE_ONESIZE_EN                              AS SIZE_ONESIZE_EN,
                    OM.SIZE_A1_CN                                   AS SIZE_A1_CN,
                    OM.SIZE_A2_CN                                   AS SIZE_A2_CN,
                    OM.SIZE_A3_CN                                   AS SIZE_A3_CN,
                    OM.SIZE_A4_CN                                   AS SIZE_A4_CN,
                    OM.SIZE_A5_CN                                   AS SIZE_A5_CN,
                    OM.SIZE_ONESIZE_CN                              AS SIZE_ONESIZE_CN,
                    OM.CARE_KR                                      AS CARE_KR,
                    OM.CARE_EN                                      AS CARE_EN,
                    OM.CARE_CN                                      AS CARE_CN,
                    OM.DETAIL_KR                                    AS DETAIL_KR,
                    OM.DETAIL_EN                                    AS DETAIL_EN,
                    OM.DETAIL_CN                                    AS DETAIL_CN,
                    OM.MATERIAL_KR									AS MATERIAL_KR,
                    OM.MATERIAL_EN									AS MATERIAL_EN,
                    OM.MATERIAL_CN									AS MATERIAL_CN,
                    IFNULL(OM.MANUFACTURER, '')                     AS MANUFACTURER,
                    IFNULL(OM.SUPPLIER, '')                         AS SUPPLIER,
                    IFNULL(OM.ORIGIN_COUNTRY, '')                   AS ORIGIN_COUNTRY,
                    IFNULL(OM.BRAND, '')                            AS BRAND,
                    IFNULL(OM.TREND, '')                            AS TREND,
                    IFNULL(OM.BOX_IDX, 0)                           AS BOX_IDX,
                    (SELECT 
                        BOX_NAME 
                    FROM 
                        dev.BOX_INFO 
                    WHERE
                        IDX = IFNULL(OM.BOX_IDX, 0))                AS BOX_NAME,
                    IFNULL(OM.PRODUCT_WEIGHT, '')                   AS PRODUCT_WEIGHT,
                    OM.CREATE_DATE									AS CREATE_DATE,
                    OM.CREATER										AS CREATER,
                    OM.UPDATE_DATE									AS UPDATE_DATE,
                    OM.UPDATER										AS UPDATER
            FROM 
                dev.ORDERSHEET_MST OM
            WHERE 
                OM.DEL_FLG = FALSE
                AND OM.IDX = ".$sel_idx;


    $db->query($sql,$where_values);
    foreach($db->fetch() as $data) {
        $img_db = new db();
        $option_db = new db();

        $img_query = '
            SELECT
                IMG_LOCATION
            FROM
                dev.ORDERSHEET_IMG
            WHERE
                PRODUCT_CODE = "'.$data['PRODUCT_CODE'].'"
            AND
                IMG_TYPE = "main"
            AND
                IMG_SIZE = "sml"
            ORDER BY 
                IDX ASC
            LIMIT 1
        ';
        $img_db->query($img_query);

        foreach($img_db->fetch() as $img_data){
            $img_location = $img_data['IMG_LOCATION'];
        }

        $option_query = "
            SELECT
                OPTION_INFO.BARCODE,
                OPTION_INFO.OPTION_NAME,
                OPTION_INFO.OPTION_STOCK_GRADE,
                OPTION_INFO.SIZE_CATEGORY,
                IFNULL(CONCAT(SIZE_DESC.SIZE_TITLE_1, '|', IFNULL(OPTION_INFO.OPTION_SIZE_1, '')),'') OPTION_SIZE_1_INFO,
                IFNULL(CONCAT(SIZE_DESC.SIZE_TITLE_2, '|', IFNULL(OPTION_INFO.OPTION_SIZE_2, '')),'') OPTION_SIZE_2_INFO,
                IFNULL(CONCAT(SIZE_DESC.SIZE_TITLE_3, '|', IFNULL(OPTION_INFO.OPTION_SIZE_3, '')),'') OPTION_SIZE_3_INFO,
                IFNULL(CONCAT(SIZE_DESC.SIZE_TITLE_4, '|', IFNULL(OPTION_INFO.OPTION_SIZE_4, '')),'') OPTION_SIZE_4_INFO,
                IFNULL(CONCAT(SIZE_DESC.SIZE_TITLE_5, '|', IFNULL(OPTION_INFO.OPTION_SIZE_5, '')),'') OPTION_SIZE_5_INFO,
                IFNULL(CONCAT(SIZE_DESC.SIZE_TITLE_6, '|', IFNULL(OPTION_INFO.OPTION_SIZE_6, '')),'') OPTION_SIZE_6_INFO
            FROM
                dev.ORDERSHEET_OPTION   OPTION_INFO  LEFT JOIN
                dev.SIZE_DESCRIPTION    SIZE_DESC
            ON
                OPTION_INFO.SIZE_CATEGORY = SIZE_DESC.CATEGORY_NAME
            WHERE
                OPTION_INFO.ORDERSHEET_IDX = ".$data['ORDERSHEET_IDX']."
            ORDER BY
                BARCODE
        ";
        $option_db->query($option_query);
        
        $option_arr = array();
        foreach($option_db->fetch() as $option_data){
            array_push($option_arr, array(
                'barcode'                   => $option_data['BARCODE'],
                'option_name'               => $option_data['OPTION_NAME'],
                'option_stock_grade'        => $option_data['OPTION_STOCK_GRADE'],
                'size_category'             => $option_data['SIZE_CATEGORY'],
                'option_size_1_info'        => $option_data['OPTION_SIZE_1_INFO'],
                'option_size_2_info'        => $option_data['OPTION_SIZE_2_INFO'],
                'option_size_3_info'        => $option_data['OPTION_SIZE_3_INFO'],
                'option_size_4_info'        => $option_data['OPTION_SIZE_4_INFO'],
                'option_size_5_info'        => $option_data['OPTION_SIZE_5_INFO'],
                'option_size_6_info'        => $option_data['OPTION_SIZE_6_INFO']
            ));
        }

        $json_result['data'][] = array(
            'ordersheet_idx'				=>intval($data['ORDERSHEET_IDX']),
            'ordersheet_img_location'		=>isset($img_location) == 1 ? $img_location : null,
            'style_code'					=>$data['STYLE_CODE'],
            'color_code'					=>$data['COLOR_CODE'],
            'product_code'					=>$data['PRODUCT_CODE'],
            'preorder_flg'			        =>$data['PREORDER_FLG'],
            'category_lrg'			        =>$data['CATEGORY_LRG'],
            'category_mdl'			        =>$data['CATEGORY_MDL'],
            'category_sml'			        =>$data['CATEGORY_SML'],
            'category_dtl'			        =>$data['CATEGORY_DTL'],
            'material'			            =>$data['MATERIAL'],
            'graphic'			            =>$data['GRAPHIC'],
            'fit'			                =>$data['FIT'],
            'product_name'			        =>$data['PRODUCT_NAME'],
            'product_size'			        =>$data['PRODUCT_SIZE'],
            'color'			                =>$data['COLOR'],
            'color_rgb'			            =>$data['COLOR_RGB'],
            'navigation'			        =>$data['NAVIGATION'],
            'limit_member'			        =>$data['LIMIT_MEMBER'],
            'limit_qty'			            =>$data['LIMIT_QTY'],
            'price_kr'			            =>$data['PRICE_KR'],
            'price_kr_gb'			        =>$data['PRICE_KR_GB'],
            'price_en'			            =>$data['PRICE_EN'],
            'price_cn'			            =>$data['PRICE_CN'],
            'product_qty'			        =>$data['PRODUCT_QTY'],
            'product_stock_grade'			=>$data['PRODUCT_STOCK_GRADE'],
            'mileage_flg'			        =>$data['MILEAGE_FLG'],
            'exclusive_flg'			        =>$data['EXCLUSIVE_FLG'],
            'launching_date'			    =>$data['LAUNCHING_DATE'],
            'wkla'			                =>$data['WKLA'],
            'model'			                =>$data['MODEL'],
            'model_wear'			        =>$data['MODEL_WEAR'],
            'size_a1_kr'			        =>$data['SIZE_A1_KR'],
            'size_a2_kr'			        =>$data['SIZE_A2_KR'],
            'size_a3_kr'			        =>$data['SIZE_A3_KR'],
            'size_a4_kr'			        =>$data['SIZE_A4_KR'],
            'size_a5_kr'			        =>$data['SIZE_A5_KR'],
            'size_onesize_kr'			    =>$data['SIZE_ONESIZE_KR'],
            'size_a1_en'			        =>$data['SIZE_A1_EN'],
            'size_a2_en'			        =>$data['SIZE_A2_EN'],
            'size_a3_en'			        =>$data['SIZE_A3_EN'],
            'size_a4_en'			        =>$data['SIZE_A4_EN'],
            'size_a5_en'			        =>$data['SIZE_A5_EN'],
            'size_onesize_en'			    =>$data['SIZE_ONESIZE_EN'],
            'size_a1_cn'			        =>$data['SIZE_A1_CN'],
            'size_a2_cn'			        =>$data['SIZE_A2_CN'],
            'size_a3_cn'			        =>$data['SIZE_A3_CN'],
            'size_a4_cn'			        =>$data['SIZE_A4_CN'],
            'size_a5_cn'			        =>$data['SIZE_A5_CN'],
            'size_onesize_cn'			    =>$data['SIZE_ONESIZE_CN'],
            'care_kr'			            =>$data['CARE_KR'],
            'care_en'			            =>$data['CARE_EN'],
            'care_cn'			            =>$data['CARE_CN'],
            'detail_kr'			            =>$data['DETAIL_KR'],
            'detail_en'			            =>$data['DETAIL_EN'],
            'detail_cn'			            =>$data['DETAIL_CN'],
            'material_kr'			        =>$data['MATERIAL_KR'],
            'material_en'			        =>$data['MATERIAL_EN'],
            'material_cn'			        =>$data['MATERIAL_CN'],
            'manufacturer'			        =>$data['MANUFACTURER'],
            'supplier'			            =>$data['SUPPLIER'],
            'origin_country'			    =>$data['ORIGIN_COUNTRY'],
            'brand'			                =>$data['BRAND'],
            'trend'			                =>$data['TREND'],
            'box_idx'			            =>$data['BOX_IDX'],
            'box_name'                      =>$data['BOX_NAME'],
            'product_weight'			    =>$data['PRODUCT_WEIGHT'],
            'ordersheet_option'             =>$option_arr,
            'update_date'                   =>$data['UPDATE_DATE'],
            'size_category'                 =>count($option_arr) > 0?$option_arr[0]['size_category']:'' 
        );
    }
}

?>