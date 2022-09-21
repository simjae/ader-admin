<?php
/*
 +=============================================================================
 | 
 | 블루마크 로그 리스트 추출 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$bluemark_idx 		= $_POST['bluemark_idx'];			//검색분류

$log_where = '1=1';
$log_where .= ' AND BLUEMARK_IDX = '.$bluemark_idx.' '; 
$log_table = '  dev.BLUEMARK_LOG	LOG 	LEFT JOIN
                dev.MEMBER			MEMBER
            ON	LOG.MEMBER_ID = MEMBER.IDX ';

$log_sql = "SELECT
                MEMBER.ID,
                MEMBER.LEVEL,
                MEMBER.NAME,
                LOG.IP,
                LOG.REG_DATE
            FROM
                ".$log_table."
            WHERE
                ".$log_where;
$db->query($log_sql);

$cnt_db = new db();
$cnt_db->query("SELECT COUNT(0) AS CNT FROM ".$log_table." WHERE ".$log_where);
foreach($cnt_db->fetch() as $data) {
	$log_cnt = $data['CNT'];
}


foreach($db->fetch() as $data) {
	$json_result['data']['log'][] = array(
        'num'			=>$log_cnt--,
		'member_id'		=>$data['ID'],
		'member_level'	=>$data['LEVEL'],
		'member_name'	=>$data['NAME'],
		'ip'		    =>$data['IP'],
		'reg_date'		=>$data['REG_DATE']
	);
}

$product_where = '1=1';
$product_where .= ' AND INFO.IDX = '.$bluemark_idx.'
                    AND IMG.DEL_FLG = FALSE
                    AND IMG_TYPE = "PRODUCT" 
                    AND IMG_SIZE = "sml" '; 
$product_table = '  dev.BLUEMARK_INFO	INFO 	                LEFT JOIN
                    dev.SHOP_PRODUCT	PRODUCT
                ON	INFO.PRODUCT_CODE = PRODUCT.PRODUCT_CODE    LEFT JOIN
                    dev.PRODUCT_IMG     IMG
                ON  INFO.PRODUCT_CODE = IMG.PRODUCT_CODE
                ';
$product_sql = "SELECT
                    IFNULL(PRODUCT.PRODUCT_NAME,'-') AS PRODUCT_NAME,
                    INFO.PRODUCT_CODE,
                    IFNULL(INFO.OPTION_CODE,'-'),
                    INFO.SERIAL_CODE,
                    INFO.SEASON,
                    REPLACE(IMG.IMG_LOCATION,'/var/www/admin/www','')		AS IMG_LOCATION
                FROM
                    ".$product_table."
                WHERE
                    ".$product_where;

$db->query($product_sql);

foreach($db->fetch() as $data) {
    $json_result['data']['product'][] = array(
        'product_name'	=>$data['PRODUCT_NAME'],
        'product_code'	=>$data['PRODUCT_CODE'],
        'option_code'	=>$data['OPTION_CODE'],
        'serial_code'	=>$data['SERIAL_CODE'],
        'season'		=>$data['SEASON'],
        'img_location'	=>$data['IMG_LOCATION'],
    );
}
?>