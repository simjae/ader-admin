<?php
/*
 +=============================================================================
 | 
 | STOCKIST 목록
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.05.12
 | 최종 수정일	: 2022.06.16
 | 버전		: 1.9
 | 설명		: 
 | 
 +=============================================================================
*/
$tables = $_TABLE['STOCKIST'];
$where = '1=1';
if(isset($no) && is_numeric($no)) {
	$where .= ' AND IDX=?';
	$where_values[]  = $no;
}
$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => $page
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
		CASE `CITY`
			WHEN "Korea" THEN 1
			WHEN "Online" THEN 2
			ELSE 3
		END,
		CITY,SEQ,IDX DESC
	LIMIT ?,?
',$where_values);
$db2 = new db();
$db3 = new db();
foreach($db->fetch() as $data) {
	/** 상점 목록 **/
	$stores = null;
	$db2->query('SELECT * FROM '.$_TABLE['STOCKIST_STORE'].' WHERE STOCK_NO=? ORDER BY SEQ,NAME,IDX',array($data['IDX']));
	foreach($db2->fetch() as $data2) {
		/** 상점 이미지 **/
		$images = null;
		$db3->query('SELECT * FROM '.$_TABLE['STOCKIST_IMAGE'].' WHERE STORE_NO=? ORDER BY SEQ,IDX',array($data2['IDX']));
		foreach($db3->fetch() as $data3) {
			$images[] = array(
				'no'=>intval($data3['IDX']),
				'url'=>$data3['IMG'],
				'thumbnail'=>$data3['THUMB']
			);
		}

		$stores[] = array(
			'no'=>intval($data2['IDX']),
			'name'=>$data2['NAME'],
			'address'=>$data2['ADDRESS'],
			'email'=>$data2['EMAIL'],
			'tel'=>$data2['TEL'],
			'keyword'=>$data2['KEYWORD'],
			'movie_url'=>$data2['MOVIE_URL'],
			'movie_image'=>$data2['IMG'],
			'movie_thumbnail'=>$data2['THUMB'],
			'gps'=>array(floatval($data2['LNG']),floatval($data2['LAT'])),
			'images'=>$images,
			'status'=>($data2['STATUS']=='Y')?true:false,
		);
	}

	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'seq'=>intval($data['SEQ']),
		'city'=>$data['CITY'],
		'locate'=>strtolower($data['LOCATE']),
		'store'=>$stores,
		'images'=>$images,
		'thumbnail'=>$images[0]['thumbnail'],
		'status'=>($data['STATUS']=='Y')?true:false,
		'finput_date'=>$data['FINPUT_DATE'],
		'linput_date'=>$data['LINPUT_DATE']
	);
}
?>