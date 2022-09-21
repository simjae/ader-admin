<?php
/*
 +=============================================================================
 | 
 | 게시판 생성/정보 수정
 | -----------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2014.12.20
 | 최종 수정일	: 2022.04.09
 | 버전		: 2.0
 | 설명		: 
 | 
 +=============================================================================
*/

$values = array(
	'BBSCODE'=>trim(strtolower($bbscode)),
	'TITLE'=>$title,
	'STATUS'=>($status=='y')?'Y':'N',
	'USE_CATEGORY'=>($use_category=='y')?'Y':'N',
	'USE_REPLY'=>($use_reply=='y')?'Y':'N',
	'USE_COMMENT'=>($use_comment=='y')?'Y':'N',
	'USE_UPLOAD'=>($use_upload=='y')?'Y':'N',
	'USE_LINK'=>($use_link=='y')?'Y':'N',
	'USE_COVER'=>($use_cover=='y')?'Y':'N',
	'COVER_W'=>intval($cover_w),
	'COVER_H'=>intval($cover_h),
	'PAGING_ROW'=>intval($paging_row),
	'PAGING_NUM'=>intval($paging_num),
	'DAY_NEW'=>intval($day_new),
	'PDS_NUM'=>intval($pds_num),
	'PDS_MAXBYTE'=>intval($pds_maxbyte),
	'PERMIT_WRITE'=>$permet_write,
	'PERMIT_LIST'=>$permet_list,
	'PERMIT_VIEW'=>$permet_view,
	'PERMIT_REPLY'=>$permet_reply,
	'PERMIT_COMMENT'=>$permet_comment,
	'SPECIAL_MEMBER'=>$special_member,
	'REMARK'=>$remark
);

if(!$db->insert($_TABLE['BOARD_CONFIG'],$values,'BBSCODE=?',array($bbscode))) {
	$code = 500;
}
?>