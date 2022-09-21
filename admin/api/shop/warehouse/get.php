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

$name = trim($name);
$category_no = get_child_warehouse_category_no(intval($category_no));
$json_result['category_no'] = $category_no;
$tables = '
	'.$_TABLE['SHOP_WARE'].' AS A
';
$where = '1=1';
if(is_numeric($no)) {
	$where .= ' AND A.IDX= ? ';
	$where_values[] = $no;
}
if($name) {
	$where .= ' AND A.NAME LIKE ? ';
	$where_values[] = '%'.$name.'%';
}
if(is_array($category_no)) {
	$where .= ' AND A.CATEGORY_NO IN ('.implode(',',$category_no).') ';
}


$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => intval($page),
	'pagenum' => $pagenum
);

$db2 = new db();
$db3 = new db();
$db4 = new db();
if($sort_name == 'asc' || $sort_name == 'desc') $orderby = (($orderby!='')?',':'').'A.NAME '.$sort_name;
if($sort_price == 'asc' || $sort_price == 'desc') $orderby = (($orderby!='')?',':'').'A.PRICE '.$sort_price;
if($sort_code == 'asc' || $sort_code == 'desc') $orderby = (($orderby!='')?',':'').'A.BARCODE '.$sort_code;
$orderby = (($orderby!='')?',':'').'A.IDX DESC ';
$where_values[] = ($page-1)*$pagenum;
$where_values[] = $pagenum;
$db->query('
	SELECT 
			A.*
		FROM '.$tables.'
	WHERE 
		'.$where.'
	ORDER BY 
		'.$orderby.'
	LIMIT 
		?,?
',$where_values);
foreach($db->fetch() as $data) {
	/** 진열되어 있는 분류 **/
	$db2->query('
		SELECT 
				CATEGORY_NO 
			FROM '.$_TABLE['SHOP_GOODS'].' 
		WHERE 
			WARE_NO=?
	',array($data['IDX']));
	$goods_category_no = null;
	foreach($db2->fetch() as $data2) {
		$goods_category_no[] = intval($data2['CATEGORY_NO']);
	}


	/** 상세 이미지 **/
	$db2->query('
		SELECT * 
			FROM '.$_TABLE['SHOP_WARE_IMAGE'].' 
		WHERE 
			WARE_NO=?
		ORDER BY 
			SEQ,IDX
	',array($data['IDX']));
	$images = null;
	$images_mobile = null;
	foreach($db2->fetch() as $data2) {
		switch($data2['CATEGORY']) {
			case '목록':
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
				break;
			
			case '상세':
				if($data2['DEVICE'] == 'PC') {
					$images_detail[] = array(
						'url' => $data2['IMG'],
						'no' => intval($data2['IDX'])
					);
				}
				else {
					$images_detail_mobile[] = array(
						'url' => $data2['IMG'],
						'no' => intval($data2['IDX'])
					);
				}
				break;
		}

	}

	/** 옵션 **/
	$db2->query('
		SELECT 
				*
			FROM '.$_TABLE['SHOP_WARE_OPTION'].' 
		WHERE 
			WARE_NO = ? 
	',array($data['IDX']));
	$option = null;
	foreach($db2->fetch() as $data2) {
		$option_values = null;
		$db3->query('
			SELECT 
					*
				FROM '.$_TABLE['SHOP_WARE_OPTION_VAL'].' 
			WHERE 
				OPTION_NO = ? 
		',array($data2['IDX']));
		foreach($db3->fetch() as $data3) {
			/** 가격 **/
			$db4->query('
				SELECT 
						* 
					FROM '.$_TABLE['SHOP_WARE_PRICE'].' 
				WHERE 
					WARE_NO = ? 
					AND OPTIONVAL_NO = ? 
			',array($data['IDX'],$data3['IDX']));
			$option_price = null;
			foreach($db4->fetch() as $data4) {
				$option_price[] = array(
					'country'=>$data4['LANGUAGE'],
					'currency'=>$data4['CURRENCY'],
					'price'=>floatval($data4['PRICE'])
				);
			}

			/** 상세 내용 **/
			$db4->query('
				SELECT 
						* 
					FROM '.$_TABLE['SHOP_WARE_DETAIL'].' 
				WHERE 
					WARE_NO = ? 
					AND OPTIONVAL_NO = ? 
			',array($data['IDX'],$data3['IDX']));
			$option_detail = null;
			foreach($db4->fetch() as $data4) {
				$option_detail[] = array(
					'language'=>$data4['LANGUAGE'],
					'title'=>$data4['TITLE'],
					'contents'=>$data4['CONTENTS']
				);
			}

			$option_values[] = array(
				'no'=>intval($data3['IDX']),
				'title'=>$data3['TITLE'],
				'barcode'=>$data3['BARCODE'],
				'value'=>$data3['VAL'],
				'price'=>$option_price,
				'detail'=>$option_detail,
				'stock'=>intval($data3['STOCK']),
				'soldout'=>(($data3['SOLDOUT_YN']=='Y')?true:false),
				'status'=>(($data3['STATUS']=='Y')?true:false),
				'is_default'=>(intval($data2['VAL_DEF'])==intval($data3['IDX']))?true:false
			);
		}


		$option[] = array(
			'no'=>intval($data2['IDX']),
			'title'=>$data2['TITLE'],
			'category'=>$data2['CATEGORY'],
			'type'=>$data2['INP_TYPE'],
			'is_required'=>(($data2['IS_REQUIRED']=='Y')?true:false),
			'status'=>(($data2['STATUS']=='Y')?true:false),
			'values'=>$option_values
		);
	}
	
	/** 가격 **/
	$db2->query('
		SELECT 
				* 
			FROM '.$_TABLE['SHOP_WARE_PRICE'].' 
		WHERE 
			WARE_NO = ? 
			AND OPTIONVAL_NO = 0
	',array($data['IDX']));
	$price = null;
	$option = null;
	foreach($db2->fetch() as $data2) {
		$price[] = array(
			'country'=>$data2['LANGUAGE'],
			'currency'=>$data2['CURRENCY'],
			'price'=>floatval($data2['PRICE'])
		);
	}

	/** 상세 내용 **/
	$db2->query('
		SELECT 
				* 
			FROM '.$_TABLE['SHOP_WARE_DETAIL'].' 
		WHERE 
			WARE_NO = ?
			AND OPTION_NO = 0 
	',array($data['IDX']));
	$detail = null;
	foreach($db2->fetch() as $data2) {
		$detail[] = array(
			'language'=>$data2['LANGUAGE'],
			'title'=>$data2['TITLE'],
			'contents'=>$data2['CONTENTS']
		);
	}
	

	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'name'=>$data['NAME'],
		'barcode'=>$data['BARCODE'],
		'goods_category'=>array(
			'no'=>$goods_category_no
		),
		'stock'=>array(
			'online'=>intval($data['STOCK']),
			'total'=>intval($data['STOCK_TOTAL']),
			'unlimit_yn'=>(($data['STOCK_UNLIMIT_YN']=='Y')?true:false)
		),
		'display_date'=>array(
			'use'=>(($data['DISPLAY_DATE_YN']=='Y')?true:false),
			'start'=>$data['DISPLAY_SDATE'],
			'end'=>$data['DISPLAY_EDATE']
		),
		'display_yn'=>(($data['DISPLAY_YN']=='Y')?true:false),
		'display_language'=>explode(',',$data['DISPLAY_LANGUAGE']),
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
		'detail'=>$detail,
		'soldout_yn'=>(($data['SOLDOUT_YN']=='Y')?true:false),
		'coupon_yn'=>(($data['COUPON_YN']=='Y')?true:false),
		'refund_yn'=>(($data['REFUND_YN']=='Y')?true:false),
		'option_yn'=>(($data['OPTION_YN']=='Y')?true:false),
		'option'=>$option,
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
				'pc'=>$images_detail,
				'mobile'=>$images_detail_mobile
			)
		)
	);
}
?>