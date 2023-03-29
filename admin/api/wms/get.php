<?php

header("Content-Type: application/javascript");

function getUrlParamter($url, $sch_tag) {
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];

$product_code = getUrlParamter($page_url, 'product_code');
$callback = getUrlParamter($page_url, 'callback');

$sql = "
    SELECT
		OM.IDX				AS PRODUCT_IDX,
		CASE
			WHEN
				PI.IMG_LOCATION IS NULL
				THEN
					'/images/default_product_img.jpg'
			ELSE
				PI.IMG_LOCATION
		END					AS IMG_LOCATION,
		OO.BARCODE			AS BARCODE,
        OM.PRODUCT_NAME		AS PRODUCT_NAME,
		OO.OPTION_NAME		AS OPTION_NAME,
        OM.CATEGORY_LRG		AS CATEGORY_LRG,
        OM.CATEGORY_MDL		AS CATEGORY_MDL,
        OM.CATEGORY_SML		AS CATEGORY_SML,
        OM.CATEGORY_DTL		AS CATEGORY_DTL,
        
		BI.BOX_WIDTH		AS LOAD_BOX_WIDTH,
        BI.BOX_LENGTH		AS LOAD_BOX_DEPTH,
        BI.BOX_HEIGHT		AS LOAD_BOX_HEIGHT,
        BI.BOX_VOLUME		AS LOAD_BOX_VOLUME
    FROM 
		ORDERSHEET_MST OM
		LEFT JOIN ORDERSHEET_OPTION OO ON
		OM.IDX = OO.ORDERSHEET_IDX
		LEFT JOIN BOX_INFO BI ON
		OM.LOAD_BOX_IDX = BI.IDX
		LEFT JOIN (
			SELECT
				S_PR.ORDERSHEET_IDX,
				S_PI.IMG_LOCATION
			FROM
				dev.SHOP_PRODUCT S_PR
				LEFT JOIN dev.PRODUCT_IMG S_PI ON
				S_PR.IDX = S_PI.PRODUCT_IDX
			WHERE
				S_PI.IMG_TYPE = 'P' AND
				S_PI.IMG_SIZE = 'S'
			GROUP BY
				S_PI.PRODUCT_IDX
		) AS PI ON
		OM.IDX = PI.ORDERSHEET_IDX
	WHERE
		OO.BARCODE = '".$product_code."' AND
		OM.IDX > 71
";

$db->query($sql);

$info = array();
foreach($db->fetch() as $data){
    $img_path = 'http://116.124.128.246:81'.$data['IMG_LOCATION'];
	
	
    $info[] = array(
        'img_location'			=> $img_path,
		'product_idx'			=> $data['PRODUCT_IDX'],
		'barcode'				=> $data['BARCODE'],
        'product_name'			=> $data['PRODUCT_NAME']."[".$data['OPTION_NAME']."]",
        'category_lrg'			=> $data['CATEGORY_LRG'],
        'category_mdl'			=> $data['CATEGORY_MDL'],
        'category_sml'			=> $data['CATEGORY_SML'],
        'category_dtl'			=> $data['CATEGORY_DTL'],
        
		'load_box_width'		=> $data['LOAD_BOX_WIDTH'],
        'load_box_depth'		=> $data['LOAD_BOX_DEPTH'],
        'load_box_height'		=> $data['LOAD_BOX_HEIGHT'],
        'load_box_volume'		=> $data['LOAD_BOX_VOLUME'],
        
		'memo'					=> $data['MEMO']
    );
}

if (count($info) > 0) {
	$json_result['result'] = "Y";
	$json_result['info'] = $info;
} else {
	$json_result['result'] = "N";
	$json_result['reason'] = "err001:not found data";
}
echo $callback.'('.$json_result['data'].');';
?>