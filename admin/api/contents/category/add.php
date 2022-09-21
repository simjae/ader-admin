<?php
/*=============================================================

   상품 등록
   ------



  =============================================================*/

/** 01. 변수 정리 **/
if(!is_numeric($goods_category) || $goods_category == '') {
	$goods_category = 0;
}

$price_size = intval($price_size);
$category = strtoupper($category);
$status = (strtoupper($status)=='Y')?'Y':'N';
$soldout_yn = (strtoupper($soldout)=='Y')?'Y':'N';
$stock_yn = (strtoupper($stock_yn)=='Y')?'Y':'N';
$is_ticket = (strtoupper($is_ticket)=='Y')?'Y':'N';
$allday_yn = (strtoupper($allday_yn)=='Y')?'Y':'N';
$selltime_yn = (strtoupper($selltime_yn)=='Y')?'Y':'N';
$add_text = strip_tags(str_replace(array('&nbsp;','<div>'),array(' ',chr(10)),$add_text));
$name = strip_tags(str_replace(array('&nbsp;','<div>'),array(' ',chr(10)),$name));
$name_min = strip_tags(str_replace(array('&nbsp;','<div>'),array(' ',chr(10)),$name_min));
$contents = strip_tags(str_replace(array('&nbsp;','<div>'),array(' ',chr(10)),$contents));
$selltime_s = intval($selltime_s);
$selltime_e = intval($selltime_e);
if(!is_numeric($seq)) $seq = 1;
if(!is_numeric($ticket_cnt)) $ticket_cnt = 1;
if(is_array($selltime_week)) $selltime_week = implode(',',$selltime_week);
if($type != 0) $map_type = '유형'.$type; // 좌석 유형이 default(일반석) 아닐 경우 200928 khw

$s030 = floatval($s030)*10;
$s031 = intval($s031);
$s032 = intval($s032);
$s033 = intval($s033);
$s034 = intval($s034);
$s036 = intval($s036);
$s038 = intval($s038);
$s040 = intval($s040);
$s042 = floatval($s042)*10;
$s043 = floatval($s043)*10;
$s044 = floatval($s044)*10;
$s045 = floatval($s045)*10;
$s046 = floatval($s046)*10;
$s047 = floatval($s047)*10;
$s048 = floatval($s048)*10;
$s049 = floatval($s049)*10;
$out_ice = floatval($out_ice)*10;
$out_water = floatval($out_water)*10;
$is_cold = (strtoupper($is_cold)=='Y')?'Y':'N';

if(is_numeric($_SESSION[SS_HEAD.'NO'])) {
	$store_no = $_SESSION[SS_HEAD.'STORE_NO'];
	$client_no = $_SESSION[SS_HEAD.'NO'];
}
if(!is_numeric($store_no) || $store_no == '') {
	$client_id = str_replace(' ','',trim($client_id));
	if(is_string($client_id)) {
		$client_data = db_get($_TABLE['CLIENT_USER'],'ID="'.$client_id.'"');
		$client_no = intval($client_data['CLIENT_NO']);
		$store_no = intval($client_data['STORE_NO']);
	}
	else {
		$result = false;
	}
}


