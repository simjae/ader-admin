<?php
/*
 +=============================================================================
 | 
 | 컨텐츠 입력
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.07.12
 | 최종 수정일	: 2020.12.31
 | 버전		: 2.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 01. 변수 정리 **/
$city = addslashes($city);
$status = (strtoupper($status) != 'Y')?'N':'Y';
$locate = trim(strtoupper($locate));
$upload_path = strtolower(str_replace(array(' ','&','*'),'_',$city)).'/'; // 업로드 위치

// 인덱스 번호가 없을 경우 신규 작성
if(!$no) {
	//@db_update($_TABLE['STOCKIST'],'SEQ=SEQ+1');

	$fields  = 'SEQ,CITY,LOCATE,STATUS,FINPUT_DATE,LINPUT_DATE';
	$values  = db_count($_TABLE['STOCKIST']).'+1,"'.$city.'","'.$locate.'","'.$status.'",NOW(),NOW()';
	$result = db_insert($_TABLE['STOCKIST'],$fields,$values);
	if($result) $no = db_lastidx();
} else {
	$query = '
		CITY="'.$city.'",
		LOCATE="'.$locate.'",
		LINPUT_DATE=Now(),
		STATUS="'.$status.'"
	';
	$result = db_update($_TABLE['STOCKIST'],$query,'IDX='.$no);
	/*
	if(db_count($_TABLE['STOCKIST'],'CITY="'.$city.'" AND IDX != '.$no) > 0) {
		$msg = '이미 동일한 지역명이 있습니다.';
		$code = 999;
		$result = false;
	}
	else {
	}
	*/
}


/** 상세 이미지 삭제 **/
/*
$where = 'STOCK_NO='.$no;
if(is_array($img_no)) {
	$where .= ' AND IDX NOT IN ('.implode(',',$img_no).')';
}
$result = db_delete($_TABLE['STOCKIST_IMAGE'],$where);
*/
/** 상세 이미지 업로드 **/
/*
if($result && is_array($_FILES['img'])) {
	for($i=0;$i<count($_FILES['img'])-1;$i++) {
		$_temp_file['name'] = $_FILES['img']['name'][$i];
		$_temp_file['type'] = $_FILES['img']['type'][$i];
		$_temp_file['tmp_name'] = $_FILES['img']['tmp_name'][$i];
		$_temp_file['error'] = $_FILES['img']['error'][$i];
		$_temp_file['size'] = $_FILES['img']['size'][$i];

		$img = file_up($_temp_file,$_CONFIG['PATH_UPLOAD_STOCKIST'].$upload_path,'','',true); // 이미지 업로드
		if($img!='') {
			$img_file[] = $_CONFIG['URL_UPLOAD_STOCKIST'].$upload_path.$img;
			// 썸네일 생성
			@make_thumbnail($_CONFIG['PATH_UPLOAD_STOCKIST'].$upload_path.$img, 160, 90, $_CONFIG['PATH_UPLOAD_STOCKIST'].$upload_path.'thumbnail/'.$img);
			$img_thumbnail[] = $_CONFIG['URL_UPLOAD_STOCKIST'].$upload_path.'thumbnail/'.$img;
		}
	}

	if(is_array($img_file)) {
		$nums = db_count($_TABLE['STOCKIST_IMAGE'],'STOCK_IDX='.$no)+1;
		for($i=0;$i<sizeof($img_file);$i++) {
			$result = db_insert(
				$_TABLE['STOCKIST_IMAGE'],
				'STOCK_NO,SEQ,IMG,THUMB,STATUS',
				$no.','.($nums+$i).',"'.$img_file[$i].'","'.$img_thumbnail[$i].'","Y"'
			);
		}
	}
}


if($result && is_numeric($no)) {
	// 삭제한 스토어 DB에서 정리
	$where = 'STOCK_NO='.$no;
	if(is_array($store_no)) {
		$where .= ' AND IDX NOT IN ('.implode(',',$store_no).')';
	}
	$result = db_delete($_TABLE['STOCKIST_STORE'],$where);

	if(is_array($store_no)) {
		$json_result['store'] = implode(',',$store_no);
		for($i=0;$i<count($store_no);$i++) {
			$img = '';
			$seq = $i+1;
			$store_upload_img = '';
			$store_upload_thumb = '';

			if($_FILES['store_img']['name'][$i] != '') {
				$_temp_file['name'] = $_FILES['store_img']['name'][$i];
				$_temp_file['type'] = $_FILES['store_img']['type'][$i];
				$_temp_file['tmp_name'] = $_FILES['store_img']['tmp_name'][$i];
				$_temp_file['error'] = $_FILES['store_img']['error'][$i];
				$_temp_file['size'] = $_FILES['store_img']['size'][$i];

				$img = file_up($_temp_file,$_CONFIG['PATH_UPLOAD_STOCKIST'].$upload_path,'','',true); // 이미지 업로드
				if($img!='') {
					$store_upload_img = $_CONFIG['URL_UPLOAD_STOCKIST'].$upload_path.$img;
					// 썸네일 생성
					@make_thumbnail($_CONFIG['PATH_UPLOAD_STOCKIST'].$upload_path.$img, 160, 90, $_CONFIG['PATH_UPLOAD_STOCKIST'].$upload_path.'thumbnail/'.$img);
					$store_upload_thumb = $_CONFIG['URL_UPLOAD_STOCKIST'].$upload_path.'thumbnail/'.$img;
				}
			}
			
			if(intval($store_no[$i]) > 0) {
				$query = '
					SEQ='.$seq.',
					NAME="'.$store_name[$i].'",
					STATUS="'.$store_status[$i].'"
				';
				if($store_upload_img != '') {
					$query .= '
						,IMG="'.$store_upload_img.'"
						,THUMB="'.$store_upload_thumb.'"
					';
				}
				$result = db_update($_TABLE['STOCKIST_STORE'],$query,'IDX='.$store_no[$i]);
			}
			elseif($store_name[$i] != '') {
				$result = db_insert(
					$_TABLE['STOCKIST_STORE'],
					'STOCK_NO,SEQ,NAME,IMG,THUMB,STATUS',
					$no.','.$seq.',"'.$store_name[$i].'","'.$store_upload_img.'","'.$store_upload_thumb.'","'.$store_status[$i].'"'
				);
			}
		}
	}
}
*/
?>