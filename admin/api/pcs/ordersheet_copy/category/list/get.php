<?php
/*
 +=============================================================================
 | 
 | 오더시트 분류별 상품 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.02.06
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
$where .= ' AND (OM.DEL_FLG = FALSE) ';

$where_cnt = $where;

$tables = "
	ORDERSHEET_MST OM
";

//검색 유형 - 카테고리
if($md_category_depth != null && $md_category_node != null){
    $category_cols_name = '';
    switch($md_category_depth){
        case '1':
            $category_cols_name = 'OM.CATEGORY_LRG'; 
            break;
        case '2':
            $category_cols_name = 'OM.CATEGORY_MDL';
            break;
        case '3':
            $category_cols_name = 'OM.CATEGORY_SML';
            break;
        case '4':
            $category_cols_name = 'OM.CATEGORY_DTL';
            break;
    }
	$where .= " AND (".$category_cols_name." = ".$md_category_node." ) ";
}
else{
    $md_category_node = -1;
}


/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' OM.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where_cnt),
	'page' => $page
);

$select = "     OM.IDX											AS ORDERSHEET_IDX,
				OM.STYLE_CODE									AS STYLE_CODE,
				OM.COLOR_CODE									AS COLOR_CODE,
				OM.PRODUCT_CODE									AS PRODUCT_CODE,
				OM.PREORDER_FLG									AS PREORDER_FLG,
				OM.CATEGORY_LRG									AS CATEGORY_LRG,
				OM.CATEGORY_MDL									AS CATEGORY_MDL,
				OM.CATEGORY_SML									AS CATEGORY_SML,
				OM.CATEGORY_DTL									AS CATEGORY_DTL,
				OM.MATERIAL										AS MATERIAL,
				OM.GRAPHIC										AS GRAPHIC,
				OM.FIT											AS FIT,
				CASE
					WHEN
						(
							SELECT
								COUNT(S_OI.IDX)
							FROM
								ORDERSHEET_IMG S_OI
							WHERE
								S_OI.ORDERSHEET_IDX = OM.IDX AND
								IMG_TYPE = 'P' AND
								IMG_SIZE = 'S'
						) > 0
						THEN
							(
								SELECT
									S_OI.IMG_LOCATION
								FROM
									ORDERSHEET_IMG S_OI
								WHERE
									S_OI.ORDERSHEET_IDX = OM.IDX AND
									S_OI.IMG_TYPE = 'P' AND
									S_OI.IMG_SIZE = 'S'
								ORDER BY
									S_OI.IDX ASC
								LIMIT
									0,1
							)
					ELSE
						'/images/default_product_img.jpg'
				END												AS ORDERSHEET_IMG,
				OM.PRODUCT_NAME									AS PRODUCT_NAME,
				OM.PRODUCT_SIZE									AS PRODUCT_SIZE,
				OM.COLOR										AS COLOR,
				OM.COLOR_RGB									AS COLOR_RGB,
				OM.LIMIT_MEMBER									AS LIMIT_MEMBER,
				OM.LIMIT_QTY									AS LIMIT_QTY,
				OM.PRICE_KR										AS PRICE_KR,
				OM.PRICE_EN										AS PRICE_EN,
				OM.PRICE_CN										AS PRICE_CN,
				OM.PRODUCT_QTY									AS PRODUCT_QTY,
				OM.LAUNCHING_DATE								AS LAUNCHING_DATE,
				OM.UPDATE_FLG									AS UPDATE_FLG,
				
				OM.CREATE_DATE									AS CREATE_DATE,
				OM.CREATER										AS CREATER,
				OM.UPDATE_DATE									AS UPDATE_DATE,
				OM.UPDATER										AS UPDATER ";


$sql = 	'SELECT
			'.$select.'
		FROM 
			'.$tables.'
		WHERE 
			'.$where.'
		ORDER BY 
			'.$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'num'							=>$total_cnt--,
        'ordersheet_idx'				=>intval($data['ORDERSHEET_IDX']),
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
		'ordersheet_img'				=>$data['ORDERSHEET_IMG'],
		'product_name'					=>$data['PRODUCT_NAME'],
		'product_size'					=>$data['PRODUCT_SIZE'],
		'color'							=>$data['COLOR'],
		'color_rgb'						=>$data['COLOR_RGB'],
		'limit_member'					=>$data['LIMIT_MEMBER'],
		'limit_qty'						=>$data['LIMIT_QTY'],
		'price_kr'						=>$data['PRICE_KR'],
		'price_en'						=>$data['PRICE_EN'],
		'price_cn'						=>$data['PRICE_CN'],
		'product_qty'					=>$data['PRODUCT_QTY'],
		'launching_date'				=>$data['LAUNCHING_DATE'],
		'update_flg'					=>$data['UPDATE_FLG'],

		'sample_flg'					=>($db->count("SAMPLE_INFO","ORDERSHEET_IDX = ".intval($data['ORDERSHEET_IDX'])." ")) == 0 ? false : true,
		'wholesale_flg'				 	=>($db->count("WHOLESALE_INFO","ORDERSHEET_IDX = ".intval($data['ORDERSHEET_IDX'])." ")) == 0 ? false : true,
		'factory_flg'					=>($db->count("FACTORY_INFO","ORDERSHEET_IDX = ".intval($data['ORDERSHEET_IDX'])." ")) == 0 ? false : true,
		'creater'						=>$data['CREATER'],
		'create_date'					=>$data['CREATE_DATE'],
		'updater'						=>$data['UPDATER'],
		'update_date'					=>$data['UPDATE_DATE']
	);
}
?>