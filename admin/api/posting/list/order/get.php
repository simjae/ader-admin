<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 리스트_전체 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sql = "SELECT
			PO.IDX			AS ORDER_IDX,
			PO.DISPLAY_NUM	AS DISPLAY_NUM,
			PO.POSTING_TYPE	AS POSTING_TYPE,
			(
				SELECT
					COUNT(S_PP.IDX)
				FROM
					dev.PAGE_POSTING S_PP
				WHERE
					S_PP.POSTING_TYPE = PO.POSTING_TYPE
			)				AS POSTING_CNT
		FROM
			dev.POSTING_ORDER PO
		ORDER BY
			PO.DISPLAY_NUM";

$db->query($sql);

foreach($db->fetch() as $data) {
	$posting_type = "";
	
	switch ($data['POSTING_TYPE']) {
		case "COLA" :
			$posting_type = "콜라보레이션";
			break;
		
		case "COLC" :
			$posting_type = "컬렉션";
			break;
		
		case "EDTL" :
			$posting_type = "에디토리얼";
			break;
		
		case "EXHB" :
			$posting_type = "기획전";
			break;
		
		case "LKBK" :
			$posting_type = "룩북";
			break;
	}
	
	$json_result['data'][] = array(
		'order_idx'			=>$data['ORDER_IDX'],
		'display_num'		=>$data['DISPLAY_NUM'],
		'posting_type'		=>$posting_type,
		'posting_cnt'		=>$data['POSTING_CNT']
	);
}
?>