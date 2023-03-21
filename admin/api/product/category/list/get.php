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

$md_category_node	= $_POST['md_category_node'];
$md_category_depth  = $_POST['md_category_depth'];

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND (PR.INDP_FLG = FALSE AND PR.DEL_FLG = FALSE) ';

$where_cnt = $where;



//검색 유형 - 카테고리
if($md_category_depth != null){
	if($md_category_node == null){
		$md_category_node = -1;
	}
	$where .= " AND (PR.MD_CATEGORY_".$md_category_depth." = ".$md_category_node." ) ";
}


/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' PRODUCT_IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$sql = "";
//검색 유형 - 상품구분
$sql = "SELECT
            PR.ORDERSHEET_IDX			AS ORDERSHEET_IDX,
            PR.IDX						AS PRODUCT_IDX,
            PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
            PR.STYLE_CODE				AS STYLE_CODE,
            PR.COLOR_CODE				AS COLOR_CODE,
            PR.PRODUCT_CODE				AS PRODUCT_CODE,
            CASE
                WHEN
                    (
                        SELECT
                            COUNT(S_PI.IDX)
                        FROM
                            PRODUCT_IMG S_PI
                        WHERE
                            S_PI.PRODUCT_IDX = PR.IDX AND
                            S_PI.IMG_TYPE = 'P' AND
                            S_PI.IMG_SIZE = 'S'
                    ) > 0
                    THEN
                        (
                            SELECT
                                REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
                            FROM
                                PRODUCT_IMG S_PI
                            WHERE
                                S_PI.PRODUCT_IDX = PR.IDX AND
                                S_PI.DEL_FLG = FALSE AND
                                S_PI.IMG_SIZE = 'S' AND
                                S_PI.IMG_TYPE = 'P'
                            ORDER BY
                                S_PI.IDX ASC
                            LIMIT
                                0,1
                        )
                ELSE
                    '/images/default_product_img.jpg'
            END							AS IMG_LOCATION,
            PR.PRODUCT_NAME				AS PRODUCT_NAME,
            PR.PRICE_KR					AS PRICE_KR,
            PR.PRICE_EN					AS PRICE_EN,
            PR.PRICE_CN					AS PRICE_CN,
            PR.DISCOUNT_KR				AS DISCOUNT_KR,
            PR.DISCOUNT_EN				AS DISCOUNT_EN,
            PR.DISCOUNT_CN				AS DISCOUNT_CN,
            PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
            PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
            PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
            PR.CREATER					AS CREATER,
            PR.CREATE_DATE				AS CREATE_DATE,
            PR.UPDATER					AS UPDATER,
            PR.UPDATE_DATE				AS UPDATE_DATE
        FROM
            SHOP_PRODUCT PR
        WHERE
            ".$where."
        ORDER BY
            ".$order;

$json_result = array(
	'total' => $db->count("(".$sql.") AS TMP"),
	'total_cnt' => $db->count("SHOP_PRODUCT PR",$where_cnt),
	'page' => $page
);

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