if($_FILES['file']['size']>0) {
	$img = file_up($_FILES['file'],$_CONFIG['PATH_UPLOAD_CONTENTS'],'','',true); // 이미지 업로드
	// 썸네일 생성
	@make_thumbnail($_CONFIG['PATH_UPLOAD_CONTENTS'].$img, 120, 120, $_CONFIG['PATH_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$img); 
	$thumb = $_CONFIG['URL_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$img;
	$file = $_CONFIG['URL_UPLOAD_CONTENTS'].$img;
}
if($_FILES['img_detail']['size']>0) {
	$img_detail = file_up($_FILES['img_detail'],$_CONFIG['PATH_UPLOAD_CONTENTS'],'','',true); // 이미지 업로드
	// 썸네일 생성
	@make_thumbnail($_CONFIG['PATH_UPLOAD_CONTENTS'].$img_detail, 120, 120, $_CONFIG['PATH_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$img_detail); 
	$img_detail_thumb = $_CONFIG['URL_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$img_detail;
	$img_detail = $_CONFIG['URL_UPLOAD_CONTENTS'].$img_detail;
}
if(!is_numeric($price)) {
	$result = false;
	$code = 999;
	$msg = 'PRICE 숫자만 입력되어야 합니다.';
}
elseif(in_array($category,array('FOOD','기타')) == false && in_array($store_data['CATEGORY'],array('독서실','메일빈')) == false) {
	if(!is_numeric($expire_min)) {
		$result = false;
		$code = 999;
		$msg = '티켓 이용시간이 입력되지 않았습니다.';
	}
	elseif(!is_numeric($expire_date) && in_array($category,array('STUDYROOM_TIME_TICKET','STUDYROOM_TIME_TICKET_EXT'))) {
		$result = false;
		$code = 999;
		$msg = '유효기간이 입력되지 않았습니다.';
	}
	elseif(!is_numeric($time_s) && $time_s != '') {
		$result = false;
		$code = 999;
		$msg = '이용가능 시작시간이 입력되지 않았습니다.';
	}
	elseif(!is_numeric($time_e) && $time_e != '') {
		$result = false;
		$code = 999;
		$msg = '이용가능 종료시간이 입력되지 않았습니다.';
	}
}
if($result) {
	$data = db_get($_TABLE['GOODS'],'IDX='.$no);

	if($store_data['CATEGORY'] == '메일빈') {
		$category = '음료';
		$target_no = $data['TARGET_NO'];
	}

	switch($category) {
		case 'STUDYROOM_TIME_TICKET':
		case 'STUDYROOM_TIME_TICKET_EXT':
			break;
		case 'STUDYROOM':
		case 'STUDYROOM_EXT':
		case 'STUDYROOM_SINGLE':
		case 'STUDYROOM_SINGLE_EXT':
			$expire_date = round($expire_min/24)+1;
			break;
		default:
			$expire_date = $expire_min;
	}

	$expire_min = floatval($expire_min) * 60; // 시간 --> 분   //구버전에서 상품을 분 단위로도 만들기 위해 소수점 허용 200803 kkh
	if(in_array($category,array(
		'STUDYROOM_SEASON_TICKET','STUDYROOM_SEASON_TICKET_EXT','FIXED_SEAT','FIXED_SEAT_EXT','LOCKER','LOCKER_EXT',
		'사우나 정기권','헬스장 정기권','사우나 정기권 연장','헬스장 정기권 연장')
	) === true) {
		$expire_min *= 24; // 시간 --> 분 --> 일
	}

	if($no && is_numeric($no)) {
		if($data['STATUS'] == 'DELETE') $status = 'DELETE';
		if($store_data['CATEGORY'] == '메일빈') {
			$result = db_update(
				$_TABLE['GOODS_MAILBEAN'],
				'
					S030 = "'.$s030.'",
					S031 = "'.$s031.'",
					S032 = "'.$s032.'",
					S033 = "'.$s033.'",
					S034 = "'.$s034.'",
					S036 = "'.$s036.'",
					S038 = "'.$s038.'",
					S040 = "'.$s040.'",
					S042 = "'.$s042.'",
					S043 = "'.$s043.'",
					S044 = "'.$s044.'",
					S045 = "'.$s045.'",
					S046 = "'.$s046.'",
					S047 = "'.$s047.'",
					S048 = "'.$s048.'",
					S049 = "'.$s049.'",
					IS_COLD = "'.$is_cold.'",
					OUT_ICE = "'.$out_ice.'",
					OUT_WATER = "'.$out_water.'"
				',
				'IDX="'.$data['TARGET_NO'].'"'
			);
		}

		$query = '
			CATEGORY = "'.$category.'",
			CATEGORY_NO = "'.$goods_category.'",
			NAME = "'.$name.'",
			NAME_MIN = "'.$name_min.'",
			CONTENTS = "'.$contents.'",
			PRICE = "'.$price.'",
			PRICE_SIZE = "'.$price_size.'",
			EXPIRE_MIN = "'.$expire_min.'",
			TARGET_NO = "'.$target_no.'",
			TIME_S = "'.$time_s.'",
			TIME_E = "'.$time_e.'",
			ALLDAY_YN = "'.$allday_yn.'",
			IS_TICKET = "'.$is_ticket.'",
			IN_LOCATION = "'.$in_location.'",
			MAP_TYPE ="'.$map_type.'",
			TICKET_CNT = "'.$ticket_cnt.'",
			ADD_TEXT = "'.$add_text.'",
			NAME_COLOR = "'.$name_color.'",
			NAME_SIZE = "'.$name_size.'",
			STOCK = "'.$stock.'",
			STOCK_YN = "'.$stock_yn.'",
			SOLDOUT_YN = "'.$soldout_yn.'",
			SELLTIME_YN = "'.$selltime_yn.'",
			SELLTIME_S = "'.$selltime_s.'",
			SELLTIME_E = "'.$selltime_e.'",
			SELLTIME_WEEK = "'.$selltime_week.'",
			STATUS = "'.$status.'",
			EXPIRE_DATE = "'.$expire_date.'",
			LINPUT_DATE = NOW()
		';
		// if($seq != 1 && $store_data['CATEGORY'] != '스터디까페') // 구버전에서는 SEQ 업데이트 되지 않도록 200715khw
		$query .= ', SEQ = "'.$seq.'"';
		if($file) $query .= ',IMG="'.$file.'" ';
		if($img_detail) $query .= ',IMG_DETAIL="'.$img_detail.'" ';
		$result = db_update($_TABLE['GOODS'],$query,'IDX='.$no);
		$json_result['mode'] = 'update';



	}
	else {
		if($store_data['CATEGORY'] == '메일빈') {
			$result = db_insert(
				$_TABLE['GOODS_MAILBEAN'],
				'
					NAME,
					S030,S031,S032,S033,S034,S036,S038,S040,S042,S043,S044,S045,S046,S047,S048,S049,
					IS_COLD,OUT_ICE,OUT_WATER
				',
				'
					"'.$name.'",
					"'.$s030.'","'.$s031.'","'.$s032.'","'.$s033.'","'.$s034.'","'.$s036.'","'.$s038.'","'.$s040.'",
					"'.$s042.'","'.$s043.'","'.$s044.'","'.$s045.'","'.$s046.'","'.$s047.'","'.$s048.'","'.$s049.'",
					"'.$is_cold.'","'.$out_ice.'","'.$out_water.'"
				'
			);
			$target_no = db_lastidx();
		}

		$fields = '
			STORE_NO,USER_NO,SEQ,CATEGORY,CATEGORY_NO,
			NAME,NAME_MIN,PRICE,PRICE_SIZE,CONTENTS,
			EXPIRE_MIN,TIME_S,TIME_E,ALLDAY_YN,IN_LOCATION,MAP_TYPE,
			TICKET_CNT,IS_TICKET,NAME_SIZE,NAME_COLOR,
			ADD_TEXT,TARGET_NO,IMG,IMG_DETAIL,
			STOCK,STOCK_YN,SOLDOUT_YN,
			SELLTIME_YN,SELLTIME_S,SELLTIME_E,SELLTIME_WEEK,
			STATUS,EXPIRE_DATE
		';
		$values = '
			"'.$store_no.'","'.$client_no.'","'.$seq.'","'.$category.'","'.$goods_category.'",
			"'.$name.'","'.$name_min.'","'.$price.'","'.$price_size.'","'.$contents.'",
			"'.$expire_min.'","'.$time_s.'","'.$time_e.'","'.$allday_yn.'","'.$in_location.'","'.$map_type.'",
			"'.$ticket_cnt.'","'.$is_ticket.'","'.$name_size.'","'.$name_color.'",
			"'.$add_text.'","'.$target_no.'","'.$file.'","'.$img_detail.'",
			"'.$stock.'","'.$stock_yn.'","'.$soldout_yn.'",
			"'.$selltime_yn.'","'.$selltime_s.'","'.$selltime_e.'","'.$selltime_week.'",
			"'.$status.'","'.$expire_date.'"
		';
		$result = db_insert($_TABLE['GOODS'],$fields,$values);
		$no = db_lastidx();
		$json_result['mode'] = 'put';

	}
	if(!$result) {
		$code = 500;
	}
	
	// 추가 정보 등록
	else {
		$result = db_delete($_TABLE['MAP_ZONE_GOODS'],'GOODS_NO='.$no.' AND TYPE_NO != "'.$type_no.'"');
		if(is_array($zone_no)) {
			$result = db_delete($_TABLE['MAP_ZONE_GOODS'],'GOODS_NO='.$no.' AND ZONE_NO NOT IN ('.implode(',',$zone_no).')');
			for($i=0;$i<sizeof($zone_no);$i++) {
				if(db_count($_TABLE['MAP_ZONE_GOODS'],'GOODS_NO='.$no.' AND ZONE_NO='.$zone_no[$i].' AND TYPE_NO='.$type_no) == 0) {
					$result = db_insert(
						$_TABLE['MAP_ZONE_GOODS'],
						'ZONE_NO,TYPE_NO,GOODS_NO',
						$zone_no[$i].','.$type_no.','.$no
					);
				}
			}
		}
	}
}

if($result) {
	if(is_array($food_extra_no_arr)) {
		@db_delete($_TABLE['GOODS_EXT'],'GOODS_NO='.$no.' AND IDX NOT IN ('.implode(',',$food_extra_no_arr).')');

		$array_max = 0;
		foreach($food_extra_no_arr as $key => $val) {
			$array_max = ($key>$array_max)?$key:$array_max;
		}
		for($i=0;$i<=intval($array_max);$i++) {
			if(isset($food_extra_no_arr[$i])) {
				$food_extra_status_arr[$i] = strtoupper($food_extra_status_arr[$i]);
				if($food_extra_status_arr[$i] != 'Y') $food_extra_status_arr[$i] = 'N';
				if(!is_numeric($food_extra_maxorder_arr[$i]) || $food_extra_maxorder_arr[$i] == '') $food_extra_maxorder_arr[$i] = 999;

				// 이미지 업로드
				$image = $food_extra_imagesrc_arr[$i];
				if($_FILES['food_extra_image_arr']['size'][$i] > 0) {
					$_temp_file['name'] = $_FILES['food_extra_image_arr']['name'][$i];
					$_temp_file['type'] = $_FILES['food_extra_image_arr']['type'][$i];
					$_temp_file['tmp_name'] = $_FILES['food_extra_image_arr']['tmp_name'][$i];
					$_temp_file['error'] = $_FILES['food_extra_image_arr']['error'][$i];
					$_temp_file['size'] = $_FILES['food_extra_image_arr']['size'][$i];
					$image = file_up($_temp_file,$_CONFIG['PATH_UPLOAD_CONTENTS'],'','',true); // 이미지 업로드
					// 썸네일 생성
					@make_thumbnail($_CONFIG['PATH_UPLOAD_CONTENTS'].$image, 120, 120, $_CONFIG['PATH_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$image); 
					$thumb = $_CONFIG['URL_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$image;
					$image = $_CONFIG['URL_UPLOAD_CONTENTS'].$image;
				}

				if($food_extra_no_arr[$i] > 0) {
					$result = db_update(
						$_TABLE['GOODS_EXT'],
						'
							NAME = "'.$food_extra_name_arr[$i].'",
							PRICE = "'.$food_extra_price_arr[$i].'",
							CATEGORY = "'.$food_extra_category_arr[$i].'",
							CONTENTS = "'.$food_extra_contents_arr[$i].'",
							IMG = "'.$image.'",
							MAXORDER = "'.$food_extra_maxorder_arr[$i].'",
							STATUS = "'.$food_extra_status_arr[$i].'",
							LINPUT_DATE=NOW()
						',
						'IDX='.$food_extra_no_arr[$i]
					);
					
					if($store_no == 454) { // 세이치 요청 기능 임시 구현 : 옵션명이 같을 경우 on/off 일괄 적용 201014 khw
						$result = db_update(
							$_TABLE['GOODS_EXT'],
							'
								STATUS = "'.$food_extra_status_arr[$i].'",
								LINPUT_DATE=NOW()
							',
							'
							NAME = "'.$food_extra_name_arr[$i].'"
							AND GOODS_NO IN (SELECT IDX FROM GOODS WHERE STORE_NO = "'.$store_no.'")'
						);
					}
				}
				else {
					$result = db_insert(
						$_TABLE['GOODS_EXT'],
						'
							GOODS_NO,CATEGORY,
							NAME,CONTENTS,IMG,
							PRICE,MAXORDER,STATUS
						',
						$no.',"'.$food_extra_category_arr[$i].'",
						"'.$food_extra_name_arr[$i].'","'.$food_extra_contents_arr[$i].'","'.$image.'",
						"'.$food_extra_price_arr[$i].'","'.$food_extra_maxorder_arr[$i].'","'.$food_extra_status_arr[$i].'"'
					);
					$food_extra_no_arr[$i] = db_lastidx();
				}

				// 선택형 옵션의 경우 추가 DB작업
				if($food_extra_category_arr[$i] == '선택') {
					if(isset($food_extra_val_no_arr[$i])) {
						@db_delete($_TABLE['GOODS_EXT_VAL'],
							'OPTION_NO='.$food_extra_no_arr[$i].' AND IDX NOT IN ('.implode(',',$food_extra_val_no_arr[$i]).')'
						);
		
						$array_max_j = 0;
						foreach($food_extra_val_no_arr[$i] as $key => $val) {
							$array_max_j = ($key>$array_max_j)?$key:$array_max_j;
						}
						for($j=0;$j<=intval($array_max_j);$j++) {
							if(isset($food_extra_val_no_arr[$i][$j])) {
								// 이미지 업로드
								//$image = $food_extra_val_image_arr[$i][$j];
								$image = '';
								if($_FILES['food_extra_val_image_arr']['size'][$i][$j] > 0) {
									$_temp_file['name'] = $_FILES['food_extra_val_image_arr']['name'][$i][$j];
									$_temp_file['type'] = $_FILES['food_extra_val_image_arr']['type'][$i][$j];
									$_temp_file['tmp_name'] = $_FILES['food_extra_val_image_arr']['tmp_name'][$i][$j];
									$_temp_file['error'] = $_FILES['food_extra_val_image_arr']['error'][$i][$j];
									$_temp_file['size'] = $_FILES['food_extra_val_image_arr']['size'][$i][$j];
									$image = file_up($_temp_file,$_CONFIG['PATH_UPLOAD_CONTENTS'],'','',true); // 이미지 업로드
									// 썸네일 생성
									@make_thumbnail($_CONFIG['PATH_UPLOAD_CONTENTS'].$image, 120, 120, $_CONFIG['PATH_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$image); 
									$thumb = $_CONFIG['URL_UPLOAD_CONTENTS'].'thumbnail'.$_CONFIG['SEPARATOR'].$image;
									$image = $_CONFIG['URL_UPLOAD_CONTENTS'].$image;
								}

								if($food_extra_val_no_arr[$i][$j] > 0) {
									$result = db_update(
										$_TABLE['GOODS_EXT_VAL'],
										'
											NAME = "'.$food_extra_val_name_arr[$i][$j].'",
											PRICE = "'.$food_extra_val_price_arr[$i][$j].'",
											LINPUT_DATE=NOW()
										'.(($image!='')?',IMG="'.$image.'"':''),
										'IDX='.$food_extra_val_no_arr[$i][$j]
									);
								}
								else {
									$result = db_insert(
										$_TABLE['GOODS_EXT_VAL'],
										'
											OPTION_NO,NAME,
											IMG,PRICE
										',
										$food_extra_no_arr[$i].',"'.$food_extra_val_name_arr[$i][$j].'",
										"'.$image.'","'.$food_extra_val_price_arr[$i][$j].'"'
									);
								}
							}
						}


					}
					else {
						@db_delete($_TABLE['GOODS_EXT_VAL'],'OPTION_NO='.$food_extra_no_arr[$i]);
					}
				}
			}
		}
	}
	else {
		@db_delete($_TABLE['GOODS_EXT'],'GOODS_NO='.$no);
	}
}

if($result) {
	/** 키오스크에 반영 **/
	for($i=0;$i<intval($store_data['POS_CNT']);$i++) DeviceRemoteCommand($i,'program/goods-refresh');
}

?>