<?php
/*
 +=============================================================================
 | 
 | 스탠바이, 드로우, 프리오더 등록용 상품검색 모달
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.17
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$regist_type    = $_POST['regist_type'];            //등록 주체(스탠바이, 드로우, 프리오더)

$product_code   = $_POST['product_code'];
$product_name   = $_POST['product_name'];

$sort_type 		= $_POST['sort_type'];				//정렬 타입
$sort_value 	= $_POST['sort_value'];				//정렬 값

$rows           = $_POST['rows'];
$page           = $_POST['page'];

$regist_table = '';

if($regist_type != null){
    switch($regist_type){
        case 'STANDBY':
            $regist_table = 'dev.PAGE_STANDBY';
            break;
        case 'DRAW':
            $regist_table = 'dev.PAGE_DRAW';
            break;
        case 'PREORDER':
            $regist_table = 'dev.PAGE_PREORDER';
            break;
    }
    
    $where_cnt=" PR.DEL_FLG = FALSE 
            AND	 PR.PRODUCT_TYPE = 'B'
            AND  PR.INDP_FLG = FALSE 
            AND  PR.SALE_FLG = TRUE
            AND (SELECT
                    COUNT(0)
                FROM
                    ".$regist_table."
                WHERE
                    PRODUCT_IDX = PR.IDX) = 0
                  ";
    
    $where = "";
    
    //검색 유형 - 상품구분
    if($product_code != null){
        $where .= ' AND (PR.PRODUCT_CODE LIKE "%'.$product_code.'%") ';
    }
    
    if($product_name != null){
        $where .= ' AND (PR.PRODUCT_NAME LIKE "%'.$product_name.'%") ';
    }
    
    $where = $where_cnt.$where;
    
    /** 정렬 조건 **/
    $order = '';
    if ($sort_value != null && $sort_type != null) {
        $order = ' PR.'.$sort_value." ".$sort_type." ";
    } else {
        $order = ' PR.IDX DESC';
    }
    
    $limit_start = (intval($page)-1)*$rows;
    $json_result = array(
        'total' => $db->count("dev.SHOP_PRODUCT PR",$where),
        'total_cnt' => $db->count("dev.SHOP_PRODUCT PR",$where_cnt),
        'page' => $page
    );
    
    $sql = "SELECT
                PR.IDX				AS PRODUCT_IDX,
                PR.STYLE_CODE		AS STYLE_CODE,
                PR.COLOR_CODE		AS COLOR_CODE,
                PR.PRODUCT_CODE		AS PRODUCT_CODE,
                PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
                PR.PRODUCT_NAME		AS PRODUCT_NAME,
                CASE
                    WHEN
                        (SELECT COUNT(*) FROM dev.PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
                        THEN
                            (
                                SELECT
                                    REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
                                FROM
                                    dev.PRODUCT_IMG S_PI
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
                PR.UPDATE_DATE		AS UPDATE_DATE
            FROM
                dev.SHOP_PRODUCT PR
            WHERE
                ".$where."
            ORDER BY
                ".$order;
    
    if ($rows != null && $select_idx_flg == null) {
        $sql .= " LIMIT ".$limit_start.",".$rows;
    }
    
    $db->query($sql);
    foreach($db->fetch() as $data) {
        $json_result['data'][] = array(
            'product_idx'		=>$data['PRODUCT_IDX'],
            'style_code'		=>$data['STYLE_CODE'],
            'color_code'		=>$data['COLOR_CODE'],
            'product_code'		=>$data['PRODUCT_CODE'],
            'product_type'		=>$data['PRODUCT_TYPE'],
            'product_name'		=>$data['PRODUCT_NAME'],
            'img_location'		=>$data['IMG_LOCATION'],
            'price_kr'			=>$data['PRICE_KR'],
            'discount_kr'		=>$data['DISCOUNT_KR'],
            'sales_price_kr'	=>$data['SALES_PRICE_KR'],
            'price_en'			=>$data['PRICE_EN'],
            'discount_en'		=>$data['DISCOUNT_EN'],
            'sales_price_en'	=>$data['SALES_PRICE_EN'],
            'price_cn'			=>$data['PRICE_CN'],
            'discount_cn'		=>$data['DISCOUNT_CN'],
            'sales_price_cn'	=>$data['SALES_PRICE_CN'],
            'update_date'		=>$data['UPDATE_DATE']
        );
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '상품목록을 불러오는데 실패했습니다.';
}

?>