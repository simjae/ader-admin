<?php
/*
 +=============================================================================
 | 
 | 게시판 목록 
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.08.30
 | 최종 수정일	: 2022.04.09
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$json_result['total'] = $db->count($_TABLE['BOARD_CONFIG']);
$json_result['page'] = intval($page);
$db->query('
	SELECT 
			A.*,
			COUNT(B.IDX) AS ARTICLE_CNT
		FROM '.$_TABLE['BOARD_CONFIG'].' AS A 
		LEFT JOIN '.$_TABLE['BOARD'].' AS B ON A.BBSCODE = B.BBSCODE AND B.STATUS != "DELETE"
	WHERE	
		A.STATUS != "DELETE" 
	GROUP BY
		A.BBSCODE 
	ORDER BY 
		A.TITLE
',$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'bbscode'=>$data['BBSCODE'],
		'title'=>$data['TITLE'],
		'use_category'=>($data['USE_CATEGORY']=='Y')?true:false,
		'use_reply'=>($data['USE_REPLY']=='Y')?true:false,
		'use_comment'=>($data['USE_COMMENT']=='Y')?true:false,
		'use_upload'=>($data['USE_UPLOAD']=='Y')?true:false,
		'use_link'=>($data['USE_LINK']=='Y')?true:false,
		'use_cover'=>($data['USE_COVER']=='Y')?true:false,
		'paging'=>array('row'=>intval($data['PAGING_ROW']),'num'=>intval($data['PAGING_NUM'])),
		'cover'=>array(intval($data['COVER_W']),intval($data['COVER_H'])),
		'day_new'=>intval($data['DAY_NEW']),
		'pds'=>array('num'=>intval($data['PDS_NUM']),'maxbyte'=>intval($data['PDS_MAXBYTE'])),
		'permition'=>array(
			'write'=>$data['PERMIT_WRITE'],
			'list'=>$data['PERMIT_LIST'],
			'view'=>$data['PERMIT_VIEW'],
			'reply'=>$data['PERMIT_REPLY'],
			'comment'=>$data['PERMIT_COMMENT']
		),
		'special_member'=>$data['SPECIAL_MEMBER'],
		'article_count'=>intval($data['ARTICLE_CNT']),
		'status'=>($data['STATUS']=='Y')?true:false,
		'reg_date'=>explode(' ',$data['REG_DATE'])[0]
	);
}
?>