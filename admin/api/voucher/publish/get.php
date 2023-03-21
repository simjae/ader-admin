<?php
/*
 +=============================================================================
 | 
 | 단일 발행 바우처 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$voucher_idx    = $_POST['voucher_idx'];        //선택 바우처 IDX

// 단일 바우처 정보
$get_voucher_info_sql = "SELECT
            IDX,
            COUNTRY,
            ON_OFF_TYPE,
            VOUCHER_TYPE,
            VOUCHER_CODE,
            VOUCHER_NAME,
            ISSUE_START_DATE,
            ISSUE_END_DATE,
            (CASE   
                WHEN DATE(ISSUE_START_DATE) > CURDATE()
                THEN '발행예정'
                WHEN DATE(ISSUE_START_DATE) <= CURDATE() AND
                     DATE(ISSUE_END_DATE) >= CURDATE()
                THEN '발행가능'
                WHEN DATE(ISSUE_END_DATE) < CURDATE()
                THEN '발행종료'
             END) AS VOUCHER_STATUS,
            VOUCHER_DATE_TYPE,
            VOUCHER_DATE_PARAM,
            VOUCHER_START_DATE,
            VOUCHER_END_DATE,
            MIN_PRICE,
            SALE_TYPE,
            SALE_PRICE,
            DESCRIPTION,
            MILEAGE_FLG,
            MEMBER_LEVEL,
            TOT_ISSUE_NUM,
            EXCEPT_PRODUCT_FLG,
            CREATE_DATE,
            CREATER,
            UPDATE_DATE,
            UPDATER
		FROM
            VOUCHER_MST
		WHERE
            IDX = ".$voucher_idx." ";

$db->query($get_voucher_info_sql);
foreach($db->fetch() as $data) {
    $level_info = array();
    if($data['MEMBER_LEVEL'] != NULL && strlen($data['MEMBER_LEVEL']) > 0 && $data['MEMBER_LEVEL'] != 'ALL'){
        $get_member_level_name_sql = "
            SELECT
                IDX,
                TITLE
            FROM
                MEMBER_LEVEL
            WHERE
                DEL_FLG = FALSE
            AND
                IDX IN (".$data['MEMBER_LEVEL'].")
        ";
        $db->query($get_member_level_name_sql);
        
        foreach($db->fetch() as $level_data){
            $level_info[] = array(
                'level_idx' =>$level_data['IDX'],
                'level_title' =>$level_data['TITLE'],
            );
        }
    }

    $voucher_product_sql = "
    SELECT
        VP.IDX				AS VOUCHER_PRODUCT_IDX,
        PR.IDX				AS PRODUCT_IDX,
        PR.ORDERSHEET_IDX	AS ORDERSHEET_IDX,
        PR.STYLE_CODE		AS STYLE_CODE,
        PR.COLOR_CODE		AS COLOR_CODE,
        PR.PRODUCT_CODE		AS PRODUCT_CODE,
        PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
        PR.PRODUCT_NAME		AS PRODUCT_NAME,
        CASE
            WHEN
                (SELECT COUNT(*) FROM PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
                THEN
                    (
                        SELECT
                            REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
                        FROM
                            PRODUCT_IMG S_PI
                        WHERE
                            S_PI.PRODUCT_IDX = PR.IDX AND
                            S_PI.IMG_TYPE = 'P' AND
                            S_PI.IMG_SIZE = 'S'
                        LIMIT
                            0,1
                    )
            ELSE
                '/images/default_product_img.jpg'
        END					AS IMG_LOCATION,
        PR.PRICE_KR			AS PRICE_KR,
        PR.DISCOUNT_KR		AS DISCOUNT_KR,
        PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
        PR.PRICE_EN			AS PRICE_EN,
        PR.DISCOUNT_EN		AS DISCOUNT_EN,
        PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
        PR.PRICE_CN			AS PRICE_CN,
        PR.DISCOUNT_CN		AS DISCOUNT_CN,
        PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
        (
            SELECT
                IFNULL(SUM(S_PS.STOCK_QTY),0)
            FROM
                PRODUCT_STOCK S_PS
            WHERE
                S_PS.PRODUCT_IDX = PR.IDX AND
                S_PS.STOCK_DATE <= NOW()
        )	AS STOCK_QTY,
        (
            SELECT
                IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
            FROM
                PRODUCT_STOCK S_PS
            WHERE
                S_PS.PRODUCT_IDX = PR.IDX AND
                S_PS.STOCK_DATE <= NOW()
        )	AS SAFE_QTY,
        (
            SELECT
                IFNULL(SUM(S_OP.PRODUCT_QTY),0)
            FROM
                ORDER_PRODUCT S_OP
            WHERE
                S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
                S_OP.PRODUCT_IDX = PR.IDX
        )	AS ORDER_QTY,
        PR.UPDATE_DATE		AS UPDATE_DATE
    FROM
        VOUCHER_PRODUCT VP LEFT JOIN
        SHOP_PRODUCT PR
    ON
        VP.product_idx = PR.IDX
    WHERE
        VP.VOUCHER_IDX = ".$voucher_idx."
    ";

    $db->query($voucher_product_sql);

    foreach($db->fetch() as $voucher_data){
        $voucher_product['data'][] = array(
            'product_idx'       =>$voucher_data['PRODUCT_IDX'],
            'style_code'		=>$voucher_data['STYLE_CODE'],
            'color_code'		=>$voucher_data['COLOR_CODE'],
            'product_code'		=>$voucher_data['PRODUCT_CODE'],
            'product_type'		=>$voucher_data['PRODUCT_TYPE'],
            'product_name'		=>$voucher_data['PRODUCT_NAME'],
            'img_location'		=>$voucher_data['IMG_LOCATION'],
            'price_kr'			=>$voucher_data['PRICE_KR'],
            'discount_kr'		=>$voucher_data['DISCOUNT_KR'],
            'sales_price_kr'	=>$voucher_data['SALES_PRICE_KR'],
            'price_en'			=>$voucher_data['PRICE_EN'],
            'discount_en'		=>$voucher_data['DISCOUNT_EN'],
            'sales_price_en'	=>$voucher_data['SALES_PRICE_EN'],
            'price_cn'			=>$voucher_data['PRICE_CN'],
            'discount_cn'		=>$voucher_data['DISCOUNT_CN'],
            'sales_price_cn'	=>$voucher_data['SALES_PRICE_CN'],
            'stock_qty'			=>$voucher_data['STOCK_QTY'],
            'order_qty'			=>$voucher_data['ORDER_QTY'],
            'safe_qty'			=>$voucher_data['SAFE_QTY'],
            'update_date'		=>$voucher_data['UPDATE_DATE']
        );
    }
	$json_result['data'][] = array(
		'no'                    =>intval($data['IDX']),
        'country'               =>$data['COUNTRY'],
        'on_off_type'           =>$data['ON_OFF_TYPE'],
		'voucher_type'          =>$data['VOUCHER_TYPE'],
        'voucher_code'          =>$data['VOUCHER_CODE'],
        'voucher_name'          =>$data['VOUCHER_NAME'],
        'issue_start_date'      =>$data['ISSUE_START_DATE'],
        'issue_end_date'        =>$data['ISSUE_END_DATE'],
        'voucher_status'        =>$data['VOUCHER_STATUS'],
        'voucher_date_type'     =>$data['VOUCHER_DATE_TYPE'],
        'voucher_date_param'    =>$data['VOUCHER_DATE_PARAM'],
        'voucher_start_date'    =>$data['VOUCHER_START_DATE'],
        'voucher_end_date'      =>$data['VOUCHER_END_DATE'],
        'min_price'             =>$data['MIN_PRICE'],
        'sale_type'             =>$data['SALE_TYPE'],
        'sale_price'            =>$data['SALE_PRICE'],
        'description'           =>$data['DESCRIPTION'],
        'mileage_flg'           =>$data['MILEAGE_FLG'],
        'member_level'          =>$data['MEMBER_LEVEL'],
        'tot_issue_num'         =>$data['TOT_ISSUE_NUM'],
        'except_product_flg'    =>$data['EXCEPT_PRODUCT_FLG'],
        'voucher_product'       =>$voucher_product,
        'member_info'           =>$level_info,
        'create_date'           =>$data['CREATE_DATE'],
        'creater'               =>$data['CREATER'],
        'update_date'           =>$data['UPDATE_DATE'],
        'updater'               =>$data['UPDATER']
	);
}
?>