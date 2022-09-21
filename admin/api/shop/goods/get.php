<?php
/*
 +=============================================================================
 | 
 | 상품 목록
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.05.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$where = '1=1';
$name = trim($name);
if(isset($no) && is_numeric($no)) {
	$where .= ' AND A.IDX='.$no;
}
if($name) $where .= ' AND B.NAME LIKE "%'.$name.'%"';
if(isset($category_no) && intval($category_no) > 0) {
	$where .= ' AND A.CATEGORY_NO = ? ';
	$where_values[] = $category_no;
}
if($sort_name == 'asc' || $sort_name == 'desc') $orderby = (($orderby!='')?',':'').'B.NAME '.$sort_name;
if($sort_price == 'asc' || $sort_price == 'desc') $orderby = (($orderby!='')?',':'').'A.PRICE '.$sort_price;
if($sort_code == 'asc' || $sort_code == 'desc') $orderby = (($orderby!='')?',':'').'B.BARCODE '.$sort_code;
$orderby = (($orderby!='')?',':'').'A.SEQ,A.IDX DESC,A.CATEGORY_NO DESC ';
$tables = '
	'.$_TABLE['SHOP_GOODS'].' AS A 
	LEFT JOIN '.$_TABLE['SHOP_WARE'].' AS B ON A.WARE_NO = B.IDX  
';
$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => $page
);
$where_values[] = ($page-1)*$pagenum;
$where_values[] = $pagenum;
$db->query('
	SELECT 
			A.IDX AS GOODS_NO,A.CATEGORY_NO,A.SEQ,
			B.* 
		FROM '.$tables.'
	WHERE 
		'.$where.'
	ORDER BY 
		'.$orderby.'
	LIMIT ?,?
',$where_values);
foreach($db->fetch() as $data) {
	if(!isset($db2)) $db2 = new db();
	/** 상세 이미지 **/
	$db2->query('
		SELECT * 
			FROM '.$_TABLE['SHOP_WARE_IMAGE'].' 
		WHERE 
			STATUS="Y" 
			AND WARE_NO='.$data['IDX'].'
		ORDER BY 
			SEQ,IDX
	');
	$images = null;
	$images_mobile = null;
	foreach($db2->fetch() as $data2) {
		if($data2['DEVICE'] == 'PC') {
			$images[] = array(
				'url' => $data2['IMG'],
				'no' => intval($data2['IDX'])
			);
		}
		else {
			$images_mobile[] = array(
				'url' => $data2['IMG'],
				'no' => intval($data2['IDX'])
			);
		}
	}

	/** 가격 **/
	$db2->query('
		SELECT 
				LANGUAGE,PRICE,CURRENCY
			FROM '.$_TABLE['SHOP_WARE_PRICE'].' 
		WHERE 
			WARE_NO='.$data['IDX'].'
		GROUP BY 
			LANGUAGE,PRICE
		ORDER BY 
			LANGUAGE
	');
	$price = null;
	foreach($db2->fetch() as $data2) {
		$price[] = array(
			'country'=>strtolower($data2['LANGUAGE']),
			'currency'=>$data2['CURRENCY'],
			'price'=>floatval($data2['PRICE'])
		);
	}

	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'seq'=>intval($data['SEQ']),
		'category'=>intval($data['CATEGORY_NO']),
		'name'=>$data['NAME'],
		'barcode'=>$data['BARCODE'],
		'url'=>$data['URL'],
		'stock'=>array(
			'online'=>intval($data['STOCK']),
			'total'=>intval($data['STOCK_TOTAL']),
			'unlimit_yn'=>(($data['STOCK_UNLIMIT_YN']=='Y')?true:false)
		),
		'display_yn'=>(($data['DISPLAY_YN']=='Y')?true:false),
		'price'=>$price,
		'color'=>array(
			'name'=>$data['COLOR'],
			'hexcode'=>$data['COLOR_CODE']
		),
		'point'=>array(
			'ratio'=>floatval($data['POINT']),
			'type'=>$data['POINT_TYPE']
		),
		'feature1'=>array(
			'title'=>$data['FEATURE1'],
			'yn'=>(($data['FEATURE1_YN']=='Y')?true:false)
		),
		'feature2'=>array(
			'title'=>$data['FEATURE2'],
			'yn'=>(($data['FEATURE2_YN']=='Y')?true:false)
		),
		'feature3'=>array(
			'title'=>$data['FEATURE3'],
			'yn'=>(($data['FEATURE3_YN']=='Y')?true:false)
		),
		'feature4'=>array(
			'title'=>$data['FEATURE4'],
			'yn'=>(($data['FEATURE4_YN']=='Y')?true:false)
		),
		'feature5'=>array(
			'title'=>$data['FEATURE5'],
			'yn'=>(($data['FEATURE5_YN']=='Y')?true:false)
		),
		'soldout_yn'=>(($data['SOLDOUT_YN']=='Y')?true:false),
		'coupon_yn'=>(($data['COUPON_YN']=='Y')?true:false),
		'refund_yn'=>(($data['REFUND_YN']=='Y')?true:false),
		'option_yn'=>(($data['OPTION_YN']=='Y')?true:false),
		'reservation_yn'=>(($data['RESERVATION_YN']=='Y')?true:false),
		'paymethod_yn'=>(($data['PAYMETHOD_YN']=='Y')?true:false),
		'delivery_free_yn'=>(($data['DELIVERY_FREE_YN']=='Y')?true:false),
		'sell_date'=>array(
			'use'=>(($data['SELL_DATE_YN']=='Y')?true:false),
			'start'=>$data['SELL_SDATE'],
			'end'=>$data['SELL_EDATE']
		),
		'remark'=>$data['REMARK'],
		'hit'=>intval($data['HIT']),
		'buy'=>intval($data['BUY']),
		'reg_date'=>$data['REG_DATE'],
		'images'=>array(
			'list'=>array(
				'pc'=>$images,
				'mobile'=>$images_mobile
			),
			'detail'=>array(
				'pc'=>$images,
				'mobile'=>$images_mobile
			)
		)
	);
}
?>