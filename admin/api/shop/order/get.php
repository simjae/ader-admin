<?php
/*
 +=============================================================================
 | 
 | 주문 목록
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.05.12
 | 최종 수정일	: 
 | 버전			: 1.0
 | 설명			: 
 | 
 +=============================================================================
*/


/** 01. 변수 정리 **/
$db2 = new db();
$db3 = new db();
$where = '1=1';
$name = trim($name);
$paymethod = trim(str_replace(' ','',strtolower($paymethod)));
$status = trim(str_replace(' ','',$status));

/** 02. 쿼리 찾기 문자열 정리 **/
if(is_numeric($no)) {
	$where .= ' AND IDX=? ';
	$where_values[] = $no;
}
if($name) {
	$where .= ' AND NAME LIKE ? ';
	$where_values[] = '%'.$name.'%';
}
if($id) {
	$where .= ' AND ID LIKE ? ';
	$where_values[] = '%'.$id.'%';
}
if(is_string($goods) && $goods != '') {
	$where .= ' AND IDX IN (
					SELECT A.ORDERIDX 
						FROM '.$_TABLE['SHOP_ORDER_GOOD'].' AS A 
						LEFT JOIN '.$_TABLE['SHOP_GOODS'].' AS B ON A.GOODSIDX = B.IDX 
					WHERE 
						B.NAME LIKE ? 
				)';
	$where_values[] = '%'.$goods.'%';
}
if(is_numeric($category) && intval($category) != 1) {
	$where .= ' AND CATEGORY_NO = ? ';
	$where_values[] = $category;
}
if(is_string($paymethod) && $paymethod != '') {
	$where .= ' AND PAYMENT = ? ';
	$where_values[] = $paymethod;
}
if(isset($status) && $status != '') {
	if($status == 'refund') {
		$where .= ' AND STATUS IN ("환불요청","환불처리중","환불완료") ';
	}
	else {
		$where .= ' AND STATUS = ? ';
		$where_values[] = $status;
	}
}
if(isset($localize) && $localize != '') {
	$where .= ' AND DELIVERYTO = ? ';
	$where_values[] = $localize;
}
if(is_numeric($price_s)) {
	$where .= ' AND PRICE >= ? ';
	$where_values[] = $price_s;
}
if(is_numeric($price_e)) {
	$where .= ' AND PRICE <= ? ';
	$where_values[] = $price_e;
}
if($orderdate_from != '') {
	$where .= ' AND ORDER_DATE >= ? ';
	$where_values[] = $orderdate_from;
}
if($orderdate_to != '') {
	$where .= ' AND ORDER_DATE <= ? ';
	$where_values[] = $orderdate_to;
}
if(is_numeric($tel)) {
	$where .= ' AND TO_TEL LIKE ? ';
	$where_values[] = '%'.$tel;
}

/** 03. 쿼리 db 뽑는 순서 **/
$orderby = ' FIELD(STATUS,"배송중","결제확인","배송준비") DESC ';
if($sort_name == 'asc' || $sort_name == 'desc') $orderby = (($orderby!='')?',':'').'NAME '.$sort_name;
if($sort_price == 'asc' || $sort_price == 'desc') $orderby = (($orderby!='')?',':'').'PRICE '.$sort_price;
if($sort_code == 'asc' || $sort_code == 'desc') $orderby = (($orderby!='')?',':'').'CODE '.$sort_code;
$orderby .= (($orderby!='')?',':'').'IDX DESC ';


/** 04. 쿼리 작성 **/
$tables = '
	'.$_TABLE['SHOP_ORDER'].' 
';
$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => intval($page)
);
$where_values[] = ($page-1)*$pagenum;
$where_values[] = $pagenum;
$db->query('
	SELECT 
			*   
		FROM '.$tables.'
	WHERE 
		'.$where.'
	ORDER BY 
		'.$orderby.'
	LIMIT 
		?,?
',$where_values);
foreach($db->fetch() as $data) {
	// 주문 상품
	$goods_data = null;
	$db2->query('
		SELECT 
			A.*,B.*
			FROM '.$_TABLE['SHOP_ORDER_GOOD'].' AS A 
			LEFT JOIN '.$_TABLE['SHOP_GOODS'].' AS B ON A.GOODSIDX = B.IDX 
		WHERE 
			A.ORDERIDX = ? 

	',array($data['IDX']));
	foreach($db2->fetch() as $data2) {
		// 옵션 사항
		$option = null;
		if($data2['OPT'] != '') {
			$db3->query('
				SELECT 
					A.*,B.TITLE 
					FROM '.$_TABLE['SHOP_GOODS_OPTION_VAL'].' AS A 
					LEFT JOIN '.$_TABLE['SHOP_GOODS_OPTION'].' AS B ON A.OPTION_NO = B.IDX 
				WHERE 
					A.IDX IN ('.$data2['OPT'].')
			');
			foreach($db3->fetch() as $data3) {
				$option[] = array(
					'title'=>$data3['TITLE'],
					'val'=>$data3['VAL']
				);
			}
		}

		$goods_data[] = array(
			'no'=>intval($data2['IDX']),
			'status'=>$data2['STATUS'],
			'quantity'=>intval($data2['QTY']),
			'name'=>$data2['NAME'],
			'code'=>$data2['CODE'],
			'image'=>$data2['COVER'],
			'price'=>intval($data2['PRICE']),
			'option'=>$option
		);
	}

	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'order_number'=>$data['ORDERNUM'],
		'title'=>$data['TITLE'],
		'name'=>$data['NAME'],
		'currency'=>$data['PG_CURRENCY'],
		'id'=>$data['ID'],
		'order_date'=>$data['ORDER_DATE'],
		'refund_date'=>$data['REFUND_DATE'],
		'cancel_date'=>$data['CANCEL_DATE'],
		'tel'=>$data['TEL'],
		'to'=>array(
			'tel'=>$data['TO_TEL'],
			'name'=>$data['TO_NAME'],
			'mobile'=>$data['TO_MOBILE'],
			'zipcode'=>$data['TO_ZIPCODE'],
			'address1'=>$data['TO_ADDRESS1'],
			'address2'=>$data['TO_ADDRESS2']
		),
		'delivery'=>array(
			'company_no'=>intval($data['DELIVERY_NO']),
			'num'=>$data['DELIVERY_NUM'],
			'area'=>$data['DELIVERYTO'],
			'category'=>$data['DELIVERY'],
			'cp'=>$data['DELIVERY_CP'],
			'date'=>$data['DELIVERY_DATE']
		),
		'goods'=>$goods_data,
		'remark'=>$data['REMARK'],
		'payment_method'=>$data['PAYMENT'],
		'payment_method_str'=>$_STRING['PAYMETHOD'][$data['PAYMENT']],
		'payment'=>(is_int($data['PRICE'])===true)?intval($data['PRICE']):floatval($data['PRICE']),
		'payment_delivery'=>(is_int($data['PRICE_DELIVERY'])===true)?intval($data['PRICE_DELIVERY']):floatval($data['PRICE_DELIVERY']),
		'status'=>$data['STATUS']
	);
}

// etc. 배송 업체 목록
/*
$delivery_data = $db->get($_TABLE['SHOP_DELIVERY_COMPANY']);
foreach($delivery_data as $data) {
	$json_result['delivery']['company'][] = array(
		'no'=>intval($data['IDX']),
		'code'=>$data['CODE'],
		'name'=>$data['NAME'],
		'is_default'=>($data['DEFAULT_YN'] == 'Y')?true:false
	);
}
*/
?>