//print_r($sql);
$db->query($sql);
foreach($db->fetch() as $data) {
	$product_idx = $data['PRODUCT_IDX'];
	$product_type = $data['PRODUCT_TYPE'];
	
	if ($product_type == "S") {
		$set_sql = "SELECT
						PR.STYLE_CODE				AS STYLE_CODE,
						PR.COLOR_CODE				AS COLOR_CODE,
						PR.PRODUCT_CODE				AS PRODUCT_CODE,
						CASE
							WHEN
								(
									SELECT
										COUNT(S_PI.IDX)
									FROM
										PRODUCT_IMG S_PI
									WHERE
										S_PI.PRODUCT_IDX = PR.IDX AND
										S_PI.IMG_TYPE = 'P' AND
										S_PI.IMG_SIZE = 'S'
								) > 0
								THEN
									(
										SELECT
											REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
										FROM
											PRODUCT_IMG S_PI
										WHERE
											S_PI.PRODUCT_IDX = PR.IDX AND
											S_PI.DEL_FLG = FALSE AND
											S_PI.IMG_SIZE = 'S' AND
											S_PI.IMG_TYPE = 'P'
										ORDER BY
											S_PI.IDX ASC
										LIMIT
											0,1
									)
							ELSE
								'/images/default_product_img.jpg'
						END							AS IMG_LOCATION,
						PR.PRODUCT_NAME				AS PRODUCT_NAME,
						PR.PRICE_KR					AS PRICE_KR,
						PR.PRICE_EN					AS PRICE_EN,
						PR.PRICE_CN					AS PRICE_CN,
						PR.DISCOUNT_KR				AS DISCOUNT_KR,
						PR.DISCOUNT_EN				AS DISCOUNT_EN,
						PR.DISCOUNT_CN				AS DISCOUNT_CN,
						PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
						PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
						PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
						PR.CREATER					AS CREATER,
						PR.CREATE_DATE				AS CREATE_DATE,
						PR.UPDATER					AS UPDATER,
						PR.UPDATE_DATE				AS UPDATE_DATE
					FROM
						SHOP_PRODUCT PR
						LEFT JOIN ORDERSHEET_MST OM ON
						PR.ORDERSHEET_IDX = OM.IDX
					WHERE
						PR.IDX IN (
							SELECT
								S_SP.PRODUCT_IDX
							FROM
								SET_PRODUCT S_SP
							WHERE
								S_SP.SET_PRODUCT_IDX = ".$product_idx."
					)";
		$db->query($set_sql);
		$set_product_info = array();
		foreach($db->fetch() as $set_data) {
			$set_product_info[] = array(
				'style_code'					=>$set_data['STYLE_CODE'],
				'color_code'					=>$set_data['COLOR_CODE'],
				'product_code'					=>$set_data['PRODUCT_CODE'],
				'img_location'					=>$set_data['IMG_LOCATION'],
				'product_name'					=>$set_data['PRODUCT_NAME'],
				'price_kr'						=>$set_data['PRICE_KR'],
				'price_en'						=>$set_data['PRICE_EN'],
				'price_cn'						=>$set_data['PRICE_CN'],
				'discount_kr'					=>$set_data['DISCOUNT_KR'],
				'discount_en'					=>$set_data['DISCOUNT_EN'],
				'discount_cn'					=>$set_data['DISCOUNT_CN'],
				'sales_price_kr'				=>$set_data['SALES_PRICE_KR'],
				'sales_price_en'				=>$set_data['SALES_PRICE_EN'],
				'sales_price_cn'				=>$set_data['SALES_PRICE_CN'],
				'creater'						=>$set_data['CREATER'],
				'create_date'					=>$set_data['CREATE_DATE'],
				'updater'						=>$set_data['UPDATER'],
				'update_date'					=>$set_data['UPDATE_DATE']
			);
		}
	}
	
	$json_result['data'][] = array(
		'num'							=>$total_cnt--,
		'product_idx'					=>$product_idx,
		'product_type'					=>$product_type,
		'ordersheet_idx'				=>$data['ORDERSHEET_IDX'],
		'style_code'					=>$data['STYLE_CODE'],
		'color_code'					=>$data['COLOR_CODE'],
		'product_code'					=>$data['PRODUCT_CODE'],
		'img_location'					=>$data['IMG_LOCATION'],
		'product_name'					=>$data['PRODUCT_NAME'],
		'price_kr'						=>$data['PRICE_KR'],
		'price_en'						=>$data['PRICE_EN'],
		'price_cn'						=>$data['PRICE_CN'],
		'discount_kr'					=>$data['DISCOUNT_KR'],
		'discount_en'					=>$data['DISCOUNT_EN'],
		'discount_cn'					=>$data['DISCOUNT_CN'],
		'sales_price_kr'				=>$data['SALES_PRICE_KR'],
		'sales_price_en'				=>$data['SALES_PRICE_EN'],
		'sales_price_cn'				=>$data['SALES_PRICE_CN'],
		'creater'						=>$data['CREATER'],
		'create_date'					=>$data['CREATE_DATE'],
		'updater'						=>$data['UPDATER'],
		'update_date'					=>$data['UPDATE_DATE'],
		'set_product_info'				=>$set_product_info
	);
}
?>