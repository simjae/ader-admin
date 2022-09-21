<?php
/*
 +=============================================================================
 | 
 | 게시판 생성/정보 수정
 | -----------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2014.12.20
 | 최종 수정일	: 
 | 버전		: 0.1
 | 설명		: 
 | 
 +=============================================================================
*/
$status = 'Y';

// 변수 정리
if($no){ //정보변경
	$query  = 'TITLE ="'.$title.'",';
	$query .= 'STATUS ="'.$status.'"';
	$where  = 'IDX='.$no;
	$result = db_update($_TABLE['ADMIN_PERMIT'],$query,$where);
} 
else {
	$fields  = 'TITLE, STATUS ';
	$values  = '"'.$title.'","'.$status.'"';
	$result = db_insert($_TABLE['ADMIN_PERMIT'],$fields,$values);
	$no = db_lastidx(); // 마지막으로 증가한 값 가져옴
}

if($result) {
	@db_delete($_TABLE['ADMIN_PERMITINFO'],'PERMIT='.$no); // 이전값 삭제

	if(is_array($permitioncheck)) {
		$fields = 'PERMIT,MODULE,PART,BBSCODE,ACTION';
		for($i=0;$i<sizeof($permitioncheck);$i++) {
			$_arr = explode('|',strtolower(trim($permitioncheck[$i])));
			$values = $no.',"'.$_arr[0].'","'.$_arr[1].'","'.$_arr[2].'","'.$_arr[3].'"';
			$result = db_insert($_TABLE['ADMIN_PERMITINFO'],$fields,$values);
			if(!$result) break;
		}
	}
}

if(!$result) $code = 500;
?>