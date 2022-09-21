<?php
/*
 +=============================================================================
 | 
 | 팝업
 | ---
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2014.12.19
 | 최종 수정일	: 2017.07.10
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$no = intval($no);

$where = '1=1';
$where_values = null;
if($no > 0) {
	$where .= ' AND IDX=? ';
	$where_values[] = $no;
}
$json_result['total'] = $db->count($_TABLE['POPUP'],$where,$where_values);
$db->query('
	SELECT 
		* 
		FROM '.$_TABLE['POPUP'].'
	WHERE 
		'.$where.'
	ORDER BY 
		SEQ ASC,IDX ASC
',$where_values);
foreach($db->fetch() as $data) {
	$imgsize = array(0,0);
	if(file_exists($data['IMG'])) {
		$imgsize = getImageSize($data['IMG']);	// 이미지 사이즈 구하기
	}

	$json_result['data'][] = array(
		'title'=>$data['TITLE'],
		'no'=>intval($data['IDX']),
		'seq'=>intval($data['SEQ']),
		'image'=>array(
			'url'=>$data['IMG_URL'],
			'thumbnail'=>$data['IMG_THUMB'],
			'width'=>$imgsize[0],
			'height'=>$imgsize[1]
		),
		'url'=>$data['URL'],
		'contents'=>$data['CONTENTS'],
		'start_date'=>substr($data['START_DATE'],0,10),
		'end_date'=>substr($data['END_DATE'],0,10),
		'status'=>($data['STATUS']=='Y')?true:false
	);
}
?>