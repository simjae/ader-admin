<?php

header("Content-Type: application/javascript");

function getUrlParamter($url, $sch_tag) {
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$callback = getUrlParamter($page_url, 'callback');

$sql = '
    SELECT 
        IMG.IMG_LOCATION            AS IMG_LOCATION,
        PRODUCT.PRODUCT_CODE        AS PRODUCT_CODE,
        PRODUCT.PRODUCT_NAME        AS PRODUCT_NAME,
        PRODUCT.PL_LRG_CATEGORY     AS PL_LRG_CATEGORY,
        PRODUCT.PL_MDL_CATEGORY     AS PL_MDL_CATEGORY,
        PRODUCT.PL_SML_CATEGORY     AS PL_SML_CATEGORY,
        PRODUCT.PL_DTL_CATEGORY     AS PL_DTL_CATEGORY,
        PRODUCT.PRODUCT_WIDTH       AS PRODUCT_WIDTH,
        PRODUCT.PRODUCT_DEPTH       AS PRODUCT_DEPTH,
        PRODUCT.PRODUCT_HEIGHT      AS PRODUCT_HEIGHT,
        PRODUCT.PRODUCT_VOLUME      AS PRODUCT_VOLUME,
        PRODUCT.MEMO                AS MEMO
    FROM 
        dev.SHOP_PRODUCT	PRODUCT
    LEFT JOIN
        (SELECT 
            *
        FROM 
            dev.PRODUCT_IMG
        WHERE
            DEL_FLG = FALSE
        AND 
            IMG_TYPE = "outfit"
        AND
            IMG_SIZE = "sml" ) 	IMG
    ON
        PRODUCT.IDX = IMG.PRODUCT_IDX
';

$db->query($sql);

foreach($db->fetch() as $data){
    if(strlen($data['IMG_LOCATION']) > 0){
        $img_path = 'http://116.124.128.246:81'.substr($data['IMG_LOCATION'],18);
    }
    else{
        $img_path = null;
    }
    $json_result['data'][] = array(
        'product_code'					=> $data['PRODUCT_CODE'],
        'product_name'					=> $data['PRODUCT_NAME'],
        'img_location'                  => $img_path,
        'pl_lrg_category'				=> $data['PL_LRG_CATEGORY'],
        'pl_mdl_category'				=> $data['PL_MDL_CATEGORY'],
        'pl_sml_category'				=> $data['PL_SML_CATEGORY'],
        'pl_dtl_category'				=> $data['PL_DTL_CATEGORY'],
        'product_width'					=> $data['PRODUCT_WIDTH'],
        'product_depth'					=> $data['PRODUCT_DEPTH'],
        'product_height'				=> $data['PRODUCT_HEIGHT'],
        'product_volume'				=> $data['PRODUCT_VOLUME'],
        'memo'					        => $data['MEMO']
    );
}
echo $callback.'('.$json_result['data'].');';

?>